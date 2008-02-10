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
 * @subpackage Xyster_Type
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */

// Call Xyster_TypeTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_TypeTest::main');
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'TestHelper.php';

require_once 'Xyster/Type.php';

/**
 * Test class for Xyster_Type.
 * Generated by PHPUnit on 2007-12-28 at 11:09:39.
 */
class Xyster_TypeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Xyster_Type
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     *
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';

        $suite  = new PHPUnit_Framework_TestSuite('Xyster_TypeTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new Xyster_Type('Xyster_Type');
    }

    /**
     * Tests the constructor throws an exception for a bad type
     */
    public function testBadConstruct()
    {
        $this->setExpectedException('Zend_Exception');
        $object = new Xyster_Type('aoeuhtns');
    }
    
    /**
     * Tests the 'equals' method
     */
    public function testEquals()
    {
        $other = new Xyster_Type('Xyster_Type');
        $other2 = new Xyster_Type('Xyster_TypeTest');
        $this->assertNotSame($this->object, $other);
        $this->assertTrue($this->object->equals($other));
        $this->assertFalse($this->object->equals($other2));
    }

    /**
     * Tests the 'getClass' method
     */
    public function testGetClass()
    {
        $class = $this->object->getClass();
        $this->assertType('ReflectionClass', $class);
        $this->assertEquals('Xyster_Type', $class->getName());
    }

    /**
     * Tests the 'getClass' method on a primitive type
     *
     */
    public function testGetClassOnPrimitive()
    {
        $object = new Xyster_Type('array');
        $this->assertNull($object->getClass());
    }
    
    /**
     * Tests the 'getName' method
     */
    public function testGetName()
    {
        $this->assertSame('Xyster_Type', $this->object->getName());
    }

    /**
     * Tests the 'getForParameters' method
     */
    public function testGetForParameters()
    {
    	$class = new ReflectionClass('HashTest');
    	$params = Xyster_Type::getForParameters($class->getMethod('testMethod'));
    	$this->assertEquals('ReflectionClass', $params[0]->getName());
    	$this->assertEquals('array', $params[1]->getName());
    	$this->assertEquals('scalar', $params[2]->getName());
        $this->assertEquals('ReflectionParameter', $params[3]->getName());
        $this->assertEquals('string', $params[4]->getName());
        $this->assertEquals('scalar', $params[5]->getName());
    }
    
    /**
     * Tests the 'hashCode' method
     */
    public function testHashCode()
    {
        $this->assertSame(Xyster_Type::hash('Xyster_Type'), $this->object->hashCode());
    }

    /**
     * Tests the 'isAssignableFrom' method
     */
    public function testIsAssignableFrom()
    {
        $this->assertTrue($this->object->isAssignableFrom('Xyster_Type'));
        $this->assertTrue($this->object->isAssignableFrom($this->object->getClass()));
        $this->assertTrue($this->object->isAssignableFrom($this->object));
        $this->assertTrue($this->object->isAssignableFrom(new Xyster_Type('Xyster_Type')));
        $this->assertFalse($this->object->isAssignableFrom(new Xyster_Type('Xyster_TypeTest')));
    }

    /**
     * Tests the 'isObject' method
     */
    public function testIsObject()
    {
        $this->assertTrue($this->object->isObject());
    }
    
    /**
     * Tests the 'isObject' method on a primitive type
     */
    public function testIsObjectOnPrimitive()
    {
        $object = new Xyster_Type('array');
        $this->assertFalse($object->isObject());
    }
    
    /**
     * Tests the '__toString' method
     */
    public function test__toString()
    {
        $this->assertEquals('Class Xyster_Type', $this->object->__toString());
    }

    /**
     * Tests the 'areEqual' static method
     */
    public function testAreEqual()
    {
        $other = new Xyster_Type('Xyster_Type');
        $notequal = new Xyster_Type('Xyster_TypeTest');
        $object = new stdClass;
        $object->test = 1234;
        $object2 = new stdClass;
        $object2->test = 4567;
        $expected = array(
                array($this->object, $this->object, true),
                array($this->object, $other, true),
                array($this->object, $notequal, false),
                array(123, 123, true),
                array(123, 456, false),
                array('aoeu', 'aoeu', true),
                array('aoeu', 123, false),
                array(array(1), array(1), true),
                array(array(123), $object, false),
                array($object, 'aoeu', false),
                array($object, $this->object, false),
                array($object, $object2, false)
            );
        foreach( $expected as $array ) {
            $this->assertEquals($array[2], Xyster_Type::areEqual($array[0], $array[1]),
                print_r($array[0], true) . ' equals ' . print_r($array[1], true) . ' should be ' . intval($array[2]));
        }
    }
    
    /**
     * Tests the 'areDeeplyEqual' static method
     */
    public function testAreDeeplyEqual()
    {
        $other = new Xyster_Type('Xyster_Type');
        $notequal = new Xyster_Type('Xyster_TypeTest');
        $object = new stdClass;
        $object->foo = 'bar';
        $object->test = 1234;
        $object2 = new stdClass;
        $object2->foo = 'baz';
        $object2->test = 4567;
        $object3 = new stdClass;
        $object3->foo = 'bar';
        $object3->aoeu = 7890;
        $object4 = new stdClass;
        $object4->foo = 'bar';
        $object4->test = 1234;
        $object4->aoeu = 7890;
        
        $a = new stdClass;
        $b = new stdClass;
        $a->obj = $b;
        $b->obj = $a;
        
        $expected = array(
                array($this->object, $this->object, true),
                array($this->object, $other, true),
                array($this->object, $notequal, false),
                array(123, 123, true),
                array(123, 456, false),
                array('aoeu', 'aoeu', true),
                array('aoeu', 123, false),
                array(array(1), array(1), true),
                array(array(123), $object, false),
                array($object, 'aoeu', false),
                array($object, $this->object, false),
                array($object, $object2, false),
                array($object, $object3, false),
                array($object, $object4, false),
                array($object, clone $object, true),
                array($a, $b, true)
            );
        foreach( $expected as $array ) {
            $this->assertEquals($array[2], Xyster_Type::areDeeplyEqual($array[0], $array[1]),
                print_r($array[0], true) . ' equals ' . print_r($array[1], true) . ' should be ' . intval($array[2]));
        }
    }

    /**
     * Tests the static 'hash' method
     */
    public function testHash()
    {
        $test = $this->object->getClass();
        
        $max = (float)PHP_INT_MAX;
        $min = (float)(0 - PHP_INT_MAX);
        $h = 0;
        $hexArray = str_split(spl_object_hash($test), 2);
        foreach( $hexArray as $v ) {
            $result = 31 * $h + hexdec($v);
            if ( $result > $max ) {
                $h = $result % $max;
            } else if ( $result < $min ) {
                $h = 0-(abs($result) % $max);
            } else {
                $h = $result;
            }
        }
        
        $h2 = 0.0;
        foreach( $hexArray as $v ) {
            $result = 31 * $h2 + Xyster_Type::hash($v);
            if ( $result > $max ) {
                $h2 = $result % $max;
            } else if ( $result < $min ) {
                $h2 = 0-(abs($result) % $max);
            } else {
                $h2 = $result;
            }
        }
        
        $expected = array(
                array(99162322, 'hello'),
                array(-1220935217, 'helloa'),
                array(-1821194164, 'hello to the world'),
                array(1333788668, 4294966296),
                array(1345844999, 12345678910),
                array(1123434234, 123.123),
                array(1231, true),
                array(1237, false),
                array(456789, 456789),
                array($h, $test),
                array($h2, $hexArray),
                array(1, new HashTest)
            );
        foreach( $expected as $array ) {
            $hash = Xyster_Type::hash($array[1]);
            $this->assertType('integer', $hash);
            $this->assertEquals($array[0], $hash,
                'Hash for "' . print_r($array[1], true) . '" should be ' . $array[0]);
        }
    }
}

class HashTest
{
	public function testMethod( ReflectionClass $class, array $items, $scalar, ReflectionParameter $param = null, $default = 'test', $default2 = null )
	{
		
	}
    public function hashCode()
    {
        return 1;
    }
}

// Call Xyster_TypeTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_TypeTest::main') {
    Xyster_TypeTest::main();
}
