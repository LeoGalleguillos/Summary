<?php
namespace LeoGalleguillos\SummaryTest\View\Helper\Summary\Html\Head;

use LeoGalleguillos\Image\Model\Entity\Image as ImageEntity;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\View\Helper\Summary\Html\Head\Og as OgHelper;
use PHPUnit\Framework\TestCase;

class OgTest extends TestCase
{
    protected function setUp()
    {
        $this->summaryEntity        = new SummaryEntity();
        $this->summaryEntity->setTitle('Hello world!');

        $this->summaryEntity->thumbnail                   = new ImageEntity();
        $this->summaryEntity->thumbnail->rootRelativePath = '/path/to/image.jpg';
        $this->summaryEntity->thumbnail->width            = 200;
        $this->summaryEntity->thumbnail->height           = 100;

        $this->ogHelper = new OgHelper();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(OgHelper::class, $this->ogHelper);
    }

    public function testGetOgDescription()
    {
        $this->assertSame(
            'So, to summarize, Hello world!',
            $this->ogHelper->getOgDescription($this->summaryEntity)
        );
    }

    public function testGetOgImageHeight()
    {
        $this->assertSame(
            100,
            $this->ogHelper->getOgImageHeight($this->summaryEntity)
        );
    }

    public function testGetOgImageWidth()
    {
        $this->assertSame(
            200,
            $this->ogHelper->getOgImageWidth($this->summaryEntity)
        );
    }

    public function testGetOgImage()
    {
        $_SERVER['HTTP_HOST'] = 'my.http.host';

        $this->assertSame(
            'https://my.http.host/path/to/image.jpg',
            $this->ogHelper->getOgImage($this->summaryEntity)
        );
    }

    public function testGetOgType()
    {
        $this->assertSame(
            'article',
            $this->ogHelper->getOgType($this->summaryEntity)
        );
    }
}
