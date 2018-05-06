<?php
namespace LeoGalleguillos\SummaryTest\Model\Table;

use Generator;
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
        $configArray        = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray        = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter      = new Adapter($configArray);
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
            1,
            'Title'
        );

        $this->assertSame(
            1,
            $this->summaryTable->selectCount()
        );
    }

    public function testSelect()
    {
        $this->summaryTable->insert(
            1,
            'Title'
        );

        $generator = $this->summaryTable->select();
        $this->assertInstanceOf(
            Generator::class,
            $generator
        );

        $array = [
            'summary_id'      => '1',
            'webpage_id'      => '1',
            'title'           => 'Title',
            'n_grams_updated' => null,
        ];
        $this->assertSame(
            $array,
            $generator->current()
        );
    }

    public function testSelectCount()
    {
        $this->assertSame(
            0,
            $this->summaryTable->selectCount()
        );
    }

    public function testSelectWhereSummaryId()
    {
        $this->summaryTable->insert(
            1,
            'Title'

        );

        $arrayObject = [
            'summary_id'      => '1',
            'webpage_id'      => '1',
            'title'           => 'Title',
            'n_grams_updated' => null,
        ];
        $this->assertEquals(
            $arrayObject,
            $this->summaryTable->selectWhereSummaryId(1)
        );
    }
}
