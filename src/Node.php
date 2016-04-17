<?php
/**
 * Created by Vitaly Iegorov <egorov@samsonos.com>.
 * on 15.04.16 at 12:47
 */
namespace samsonframework\html2less;

/**
 * LESS tree node.
 *
 * @author    Vitaly Egorov <egorov@samsonos.com>
 * @copyright 2016 SamsonOS
 */
class Node
{
    /** @var string Selector for node */
    public $selector;
    /** @var $this Pointer to parent node */
    public $parent;
    /** @var $this [] Collection of nested nodes */
    public $children = array();

    /**
     * Create LESS Node
     *
     * @param string $selector Forced LESS node selector
     * @param        $this     $parent   Pointer to parent node
     */
    public function __construct($selector, self &$parent = null)
    {
        // Pointer to parent LESS Node
        $this->parent = &$parent;
        $this->selector = $selector;

        // Add this node to parent
        if (null !== $parent) {
            // Store child by selector to avoid duplication
            $parent->children[$this->selector] = $this;
        }
    }

    /**
     * Get child node by selector.
     *
     * @param string $selector Node selector
     *
     * @return null|$this Node or null if not found
     */
    public function getChild($selector)
    {
        if (array_key_exists($selector, $this->children)) {
            return $this->children[$selector];
        }

        return null;
    }

    /**
     * @return string Object string representation
     */
    public function __toString()
    {
        return $this->selector;
    }
}
