<?php
/**
 * Xyster Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/bsd-license.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to xyster@devweblog.org so we can send you a copy immediately.
 *
 * @category  Xyster
 * @package   UnitTests
 * @subpackage Xyster_Collection
 * @copyright Copyright (c) 2007 Irrational Logic (http://devweblog.org)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */

/**
 * PHPUnit test case
 */
require_once 'Xyster/Collection/BaseCollectionTest.php';
/**
 * Xyster_Collection_List
 */
require_once 'Xyster/Collection/List.php';
/**
 * Test for Xyster_Collection
 *
 */
class Xyster_Collection_ListTest extends Xyster_Collection_BaseCollectionTest
{
    protected $_className = 'Xyster_Collection_List';

    public function testGet()
    {
        $list = $this->_getNewCollection();
        $value = $this->_getNewValue();
        $list->add( $value );
        $this->assertEquals($value,$list->get(0));
        try {
            $list->get(-1);
        } catch ( Exception $thrown ) {
            return;
        }
        $this->fail("Unthrown exception when using invalid index");
    }
    public function testIndexOf()
    {
        $list = $this->_getNewCollectionWithRandomValues();
        $value = $list->get(2);
        $this->assertEquals(2,$list->indexOf($value));
        $this->assertFalse($list->indexOf('not in the list'));
    }
    public function testInsert()
    {
        $list = $this->_getNewCollection();
        $pre = $list->count();
        $list->insert(0,$this->_getNewValue());
        $post = $list->count();
        $this->assertTrue($pre < $post);
        try {
            $list->insert(-1,null);
        } catch ( Exception $thrown ) {
            return;
        }
        $this->fail("Unthrown exception when using invalid index");
    }
    public function testInsertAll()
    {
        $list = $this->_getNewCollection();
        $new = $this->_getNewCollectionWithRandomValues();
        $pre = $list->count();
        $ins = $new->count();
        $list->insertAll(0,$new);
        $post = $list->count();
        $this->assertEquals($post,$pre+$ins);
        try {
            $list->insertAll(-1,$new);
        } catch ( Exception $thrown ) {
            return;
        }
        $this->fail("Unthrown exception when using invalid index");
    }
    public function testOffsetExists()
    {
        $list = $this->_getNewCollectionWithRandomValues();
        $this->assertTrue(isset($list[0]));
    }
    public function testRemoveAt()
    {
        $list = $this->_getNewCollectionWithRandomValues();
        $pre = $list->count();
        $list->removeAt(2);
        $post = $list->count();
        $this->assertEquals($post,$pre-1);
        try {
            $list->removeAt(-1);
        } catch ( Exception $thrown ) {
            return;
        }
        $this->fail("Unthrown exception when using invalid index");
    }
    public function testSet()
    {
        $list = $this->_getNewCollectionWithRandomValues();
        $pre = $list->count();
        $value = $this->_getNewValue();
        $list->set(2,$value);
        $post = $list->count();
        $this->assertEquals($value,$list->get(2));
        $this->assertEquals($pre,$post);
        try {
            $list->set(-1,null);
        } catch ( Exception $thrown ) {
            return;
        }
        $this->fail("Unthrown exception when using invalid index");
    }
    public function testSlice()
    {
        $list = $this->_getNewCollectionWithRandomValues();
        $pre = $list->count();
        $list->slice(0,2);
        $post = $list->count();
        $this->assertEquals($post,$pre-2);
                try {
            $list->slice(-2,-1);
        } catch ( Exception $thrown ) {
            return;
        }
        $this->fail("Unthrown exception when using invalid index");
    }
}