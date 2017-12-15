<?php
namespace LeoGalleguillos\SummaryTest\Model\Factory;

use ArrayObject;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Factory\Summary as SummaryFactory;
use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;
use PHPUnit\Framework\TestCase;

class SummaryTest extends TestCase
{
    protected function setUp()
    {
        $this->summaryTable   = $this->createMock(SummaryTable::class);
        $this->summaryFactory = new SummaryFactory($this->summaryTable);
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SummaryFactory::class, $this->summaryFactory);
    }

    public function testBuildFromArrayObject()
    {
        $arrayObject = new ArrayObject([
            'summary_id' => 123,
            'title'      => 'this is the title',
            'body'       => 'this is the body',
        ]);
        $summaryEntity            = new SummaryEntity();
        $summaryEntity->summaryId = 123;
        $summaryEntity->title     = 'this is the title';
        $summaryEntity->body      = 'this is the body';

        $this->assertEquals(
            $summaryEntity,
            $this->summaryFactory->buildFromArrayObject($arrayObject)
        );
    }

    public function testBuildFromSummaryId()
    {
        $arrayObject = new ArrayObject([
            'summary_id' => 456,
            'title'      => 'the title for this summary',
            'body'       => 'the body for this summary',
        ]);
        $this->summaryTable->method('selectWhereSummaryId')->willReturn($arrayObject);
        $summaryEntity            = new SummaryEntity();
        $summaryEntity->summaryId = 456;
        $summaryEntity->title     = 'the title for this summary';
        $summaryEntity->body      = 'the body for this summary';

        $this->assertEquals(
            $summaryEntity,
            $summaryEntity = $this->summaryFactory->buildFromSummaryId(456)
        );
    }
}
