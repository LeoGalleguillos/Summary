<?php
namespace LeoGalleguillos\SummaryTest\Model\Factory\View\Helper\Summary\Html\Head;

use Interop\Container\ContainerInterface;
use LeoGalleguillos\Facebook\View\Helper\ShareUrl as FacebookShareUrlHelper;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\FacebookShareUrl as FacebookShareUrlHelperFactory;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use LeoGalleguillos\Summary\View\Helper\Summary\FacebookShareUrl as SummaryFacebookShareUrlHelper;
use PHPUnit\Framework\TestCase;
use Zend\View\HelperPluginManager;

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
        $viewHelperManagerMock      = $this->createMock(HelperPluginManager::class);
        $facebookShareUrlHelperMock = $this->createMock(FacebookShareUrlHelper::class);
        $summaryUrlServiceMock      = $this->createMock(SummaryUrlService::class);
        $containerInterfaceMock     = $this->createMock(ContainerInterface::class);

        $viewHelperManagerMock->method('get')->willReturn(
            $facebookShareUrlHelperMock
        );
        $containerInterfaceMock->method('get')->will(
            $this->onConsecutiveCalls(
                $viewHelperManagerMock,
                $summaryUrlServiceMock
            )
        );

        $this->assertInstanceOf(
            SummaryFacebookShareUrlHelper::class,
            $this->facebookShareUrlHelperFactory->__invoke($containerInterfaceMock, '', null)
        );
    }
}
