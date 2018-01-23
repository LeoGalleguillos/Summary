<?php
namespace LeoGalleguillos\SummaryTest\Model\Service\Summary;

use LeoGalleguillos\Html\Model\Service as HtmlService;
use LeoGalleguillos\String\Model\Service as StringService;
use LeoGalleguillos\Summary\Model\Service as SummaryService;
use LeoGalleguillos\Summary\Model\Entity as SummaryEntity;
use PHPUnit\Framework\TestCase;

class NGramsTest extends TestCase
{
    protected function setUp()
    {
        $this->wordsOnlyService = $this->createMock(
            HtmlService\WordsOnly::class
        );
        $this->nGramsSortedByCountService = $this->createMock(
            StringService\NGrams\SortedByCount::class
        );
        $this->nGramsService = new SummaryService\NGrams(
            $this->wordsOnlyService,
            $this->nGramsSortedByCountService
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            SummaryService\NGrams::class,
            $this->nGramsService
        );
    }
}
