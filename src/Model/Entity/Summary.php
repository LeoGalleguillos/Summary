<?php
namespace LeoGalleguillos\Summary\Model\Entity;

use DateTime;
use LeoGalleguillos\Website\Model\Entity as WebsiteEntity;

class Summary
{
    /**
     * @var array
     */
    protected $nGrams;

    /**
     * @var DateTime
     */
    protected $nGramsUpdated;

    /**
     * @var string
     */
    protected $rootRelativeUrl;

    /**
     * @var int
     */
    protected $summaryId;

    /**
     * @var string
     */
    protected $title;

    /**
     * WebsiteEntity\Webpage
     */
    protected $webpage;

    public function getNGrams() : array
    {
        return $this->nGrams;
    }

    public function getNGramsUpdated() : DateTime
    {
        return $this->nGramsUpdated;
    }

    public function getRootRelativeUrl() : string
    {
        return $this->rootRelativeUrl;
    }

    public function getSummaryId() : int
    {
        return $this->summaryId;
    }

    public function getTitle() : string
    {
        return $this->title;
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

    public function setNGramsUpdated(DateTime $nGramsUpdated)
    {
        $this->nGramsUpdated = $nGramsUpdated;
        return $this;
    }

    public function setRootRelativeUrl(string $rootRelativeUrl)
    {
        $this->rootRelativeUrl = $rootRelativeUrl;
        return $this;
    }

    public function setSummaryId(int $summaryId)
    {
        $this->summaryId = $summaryId;
        return $this;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    public function setWebpage(WebsiteEntity\Webpage $webpage)
    {
        $this->webpage = $webpage;
        return $this;
    }
}
