<?php
namespace LeoGalleguillos\Summary\View\Helper\Summary\Html\Head;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use Zend\View\Helper\AbstractHelper;

class Og extends AbstractHelper
{
    public function __construct(
    ) {
    }

    public function __invoke()
    {
        return $this;
    }

    public function getOgDescription(SummaryEntity $summaryEntity) : string
    {
        return 'So, to summarize, ' . $summaryEntity->getTitle();
    }

    public function getOgImage(SummaryEntity $summaryEntity) : string
    {
        return 'https://'
             . $_SERVER['HTTP_HOST']
             . $summaryEntity->thumbnail->rootRelativePath;
    }

    public function getOgImageHeight(SummaryEntity $summaryEntity) : int
    {
        return $summaryEntity->thumbnail->getHeight();
    }

    public function getOgImageWidth(SummaryEntity $summaryEntity) : int
    {
        return $summaryEntity->thumbnail->getWidth();
    }

    public function getOgType(SummaryEntity $summaryEntity) : string
    {
        return 'article';
    }
}
