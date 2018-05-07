<?php
namespace LeoGalleguillos\SummaryTest\Model\Service\Summary\NGrams;

use LeoGalleguillos\Summary\Model\Service as SummaryService;
use LeoGalleguillos\Summary\Model\Entity as SummaryEntity;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{
    protected function setUp()
    {
        $this->nGram2TableMock = $this->createMock(
            SummaryTable\NGram2::class
        );
        $this->nGram3TableMock = $this->createMock(
            SummaryTable\NGram3::class
        );
        $this->nGram4TableMock = $this->createMock(
            SummaryTable\NGram4::class
        );
        $this->insertNGramsService = new SummaryService\NGrams\Insert(
            $this->nGram2TableMock,
            $this->nGram3TableMock,
            $this->nGram4TableMock
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            SummaryService\NGrams\Insert::class,
            $this->insertNGramsService
        );
    }
}
