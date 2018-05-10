<?php
namespace LeoGalleguillos\SummaryTest\Model\Table;

use Generator;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class NGram3Test extends TestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/leogalle_test/n_gram_3/';

    /**
     * @var SummaryTable
     */
    protected $nGram3Table;

    protected function setUp()
    {
        $configArray       = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray       = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter     = new Adapter($configArray);
        $this->nGram3Table = new SummaryTable\NGram3($this->adapter);

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
            SummaryTable\NGram3::class,
            $this->nGram3Table
        );
    }

    public function testInsert()
    {
        $this->nGram3Table->insertIgnore(
            1,
            2,
            'word1',
            'word2',
            'word3'
        );

        $this->assertSame(
            1,
            $this->nGram3Table->selectCount()
        );
    }
}
