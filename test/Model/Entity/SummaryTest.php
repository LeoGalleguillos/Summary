<?php
namespace LeoGalleguillos\SummaryTest\Model\Entity;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use PHPUnit\Framework\TestCase;

class SummaryTest extends TestCase
{
    protected function setUp()
    {
        $this->summaryEntity = new SummaryEntity();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SummaryEntity::class, $this->summaryEntity);
    }

    public function testAttributes()
    {
        $this->assertObjectHasAttribute('body', $this->summaryEntity);
        $this->assertObjectHasAttribute('summaryId', $this->summaryEntity);
        $this->assertObjectHasAttribute('thumbnail', $this->summaryEntity);
        $this->assertObjectHasAttribute('title', $this->summaryEntity);
    }
}
