<?php
namespace LeoGalleguillos\Summary\Model\Table;

use Generator;
use Zend\Db\Adapter\Adapter;

class NGram4
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
        int $count,
        string $word1,
        string $word2,
        string $word3,
        string $word4
    ) : int {
        $sql = '
            INSERT
              INTO `n_gram_4` (
                       `summary_id`, `count`, `word_1`, `word_2`, `word_3`, `word_4`
                   )
            VALUES (?, ?, ?, ?, ?, ?)
                 ;
        ';
        $parameters = [
            $summaryId,
            $count,
            $word1,
            $word2,
            $word3,
            $word4,
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
              FROM `n_gram_4`
                 ;
        ';
        return (int) $this->adapter->query($sql)->execute()->current()['count'];
    }
}
