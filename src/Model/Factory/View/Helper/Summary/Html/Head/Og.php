<?php
namespace LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\Html\Head;

use Interop\Container\ContainerInterface;
use LeoGalleguillos\Summary\View\Helper\Summary\Html\Head\Og as OgHelper;
use Zend\ServiceManager\Factory\FactoryInterface;

class Og implements FactoryInterface
{
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        return new OgHelper();
    }
}
