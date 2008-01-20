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
 * @subpackage Xyster_Container
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */

// Call Xyster_Container_Adapter_AbstractTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Container_Adapter_AbstractTest::main');
}

/**
 * Test helper
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'TestHelper.php';

require_once 'PHPUnit/Framework.php';
require_once 'Xyster/Container/Adapter/Abstract.php';

/**
 * Test class for Xyster_Container_Adapter_Abstract.
 * Generated by PHPUnit on 2007-12-19 at 18:53:15.
 */
class Xyster_Container_Adapter_AbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Xyster_Container_Adapter_Abstract
     */
    protected $object;

    protected $_key;
    
    protected $_class = 'ArrayObject';
    
    /**
     * Runs the test methods of this class.
     * 
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';

        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Container_Adapter_AbstractTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        require_once 'Xyster/Type.php';
        $class = new Xyster_Type($this->_class);
        $this->_key = $class;
        $this->object = new Xyster_Container_Adapter_AbstractStub($this->_key, $class);
    }

    /**
     * Tests the 'accept' method
     */
    public function testAccept()
    {
        require_once 'Xyster/Container/Visitor/Mock.php';
        $visitor = new Xyster_Container_Visitor_Mock;
        $this->object->accept($visitor);
        $this->assertEquals(1, $visitor->getCalled('visitComponentAdapter'));
    }

    /**
     * Tests the change monitor method
     */
    public function testChangeMonitor()
    {
        require_once 'Xyster/Container/Monitor/Null.php';
        $monitor = new Xyster_Container_Monitor_Null;
        $this->object->changeMonitor($monitor);
        
        $this->assertSame($monitor, $this->object->currentMonitor());
    }

    /**
     * Tests the 'currentMonitor' method
     */
    public function testCurrentMonitor()
    {
        $this->assertType('Xyster_Container_Monitor_Null', $this->object->currentMonitor());
    }

    /**
     * Tests the 'getDelegate' method
     */
    public function testGetDelegate()
    {
        $this->assertNull($this->object->getDelegate());
    }

    /**
     * Tests the 'getImplementation' method
     */
    public function testGetImplementation()
    {
        $this->assertType('Xyster_Type', $this->object->getImplementation());
        $this->assertEquals($this->_class, $this->object->getImplementation()->getName());
    }

    /**
     * Tests the 'getKey' method
     */
    public function testGetKey()
    {
        $this->assertSame($this->_key, $this->object->getKey());
    }

    /**
     * Tests the 'toString' method
     */
    public function test__toString()
    {
        $this->assertEquals($this->object->getDescriptor() . (string)$this->_key, $this->object->__toString());
    }
    
    /**
     * Tests supplying a null key will throw an exception
     *
     */
    public function testBadConstruct()
    {
        $this->setExpectedException('Xyster_Container_Exception');
        $object = new Xyster_Container_Adapter_AbstractStub(null, $this->_key);
    }

    /**
     * Tests key must be same type as implementation
     *
     */
    public function testIncompatibleTypes()
    {
        $this->setExpectedException('Xyster_Container_Exception');
        $object = new Xyster_Container_Adapter_AbstractStub(new Xyster_Type('SplObjectStorage'), $this->_key);
    }
}

/**
 * A stub abstract adapter
 *
 */
class Xyster_Container_Adapter_AbstractStub extends Xyster_Container_Adapter_Abstract
{
    public function getInstance(Xyster_Container_Interface $container)
    {
        return $this->getImplementation()->newInstance();
    }
    public function verify(Xyster_Container_Interface $container)
    {
    }
    public function getDescriptor()
    {
        return 'AbstractStub:';
    }
}

// Call Xyster_Container_Adapter_AbstractTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Container_Adapter_AbstractTest::main') {
    Xyster_Container_Adapter_AbstractTest::main();
}