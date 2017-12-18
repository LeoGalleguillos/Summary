<?php
namespace LeoGalleguillos\SummaryTest\Model\Table;

use ArrayObject;
use LeoGalleguillos\Summary\Model\Table\Source as SourceTable;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class SourceTest extends TestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/leogalle_test/source/';

    /**
     * @var SummaryTable
     */
    protected $sourceTable;

    protected function setUp()
    {
        $configArray     = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray     = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter         = new Adapter($configArray);
        $this->sourceTable = new SourceTable($this->adapter);

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
        $this->assertInstanceOf(SourceTable::class, $this->sourceTable);
    }

    public function testInsert()
    {
        $this->sourceTable->insert(
            1,
            'url'
        );

        $this->sourceTable->insert(
            1,
            'the best source ever'
        );

        $this->sourceTable->insert(
            2,
            'This is the second-best source ever cited'
        );

        $this->assertSame(
            3,
            $this->sourceTable->selectCount()
        );
    }

    public function testSelectCount()
    {
        $this->assertSame(
            0,
            $this->sourceTable->selectCount()
        );
    }

    public function testSelectWhereSummaryId()
    {
        $this->sourceTable->insert(
            1,
            'url'
        );
        $arrayObject1 = new ArrayObject([
            'source_id' => 1,
            'summary_id' => 1,
            'url' => 'url',
        ]);

        $this->sourceTable->insert(
            1,
            'the best source ever'
        );
        $arrayObject2 = new ArrayObject([
            'source_id' => 2,
            'summary_id' => 1,
            'url' => 'the best source ever',
        ]);

        $this->sourceTable->insert(
            2,
            'source for another summary ID'
        );
        $arrayObject3 = new ArrayObject([
            'source_id' => 3,
            'summary_id'      => 2,
            'url' => 'source for another summary ID',
        ]);

        $arrayObjects = new ArrayObject();
        $arrayObjects[] = $arrayObject1;
        $arrayObjects[] = $arrayObject2;
        $this->assertEquals(
            $arrayObjects,
            $this->sourceTable->selectWhereSummaryId(1)
        );

        $arrayObjects = new ArrayObject();
        $arrayObjects[] = $arrayObject3;
        $this->assertEquals(
            $arrayObjects,
            $this->sourceTable->selectWhereSummaryId(2)
        );
    }
}
