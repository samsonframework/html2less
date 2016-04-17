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

        /** @var \DOMDocument $dom Pointer to current dom element */
        $dom = new \DOMDocument();
        $dom->loadHTML($source, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // Perform recursive node analysis
        return $this->analyzeSourceNode($dom);
    }

    /**
     * Perform source node analysis.
     *
     * @param \DOMNode $domNode
     * @param Node     $parent
     *
     * @return Node
     */
    protected function &analyzeSourceNode(\DOMNode $domNode, Node $parent = null)
    {
        $node = null;
        foreach ($domNode->childNodes as $child) {
            $tag = $child->nodeName;

            // Work only with allowed DOMElements
            if ($child->nodeType === 1 && !in_array($tag, static::$ignoredNodes, true)) {
                // Get node classes
                $classes = array_filter(explode(' ', $this->getDOMAttributeValue($child, 'class')));

                $selector = $this->getSelector($child, $tag);

                // Find child node by selector
                $node = $parent !== null ? $parent->getChild($selector) : null;

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

        return $node;
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
            /**@var \DOMAttr $attribute */
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
     * Get current \DOMNode LESS selector.
     *
     * @param \DOMNode $child
     * @param string   $tag
     * @param array    $classes
     *
     * @return string LESS selector
     */
    protected function getSelector(\DOMNode $child, $tag, array $classes = array())
    {
        // Define less node selector
        if (($identifier = $this->getDOMAttributeValue($child, 'id')) !== null) {
            return '#' . $identifier;
        } elseif (count($classes)) {
            return '.' . array_shift($classes);
        } elseif (($name = $this->getDOMAttributeValue($child, 'name')) !== null) {
            return $tag . '[name=' . $name . ']';
        } else {
            return $tag;
        }
    }

    /**
     * Render LESS tree. This function is recursive.
     *
     * @param Node   $node   Current LESS tree node
     * @param string $output Final LESS code string
     * @param int    $level  Current recursion level
     *
     * @return string LESS code
     */
    public function output(Node $node, $output = '', $level = 0)
    {
        // Output less node with spaces
        $output .= $this->spaces($level) . $node . ' {' . "\n";

        foreach ($node->children as $child) {
            $output = $this->output($child, $output, $level + 1);
        }

        // Close less node with spaces
        $output .= $this->spaces($level) . '}' . "\n";

        return $output;
    }

    /**
     * Get spaces for LESS tree level.
     *
     * @param int $level LESS tree depth
     *
     * @return string Spaces for current LESS tree depth
     */
    protected function spaces($level = 0)
    {
        return implode('', array_fill(0, $level, '  '));
    }
}
