<?php
namespace LeoGalleguillos\SummaryTest\Model\Service;

use ArrayObject;
use LeoGalleguillos\Summary\Model\Entity\Source as SourceEntity;
use LeoGalleguillos\Summary\Model\Factory\Source as SourceFactory;
use LeoGalleguillos\Summary\Model\Table\Source as SourceTable;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service\Summary as SummaryService;
use PHPUnit\Framework\TestCase;

class SummaryTest extends TestCase
{
    protected function setUp()
    {
        $this->sourceFactory  = $this->createMock(SourceFactory::class);
        $this->sourceTable    = $this->createMock(SourceTable::class);
        $this->summaryService = new SummaryService(
            $this->sourceFactory,
            $this->sourceTable
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SummaryService::class, $this->summaryService);
    }

    public function testGetSourceEntites()
    {
        $summaryEntity = new SummaryEntity();
        $summaryEntity->summaryId = 3;

        $arrayObject1 = new ArrayObject([
            'source_id' => 1,
            'summary_id' => 1,
            'url' => 'url',
            'title' => 'title',
        ]);
        $arrayObject2 = new ArrayObject([
            'source_id' => 2,
            'summary_id' => 1,
            'url' => 'the best source ever',
            'title' => 'title for the best source ever',
        ]);
        $arrayObjects = new ArrayObject();
        $arrayObjects[] = $arrayObject1;
        $arrayObjects[] = $arrayObject2;

        $sourceEntity1 = new SourceEntity();
        $sourceEntity1->sourceId = 1;
        $sourceEntity1->summaryId = 1;
        $sourceEntity1->url = 'url';
        $sourceEntity1->title = 'title';

        $sourceEntity2 = new SourceEntity();
        $sourceEntity2->sourceId = 2;
        $sourceEntity2->summaryId = 1;
        $sourceEntity2->url = 'the best source ever';
        $sourceEntity2->title = 'title for the best source ever';

        $sourceEntities = array();
        $sourceEntities[] = $sourceEntity1;
        $sourceEntities[] = $sourceEntity2;

        $this->sourceTable->method('selectWhereSummaryId')->willReturn($arrayObjects);
        $this->sourceFactory->method('buildFromArrayObject')
             ->will($this->onConsecutiveCalls($sourceEntity1, $sourceEntity2));

        $this->assertSame(
            $sourceEntities,
            $this->summaryService->getSourceEntities($summaryEntity)
        );
    }
}
