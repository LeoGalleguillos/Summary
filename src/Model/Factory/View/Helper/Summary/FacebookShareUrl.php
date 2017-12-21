<?php
namespace LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary;

use Interop\Container\ContainerInterface;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use LeoGalleguillos\Summary\View\Helper\Summary\FacebookShareUrl as FacebookShareUrlHelper;
use Zend\ServiceManager\Factory\FactoryInterface;

class FacebookShareUrl implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        return new FacebookShareUrlHelper(
            $container->get(SummaryUrlService::class)
        );
    }
}
