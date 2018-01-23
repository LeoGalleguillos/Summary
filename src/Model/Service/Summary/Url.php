<?php
namespace LeoGalleguillos\Summary\Model\Service\Summary;

use LeoGalleguillos\Summary\Model\Service\RootRelativeUrl as SummaryRootRelativeUrlService;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;

class Url
{
    public function __construct(
        SummaryRootRelativeUrlService $summaryRootRelativeUrlService
    ) {
        $this->summaryRootRelativeUrlService = $summaryRootRelativeUrlService;
    }

    /**
     * Get root-relative URL.
     *
     * @return string
     */
    public function getUrl(SummaryEntity $summaryEntity) : string
    {
        return 'https://'
             . $_SERVER['HTTP_HOST']
             . $this->summaryRootRelativeUrlService->getRootRelativeUrl($summaryEntity);
    }
}
