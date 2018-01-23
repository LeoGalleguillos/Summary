<?php
namespace LeoGalleguillos\Summary\Model\Service;

use LeoGalleguillos\Html\Model\Service as HtmlService;
use LeoGalleguillos\String\Model\Service as StringService;
use LeoGalleguillos\Summary\Model\Service\Slug as SummarySlugService;
use LeoGalleguillos\Summary\Model\Entity as SummaryEntity;

class Title
{
    /**
     * Get title.
     *
     * @param SummaryEntity\Summary $summaryEntity
     * @return string
     */
    public function getTitle(SummaryEntity\Summary $summaryEntity) : string
    {
        $count = 0;
        $title = '';
        $nGrams = $summaryEntity->getNGrams();
        foreach ($nGrams[3] as $key => $nGram) {
            $title .= ($count == 2)
                    ? ('and ' . $key)
                    : ($key . ', ');
            $count++;
            if ($count >= 3) {
                break;
            }
        }
        return $title;
    }
}
