<?php
namespace LeoGalleguillos\SummaryTest\Model\Service\Summary;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service\Summary\RootRelativeUrl as SummaryRootRelativeUrlService;
use LeoGalleguillos\Summary\Model\Service\Summary\Slug as SummarySlugService;
use PHPUnit\Framework\TestCase;

class RootRelativeUrlTest extends TestCase
{
    protected function setUp()
    {
        $summarySlugService = $this->createMock(SummarySlugService::class);
        $summarySlugService->method('getSlug')->willReturn('This-is-the-slug');
        $this->summaryRootRelativeUrlService = new SummaryRootRelativeUrlService(
            $summarySlugService
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            SummaryRootRelativeUrlService::class,
            $this->summaryRootRelativeUrlService
        );
    }

    public function testGetRootRelativeUrl()
    {
        $summaryEntity = new SummaryEntity();
        $summaryEntity->setSummaryId(1);
        $this->assertSame(
            '/summaries/1/This-is-the-slug',
            $this->summaryRootRelativeUrlService->getRootRelativeUrl($summaryEntity)
        );
    }
}
