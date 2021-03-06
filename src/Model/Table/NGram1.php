<?php
namespace LeoGalleguillos\Summary\Model\Table;

use Generator;
use Zend\Db\Adapter\Adapter;

class NGram1
{
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return int Primary key
     */
    public function insertIgnore(
        int $summaryId,
        int $count,
        string $word1
    ) : int {
        $sql = '
            INSERT IGNORE
              INTO `n_gram_1` (`summary_id`, `count`, `word_1`)
            VALUES (?, ?, ?)
                 ;
        ';
        $parameters = [
            $summaryId,
            $count,
            $word1,
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getGeneratedValue();
    }

    public function selectCount()
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `n_gram_1`
                 ;
        ';
        return (int) $this->adapter->query($sql)->execute()->current()['count'];
    }

    /**
     * @return Generator
     * @yield array
     */
    public function selectWhereSummaryId(int $summaryId) : Generator
    {
        $sql = '
            SELECT `summary_id`, `count`, `word_1`
              FROM `n_gram_1`
             WHERE `summary_id` = ?
             ORDER
                BY `count` DESC
                 ;
        ';
        $parameters = [
            $summaryId,
        ];
        foreach ($this->adapter->query($sql)->execute($parameters) as $array) {
            yield $array;
        }
    }
}
