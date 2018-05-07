<?php
namespace LeoGalleguillos\Summary\Model\Service;

use LeoGalleguillos\Html\Model\Service as HtmlService;
use LeoGalleguillos\String\Model\Service as StringService;
use LeoGalleguillos\Summary\Model\Service\Slug as SummarySlugService;
use LeoGalleguillos\Summary\Model\Entity as SummaryEntity;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;

class NGrams
{
    public function __construct(
        HtmlService\WordsOnly $wordsOnlyService,
        StringService\NGrams\SortedByCount $nGramsSortedByCountService,
        SummaryTable\NGram2 $nGram2Table,
        SummaryTable\NGram3 $nGram3Table,
        SummaryTable\NGram4 $nGram4Table
    ) {
        $this->wordsOnlyService           = $wordsOnlyService;
        $this->nGramsSortedByCountService = $nGramsSortedByCountService;
        $this->nGram2Table                = $nGram2Table;
        $this->nGram3Table                = $nGram3Table;
        $this->nGram4Table                = $nGram4Table;
    }

    /**
     * Get n-grams.
     *
     * @param SummaryEntity\Summary $summaryEntity
     * @return array
     */
    public function getNGrams(SummaryEntity\Summary $summaryEntity) : array
    {
        return $this->nGramsSortedByCountService->getNGramsSortedByCount(
            $this->wordsOnlyService->getWordsOnly(
                $summaryEntity->getWebpage()->getHtml()->getString()
            ),
            1,
            4
        );
    }

    public function getNGramsFromTables(
        SummaryEntity\Summary $summaryEntity
    ) : array {
        $nGrams = [];
    }
}
