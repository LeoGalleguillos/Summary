<?php
namespace LeoGalleguillos\SummaryTest\Model\Entity;

use LeoGalleguillos\Summary\Model\Entity\Source as SourceEntity;
use PHPUnit\Framework\TestCase;

class SourceTest extends TestCase
{
    protected function setUp()
    {
        $this->sourceEntity = new SourceEntity();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SourceEntity::class, $this->sourceEntity);
    }

    public function testAttributes()
    {
        $this->assertObjectHasAttribute('sourceId', $this->sourceEntity);
        $this->assertObjectHasAttribute('summaryId', $this->sourceEntity);
        $this->assertObjectHasAttribute('url', $this->sourceEntity);
        $this->assertObjectHasAttribute('title', $this->sourceEntity);
    }
}
