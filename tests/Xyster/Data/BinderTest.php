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
 * @subpackage Xyster_Data
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */

// Call Xyster_Data_BinderTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Data_BinderTest::main');
}

require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'PHPUnit/Framework.php';
require_once 'Xyster/Data/Binder.php';

/**
 * Test class for Xyster_Data_Binder.
 * Generated by PHPUnit on 2008-05-06 at 20:45:04.
 */
class Xyster_Data_BinderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Xyster_Data_Binder
     */
    protected $object;

    protected $target;
    
    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Data_BinderTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->target = new stdClass;
        $this->object = new Xyster_Data_Binder($this->target);
    }
    
    /**
     * Tests the constructor
     *
     */
    public function testBadConstruct()
    {
        $this->setExpectedException('Xyster_Data_Binder_Exception');
        $test = new Xyster_Data_Binder('obviously a string');
    }
    
    /**
     * Tests the 'addSetter' method
     */
    public function testAddSetter()
    {
        $setter = new Xyster_Data_BinderTest_Setter;
        $return = $this->object->addSetter($setter, 'here');
        $this->assertSame($this->object, $return);
        $values = array('foo' => 'bar', 'this' => 'that', 'here' => 'there');
        $this->object->bind($values);
        $this->assertEquals(1, $setter->called);
    }
    
    /**
     * Tests the 'addSetter' method
     */
    public function testAddSetterAll()
    {
        $setter = new Xyster_Data_BinderTest_Setter;
        $return = $this->object->addSetter($setter);
        $this->assertSame($this->object, $return);
        $values = array('foo' => 'bar', 'this' => 'that', 'here' => 'there');
        $this->object->bind($values);
        $this->assertEquals(3, $setter->called);
    }
    
    /**
     * Tests the 'bind' method
     */
    public function testBind()
    {
        $values = array('foo' => 'bar', 'this' => 'that', 'here' => 'there');
        $this->object->bind($values);
        foreach( $values as $name => $value ) {
            $this->assertEquals($value, $this->target->$name);
        }
    }

    /**
     * Tests the 'getTarget' method
     */
    public function testGetTarget()
    {
        $this->assertSame($this->target, $this->object->getTarget());
    }

    /**
     * Tests the 'isAllowed' method
     */
    public function testIsAllowed()
    {
        $this->object->setAllowedFields(array('foo', 'bar'));
        $this->assertTrue($this->object->isAllowed('foo'));
        $this->assertTrue($this->object->isAllowed('bar'));
        $this->assertFalse($this->object->isAllowed('test'));
        
        $this->object->setDisallowedFields(array('foo', 'silly'));
        $this->assertFalse($this->object->isAllowed('foo'));
        $this->assertFalse($this->object->isAllowed('silly'));
        $this->assertTrue($this->object->isAllowed('bar'));
        $this->assertTrue($this->object->isAllowed('test'));
    }

    /**
     * Tests the allowed fields methods 
     */
    public function testGetAndSetAllowedFields()
    {
        $fields = array('foo', 'bar', 'foobar');
        $return = $this->object->setAllowedFields($fields);
        $this->assertSame($this->object, $return);
        $this->assertEquals($fields, $this->object->getAllowedFields());
    }

    /**
     * Tests the disallowed fields methods
     */
    public function testGetAndSetDisallowedFields()
    {
        $fields = array('foo', 'bar', 'foobar');
        $return = $this->object->setDisallowedFields($fields);
        $this->assertSame($this->object, $return);
        $this->assertEquals($fields, $this->object->getDisallowedFields());
    }
}

require_once 'Xyster/Data/Binder/Setter.php';

class Xyster_Data_BinderTest_Setter extends Xyster_Data_Binder_Setter
{
    public $called = 0;
    
    public function set($target, $field, $value)
    {
        $this->called++;
        parent::set($target, $field, $value);
    }
}

// Call Xyster_Data_BinderTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Data_BinderTest::main') {
    Xyster_Data_BinderTest::main();
}
