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
// Call Xyster_Db_ConstraintTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Db_ConstraintTest::main');
}
require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'Xyster/Db/Constraint.php';
require_once 'Xyster/Db/Table.php';

/**
 * Test class for Xyster_Db_Constraint.
 * Generated by PHPUnit on 2008-07-08 at 23:45:56.
 */
class Xyster_Db_ConstraintTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Xyster_Db_Constraint
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Db_ConstraintTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new Xyster_Db_ConstraintTest_Stub;
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
}

class Xyster_Db_ConstraintTest_Stub extends Xyster_Db_Constraint
{    
}

// Call Xyster_Db_ConstraintTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Db_ConstraintTest::main') {
    Xyster_Db_ConstraintTest::main();
}
