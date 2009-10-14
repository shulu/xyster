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
 * @subpackage Xyster_Orm
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
// Call Xyster_Orm_Type_FloatTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Orm_Type_FloatTest::main');
}
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestFloatCommon.php';
require_once 'Xyster/Orm/Type/Float.php';

/**
 * Test class for Xyster_Orm_Type_Float.
 * Generated by PHPUnit on 2008-07-26 at 15:05:37.
 */
class Xyster_Orm_Type_FloatTest extends Xyster_Orm_Type_TestFloatCommon
{
    /**
     * @var    Xyster_Orm_Type_Float
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Orm_Type_FloatTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new Xyster_Orm_Type_Float;
    }
    
    /**
     * Tests the 'getDataType' method
     */
    public function testGetDataType()
    {
        $this->assertSame(Xyster_Db_DataType::Float(), $this->object->getDataType());
    }

    /**
     * Tests the 'getName' method
     */
    public function testGetName()
    {
        $this->assertEquals('float', $this->object->getName());
    }
}

// Call Xyster_Orm_Type_FloatTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Orm_Type_FloatTest::main') {
    Xyster_Orm_Type_FloatTest::main();
}