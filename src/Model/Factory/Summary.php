<?php
namespace LeoGalleguillos\Summary\Model\Factory;

use ArrayObject;
use LeoGalleguillos\Image\Model\Entity\Image as ImageEntity;
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

        $summaryEntity->thumbnail = new ImageEntity();
        $summaryEntity->thumbnail->rootRelativePath = $arrayObject['thumbnail_root_relative_path'];
        $summaryEntity->thumbnail->width = $arrayObject['thumbnail_width'];
        $summaryEntity->thumbnail->height = $arrayObject['thumbnail_height'];
        return $summaryEntity;
    }

    public function buildFromSummaryId(int $summaryId)
    {
        $arrayObject = $this->summaryTable->selectWhereSummaryId($summaryId);
        return $this->buildFromArrayObject($arrayObject);
    }
}
