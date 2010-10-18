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
 * @subpackage Xyster_Collection
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
namespace XysterTest\Collection;
use Xyster\Collection\DelegateMap;
/**
 * Test class for Xyster_Collection_Map_Delegate.
 * Generated by PHPUnit on 2008-07-16 at 13:56:08.
 */
class DelegateMapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var    DelegateMap
     */
    protected $object;

    /**
     * @var \Xyster\Collection\Map
     */
    protected $map;
    
    protected $key;
    
    protected $value;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $obj = new \stdClass;
        $obj->name = 1234;
        $obj2 = new \stdClass;
        $obj2->name = 'aoeu';
        $obj3 = new \stdClass;
        $obj3->name = 5678;
        $obj4 = new \stdClass;
        $obj4->name = 'htns';
        
        $this->key = $obj;
        $this->value = $obj2;
        
        $this->map = new \Xyster\Collection\Map;
        $this->map->set($obj, $obj2);
        $this->map->set($obj3, $obj4);
        $this->object = new DelegateMap($this->map);
    }

    /**
     * Tests the 'clear' method
     */
    public function testClear()
    {
        $this->assertEquals(2, count($this->object));
        $this->object->clear();
        $this->assertTrue($this->map->isEmpty());
    }

    /**
     * Tests the 'count' method
     */
    public function testCount()
    {
        $this->assertEquals(2, count($this->object));
    }

    /**
     * Tests the 'containsKey' method
     */
    public function testContainsKey()
    {
        $this->assertTrue($this->object->containsKey($this->key));
    }

    /**
     * Tests the 'containsValue' method
     */
    public function testContainsValue()
    {
        $this->assertTrue($this->object->containsValue($this->value));
    }

    /**
     * Tests the 'get' method
     */
    public function testGet()
    {
        $this->assertEquals($this->map->get($this->key), $this->object->get($this->key));
    }

    /**
     * Tests the 'getIterator' method
     */
    public function testGetIterator()
    {
        $this->assertType('Iterator', $this->object->getIterator());
    }

    /**
     * Tests the 'keys' method
     */
    public function testKeys()
    {
        $this->assertEquals($this->map->keys(), $this->object->keys());
    }

    /**
     * Tests the 'keyFor' method
     */
    public function testKeyFor()
    {
        $this->assertEquals($this->map->keyFor($this->value), $this->object->keyFor($this->value));
    }

    /**
     * Tests the 'keysFor' method
     */
    public function testKeysFor()
    {
        $this->assertEquals($this->map->keysFor($this->value), $this->object->keysFor($this->value));
    }

    /**
     * Tests the 'isEmpty' method
     */
    public function testIsEmpty()
    {
        $this->assertFalse($this->object->isEmpty());
    }

    /**
     * Tests the 'merge' method
     */
    public function testMerge()
    {
        $map = new \Xyster\Collection\Map;
        $key = new \stdClass;
        $key->name = 9101;
        $val = new \stdClass;
        $val->name = 'you have our gratitude';
        $map->set($key, $val);
        $this->assertFalse($this->map->containsKey($key));
        $this->object->merge($map);
        $this->assertTrue($this->map->containsKey($key));
    }

    /**
     * Tests the 'offsetExists' method
     */
    public function testOffsetExists()
    {
        $this->assertFalse($this->object->offsetExists($this->value));
        $this->assertTrue($this->object->offsetExists($this->key));
    }

    /**
     * Tests the 'offsetGet' method
     */
    public function testOffsetGet()
    {
        $this->assertEquals($this->map->offsetGet($this->key), $this->object->offsetGet($this->key));
    }

    /**
     * Tests the 'offsetSet' method
     */
    public function testOffsetSet()
    {
        $val = new \stdClass;
        $val->name = 'take him to detroit';
        $this->object->offsetSet($this->key, $val);
        $this->assertEquals($val, $this->map->get($this->key));
    }

    /**
     * Tests the 'offsetUnset' method
     */
    public function testOffsetUnset()
    {
        $this->assertTrue($this->map->containsKey($this->key));
        $this->object->offsetUnset($this->key);
        $this->assertFalse($this->map->containsKey($this->key));
    }

    /**
     * Tests the 'remove' method
     */
    public function testRemove()
    {
        $this->assertTrue($this->map->containsKey($this->key));
        $this->object->remove($this->key);
        $this->assertFalse($this->map->containsKey($this->key));
    }

    /**
     * Tests the 'set' method
     */
    public function testSet()
    {
        $val = new \stdClass;
        $val->name = 'take him to detroit';
        $this->object->set($this->key, $val);
        $this->assertEquals($val, $this->map->get($this->key));
    }

    /**
     * Tests the 'toArray' method
     */
    public function testToArray()
    {
        $this->assertEquals($this->map->toArray(), $this->object->toArray());
    }

    /**
     * Tests the 'values' method
     */
    public function testValues()
    {
        $this->assertEquals($this->map->values(), $this->object->values());
    }
}