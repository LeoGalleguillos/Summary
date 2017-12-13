<?php
namespace LeoGalleguillos\Summary\Model\Service;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;

class Summary
{
    /**
     * Get full name.
     *
     * @return string
     */
    public function getFullName(SummaryEntity $summaryEntity)
    {
        $fullName = $summaryEntity->artist . ' - ' . $summaryEntity->title;
        if ($summaryEntity->featuredArtists) {
            $fullName .= ' (ft ' . $summaryEntity->featuredArtists . ')';
        }
        return $fullName;
    }
}
