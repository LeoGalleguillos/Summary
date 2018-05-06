<?php
namespace LeoGalleguillos\Summary\Model\Table\Summary;

use Generator;
use Zend\Db\Adapter\Adapter;

class Title
{
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function updateSetTitleWhereSummaryId(
        string $title,
        int $summaryId
    ) {
        $sql = '
            UPDATE `summary`
               SET `title` = :title
             WHERE `summary_id` = :summaryId
                 ;
        ';
        $parameters = [
            'title'     => $title,
            'summaryId' => $summaryId,
        ];
        return (bool) $this->adapter
                           ->query($sql)
                           ->execute([$parameters])
                           ->getAffectedRows();
    }
}
