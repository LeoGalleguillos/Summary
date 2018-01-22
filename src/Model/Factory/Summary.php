<?php
namespace LeoGalleguillos\Summary\Model\Factory;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;
use LeoGalleguillos\Website\Model\Factory as WebsiteFactory;

class Summary
{
    public function __construct(
        SummaryTable $summaryTable,
        WebsiteFactory\Webpage $webpageFactory
    ) {
        $this->summaryTable   = $summaryTable;
        $this->webpageFactory = $webpageFactory;
    }

    public function buildFromSummaryId(int $summaryId)
    {
        $arrayObject = $this->summaryTable->selectWhereSummaryId($summaryId);

        $webpageEntity = $this->webpageFactory->buildFromWebpageId(
            $arrayObject['webpage_id']
        );

        $summaryEntity            = new SummaryEntity();
        $summaryEntity->setSummaryId((int) $arrayObject['summary_id'])
                      ->setWebpage($webpageEntity);

        return $summaryEntity;
    }
}
