<?php
namespace LeoGalleguillos\SummaryTest\Model\Factory;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Factory\Summary as SummaryFactory;
use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;
use PHPUnit\Framework\TestCase;

class SummaryTest extends TestCase
{
    protected function setUp()
    {
        $summaryTable = $this->createMock(SummaryTable::class);

        $this->summaryFactory = new SummaryFactory($summaryTable);
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SummaryFactory::class, $this->summaryFactory);
    }
}
