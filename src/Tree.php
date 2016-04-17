<?php
namespace samsonframework\html2less;

/**
 * Created by Vitaly Iegorov <egorov@samsonos.com>.
 * on 15.04.16 at 12:43
 */
class Tree
{
    /** @var array Collection of ignored DOM nodes */
    public static $ignoredNodes = array(
        'head',
        'meta',
        'script',
        'noscript',
        'link',
        'title',
        'br',
    );

    /**
     * Build destination code tree from source code.
     *
     * @param string $source Source code
     *
     * @return Node Less tree root node
     */
    public function build($source)
    {
        // Prepare source code
        $source = $this->prepare($source);

        // Build destination node tree
        return $this->analyze($source);
    }

    /**
     * Source code cleaner.
     *
     * @param string $source
     *
     * @return string Cleared source code
     */
    protected function prepare($source)
    {
        // Remove all PHP code from view
        return trim(preg_replace('/<\?(php|=).*?\?>/', '', $source));
    }

    /**
     * Analyze source code and create destination code tree.
     *
     * @param string $source Source code
     *
     * @return Node Internal code tree
     */
    protected function &analyze($source)
    {
        libxml_use_internal_errors(true);

        /** @var \DOMNode Pointer to current dom element */
        $dom = new \DOMDocument();
        $dom->loadHTML($source);

        // Perform recursive node analysis
        return $this->analyzeSourceNode($dom, new Node(''));
    }

    /**
     * Perform source node analysis.
     *
     * @param \DOMNode $domNode
     * @param Node     $parent
     *
     * @return Node
     */
    protected function &analyzeSourceNode(\DOMNode $domNode, Node $parent)
    {
        foreach ($domNode->childNodes as $child) {
            $tag = $child->nodeName;

            // Work only with allowed DOMElements
            if ($child->nodeType === 1 && !in_array($tag, static::$ignoredNodes)) {
                // Get node classes
                $classes = array_filter(explode(' ', $this->getDOMAttributeValue($child, 'class')));

                // Define less node selector
                $selector = $tag;
                if (($identifier = $this->getDOMAttributeValue($child, 'id')) !== null) {
                    $selector = '#' . $identifier;
                } elseif (count($classes)) {
                    $selector = '.' . array_shift($classes);
                } elseif (($name = $this->getDOMAttributeValue($child, 'name')) !== null) {
                    $selector = $tag . '[name=' . $name . ']';
                }

                // Find child node by selector
                $node = $parent->getChild($selector);

                // Check if we have created this selector LessNode for this branch
                if (null === $node) {
                    // Create internal node instance
                    $node = new Node($selector, $parent);
                }

                // Create inner class modifiers for parent node
                foreach ($classes as $class) {
                    new Node('&.' . $class, $node);
                }

                // Go deeper in recursion
                $this->analyzeSourceNode($child, $node);
            }
        }

        return $parent;
    }

    /**
     * Get DOM node attribute value.
     *
     * @param \DOMNode $domNode
     * @param string   $attributeName
     *
     * @return null|string DOM node attribute value
     */
    protected function getDOMAttributeValue(\DOMNode $domNode, $attributeName)
    {
        if (null !== $domNode->attributes) {
            /**@var \DOMNode $attribute */
            foreach ($domNode->attributes as $attribute) {
                $value = trim($attribute->nodeValue);
                // If DOM attribute matches needed
                if ($attributeName === $attribute->name && $value !== '') {
                    // Remove white spaces
                    return $value;
                }
            }
        }

        return null;
    }

    /**
     * @param Node   $node
     * @param string $output
     * @param int    $level
     *
     * @return string
     */
    public function output(Node $node, &$output = '', $level = 0)
    {
        // Define if this is not empty node and this is not generic nodes
        $hasSelector = isset($node->selector{0}) && !in_array($node->selector, array('html', 'body'));

        // Output less node with spaces
        if ($hasSelector) {
            $output .= implode('', array_fill(0, $level, '  ')) . $node . ' {' . "\n";
        }

        foreach ($node->children as $child) {
            $this->output($child, $output, $hasSelector ? $level + 1 : $level);
        }

        // Close less node with spaces
        if ($hasSelector) {
            $output .= implode('', array_fill(0, $level, '  ')) . '}' . "\n";
        }

        return $output;
    }
}
