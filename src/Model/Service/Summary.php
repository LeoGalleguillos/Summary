<?php
namespace LeoGalleguillos\Summary\Model\Service;

use LeoGalleguillos\Summary\Model\Entity\Source as SourceEntity;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Factory\Source as SourceFactory;
use LeoGalleguillos\Summary\Model\Table\Source as SourceTable;

class Summary
{
    public function __construct(
        SourceFactory $sourceFactory,
        SourceTable $sourceTable
    ) {
        $this->sourceFactory = $sourceFactory;
        $this->sourceTable   = $sourceTable;
    }

    /**
     * Get source entities.
     *
     * @return SourceEntity[]
     */
    public function getSourceEntities(SummaryEntity $summaryEntity) : array
    {
        $sourceEntities = [];
        $sourceArrays = $this->sourceTable->selectWhereSummaryId($summaryEntity->summaryId);
        foreach ($sourceArrays as $sourceArray) {
            $sourceEntities[] = $this->sourceFactory->buildFromArrayObject($sourceArray);
        }
        return $sourceEntities;
    }
}
