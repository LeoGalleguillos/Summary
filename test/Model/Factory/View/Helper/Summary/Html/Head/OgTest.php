<?php
namespace LeoGalleguillos\SummaryTest\Model\Factory\View\Helper\Summary\Html\Head;

use Interop\Container\ContainerInterface;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\Html\Head\Og as OgHelperFactory;
use LeoGalleguillos\Summary\View\Helper\Summary\Html\Head\Og as OgHelper;
use PHPUnit\Framework\TestCase;

class OgTest extends TestCase
{
    protected function setUp()
    {
        $this->ogHelperFactory = new OgHelperFactory();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(OgHelperFactory::class, $this->ogHelperFactory);
    }

    public function testInvoke()
    {
        $containerInterfaceMock = $this->createMock(ContainerInterface::class);
        $this->assertInstanceOf(
            OgHelper::class,
            $this->ogHelperFactory->__invoke($containerInterfaceMock, '', null)
        );
    }
}
