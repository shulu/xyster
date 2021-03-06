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
use Xyster\Collection\ArrayList;
/**
 * Test for Xyster_Collection
 *
 */
class ListTest extends BaseCollectionTest
{
    protected $_className = '\Xyster\Collection\ArrayList';
    
    /**
     * Tests the 'get' method
     * @expectedException \OutOfBoundsException
     */
    public function testGet()
    {
        $list = $this->_getNewCollection();
        $value = $this->_getNewValue();
        $list->add($value);
        $this->assertEquals($value, $list->get(0));
        $list->get(-1);
    }
    
    /**
     * Tests the 'indexOf' method
     *
     */
    public function testIndexOf()
    {
        $list = $this->_getNewCollectionWithRandomValues();
        $value = $list->get(2);
        $this->assertEquals(2, $list->indexOf($value));
        $this->assertFalse($list->indexOf('not in the list'));
    }
    
    /**
     * Tests the 'insert' method
     *
     * @expectedException \OutOfBoundsException
     */
    public function testInsert()
    {
        $list = $this->_getNewCollection();
        $pre = $list->count();
        $list->insert(0, $this->_getNewValue());
        $post = $list->count();
        $this->assertTrue($pre < $post);
        $list->insert(-1, null);
    }
    
    /**
     * Tests the 'insertAll' method
     * @expectedException \OutOfBoundsException
     */
    public function testInsertAll()
    {
        $list = $this->_getNewCollection();
        $new = $this->_getNewCollectionWithRandomValues();
        $pre = $list->count();
        $ins = $new->count();
        $list->insertAll(0, $new);
        $post = $list->count();
        $this->assertEquals($post, $pre + $ins);
        $list->insertAll(-1, $new);
    }
    
    /**
     * Tests the 'offsetExists' method
     *
     */
    public function testOffsetExists()
    {
        $list = $this->_getNewCollectionWithRandomValues();
        $this->assertTrue(isset($list[0]));
    }
    
    /**
     * Tests the 'removeAt' method
     * @expectedException \OutOfBoundsException
     */
    public function testRemoveAt()
    {
        $list = $this->_getNewCollectionWithRandomValues();
        $pre = $list->count();
        $list->removeAt(2);
        $post = $list->count();
        $this->assertEquals($post, $pre - 1);
        $list->removeAt(-1);
    }
    
    /**
     * Tests the 'set' method
     * @expectedException \OutOfBoundsException
     */
    public function testSet()
    {
        $list = $this->_getNewCollectionWithRandomValues();
        $pre = $list->count();
        $value = $this->_getNewValue();
        $list->set(2, $value);
        $post = $list->count();
        $this->assertEquals($value, $list->get(2));
        $this->assertEquals($pre, $post);
        $list->set(-1, null);
    }
    
    /**
     * Tests the 'slice' method
     * @expectedException \OutOfBoundsException
     */
    public function testSlice()
    {
        $list = $this->_getNewCollectionWithRandomValues();
        $pre = $list->count();
        $list->slice(0, 2);
        $post = $list->count();
        $this->assertEquals($post, $pre - 2);
        $list->slice(-2, -1);
    }
}
