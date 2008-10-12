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
// Call Xyster_Orm_Context_EntityEntryTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Orm_Context_EntityEntryTest::main');
}
require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'Xyster/Orm/Context/EntityEntry.php';
require_once 'Xyster/Orm/Persister/Entity/Interface.php';

/**
 * Test class for Xyster_Orm_Context_EntityEntry.
 * Generated by PHPUnit on 2008-10-06 at 17:42:16.
 */
class Xyster_Orm_Context_EntityEntryTest extends PHPUnit_Framework_TestCase
{
    protected $status;
    protected $persister;
    
    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Orm_Context_EntityEntryTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->status = Xyster_Orm_Engine_Status::Managed();
        $this->persister = $this->getMock('Xyster_Orm_Persister_Entity_Interface');
        $this->persister->expects($this->any())
            ->method('getEntityName')
            ->will($this->returnValue('Foobar'));
        $this->persister->expects($this->any())
            ->method('getPropertyValues')
            ->will($this->returnValue(array(111)));
    }

    /**
     * Tests the constructor
     */
    public function testConstructor()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, true, $this->persister, false, true);
        $this->assertSame($this->status, $entry->getStatus());
        $this->assertEquals($loaded, $entry->getLoadedState());
        $this->assertSame($this->persister, $entry->getPersister());
        $this->assertEquals(1, $entry->getRowId());
        $this->assertEquals(2, $entry->getId());
        $this->assertEquals(3, $entry->getVersion());
        $this->assertTrue($entry->isInDatabase());
        $this->assertTrue($entry->isLoadedLazyUnfetched());
        $this->assertEquals('Foobar', $entry->getEntityName());
    }
    
    /**
     * Tests the 'getDeletedState' and 'setDeletedState' methods
     */
    public function testGetAndSetDeletedState()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, true, $this->persister, false, true);
        $this->assertNull($entry->getDeletedState());
        $this->assertSame($entry, $entry->setDeletedState(array(123)));
        $this->assertEquals(array(123), $entry->getDeletedState());
    }

    /**
     * Tests the 'isNullifiable' method
     */
    public function testIsNullifiable()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, true, $this->persister, false, true);
        $session = $this->getMock('Xyster_Orm_Session_Interface');
        
        $entry->setStatus(Xyster_Orm_Engine_Status::Saving());
        $this->assertTrue($entry->isNullifiable(false, $session));
        
        $entry->setStatus(Xyster_Orm_Engine_Status::Managed());
        $this->assertFalse($entry->isNullifiable(true, $session));
        
        // @todo test the nullifiableEntityKeys thing
    }

    /**
     * Tests the 'postDelete' method
     */
    public function testPostDelete()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, true, $this->persister, false, false);
        
        $this->assertTrue($entry->isInDatabase());
        $this->assertNotSame(Xyster_Orm_Engine_Status::Gone(), $entry->getStatus());
        $entry->postDelete();
        $this->assertFalse($entry->isInDatabase());
        $this->assertSame(Xyster_Orm_Engine_Status::Gone(), $entry->getStatus());
    }

    /**
     * Tests the 'postInsert' method
     */
    public function testPostInsert()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, false, $this->persister, false, false);
            
        $this->assertFalse($entry->isInDatabase());
        $entry->postInsert();
        $this->assertTrue($entry->isInDatabase());
    }

    /**
     * Tests the 'postUpdate' method
     */
    public function testPostUpdate()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, true, $this->persister, false, true);
        $entity = new stdClass;
        
        $this->persister->expects($this->any())
            ->method('isVersioned')
            ->will($this->returnValue(true));
        $this->persister->expects($this->once())
            ->method('setPropertyValue');
            
        $entry->postUpdate($entity, array(1, 2, 3), 123);
        $this->assertEquals(array(1, 2, 3), $entry->getLoadedState());
        $this->assertEquals(123, $entry->getVersion());
    }

    /**
     * Tests the 'requiresDirtyCheck' method
     */
    public function testRequiresDirtyCheck1()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, true, $this->persister, false, true);
        $entity = new stdClass;
        $this->persister->expects($this->any())
            ->method('isMutable')
            ->will($this->returnValue(false));
        
        $this->assertFalse($entry->requiresDirtyCheck($entity));
        $entry->setStatus(Xyster_Orm_Engine_Status::ReadOnly());
        $this->assertFalse($entry->requiresDirtyCheck($entity));
    }
    
    /**
     * Tests the 'requiresDirtyCheck' method
     */
    public function testRequiresDirtyCheck2()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, true, $this->persister, false, true);
        $entity = new stdClass;
        $this->persister->expects($this->any())
            ->method('isMutable')
            ->will($this->returnValue(true));
        $this->persister->expects($this->any())
            ->method('hasMutableProperties')
            ->will($this->returnValue(false));
        $this->assertFalse($entry->requiresDirtyCheck($entity));
    }
    
    /**
     * Tests the 'requiresDirtyCheck' method
     */
    public function testRequiresDirtyCheck3()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, true, $this->persister, false, true);
        $entity = new stdClass;
        $this->persister->expects($this->any())
            ->method('isMutable')
            ->will($this->returnValue(true));
        $this->persister->expects($this->any())
            ->method('hasMutableProperties')
            ->will($this->returnValue(true));
        $this->assertTrue($entry->requiresDirtyCheck($entity));
    }
    
    /**
     * Tests the 'setReadOnly' method
     */
    public function testSetReadOnly()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, true, $this->persister, false, true);
        $entity = new stdClass;
        
        $this->assertSame($entry, $entry->setReadOnly(true, $entity));
        $this->assertSame(Xyster_Orm_Engine_Status::ReadOnly(), $entry->getStatus());
        $this->assertNull($entry->getLoadedState());
        
        $this->assertSame($entry, $entry->setReadOnly(false, $entity));
        $this->assertSame(Xyster_Orm_Engine_Status::Managed(), $entry->getStatus());
        $this->assertEquals(array(111), $entry->getLoadedState());
        
        $entry->setStatus(Xyster_Orm_Engine_Status::Loading());
        $this->setExpectedException('Xyster_Orm_Exception', 'Cannot set read-only for this state: Loading');
        $entry->setReadOnly(true, $entity);
    }

    /**
     * Tests the 'getStatus' and 'setStatus' methods
     */
    public function testSetStatus()
    {
        $loaded = array(1);
        $entry = new Xyster_Orm_Context_EntityEntry($this->status, $loaded, 1, 2,
            3, true, $this->persister, false, true);
        $status = Xyster_Orm_Engine_Status::Loading();
        $this->assertSame($this->status, $entry->getStatus());
        $this->assertSame($entry, $entry->setStatus($status));
        $this->assertSame($status, $entry->getStatus());
    }
}

// Call Xyster_Orm_Context_EntityEntryTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Orm_Context_EntityEntryTest::main') {
    Xyster_Orm_Context_EntityEntryTest::main();
}