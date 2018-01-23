<?php
namespace LeoGalleguillos\Summary\View\Helper\Summary;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use Zend\View\Helper\AbstractHelper;

class HtmlHeadTitle extends AbstractHelper
{
    public function __construct(
    ) {
    }

    public function __invoke()
    {
        return $this;
    }

    public function getHtmlHeadTitle(SummaryEntity $summaryEntity) : string
    {
        return 'So, to summarize, ' . $summaryEntity->getTitle();
    }
}
