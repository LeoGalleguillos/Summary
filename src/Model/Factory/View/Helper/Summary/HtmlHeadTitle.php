<?php
namespace LeoGalleguillos\Summary\Model\Factory\View\Helper;

use Interop\Container\ContainerInterface;
use LeoGalleguillos\Summary\View\Helper\Summary\HtmlHeadTitle as HtmlHeadTitleHelper;
use Zend\ServiceManager\Factory\FactoryInterface;

class HtmlHeadTitle implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        return new HtmlHeadTitleHelper();
    }
}
