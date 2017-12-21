<?php
namespace LeoGalleguillos\SummaryTest\Model\Service\Summary;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service\Summary\Slug as SummarySlugService;
use PHPUnit\Framework\TestCase;

class SlugTest extends TestCase
{
    protected function setUp()
    {
        $this->summarySlugService = new SummarySlugService();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SummarySlugService::class, $this->summarySlugService);
    }
}
