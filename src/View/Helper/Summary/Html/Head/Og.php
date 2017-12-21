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
        return 'So, to summarize, ' . $summaryEntity->title;
    }

    public function getOgImage(SummaryEntity $summaryEntity) : string
    {
        return 'https://'
             . $_SERVER['HTTP_HOST']
             . $summaryEntity->thumbnail->rootRelativePath;
    }

    public function getOgType(SummaryEntity $summaryEntity) : string
    {
        return 'article';
    }
}
