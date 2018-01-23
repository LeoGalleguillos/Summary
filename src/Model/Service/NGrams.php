<?php
namespace LeoGalleguillos\Summary\Model\Service;

use LeoGalleguillos\Html\Model\Service as HtmlService;
use LeoGalleguillos\String\Model\Service as StringService;
use LeoGalleguillos\Summary\Model\Service\Slug as SummarySlugService;
use LeoGalleguillos\Summary\Model\Entity as SummaryEntity;

class NGrams
{
    public function __construct(
        HtmlService\WordsOnly $wordsOnlyService,
        StringService\NGrams\SortedByCount $nGramsSortedByCountService
    ) {
        $this->wordsOnlyService           = $wordsOnlyService;
        $this->nGramsSortedByCountService = $nGramsSortedByCountService;
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
}
