<?php
namespace LeoGalleguillos\SummaryTest\Model\Table;

use LeoGalleguillos\Summary\Model\Table\Summary as SummaryTable;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class SummaryTest extends TestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/leogalle_test/summary/';

    /**
     * @var SummaryTable
     */
    protected $summaryTable;

    protected function setUp()
    {
        $configArray     = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray     = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter         = new Adapter($configArray);
        $this->summaryTable = new SummaryTable($this->adapter);

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
        $this->assertInstanceOf(SummaryTable::class, $this->summaryTable);
    }

    public function testInsert()
    {
        $this->summaryTable->insert(
            'artist',
            'title',
            'featured artists'
        );

        $this->summaryTable->insert(
            'Rihanna',
            'Work',
            'Drake'
        );

        $this->assertSame(
            2,
            $this->summaryTable->selectCount()
        );
    }

    public function testSelectCount()
    {
        $this->assertSame(
            0,
            $this->summaryTable->selectCount()
        );
    }
}
