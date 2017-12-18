<?php
namespace LeoGalleguillos\SummaryTest\Model\Factory;

use ArrayObject;
use LeoGalleguillos\Summary\Model\Entity\Source as SourceEntity;
use LeoGalleguillos\Summary\Model\Factory\Source as SourceFactory;
use LeoGalleguillos\Summary\Model\Table\Source as SourceTable;
use PHPUnit\Framework\TestCase;

class SourceTest extends TestCase
{
    protected function setUp()
    {
        $this->sourceTable   = $this->createMock(SourceTable::class);
        $this->sourceFactory = new SourceFactory($this->sourceTable);
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SourceFactory::class, $this->sourceFactory);
    }

    public function testBuildFromArrayObject()
    {
        $arrayObject = new ArrayObject([
            'source_id'  => 123,
            'summary_id' => 456,
            'url'        => 'this is the url',
            'title'      => 'this is the title',
        ]);
        $sourceEntity            = new SourceEntity();
        $sourceEntity->sourceId  = 123;
        $sourceEntity->summaryId = 456;
        $sourceEntity->url       = 'this is the url';
        $sourceEntity->title     = 'this is the title';

        $this->assertEquals(
            $sourceEntity,
            $this->sourceFactory->buildFromArrayObject($arrayObject)
        );
    }

    public function testBuildFromSummaryId()
    {
        $arrayObject = new ArrayObject([
            'source_id'  => 123,
            'summary_id' => 456,
            'url'        => 'this is the url',
            'title'      => 'this is the title',
        ]);
        $this->sourceTable->method('selectWhereSourceId')->willReturn($arrayObject);
        $sourceEntity            = new SourceEntity();
        $sourceEntity->sourceId  = 123;
        $sourceEntity->summaryId = 456;
        $sourceEntity->url     = 'this is the url';
        $sourceEntity->title      = 'this is the title';

        $this->assertEquals(
            $sourceEntity,
            $sourceEntity = $this->sourceFactory->buildFromSourceId(123)
        );
    }
}
