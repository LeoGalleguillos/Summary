<?php
namespace LeoGalleguillos\Summary\Model\Factory;

use ArrayObject;
use LeoGalleguillos\Summary\Model\Entity\Source as SourceEntity;
use LeoGalleguillos\Summary\Model\Table\Source as SourceTable;

class Source
{
    public function __construct(
        SourceTable $sourceTable
    ) {
        $this->sourceTable = $sourceTable;
    }

    public function buildFromArrayObject(ArrayObject $arrayObject)
    {
        $sourceEntity            = new SourceEntity();
        $sourceEntity->sourceId  = $arrayObject['source_id'];
        $sourceEntity->summaryId = $arrayObject['summary_id'];
        $sourceEntity->url       = $arrayObject['url'];
        $sourceEntity->title     = $arrayObject['title'];
        return $sourceEntity;
    }

    public function buildFromSourceId(int $sourceId)
    {
        $arrayObject = $this->sourceTable->selectWhereSourceId($sourceId);
        return $this->buildFromArrayObject($arrayObject);
    }
}
