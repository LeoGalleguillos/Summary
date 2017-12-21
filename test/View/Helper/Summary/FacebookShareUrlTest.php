<?php
namespace LeoGalleguillos\SummaryTest\View\Helper\Summary;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use LeoGalleguillos\Summary\View\Helper\Summary\FacebookShareUrl as FacebookShareUrlHelper;
use PHPUnit\Framework\TestCase;

class FacebookShareUrlTest extends TestCase
{
    protected function setUp()
    {
        $this->summaryUrlService = $this->createMock(SummaryUrlService::class);
        $this->facebookShareUrlHelper = new FacebookShareUrlHelper(
            $this->summaryUrlService
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            FacebookShareUrlHelper::class,
            $this->facebookShareUrlHelper
        );
    }

    public function testInvoke()
    {
        $this->assertSame(
            $this->facebookShareUrlHelper,
            $this->facebookShareUrlHelper->__invoke()
        );
    }

    public function testGetHtmlHeadTitle()
    {
        $summaryEntity = new SummaryEntity();
        $this->summaryUrlService
             ->method('getUrl')
             ->willReturn('https://www.sotosummarize.com/summaries/8/Example-slug');

        $this->assertSame(
            'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.sotosummarize.com%2Fsummaries%2F8%2FExample-slug',
            $this->facebookShareUrlHelper->getFacebookShareUrl($summaryEntity)
        );
    }
}
