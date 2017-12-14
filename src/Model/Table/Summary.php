<?php
namespace LeoGalleguillos\Summary\Model\Table;

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
        string $title,
        string $body
    ) {
        $sql = '
            INSERT
              INTO `summary` (`title`, `body`)
            VALUES (?, ?)
                 ;
        ';
        $parameters = [
            $title,
            $body,
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
}
