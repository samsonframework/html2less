<?php
/**
 * Created by Vitaly Iegorov <egorov@samsonos.com>.
 * on 15.04.16 at 12:47
 */
namespace samsonframework\html2less;

/**
 * Internal HTML DOM node tree.
 *
 * @author    Vitaly Egorov <egorov@samsonos.com>
 * @copyright 2016 SamsonOS
 */
class HTMLDOMNode
{
    /** @var string HTML tag name */
    public $tag;
    /** @var string HTML identifier */
    public $identifier;
    /** @var string[] CSS class names collection */
    public $class = array();
    /** @var string HTML name attribute value */
    public $name;
    /** @var string Selector for node */
    public $selector;
    /** @var \DOMNode pointer to DOM node */
    public $dom;
    /** @var $this Pointer to parent node */
    public $parent;
    /** @var $this [] Collection of nested nodes */
    public $children = array();

    /**
     * Create LESS Node
     *
     * @param \DOMNode $node     Pointer to DOM node
     * @param          $this     $parent   Pointer to parent node
     * @param string   $selector Forced LESS node selector
     */
    public function __construct(\DOMNode &$node, self &$parent = null, $selector = null)
    {
        // Store pointer to DOM node
        $this->dom = &$node;
        // Store html tag
        $this->tag = $node->nodeName;
        // Pointer to parent LESS Node
        $this->parent = &$parent;

        // Fill all available node parameters
        if (null !== $node->attributes) {
            /**@var \DOMNode $attribute */
            foreach ($node->attributes as $attribute) {
                $value = trim($attribute->nodeValue);
                if ($value !== '') {
                    if ($attribute->name === 'class') {
                        $this->class = explode(' ', $value);
                    } elseif ($attribute->name === 'identifier') {
                        $this->identifier = $value;
                    } elseif ($attribute->name === 'name') {
                        $this->name = $value;
                    }
                }
            }
        }

        $this->selector = $selector;
        if (null !== $selector) {
            // Choose default LESS selector for node
            $this->selector = $this->tag;
            // If we have class attribute
            if (count($this->class)) {
                // Use the first class by default
                $this->selector = '.' . $this->class[0];
            }
        }
    }

    /**
     * @return string Object string representation
     */
    public function __toString()
    {
        return $this->tag . '[' . $this->selector . ']';
    }
}
