<?php
namespace LeoGalleguillos\SummaryTest\Model\Factory\View\Helper\Summary\Html\Head;

use Interop\Container\ContainerInterface;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\FacebookShareUrl as FacebookShareUrlHelperFactory;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use LeoGalleguillos\Summary\View\Helper\Summary\FacebookShareUrl as FacebookShareUrlHelper;
use PHPUnit\Framework\TestCase;

class FacebookShareUrlTest extends TestCase
{
    protected function setUp()
    {
        $this->facebookShareUrlHelperFactory = new FacebookShareUrlHelperFactory();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            FacebookShareUrlHelperFactory::class,
            $this->facebookShareUrlHelperFactory
        );
    }

    public function testInvoke()
    {
        $summaryUrlServiceMock  = $this->createMock(SummaryUrlService::class);
        $containerInterfaceMock = $this->createMock(ContainerInterface::class);
        $containerInterfaceMock->method('get')->willReturn($summaryUrlServiceMock);
        $this->assertInstanceOf(
            FacebookShareUrlHelper::class,
            $this->facebookShareUrlHelperFactory->__invoke($containerInterfaceMock, '', null)
        );
    }
}
