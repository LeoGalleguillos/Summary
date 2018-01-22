<?php
namespace LeoGalleguillos\Summary\Model\Entity;

use LeoGalleguillos\Website\Model\Entity as WebsiteEntity;

class Summary
{
    /**
     * @var int
     */
    protected $summaryId;

    /**
     * WebsiteEntity\Webpage
     */
    protected $webpage;

    public function getSummaryId() : int
    {
        return $this->summaryId;
    }

    public function setSummaryId(int $summaryId)
    {
        $this->summaryId = $summaryId;
        return $this;
    }

    public function setWebpage(WebsiteEntity\Webpage $webpage)
    {
        $this->webpage = $webpage;
        return $this;
    }
}
