<?php
namespace LeoGalleguillos\Summary\Model\Service;

use LeoGalleguillos\String\Model\Service\UrlFriendly as UrlFriendlyService;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;

class Slug
{
    public function __construct(
        UrlFriendlyService $urlFriendlyService
    ) {
        $this->urlFriendlyService = $urlFriendlyService;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug(SummaryEntity $summaryEntity) : string
    {
        return $this->urlFriendlyService->getUrlFriendly(
            $summaryEntity->getWebpage()->getTitle()
        );
    }
}
