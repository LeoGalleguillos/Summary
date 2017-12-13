<?php
namespace LeoGalleguillos\SummaryTest\Model\Service;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service\Summary as SummaryService;
use PHPUnit\Framework\TestCase;

class SummaryTest extends TestCase
{
    protected function setUp()
    {
        $this->summaryEntity            = new SummaryEntity();
        $this->summaryEntity->artist    = 'Rihanna';
        $this->summaryEntity->title     = 'Work';
        $this->summaryEntity->featuredArtists     = 'Drake';

        $this->summaryService = new SummaryService();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SummaryService::class, $this->summaryService);
    }

    public function testGetFullName()
    {
        $this->assertSame(
            'Rihanna - Work (ft Drake)',
            $this->summaryService->getFullName($this->summaryEntity)
        );
    }
}
