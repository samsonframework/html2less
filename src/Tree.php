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
        return $this->analyzeSourceNode($dom, new Node('', ''));
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
            if ($child->nodeType === 1 && !in_array($tag, static::$ignoredNodes, true)) {
                // Get node classes
                $classes = array_filter(explode(' ', $this->getDOMAttributeValue($child, 'class')));

                // Get LESS node selector
                $selector = $this->getSelector($child, $tag, $classes);

                // Ignore divs as generic markup element
                if ($selector !== 'div') {
                    // Find child node by selector
                    $node = $parent !== null ? $parent->getChild($selector) : null;

                    // Check if we have created this selector LessNode for this branch
                    if (null === $node) {
                        // Create internal node instance
                        $node = new Node($selector, $tag, $parent);
                    }

                    // Create inner class modifiers for parent node
                    foreach ($classes as $class) {
                        // Create inner node without correct tag to avoid grouping bugs
                        new Node('&.' . $class, '&.' . $class, $node);
                    }

                    // Go deeper in recursion
                    $this->analyzeSourceNode($child, $node);
                } else {
                    // Go deeper in recursion
                    $this->analyzeSourceNode($child, $parent);
                }
            }
        }

        if (null !== $parent) {
            /** @var Node[string] $tagNodes Group current level nodes by tags */
            $tagNodes = [];
            foreach ($parent->children as $child) {
                // Ignore DIV as generic markup element
                if ($child->tag !== 'div') {
                    $tagNodes[$child->tag][$child->selector] = $child;
                }
            }

            // Check if we have inner nodes with same tag
            foreach ($tagNodes as $tag => $nodes) {
                if (count($nodes) > 1) {
                    /**
                     * @var Node $matchingTagNode
                     * If we already had LESS node for this tag then we have
                     * already replaced it with group tag so we do not need
                     * to re-remove it from parent as it is already a new one
                     */
                    $matchingTagNode = null;
                    if (array_key_exists($tag, $nodes)) {
                        $matchingTagNode = $nodes[$tag];
                        unset($nodes[$tag]);
                    }

                    $tagNode = new Node($tag, $tag, $parent);

                    foreach ($nodes as $selector => $child) {
                        // Attach child to new grouped tag node
                        $child->parent = &$tagNode;
                        $tagNode->children[$selector] = $child;
                        // Append & for inner nodes
                        $child->selector = '&' . ltrim($child->selector, '&');
                        // Remove child from current parent
                        unset($parent->children[$selector]);
                    }

                    // Add matching tag node children to new grouped tag
                    if (null !== $matchingTagNode) {
                        foreach ($matchingTagNode->children as $selector => $child) {
                            // Attach child to new grouped tag node
                            $child->parent = &$tagNode;
                            $tagNode->children[$selector] = $child;
                        }
                    }
                }
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
    protected function getSelector(\DOMNode $child, $tag, array &$classes)
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
        $output .= $this->spaces($level) . $node . '{' . "\n";

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
