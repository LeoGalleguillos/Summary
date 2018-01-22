<?php
namespace LeoGalleguillos\Summary\Model\Table;

use ArrayObject;
use Zend\Db\Adapter\Adapter;

class Summary
{
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return int Primary key
     */
    public function insert(
        int $webpageId
    ) {
        $sql = '
            INSERT
              INTO `summary` (`webpage_id`)
            VALUES (?)
                 ;
        ';
        $parameters = [
            $webpageId,
        ];
        return $this->adapter
                    ->query($sql, $parameters)
                    ->getGeneratedValue();
    }

    public function selectCount()
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `summary`
                 ;
        ';
        $row = $this->adapter->query($sql)->execute()->current();
        return (int) $row['count'];
    }

    /**
     * @return ArrayObject
     */
    public function selectWhereSummaryId($summaryId) : ArrayObject
    {
        $sql = '
            SELECT `summary`.`summary_id`
                 , `summary`.`webpage_id`
              FROM `summary`
             WHERE `summary`.`summary_id` = ?
                 ;
        ';
        $result = $this->adapter->query($sql, [$summaryId])->current();

        return $result;
    }
}
