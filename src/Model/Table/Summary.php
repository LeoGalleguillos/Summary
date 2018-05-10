<?php
namespace LeoGalleguillos\Summary\Model\Table;

use Generator;
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
        int $webpageId,
        string $title = null
    ) {
        $sql = '
            INSERT
              INTO `summary` (`webpage_id`, `title`)
            VALUES (?, ?)
                 ;
        ';
        $parameters = [
            $webpageId,
            $title,
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getGeneratedValue();
    }

    public function select() : Generator
    {
        $sql = '
            SELECT `summary`.`summary_id`
                 , `summary`.`webpage_id`
                 , `summary`.`title`
                 , `summary`.`n_grams_updated`
              FROM `summary`
                 ;
        ';
        foreach ($this->adapter->query($sql)->execute() as $array) {
            yield $array;
        }
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
     * @return int
     */
    public function selectMaxWebpageId() : int
    {
        $sql = '
            SELECT MAX(`summary`.`webpage_id`) AS `webpage_id`
              FROM `summary`
                 ;
        ';
        return (int) $this->adapter->query($sql)->execute()->current()['webpage_id'];
    }

    /**
     * @return array
     */
    public function selectWhereSummaryId($summaryId) : array
    {
        $sql = '
            SELECT `summary`.`summary_id`
                 , `summary`.`webpage_id`
                 , `summary`.`title`
                 , `summary`.`n_grams_updated`
              FROM `summary`
             WHERE `summary`.`summary_id` = ?
                 ;
        ';
        return $this->adapter->query($sql)->execute([$summaryId])->current();
    }
}
