<?php
/**
 * Xyster Framework
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/bsd-license.php
 *
 * @category  Xyster
 * @package   UnitTests
 * @subpackage Xyster_Db
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
// Call Xyster_Db_IndexTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Db_IndexTest::main');
}
require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'Xyster/Db/Index.php';
require_once 'Xyster/Db/Table.php';

/**
 * Test class for Xyster_Db_Index.
 * Generated by PHPUnit on 2008-07-09 at 11:55:54.
 */
class Xyster_Db_IndexTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Xyster_Db_Index
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Db_IndexTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new Xyster_Db_Index;
    }

    /**
     * Tests the 'addColumn' and 'getSortedColumns' methods
     */
    public function testAddColumn()
    {
        $column = new Xyster_Db_Column('foobar');
        $return = $this->object->addColumn($column);
        $this->assertSame($this->object, $return);
        $this->assertEquals(1, $this->object->getColumnSpan());
        $sort = current($this->object->getSortedColumns());
        $this->assertEquals($sort->getDirection(), 'ASC');
    }
    
    /**
     * Tests the 'addSortedColumn' method
     */
    public function testAddSortedColumn()
    {
        $column = new Xyster_Db_Column('foobar');
        $sort = $column->desc();
        $return = $this->object->addSortedColumn($sort);
        $this->assertSame($this->object, $return);
        $this->assertEquals(1, $this->object->getColumnSpan());
    }
    
    /**
     * Tests the 'getTable' and 'setTable' methods
     */
    public function testGetAndSetTable()
    {
        $table = new Xyster_Db_Table;
        $this->assertSame($this->object, $this->object->setTable($table));
        $this->assertSame($table, $this->object->getTable());
    }

    /**
     * Tests the 'isFulltext' and 'setFulltext' methods
     */
    public function testIsAndSetFulltext()
    {
        $this->assertFalse($this->object->isFulltext());
        $this->assertSame($this->object, $this->object->setFulltext());
        $this->assertTrue($this->object->isFulltext());
        $this->object->setFulltext(false);
        $this->assertFalse($this->object->isFulltext());
    }
}

// Call Xyster_Db_IndexTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Db_IndexTest::main') {
    Xyster_Db_IndexTest::main();
}
