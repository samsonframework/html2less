<?php

namespace samsonframework\html2less\tests;

use samsonframework\html2less\Tree;

/**
 * Created by <egorov@samsonos.com>
 * on 18.04.16 at 17:20.
 */
class TreeTest extends \PHPUnit_Framework_TestCase
{
    /** @var Tree */
    protected $lessTree;

    /** Init tests */
    public function setUp()
    {
        $this->lessTree = new Tree();

        parent::setUp(); // TODO: Change the autogenerated stub
    }

    public function testTagGroupingAtSameLevel()
    {
        // HTML code block
        $html = <<<'HTML'
    <div id="testDIVIdentifier" class="test-class">
        <div>
            <a><span>Test link</span></a>
            <a id="testAIdentifier"><span>Test link 2</span></a>
            <a><span>Test link 3</span></a>
            <a id="testAIdentifier2"><span id="testSPANIdentifier">Test link 4</span></a>
        </div>
        <div class="testDIV">

        </div>
        <div id="testDIVIdentifier">

        </div>
    </div>
HTML;

        $expected = <<<'LESS'
{
  #testDIVIdentifier {
    &.test-class {
    }
    a {
      &#testAIdentifier {
        span {
        }
      }
      &#testAIdentifier2 {
        #testSPANIdentifier {
        }
      }
      span {
      }
    }
    .testDIV {
    }
    #testDIVIdentifier {
    }
  }
}

LESS;

        $tree = new Tree();
        $lessTree = $tree->build($html);
        $output = $tree->output($lessTree);
        $this->assertEquals($expected, $output);
    }

    public function testInnerGroupingBug()
    {
        $html = <<<'HTML'
<div class="share-hidden">
    <div class="share">
        <div class="share-header">
            <?php t('Share with your friends') ?>
        </div>

        <div class="all-share">
            <a class="goodshare one-share fb" data-type="fb" href="#"></a>
            <a class="goodshare one-share tw" data-type="tw" href="#"></a>
            <a class="badshare one-share gp" data-type="gp" href="#"></a>
            <a class="goodshare one-share gp" data-type="gp" href="#"></a>
        </div>
    </div>
</div>
HTML;
        $expected = <<<'LESS'
{
  .share-hidden {
    .share {
      .share-header {
      }
      .all-share {
        a {
          &.goodshare {
            &.one-share {
            }
            &.fb {
            }
            &.tw {
            }
            &.gp {
            }
          }
          &.badshare {
            &.one-share {
            }
            &.gp {
            }
          }
        }
      }
    }
  }
}

LESS;

        $tree = new Tree();
        $lessTree = $tree->build($html);
        $output = $tree->output($lessTree);
        $this->assertEquals($expected, $output);
    }
}
