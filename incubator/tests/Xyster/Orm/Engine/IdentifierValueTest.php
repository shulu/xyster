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
// Call Xyster_Orm_Engine_IdentifierValueTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Orm_Engine_IdentifierValueTest::main');
}
require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'Xyster/Orm/Engine/IdentifierValue.php';

/**
 * Test class for Xyster_Orm_Engine_IdentifierValue.
 * Generated by PHPUnit on 2008-08-11 at 15:01:31.
 */
class Xyster_Orm_Engine_IdentifierValueTest extends PHPUnit_Framework_TestCase
{
    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Orm_Engine_IdentifierValueTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Tests normal operation of the class
     */
    public function testNormal()
    {
        $val = new Xyster_Orm_Engine_IdentifierValue('foobar');
        $this->assertEquals('foobar', $val->getDefaultValue(123));
        $this->assertTrue($val->isUnsaved('foobar'));
        $this->assertTrue($val->isUnsaved(null));
        $this->assertFalse($val->isUnsaved('something'));
    }

    /**
     * Tests the 'any' method
     */
    public function testAny()
    {
        $val = Xyster_Orm_Engine_IdentifierValue::Any();
        $this->assertSame($val, Xyster_Orm_Engine_IdentifierValue::factory('any'));
        $this->assertEquals(123, $val->getDefaultValue(123));
        $this->assertTrue($val->isUnsaved(null));
        $this->assertTrue($val->isUnsaved(123));
    }

    /**
     * Tests the 'none' method
     */
    public function testNone()
    {
        $val = Xyster_Orm_Engine_IdentifierValue::None();
        $this->assertSame($val, Xyster_Orm_Engine_IdentifierValue::factory('none'));
        $this->assertEquals(123, $val->getDefaultValue(123));
        $this->assertFalse($val->isUnsaved(null));
        $this->assertFalse($val->isUnsaved(123));
    }

    /**
     * Tests the 'null' method
     */
    public function testNull()
    {
        $val = Xyster_Orm_Engine_IdentifierValue::Null();
        $this->assertSame($val, Xyster_Orm_Engine_IdentifierValue::factory('null'));
        $this->assertFalse($val->isUnsaved(123));
        $this->assertTrue($val->isUnsaved(null));
        $this->assertNull($val->getDefaultValue(123));
    }

    /**
     * Tests the 'undefined' method
     */
    public function testUndefined()
    {
        $val = Xyster_Orm_Engine_IdentifierValue::Undefined();
        $this->assertSame($val, Xyster_Orm_Engine_IdentifierValue::factory('undefined'));
        $this->assertNull($val->getDefaultValue(123));
        $this->assertNull($val->isUnsaved(123));
    }
}

// Call Xyster_Orm_Engine_IdentifierValueTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Orm_Engine_IdentifierValueTest::main') {
    Xyster_Orm_Engine_IdentifierValueTest::main();
}
