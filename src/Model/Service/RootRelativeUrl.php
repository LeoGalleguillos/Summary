<?php
namespace LeoGalleguillos\Summary\Model\Service;

use LeoGalleguillos\Summary\Model\Service\Slug as SummarySlugService;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;

class RootRelativeUrl
{
    public function __construct(
        SummarySlugService $summarySlugService
    ) {
        $this->summarySlugService = $summarySlugService;
    }

    /**
     * Get root-relative URL.
     *
     * @return string
     */
    public function getRootRelativeUrl(SummaryEntity $summaryEntity) : string
    {
        return '/summaries/'
             . $summaryEntity->getSummaryId()
             . '/'
             . $this->summarySlugService->getSlug($summaryEntity);
    }
}
