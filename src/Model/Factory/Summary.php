<?php
namespace LeoGalleguillos\Summary\Model\Factory;

use ArrayObject;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;

class Summary
{
    public function __construct(
        SummaryTable $summaryTable
    ) {
        $this->summaryTable = $summaryTable;
    }

    public function buildFromArrayObject(ArrayObject $arrayObject)
    {
        $summaryEntity            = new SummaryEntity();
        $summaryEntity->summaryId = $arrayObject['summary_id'];
        $summaryEntity->title     = $arrayObject['title'];
        $summaryEntity->body      = $arrayObject['body'];
        return $summaryEntity;
    }

    public function buildFromSummaryId(int $summaryId)
    {
        $arrayObject = $this->summaryTable->selectWhereSummaryId($summaryId);
        return $this->buildFromArrayObject($arrayObject);
    }
}
