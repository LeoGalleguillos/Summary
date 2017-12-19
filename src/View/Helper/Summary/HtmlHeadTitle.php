<?php
namespace LeoGalleguillos\Summary\View\Helper\Summary;

use Zend\View\Helper\AbstractHelper;

class HtmlHeadTitle extends AbstractHelper
{
    public function __construct(
    ) {
    }

    public function __invoke()
    {
        return $this;
    }

    public function getHtmlHeadTitle()
    {
        return 'wow';
    }
}
