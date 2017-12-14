<?php
namespace LeoGalleguillos\SummaryTest\Model\Factory;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Factory\Summary as SummaryFactory;
use PHPUnit\Framework\TestCase;

class SummaryTest extends TestCase
{
    protected function setUp()
    {
        $this->summaryFactory = new SummaryFactory();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SummaryFactory::class, $this->summaryFactory);
    }
}
