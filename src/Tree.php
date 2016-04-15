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
        'html',
        '.clear',
        '&.clear',
        '.clearfix',
        '&.clearfix',
        'body',
        'meta',
        'script',
        'link',
        'title',
        'br'
    );

    /**
     * Build destination code tree from source code.
     *
     * @param string $source Source code
     */
    public function build($source)
    {
        // Prepare source code
        $source = $this->prepare($source);

        // Build destination node tree
        $tree = $this->analyze($source);


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
     * @return HTMLDOMNode Internal code tree
     */
    protected function &analyze($source)
    {
        libxml_use_internal_errors(true);

        /** @var \DOMNode Pointer to current dom element */
        $dom = new \DOMDocument();
        $dom->loadHTML($source);

        // Perform recursive node analysis
        return $this->analyzeSourceNode($dom, new HTMLDOMNode(new \DOMNode()));
    }

    /**
     * Perform source node analysis.
     *
     * @param \DOMNode    $domNode
     * @param HTMLDOMNode $parent
     *
     * @return HTMLDOMNode
     */
    protected function &analyzeSourceNode(\DOMNode $domNode, HTMLDOMNode $parent)
    {
        /** @var \DOMNode[] $children */
        $children = [];
        /** @var array $tags tag name => count collection */
        $tags = [];

        // Work only with DOMElements
        foreach ($domNode->childNodes as $child) {
            if ($child->nodeType === 1) {
                $children[] = $child;

                // Get child node tag and count them
                $tag = $child->nodeName;
                if (!array_key_exists($tag, $tags)) {
                    $tags[$tag] = 1;
                } else {
                    $tags[$tag]++;
                }
            }
        }

        // Iterate all normal DOM nodes
        foreach ($children as $child) {
            // Create internal node instance
            $node = new HTMLDOMNode($child, $parent);

            // Go deeper in recursion
            $this->analyzeSourceNode($child, $node);
        }

        return $parent;
    }

    /**
     * Generate LESS code from current LESS Node tree
     *
     * @param string $html HTML code to parse
     *
     * @return string Generated LESS code from tree
     */
    public function toLESS($html = null)
    {
        $output = '';
        // If HTML is not empty
        if (isset($this->html{0})) {
            // Remove all PHP code from view
            $this->html = preg_replace('/<\?php.*?\?>/', '', $this->html);
            // Parse HTML
            $this->dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $this->dom->loadHTML($this->html);
            // Generate LESS Node tree
            $this->handleNode($this->dom, $this->path);
            // Generate recursively LESS code
            $this->_toLESS($this->path, $output);
        } else {
            $output = 'Nothing to convert =(';
        }
        return $output;
    }

    /**
     * Handle current DOM node and transform it to LESS node
     *
     * @param \DOMNode $node Pointer to current analyzed DOM node
     * @param array    $path
     *
     * @internal param \samsonos\php\skeleton\Node $parent Pointer to parent LESS Node
     */
    protected function handleNode(\DOMNode & $node, &$path = array())
    {
        // Collect normal HTML DOM nodes
        /** @var \DOMNode[] $children */
        $children = array();
        foreach ($node->childNodes as $child) {
            // Work only with DOMElements
            if ($child->nodeType == 1) {
                $children[] = $child;
            }
        }
        // Group current level HTML DOM nodes by tag name and count them
        $childrenTagArray = array();
        foreach ($children as $child) {
            $tag = $child->nodeName;
            if (!isset($childrenTagArray[$tag])) {
                $childrenTagArray[$tag] = 1;
            } else $childrenTagArray[$tag]++;
        }
        // Iterate all normal DOM nodes
        foreach ($children as $child) {
            // Create LESS node
            $childNode = new HTMLDOMNode($child);
            // If this LESS node has NO CSS classes
            if (sizeof($childNode->class) == 0) {
                // Create new multidimensional array key group
                if (!isset($path[$child->nodeName])) {
                    $path[$child->nodeName] = array();
                }
                // Go deeper in recursion with current child node and new path
                $this->handleNode($child, $path[$child->nodeName]);
            } else { // This child DOM node has CSS classes
                // Get first node class and remove it from array og classes
                $firstClass = array_shift($childNode->class);
                // Save current LESS path
                $oldPath = &$path;
                // If there is more than one DOM child node with this tag name at this level
                if ($childrenTagArray[$childNode->tag] > 1 && $childNode->tag != 'div') {
                    // Create correct LESS class name
                    $class = '&.' . $firstClass;
                    // Create new multidimensional array key group with tag name group
                    if (!isset($path[$child->nodeName][$class])) {
                        $path[$child->nodeName][$class] = array();
                    }
                    // Go deeper in recursion with current child node and new path with tag name group and CSS class name group
                    $this->handleNode($child, $path[$child->nodeName][$class]);
                    // Make new path as current
                    $path = &$path[$child->nodeName][$class];
                } else { // There is only on child with this tag name at this level
                    // Create correct LESS class name
                    $class = '.' . $firstClass;
                    // Create new multidimensional array key group without tag name group
                    if (!isset($path[$class])) {
                        $path[$class] = array();
                    }
                    // Go deeper in recursion with current child node and new path with CSS class name group
                    $this->handleNode($child, $path[$class]);
                    // Make new path as current
                    $path = &$path[$class];
                }
                // Iterate all other classes starting from second class
                foreach ($childNode->class as $class) {
                    // Create correct LESS class name
                    $class = '&.' . $class;
                    // Create new multidimensional array key group with tag name group
                    if (!isset($path[$class])) {
                        $path[$class] = array();
                    }
                    // Go deeper in recursion with current child node and new path with tag name group and CSS class name group
                    $this->handleNode($child, $path[$class]);
                }
                // Return old LESS path tree
                $path = &$oldPath;
            }
        }
    }

    /**
     * Inner recursive output LESS generator
     *
     * @param array  $node   Current LESS path array pointer
     * @param string $output Current LESS text output
     * @param int    $level  Current LESS nesting level
     */
    protected function _toLESS(array $node, & $output = '', $level = 0)
    {
        // Iterate all LESS path node array
        foreach ($node as $key => $child) {
            // Flag for rendering current LESS path node
            $render = !in_array($key, self::$ignoredNodes);
            // If this path key is not ignored
            if ($render) {
                $output .= "\n" . $this->spacer($level) . $key . ' {';
            }
            // Go deeper in recursion
            $this->_toLESS($child, $output, $render ? $level + 1 : $level);
            // If this path key is not ignored
            if ($render) {
                $output .= "\n" . $this->spacer($level) . '}';
            }
        }
    }

    /**
     * Generate spaces for specific code level
     *
     * @param integer $level Current code nesting level
     *
     * @return string Spaces string
     */
    protected function spacer($level)
    {
        $result = '';
        for ($i = 0; $i < $level; $i++) {
            $result .= '  ';
        }
        return $result;
    }

}