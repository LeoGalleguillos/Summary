<?php
namespace LeoGalleguillos\SummaryTest\View\Helper\Summary;

use ArrayObject;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
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

    public function testGetHtmlHeadTitle()
    {
        $summaryEntity = new SummaryEntity();
        $summaryEntity->title = 'This is the Title';
        $this->assertSame(
            'So, to summarize, This is the Title',
            $this->htmlHeadTitleHelper->getHtmlHeadTitle($summaryEntity)
        );

        $summaryEntity = new SummaryEntity();
        $summaryEntity->title = 'This is another title';
        $this->assertSame(
            'So, to summarize, This is another title',
            $this->htmlHeadTitleHelper->getHtmlHeadTitle($summaryEntity)
        );
    }
}
