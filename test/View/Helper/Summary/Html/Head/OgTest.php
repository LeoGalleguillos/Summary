<?php
namespace LeoGalleguillos\SummaryTest\View\Helper\Summary\Html\Head;

use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\View\Helper\Summary\Html\Head\Og as OgHelper;
use PHPUnit\Framework\TestCase;

class OgTest extends TestCase
{
    protected function setUp()
    {
        $this->summaryEntity        = new SummaryEntity();
        $this->summaryEntity->title = 'Hello world!';

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

    public function testGetOgType()
    {
        $this->assertSame(
            'article',
            $this->ogHelper->getOgType($this->summaryEntity)
        );
    }
}
