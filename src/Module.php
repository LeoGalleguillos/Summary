<?php
namespace LeoGalleguillos\Summary;

use LeoGalleguillos\String\Model\Service\UrlFriendly as UrlFriendlyService;
use LeoGalleguillos\Summary\Model\Factory\Source as SourceFactory;
use LeoGalleguillos\Summary\Model\Factory\Summary as SummaryFactory;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\FacebookShareUrl as FacebookShareUrlHelperFactory;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\Html\Head\Og as OgHelperFactory;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\HtmlHeadTitle as HtmlHeadTitleHelperFactory;
use LeoGalleguillos\Summary\Model\Service\Summary as SummaryService;
use LeoGalleguillos\Summary\Model\Service\Summary\RootRelativeUrl as SummaryRootRelativeUrlService;
use LeoGalleguillos\Summary\Model\Service\Summary\Slug as SummarySlugService;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use LeoGalleguillos\Summary\Model\Table\Source as SourceTable;
use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'factories' => [
                    'facebookShareUrl'     => FacebookShareUrlHelperFactory::class,
                    'summaryOg'            => OgHelperFactory::class,
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
                SummaryRootRelativeUrlService::class => function ($serviceManager) {
                    return new SummaryRootRelativeUrlService(
                        $serviceManager->get(SummarySlugService::class)
                    );
                },
                SummarySlugService::class => function ($serviceManager) {
                    return new SummaryService(
                        $serviceManager->get(UrlFriendlyService::class)
                    );
                },
                SummaryUrlService::class => function ($serviceManager) {
                    return new SummaryUrlService(
                        $serviceManager->get(SummaryRootRelativeUrlService::class)
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
