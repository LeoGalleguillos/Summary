<?php
namespace LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary;

use Interop\Container\ContainerInterface;
use LeoGalleguillos\Facebook\View\Helper\ShareUrl as FacebookShareUrlHelper;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use LeoGalleguillos\Summary\View\Helper\Summary\FacebookShareUrl as SummaryFacebookShareUrlHelper;
use Zend\ServiceManager\Factory\FactoryInterface;

class FacebookShareUrl implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $viewHelperManager = $container->get('ViewHelperManager');
        return new SummaryFacebookShareUrlHelper(
            $viewHelperManager->get(FacebookShareUrlHelper::class),
            $container->get(SummaryUrlService::class)
        );
    }
}
