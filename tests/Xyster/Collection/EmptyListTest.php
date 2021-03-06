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
use Xyster\Collection\EmptyList;
/**
 * Test class for Xyster_Collection_List_Empty.
 * Generated by PHPUnit on 2008-01-31 at 16:15:02.
 */
class EmptyListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var    EmptyList
     */
    protected $object;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new EmptyList;
    }

    /**
     * Tests the 'add' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testAdd()
    {
        $this->object->add(null);
    }

    /**
     * Tests the 'clear' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testClear()
    {
        $this->object->clear();
    }

    /**
     * Tests the 'contains' method
     */
    public function testContains()
    {
       $this->assertFalse($this->object->contains(null));
    }

    /**
     * Tests the 'containsAll' method
     */
    public function testContainsAll()
    {
    	$this->assertFalse($this->object->containsAll($this->object));
    }

    /**
     * Tests the 'containsAny' method
     */
    public function testContainsAny()
    {
        $this->assertFalse($this->object->containsAny($this->object));
    }

    /**
     * Tests the 'count' method
     */
    public function testCount()
    {
        $this->assertSame(0, $this->object->count());
    }

    /**
     * Tests the 'get' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testGet()
    {
    	$this->object->get(0);
    }

    /**
     * Tests the 'getIterator' method
     */
    public function testGetIterator()
    {
        $this->assertType('EmptyIterator', $this->object->getIterator());
    }

    /**
     * Tests the 'indexOf' method
     */
    public function testIndexOf()
    {
        $this->assertNull($this->object->indexOf(null));
    }

    /**
     * Tests the 'insert' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testInsert()
    {
    	$this->object->insert(0, null);
    }

    /**
     * Tests the 'insertAll' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testInsertAll()
    {
    	$this->object->insertAll(0, $this->object);
    }

    /**
     * Tests the 'isEmpty' method
     */
    public function testIsEmpty()
    {
        $this->assertTrue($this->object->isEmpty());
    }

    /**
     * Tests the 'merge' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testMerge()
    {
    	$this->object->merge($this->object);
    }

    /**
     * Tests the 'offsetExists' method
     */
    public function testOffsetExists()
    {
        $this->assertFalse($this->object->offsetExists(0));
    }

    /**
     * Tests the 'offsetGet' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testOffsetGet()
    {
    	$this->object->offsetGet(0);
    }

    /**
     * Tests the 'offsetSet' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testOffsetSet()
    {
    	$this->object->offsetSet(0, null);
    }

    /**
     * Tests the 'offsetUnset' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testOffsetUnset()
    {
    	$this->object->offsetUnset(0);
    }

    /**
     * Tests the 'remove' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testRemove()
    {
    	$this->object->remove(null);
    }

    /**
     * Tests the 'removeAll' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testRemoveAll()
    {
    	$this->object->removeAll($this->object);
    }

    /**
     * Tests the 'removeAt' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testRemoveAt()
    {
        $this->object->removeAt(0);
    }

    /**
     * Tests the 'retainAll' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testRetainAll()
    {
        $this->object->retainAll($this->object);
    }

    /**
     * Tests the 'set' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testSet()
    {
        $this->object->set(0, null);
    }

    /**
     * Tests the 'slice' method
     * @expectedException \Xyster\Collection\UnmodifiableException
     */
    public function testSlice()
    {
        $this->object->slice(0, 1);
    }

    /**
     * Tests the 'toArray' method
     */
    public function testToArray()
    {
        $this->assertSame(array(), $this->object->toArray());
    }
}
