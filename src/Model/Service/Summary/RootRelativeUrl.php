<?php
namespace LeoGalleguillos\Summary\Model\Service\Summary;

use LeoGalleguillos\Summary\Model\Service\Summary\Slug as SummarySlugService;
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
             . $summaryEntity->summaryId
             . '/'
             . $this->summarySlugService->getSlug($summaryEntity);
    }
}
