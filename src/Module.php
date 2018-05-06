<?php
namespace LeoGalleguillos\Summary;

use LeoGalleguillos\Html\Model\Service as HtmlService;
use LeoGalleguillos\String\Model\Service as StringService;
use LeoGalleguillos\Summary\Model\Factory\Source as SourceFactory;
use LeoGalleguillos\Summary\Model\Factory as SummaryFactory;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\FacebookShareUrl as FacebookShareUrlHelperFactory;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\TwitterShareUrl as TwitterShareUrlHelperFactory;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\Html\Head\Og as OgHelperFactory;
use LeoGalleguillos\Summary\Model\Factory\View\Helper\Summary\HtmlHeadTitle as HtmlHeadTitleHelperFactory;
use LeoGalleguillos\Summary\Model\Service as SummaryService;
use LeoGalleguillos\Summary\Model\Service\Summary\Url as SummaryUrlService;
use LeoGalleguillos\Summary\Model\Table\Source as SourceTable;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;
use LeoGalleguillos\Summary\View\Helper\Summary\FacebookShareUrl as FacebookShareUrlHelper;
use LeoGalleguillos\Summary\View\Helper\Summary\TwitterShareUrl as TwitterShareUrlHelper;
use LeoGalleguillos\Website\Model\Factory as WebsiteFactory;

class Module
{
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases' => [
                    'summaryFacebookShareUrl' => FacebookShareUrlHelper::class,
                    'summaryTwitterShareUrl'  => TwitterShareUrlHelper::class,
                ],
                'factories' => [
                    FacebookShareUrlHelper::class => FacebookShareUrlHelperFactory::class,
                    TwitterShareUrlHelper::class  => TwitterShareUrlHelperFactory::class,
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
                SummaryFactory\Summary::class => function ($serviceManager) {
                    return new SummaryFactory\Summary(
                        $serviceManager->get(SummaryService\NGrams::class),
                        $serviceManager->get(SummaryService\RootRelativeUrl::class),
                        $serviceManager->get(SummaryService\Title::class),
                        $serviceManager->get(SummaryTable\Summary::class),
                        $serviceManager->get(WebsiteFactory\Webpage::class)
                    );
                },
                SummaryService\NGrams::class => function ($serviceManager) {
                    return new SummaryService\NGrams(
                        $serviceManager->get(HtmlService\WordsOnly::class),
                        $serviceManager->get(StringService\NGrams\SortedByCount::class)
                    );
                },
                SummaryService\Summary::class => function ($serviceManager) {
                    return new SummaryService\Summary(
                        $serviceManager->get(SourceFactory::class),
                        $serviceManager->get(SourceTable::class)
                    );
                },
                SummaryService\RootRelativeUrl::class => function ($serviceManager) {
                    return new SummaryService\RootRelativeUrl(
                        $serviceManager->get(SummaryService\Slug::class)
                    );
                },
                SummaryService\SummaryEntities::class => function ($serviceManager) {
                    return new SummaryService\SummaryEntities(
                        $serviceManager->get(SummaryFactory\Summary::class),
                        $serviceManager->get(SummaryTable\Summary::class)
                    );
                },
                SummaryService\Slug::class => function ($serviceManager) {
                    return new SummaryService\Slug(
                        $serviceManager->get(StringService\UrlFriendly::class)
                    );
                },
                SummaryService\Title::class => function ($serviceManager) {
                    return new SummaryService\Title();
                },
                SummaryUrlService::class => function ($serviceManager) {
                    return new SummaryUrlService(
                        $serviceManager->get(SummaryService\RootRelativeUrl::class)
                    );
                },
                SourceTable::class => function ($serviceManager) {
                    return new SourceTable(
                        $serviceManager->get('main')
                    );
                },
                SummaryTable\Summary::class => function ($serviceManager) {
                    return new SummaryTable\Summary(
                        $serviceManager->get('main')
                    );
                },
                SummaryTable\Summary\Title::class => function ($serviceManager) {
                    return new SummaryTable\Summary\Title(
                        $serviceManager->get('main')
                    );
                },
            ],
        ];
    }
}
