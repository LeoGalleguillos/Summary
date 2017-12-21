<?php
namespace LeoGalleguillos\Summary\View\Helper\Summary;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use Zend\View\Helper\AbstractHelper;

class FacebookShareUrl extends AbstractHelper
{
    public function __construct(
        SummaryUrlService $summaryUrlService
    ) {
        $this->summaryUrlService = $summaryUrlService;
    }

    public function __invoke()
    {
        return $this;
    }

    public function getFacebookShareUrl(SummaryEntity $summaryEntity) : string
    {
        return 'https://www.facebook.com/sharer/sharer.php?u='
             . urlencode($this->summaryUrlService->getUrl($summaryEntity));
    }
}
