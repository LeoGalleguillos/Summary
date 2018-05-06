<?php
namespace LeoGalleguillos\SummaryTest\Model\Table\Summary;

use LeoGalleguillos\Summary\Model\Table as SummaryTable;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class TitleTest extends TestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../../..' . '/sql/leogalle_test/summary/';

    /**
     * @var SummaryTable
     */
    protected $summaryTable;

    protected function setUp()
    {
        $this->sqlPath      = $_SERVER['PWD'] . '/sql/leogalle_test/summary/';
        $configArray        = require($_SERVER['PWD'] . '/config/autoload/local.php');
        $configArray        = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter      = new Adapter($configArray);
        $this->summaryTitleTable = new SummaryTable\Summary\Title($this->adapter);

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
            SummaryTable\Summary\Title::class,
            $this->summaryTitleTable
        );
    }
}
