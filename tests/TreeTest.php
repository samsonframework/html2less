<?php
namespace samsonframework\html2less\tests;

use samsonframework\html2less\Tree;

/**
 * Created by <egorov@samsonos.com>
 * on 18.04.16 at 17:20
 */
class TreeTest extends \PHPUnit_Framework_TestCase
{
    public function testIdentifierNode()
    {
        // HTML code block
        $html = <<<'HTML'
    <div id="testDIVIdentifier" class="test-class">
        <a><span>Test link</span></a>
        <a id="testAIdentifier"><span>Test link 2</span></a>
        <a><span>Test link 3</span></a>
        <a id="testAIdentifier2"><span id="testSPANIdentifier">Test link 4</span></a>
    </div>
HTML;
        $expected = <<<'LESS'
#testDIVIdentifier {
  &.test-class {
  }
  a {
    span {
    }
  }
  #testAIdentifier {
    span {
    }
  }
  #testAIdentifier2 {
    #testSPANIdentifier {
    }
  }
}

LESS;

        $tree = new Tree();
        $lessTree = $tree->build($html);
        var_dump($tree->output($lessTree));
        $this->assertEquals($expected, $tree->output($lessTree));
    }
}
