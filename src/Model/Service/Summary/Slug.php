<?php
namespace LeoGalleguillos\Summary\Model\Service\Summary;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;

class Slug
{
    public function __construct(
    ) {
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug(SummaryEntity $summaryEntity) : string
    {
        return 'wow';
    }
}
