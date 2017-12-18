<?php
namespace LeoGalleguillos\Summary\Model\Table;

use ArrayObject;
use Zend\Db\Adapter\Adapter;

class Source
{
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return int Primary key
     */
    public function insert(
        int $summaryId,
        string $url,
        string $title
    ) {
        $sql = '
            INSERT
              INTO `source` (`summary_id`, `url`, `title`)
            VALUES (?, ?, ?)
                 ;
        ';
        $parameters = [
            $summaryId,
            $url,
            $title,
        ];
        return $this->adapter
                    ->query($sql, $parameters)
                    ->getGeneratedValue();
    }

    public function selectCount()
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `source`
                 ;
        ';
        $row = $this->adapter->query($sql)->execute()->current();
        return (int) $row['count'];
    }

    /**
     * @return ArrayObject
     */
    public function selectWhereSourceId(int $sourceId) : ArrayObject
    {
        $sql = '
            SELECT `source`.`source_id`
                 , `source`.`summary_id`
                 , `source`.`url`
                 , `source`.`title`
              FROM `source`
             WHERE `source`.`source_id` = ?
                 ;
        ';
        $result = $this->adapter->query($sql, [$sourceId])->current();

        return $result;
    }

    /**
     * @return ArrayObject
     */
    public function selectWhereSummaryId(int $summaryId) : ArrayObject
    {
        $sql = '
            SELECT `source`.`source_id`
                 , `source`.`summary_id`
                 , `source`.`url`
                 , `source`.`title`
              FROM `source`
             WHERE `source`.`summary_id` = ?
                 ;
        ';
        $rows = $this->adapter->query($sql, [$summaryId]);

        $arrayObjects = new ArrayObject;

        foreach ($rows as $row) {
            $arrayObjects[] = $row;
        }

        return $arrayObjects;
    }
}
