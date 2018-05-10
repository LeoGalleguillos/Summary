<?php
namespace LeoGalleguillos\SummaryTest\Model\Table;

use Generator;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class NGram2Test extends TestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/leogalle_test/n_gram_2/';

    /**
     * @var SummaryTable
     */
    protected $nGram2Table;

    protected function setUp()
    {
        $configArray       = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray       = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter     = new Adapter($configArray);
        $this->nGram2Table = new SummaryTable\NGram2($this->adapter);

        $this->dropTable();
        $this->createTable();
    }

    protected function dropTable()
    {
        $sql = file_get_contents($this->sqlPath . 'drop.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    protected function createTable()
    {
        $sql = file_get_contents($this->sqlPath . 'create.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            SummaryTable\NGram2::class,
            $this->nGram2Table
        );
    }

    public function testInsert()
    {
        $this->nGram2Table->insertIgnore(
            1,
            2,
            'word1',
            'word2'
        );
        $this->assertSame(
            1,
            $this->nGram2Table->selectCount()
        );
    }

    public function testSelectWhereSummaryId()
    {
        $generator = $this->nGram2Table->selectWhereSummaryId(1);
        $this->assertNull($generator->current());

        $this->nGram2Table->insertIgnore(
            1,
            100,
            'word1',
            'word2'
        );
        $this->nGram2Table->insertIgnore(
            1,
            50,
            'word1',
            'word2'
        );
        $generator = $this->nGram2Table->selectWhereSummaryId(1);
        $array = [
            'summary_id' => '1',
            'count'      => '100',
            'word_1'     => 'word1',
            'word_2'     => 'word2',
        ];
        $this->assertSame(
            $array,
            $generator->current()
        );
        $generator->next();
        $array = [
            'summary_id' => '1',
            'count'      => '50',
            'word_1'     => 'word1',
            'word_2'     => 'word2',
        ];
        $this->assertSame(
            $array,
            $generator->current()
        );
    }
}
