<?php
namespace LeoGalleguillos\Summary\View\Helper\Summary;

use LeoGalleguillos\Facebook\View\Helper\ShareUrl as FacebookShareUrlHelper;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use Zend\View\Helper\AbstractHelper;

class FacebookShareUrl extends AbstractHelper
{
    public function __construct(
        FacebookShareUrlHelper $facebookShareUrlHelper,
        SummaryUrlService $summaryUrlService
    ) {
        $this->facebookShareUrlHelper = $facebookShareUrlHelper;
        $this->summaryUrlService      = $summaryUrlService;
    }

    public function __invoke()
    {
        return $this;
    }

    public function getFacebookShareUrl(SummaryEntity $summaryEntity) : string
    {
        return $this->facebookShareUrlHelper->getShareUrl(
            $this->summaryUrlService->getUrl($summaryEntity)
        );
    }
}
