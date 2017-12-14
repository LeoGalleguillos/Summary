<?php
namespace LeoGalleguillos\SummaryTest\Model\Table;

use ArrayObject;
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
            'title',
            'body'
        );

        $this->summaryTable->insert(
            'My Amazing Summary',
            'This is the best summary every written.'
        );

        $this->summaryTable->insert(
            'One More',
            'This is the second-best summary every written.'
        );

        $this->assertSame(
            3,
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

    public function testSelectWhereSummaryId()
    {
        $this->summaryTable->insert(
            'title',
            'body'
        );

        $this->summaryTable->insert(
            'My Amazing Summary',
            'This is the best summary every written.'
        );

        $arrayObject = new ArrayObject([
            'summary_id' => '1',
            'title'      => 'title',
            'body'       => 'body',
        ]);
        $this->assertEquals(
            $arrayObject,
            $this->summaryTable->selectWhereSummaryId(1)
        );

        $arrayObject = new ArrayObject([
            'summary_id' => '2',
            'title'      => 'My Amazing Summary',
            'body'       => 'This is the best summary every written.',
        ]);
        $this->assertEquals(
            $arrayObject,
            $this->summaryTable->selectWhereSummaryId(2)
        );
    }
}
