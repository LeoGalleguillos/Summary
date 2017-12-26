<?php
namespace LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary;

use Interop\Container\ContainerInterface;
use LeoGalleguillos\Twitter\View\Helper\ShareUrl as TwitterShareUrlHelper;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use LeoGalleguillos\Summary\View\Helper\Summary\TwitterShareUrl as SummaryTwitterShareUrlHelper;
use Zend\ServiceManager\Factory\FactoryInterface;

class TwitterShareUrl implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $viewHelperManager = $container->get('ViewHelperManager');
        return new SummaryTwitterShareUrlHelper(
            $viewHelperManager->get(TwitterShareUrlHelper::class),
            $container->get(SummaryUrlService::class)
        );
    }
}
