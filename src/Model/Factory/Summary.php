<?php
namespace LeoGalleguillos\Summary\Model\Factory;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service as SummaryService;
use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;
use LeoGalleguillos\Website\Model\Factory as WebsiteFactory;

class Summary
{
    public function __construct(
        SummaryService\NGrams $nGramsService,
        SummaryService\Title $titleService,
        SummaryTable $summaryTable,
        WebsiteFactory\Webpage $webpageFactory
    ) {
        $this->nGramsService  = $nGramsService;
        $this->titleService   = $titleService;
        $this->summaryTable   = $summaryTable;
        $this->webpageFactory = $webpageFactory;
    }

    public function buildFromSummaryId(int $summaryId)
    {
        $arrayObject = $this->summaryTable->selectWhereSummaryId($summaryId);

        $webpageEntity = $this->webpageFactory->buildFromWebpageId(
            $arrayObject['webpage_id']
        );

        $summaryEntity = new SummaryEntity();
        $summaryEntity->setSummaryId((int) $arrayObject['summary_id'])
                      ->setWebpage($webpageEntity);

        $nGrams = $this->nGramsService->getNGrams($summaryEntity);
        $summaryEntity->setNGrams($nGrams);

        $title = $this->titleService->getTitle($summaryEntity);
        $summaryEntity->setTitle($title);

        return $summaryEntity;
    }
}
