<?php
namespace LeoGalleguillos\Summary\Model\Service\Summary;

use Generator;
use LeoGalleguillos\Summary\Model\Entity as SummaryEntity;
use LeoGalleguillos\Summary\Model\Factory as SummaryFactory;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;

class SummaryEntities
{
    public function __construct(
        SummaryFactory\Summary $summaryFactory,
        SummaryTable\Summary $summaryTable
    ) {
        $this->summaryFactory = $summaryFactory;
        $this->summaryTable   = $summaryTable;
    }

    /**
     * Get summary entities.
     *
     * @yield SummaryEntity\Summary
     * @return Generator
     */
    public function getSummaryEntities() : Generator
    {
    }
}
