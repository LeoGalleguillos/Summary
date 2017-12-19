<?php
namespace LeoGalleguillos\Summary;

use LeoGalleguillos\Summary\Model\Factory\Source as SourceFactory;
use LeoGalleguillos\Summary\Model\Factory\Summary as SummaryFactory;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\HtmlHeadTitle as HtmlHeadTitleHelperFactory;
use LeoGalleguillos\Summary\Model\Service\Summary as SummaryService;
use LeoGalleguillos\Summary\Model\Table\Source as SourceTable;
use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'factories' => [
                    'summaryHtmlHeadTitle' => HtmlHeadTitleHelperFactory::class,
                ],
            ],
        ];
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                SourceFactory::class => function ($serviceManager) {
                    return new SourceFactory(
                        $serviceManager->get(SourceTable::class)
                    );
                },
                SummaryFactory::class => function ($serviceManager) {
                    return new SummaryFactory(
                        $serviceManager->get(SummaryTable::class)
                    );
                },
                SummaryService::class => function ($serviceManager) {
                    return new SummaryService(
                        $serviceManager->get(SourceFactory::class),
                        $serviceManager->get(SourceTable::class)
                    );
                },
                SourceTable::class => function ($serviceManager) {
                    return new SourceTable(
                        $serviceManager->get('main')
                    );
                },
                SummaryTable::class => function ($serviceManager) {
                    return new SummaryTable(
                        $serviceManager->get('main')
                    );
                },
            ],
        ];
    }
}
