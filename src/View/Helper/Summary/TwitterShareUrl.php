<?php
namespace LeoGalleguillos\Summary\View\Helper\Summary;

use LeoGalleguillos\Twitter\View\Helper\ShareUrl as TwitterShareUrlHelper;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use Zend\View\Helper\AbstractHelper;

class TwitterShareUrl extends AbstractHelper
{
    public function __construct(
        TwitterShareUrlHelper $twitterShareUrlHelper,
        SummaryUrlService $summaryUrlService
    ) {
        $this->twitterShareUrlHelper = $twitterShareUrlHelper;
        $this->summaryUrlService      = $summaryUrlService;
    }

    public function __invoke()
    {
        return $this;
    }

    public function getTwitterShareUrl(SummaryEntity $summaryEntity) : string
    {
        return $this->twitterShareUrlHelper->getShareUrl(
            $this->summaryUrlService->getUrl($summaryEntity)
        );
    }
}
