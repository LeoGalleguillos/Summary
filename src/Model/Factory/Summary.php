<?php
namespace LeoGalleguillos\Summary\Model\Factory;

use LeoGalleguillos\Summary\Model\Entity as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service as SummaryService;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;
use LeoGalleguillos\Website\Model\Factory as WebsiteFactory;

class Summary
{
    public function __construct(
        SummaryService\NGrams $nGramsService,
        SummaryService\RootRelativeUrl $rootRelativeUrlService,
        SummaryService\Title $titleService,
        SummaryTable\Summary $summaryTable,
        WebsiteFactory\Webpage $webpageFactory
    ) {
        $this->nGramsService   = $nGramsService;
        $this->rootRelativeUrlService = $rootRelativeUrlService;
        $this->titleService    = $titleService;
        $this->summaryTable    = $summaryTable;
        $this->webpageFactory  = $webpageFactory;
    }

    public function buildFromSummaryId(int $summaryId)
    {
        return $this->buildFromArray(
            $this->summaryTable->selectWhereSummaryId($summaryId)
        );
    }

    public function buildFromArray(array $array) : SummaryEntity\Summary
    {
        $webpageEntity = $this->webpageFactory->buildFromWebpageId(
            $array['webpage_id']
        );


        $summaryEntity = new SummaryEntity\Summary();
        $summaryEntity->setSummaryId((int) $array['summary_id'])
                      ->setWebpage($webpageEntity);

        if (empty($array['title'])) {
            $array['title'] = $this->titleService->getTitle($summaryEntity);
        }
        $summaryEntity->setTitle($array['title']);

        $nGrams = $this->nGramsService->getNGrams($summaryEntity);
        $summaryEntity->setNGrams($nGrams);


        $rootRelativeUrl = $this->rootRelativeUrlService->getRootRelativeUrl($summaryEntity);
        $summaryEntity->setRootRelativeUrl($rootRelativeUrl);

        return $summaryEntity;
    }
}
