<?php
namespace LeoGalleguillos\SummaryTest\Model\Service\Summary;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service\Summary\RootRelativeUrl as SummaryRootRelativeUrlService;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    protected function setUp()
    {
        $summaryRootRelativeUrlService = $this->createMock(SummaryRootRelativeUrlService::class);
        $summaryRootRelativeUrlService
            ->method('getRootRelativeUrl')
            ->willReturn('/summaries/123/This-is-the-amazing-slug');
        $this->summaryUrlService = new SummaryUrlService(
            $summaryRootRelativeUrlService
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            SummaryUrlService::class,
            $this->summaryUrlService
        );
    }

    public function testGetUrl()
    {
        $summaryEntity = new SummaryEntity();
        $_SERVER['HTTP_HOST'] = 'my.http.host';
        $this->assertSame(
            'https://my.http.host/summaries/123/This-is-the-amazing-slug',
            $this->summaryUrlService->getUrl($summaryEntity)
        );
    }
}
