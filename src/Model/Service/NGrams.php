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
        SummaryTable\NGram1 $nGram1Table,
        SummaryTable\NGram2 $nGram2Table,
        SummaryTable\NGram3 $nGram3Table,
        SummaryTable\NGram4 $nGram4Table
    ) {
        $this->wordsOnlyService           = $wordsOnlyService;
        $this->nGramsSortedByCountService = $nGramsSortedByCountService;
        $this->nGram1Table                = $nGram1Table;
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

    /**
     * Get n-grams from tables.
     *
     * @param SummaryEntity\Summary $summaryEntity
     * @return array
     */
    public function getNGramsFromTables(
        SummaryEntity\Summary $summaryEntity
    ) : array {
        $nGrams = [];
        $nGrams[1] = [];
        $nGrams[2] = [];
        $nGrams[3] = [];
        $nGrams[4] = [];

        $generator = $this->nGram1Table->selectWhereSummaryId(
            $summaryEntity->getSummaryId()
        );
        foreach ($generator as $array) {
            $count = $array['count'];
            $sequence = [
                $array['word_1'],
            ];
            $key = implode(' ', $sequence);
            $nGrams[1][$key] = [
                'count' => $count,
                'sequence' => $sequence,
            ];
        }

        $generator = $this->nGram2Table->selectWhereSummaryId(
            $summaryEntity->getSummaryId()
        );
        foreach ($generator as $array) {
            $count = $array['count'];
            $sequence = [
                $array['word_1'],
                $array['word_2'],
            ];
            $key = implode(' ', $sequence);
            $nGrams[2][$key] = [
                'count' => $count,
                'sequence' => $sequence,
            ];
        }

        $generator = $this->nGram3Table->selectWhereSummaryId(
            $summaryEntity->getSummaryId()
        );
        foreach ($generator as $array) {
            $count = $array['count'];
            $sequence = [
                $array['word_1'],
                $array['word_2'],
                $array['word_3'],
            ];
            $key = implode(' ', $sequence);
            $nGrams[3][$key] = [
                'count' => $count,
                'sequence' => $sequence,
            ];
        }

        $generator = $this->nGram4Table->selectWhereSummaryId(
            $summaryEntity->getSummaryId()
        );
        foreach ($generator as $array) {
            $count = $array['count'];
            $sequence = [
                $array['word_1'],
                $array['word_2'],
                $array['word_3'],
                $array['word_4'],
            ];
            $key = implode(' ', $sequence);
            $nGrams[4][$key] = [
                'count' => $count,
                'sequence' => $sequence,
            ];
        }

        return $nGrams;
    }
}
