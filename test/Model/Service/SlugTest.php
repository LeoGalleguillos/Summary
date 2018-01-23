<?php
namespace LeoGalleguillos\SummaryTest\Model\Service\Summary;

use LeoGalleguillos\String\Model\Service\UrlFriendly as UrlFriendlyService;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service as SummaryService;
use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{
    protected function setUp()
    {
        $this->summarySlugService = new SummaryService\Slug(
            new UrlFriendlyService()
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            SummaryService\Slug::class,
            $this->summarySlugService
        );
    }

    public function testGetSlug()
    {
        $summaryEntity = new SummaryEntity();
        $summaryEntity->title = 'This is the title!';
        $this->assertSame(
            'This-is-the-title',
            $this->summarySlugService->getSlug($summaryEntity)
        );
    }
}
