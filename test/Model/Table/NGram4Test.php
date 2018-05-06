<?php
namespace LeoGalleguillos\SummaryTest\Model\Table;

use Generator;
use LeoGalleguillos\Summary\Model\Table as SummaryTable;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class NGram4Test extends TestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/leogalle_test/n_gram_4/';

    /**
     * @var SummaryTable
     */
    protected $nGram4Table;

    protected function setUp()
    {
        $configArray       = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray       = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter     = new Adapter($configArray);
        $this->nGram4Table = new SummaryTable\NGram4($this->adapter);

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
            SummaryTable\NGram4::class,
            $this->nGram4Table
        );
    }

    public function testInsert()
    {
        $this->nGram4Table->insert(
            1,
            2,
            'word1',
            'word2',
            'word3',
            'word4'
        );

        $this->assertSame(
            1,
            $this->nGram4Table->selectCount()
        );
    }
}
