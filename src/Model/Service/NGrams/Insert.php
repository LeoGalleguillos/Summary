<?php
namespace LeoGalleguillos\Summary\Model\Service\NGrams;

use LeoGalleguillos\Summary\Model\Entity as SummaryEntity;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;

class Insert
{
    public function __construct(
        SummaryTable\NGram2 $nGram2Table,
        SummaryTable\NGram3 $nGram3Table,
        SummaryTable\NGram4 $nGram4Table
    ) {
        $this->nGram2Table = $nGram2Table;
        $this->nGram3Table = $nGram3Table;
        $this->nGram4Table = $nGram4Table;
    }

    public function insert(
        SummaryEntity\Summary $summaryEntity,
        array $nGrams
    ) {
        $iteration = 0;
        foreach ($nGrams[2] as $key => $array) {
            $count    = $array['count'];
            $sequence = $array['sequence'];
            $this->nGram2Table->insert(
                $summaryEntity->getSummaryId(),
                $count,
                $sequence[0],
                $sequence[1]
            );
            if ($iteration >= 9) {
                break;
            }
            $iteration++;
        }
    }
}
