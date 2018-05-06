<?php
namespace LeoGalleguillos\Summary\Model\Table\Summary;

use Zend\Db\Adapter\Adapter;

class NGramsUpdated
{
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function updateSetNGramsUpdatedToNowWhereSummaryId(
        int $summaryId
    ) {
        $sql = '
            UPDATE `summary`
               SET `n_grams_updated` = NOW()
             WHERE `summary_id` = ?
                 ;
        ';
        $parameters = [
            $summaryId
        ];
        return (bool) $this->adapter
                           ->query($sql)
                           ->execute($parameters)
                           ->getAffectedRows();
    }
}
