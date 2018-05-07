<?php
namespace LeoGalleguillos\SummaryTest\Model\Factory;

use ArrayObject;
use LeoGalleguillos\Image\Model\Entity\Image as ImageEntity;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Factory\Summary as SummaryFactory;
use LeoGalleguillos\Summary\Model\Service as SummaryService;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;
use LeoGalleguillos\Website\Model\Entity as WebsiteEntity;
use LeoGalleguillos\Website\Model\Factory as WebsiteFactory;
use PHPUnit\Framework\TestCase;

class SummaryTest extends TestCase
{
    protected function setUp()
    {
        $this->nGramsServiceMock  = $this->createMock(
            SummaryService\NGrams::class
        );
        $this->insertNGramsServiceMock  = $this->createMock(
            SummaryService\NGrams\Insert::class
        );
        $this->rootRelativeUrlServiceMock    = $this->createMock(SummaryService\RootRelativeUrl::class);
        $this->titleServiceMock   = $this->createMock(SummaryService\Title::class);
        $this->summaryTableMock   = $this->createMock(SummaryTable\Summary::class);
        $this->summaryNGramsUpdatedTableMock = $this->createMock(
            SummaryTable\Summary\NGramsUpdated::class
        );
        $this->summaryTitleTableMock = $this->createMock(
            SummaryTable\Summary\Title::class
        );
        $this->webpageFactoryMock = $this->createMock(WebsiteFactory\Webpage::class);

        $this->summaryFactory = new SummaryFactory(
            $this->nGramsServiceMock,
            $this->insertNGramsServiceMock,
            $this->rootRelativeUrlServiceMock,
            $this->titleServiceMock,
            $this->summaryTableMock,
            $this->summaryNGramsUpdatedTableMock,
            $this->summaryTitleTableMock,
            $this->webpageFactoryMock
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(SummaryFactory::class, $this->summaryFactory);
    }

    public function testBuildFromSummaryId()
    {
        $arrayObject = [
            'summary_id' => '123',
            'webpage_id' => '456',
        ];
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
