<?php
namespace LeoGalleguillos\Summary\Model\Entity;

use LeoGalleguillos\Website\Model\Entity as WebsiteEntity;

class Summary
{
    /**
     * @var array
     */
    protected $nGrams;

    /**
     * @var int
     */
    protected $summaryId;

    /**
     * WebsiteEntity\Webpage
     */
    protected $webpage;

    public function getNGrams() : array
    {
        return $this->nGrams;
    }

    public function getSummaryId() : int
    {
        return $this->summaryId;
    }

    public function getWebpage() : WebsiteEntity\Webpage
    {
        return $this->webpage;
    }

    public function setNGrams(array $nGrams)
    {
        $this->nGrams = $nGrams;
        return $this;
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
