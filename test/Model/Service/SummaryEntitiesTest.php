<?php
namespace LeoGalleguillos\SummaryTest\Model\Service;

use LeoGalleguillos\Summary\Model\Factory as SummaryFactory;
use LeoGalleguillos\Summary\Model\Service as SummaryService;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;
use PHPUnit\Framework\TestCase;

class SummaryEntitiesTest extends TestCase
{
    protected function setUp()
    {
        $this->summaryFactoryMock = $this->createMock(
            SummaryFactory\Summary::class
        );
        $this->summaryTableMock = $this->createMock(
            SummaryTable\Summary::class
        );

        $this->summaryEntitiesService = new SummaryService\SummaryEntities(
            $this->summaryFactoryMock,
            $this->summaryTableMock
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            SummaryService\SummaryEntities::class,
            $this->summaryEntitiesService
        );
    }
}
