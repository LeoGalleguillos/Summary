<?php
namespace LeoGalleguillos\Summary;

use LeoGalleguillos\Summary\Model\Service\Summary as SummaryService;
use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;

class Module
{
    public function getServiceConfig()
    {
        return [
            'factories' => [
                SummaryService::class => function ($serviceManager) {
                    return new SummaryService();
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
