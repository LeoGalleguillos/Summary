<?php
namespace LeoGalleguillos\SummaryTest\View\Helper\Summary;

use LeoGalleguillos\Facebook\View\Helper\ShareUrl as FacebookShareUrlHelper;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use LeoGalleguillos\Summary\View\Helper\Summary\FacebookShareUrl as SummaryFacebookShareUrlHelper;
use PHPUnit\Framework\TestCase;

class FacebookShareUrlTest extends TestCase
{
    protected function setUp()
    {
        $this->facebookShareUrlHelperMock = $this->createMock(FacebookShareUrlHelper::class);
        $this->summaryUrlService          = $this->createMock(SummaryUrlService::class);

        $this->summaryFacebookShareUrlHelper = new SummaryFacebookShareUrlHelper(
            $this->facebookShareUrlHelperMock,
            $this->summaryUrlService
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            SummaryFacebookShareUrlHelper::class,
            $this->summaryFacebookShareUrlHelper
        );
    }

    public function testInvoke()
    {
        $this->assertSame(
            $this->summaryFacebookShareUrlHelper,
            $this->summaryFacebookShareUrlHelper->__invoke()
        );
    }

    public function testGetFacebookShareUrl()
    {
        $summaryEntity = new SummaryEntity();
        $this->facebookShareUrlHelperMock
             ->method('getShareUrl')
             ->willReturn('https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.sotosummarize.com%2Fsummaries%2F8%2FExample-slug');
        $this->summaryUrlService
             ->method('getUrl')
             ->willReturn('https://www.sotosummarize.com/summaries/8/Example-slug');

        $this->assertSame(
            'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.sotosummarize.com%2Fsummaries%2F8%2FExample-slug',
            $this->summaryFacebookShareUrlHelper->getFacebookShareUrl($summaryEntity)
        );
    }
}
