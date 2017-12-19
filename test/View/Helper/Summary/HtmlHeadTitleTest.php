<?php
namespace LeoGalleguillos\SummaryTest\View\Helper\Summary;

use ArrayObject;
use LeoGalleguillos\Summary\View\Helper\Summary\HtmlHeadTitle as HtmlHeadTitleHelper;
use PHPUnit\Framework\TestCase;

class HtmlHeadTitleTest extends TestCase
{
    protected function setUp()
    {
        $this->htmlHeadTitleHelper = new HtmlHeadTitleHelper();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(HtmlHeadTitleHelper::class, $this->htmlHeadTitleHelper);
    }

    public function testInvoke()
    {
        $this->assertSame(
            $this->htmlHeadTitleHelper,
            $this->htmlHeadTitleHelper->__invoke()
        );
    }
}
