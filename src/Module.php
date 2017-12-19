<?php
namespace LeoGalleguillos\Summary;

use LeoGalleguillos\Summary\Model\Factory\Source as SourceFactory;
use LeoGalleguillos\Summary\Model\Factory\Summary as SummaryFactory;
use LeoGalleguillos\Summary\Model\Service\Summary as SummaryService;
use LeoGalleguillos\Summary\Model\Table\Source as SourceTable;
use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;

class Module
{
    public function getServiceConfig()
    {
        return [
            'factories' => [
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
                SummaryTable::class => function ($serviceManager) {
                    return new SummaryTable(
                        $serviceManager->get('main')
                    );
                },
            ],
        ];
    }
}
