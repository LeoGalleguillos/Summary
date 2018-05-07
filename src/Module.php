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
                        $serviceManager->get(SummaryTable\Summary\NGramsUpdated::class),
                        $serviceManager->get(SummaryTable\Summary\Title::class),
                        $serviceManager->get(WebsiteFactory\Webpage::class)
                    );
                },
                SummaryService\NGrams::class => function ($serviceManager) {
                    return new SummaryService\NGrams(
                        $serviceManager->get(HtmlService\WordsOnly::class),
                        $serviceManager->get(StringService\NGrams\SortedByCount::class),
                        $serviceManager->get(SummaryTable\NGram2::class),
                        $serviceManager->get(SummaryTable\NGram3::class),
                        $serviceManager->get(SummaryTable\NGram4::class)
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
                SummaryTable\NGram2::class => function ($serviceManager) {
                    return new SummaryTable\NGram2(
                        $serviceManager->get('main')
                    );
                },
                SummaryTable\NGram3::class => function ($serviceManager) {
                    return new SummaryTable\NGram3(
                        $serviceManager->get('main')
                    );
                },
                SummaryTable\NGram4::class => function ($serviceManager) {
                    return new SummaryTable\NGram4(
                        $serviceManager->get('main')
                    );
                },
                SummaryTable\Summary::class => function ($serviceManager) {
                    return new SummaryTable\Summary(
                        $serviceManager->get('main')
                    );
                },
                SummaryTable\Summary\NGramsUpdated::class => function ($serviceManager) {
                    return new SummaryTable\Summary\NGramsUpdated(
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
