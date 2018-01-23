<?php
namespace LeoGalleguillos\SummaryTest\Model\Service\Summary;

use LeoGalleguillos\String\Model\Service\UrlFriendly as UrlFriendlyService;
use LeoGalleguillos\Summary\Model\Entity\Summary as SummaryEntity;
use LeoGalleguillos\Summary\Model\Service as SummaryService;
use LeoGalleguillos\Website\Model\Entity as WebsiteEntity;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    protected function setUp()
    {
        $this->titleService = new SummaryService\Title();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            SummaryService\Title::class,
            $this->titleService
        );
    }

    public function testGetSlug()
    {
        $summaryEntity = new SummaryEntity();
        $nGrams = [
            3 => [
                'bird cat dog' => [
                    'count' => 3,
                    'sequence' => [
                        'bird',
                        'cat',
                        'dog',
                    ],
                ],
                'cat dog elephant' => [
                    'count' => 2,
                    'sequence' => [
                        'cat',
                        'dog',
                        'elephant',
                    ],
                ],
            ],
        ];
        $summaryEntity->setNGrams($nGrams);
        $this->assertSame(
            'bird cat dog, cat dog elephant, ',
            $this->titleService->getTitle($summaryEntity)
        );

        $nGrams = [
            3 => [
                'bird cat dog' => [
                    'count' => 3,
                    'sequence' => [
                        'bird',
                        'cat',
                        'dog',
                    ],
                ],
                'cat dog elephant' => [
                    'count' => 2,
                    'sequence' => [
                        'cat',
                        'dog',
                        'elephant',
                    ],
                ],
                'dog elephant fox' => [
                    'count' => 2,
                    'sequence' => [
                        'dog',
                        'elephant',
                        'fox',
                    ],
                ],
            ],
        ];
        $summaryEntity->setNGrams($nGrams);
        $this->assertSame(
            'bird cat dog, cat dog elephant, and dog elephant fox',
            $this->titleService->getTitle($summaryEntity)
        );
    }
}
