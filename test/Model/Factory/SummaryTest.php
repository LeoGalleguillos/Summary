<?php
namespace LeoGalleguillos\SummaryTest\Model\Factory;

use ArrayObject;
use LeoGalleguillos\Image\Model\Entity\Image as ImageEntity;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Factory\Summary as SummaryFactory;
use LeoGalleguillos\Summary\Model\Service as SummaryService;
use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;
use LeoGalleguillos\Website\Model\Entity as WebsiteEntity;
use LeoGalleguillos\Website\Model\Factory as WebsiteFactory;
use PHPUnit\Framework\TestCase;

class SummaryTest extends TestCase
{
    protected function setUp()
    {
        $this->nGramsServiceMock   = $this->createMock(SummaryService\NGrams::class);
        $this->summaryTableMock   = $this->createMock(SummaryTable::class);
        $this->webpageFactoryMock = $this->createMock(WebsiteFactory\Webpage::class);
        $this->summaryFactory     = new SummaryFactory(
            $this->nGramsServiceMock,
            $this->summaryTableMock,
            $this->webpageFactoryMock
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SummaryFactory::class, $this->summaryFactory);
    }

    public function testBuildFromSummaryId()
    {
        $arrayObject = new ArrayObject([
            'summary_id' => '123',
            'webpage_id' => '456',
        ]);
        $webpageEntity = new WebsiteEntity\Webpage();
        $this->summaryTableMock->method('selectWhereSummaryId')->willReturn($arrayObject);
        $this->webpageFactoryMock->method('buildFromWebpageId')->willReturn(
            $webpageEntity
        );

        $summaryEntity            = new SummaryEntity();
        $summaryEntity->setSummaryId(123)
                      ->setWebpage($webpageEntity)
                      ->setNGrams([]);

        $this->assertEquals(
            $summaryEntity,
            $this->summaryFactory->buildFromSummaryId(456)
        );
    }
}
