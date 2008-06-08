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
// Call Xyster_Orm_Mapper_IntegrityTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Orm_Mapper_IntegrityTest::main');
}
require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'TestSetup.php';
require_once 'Xyster/Orm/Mapper/Integrity.php';

/**
 * Test class for Xyster_Orm_Mapper_Integrity.
 * Generated by PHPUnit on 2008-06-08 at 13:00:39.
 */
class Xyster_Orm_Mapper_IntegrityTest extends Xyster_Orm_TestSetup
{
    /**
     * @var    Xyster_Orm_Mapper_Integrity
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Orm_Mapper_IntegrityTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new Xyster_Orm_Mapper_Integrity($this->_mockFactory());
    }

    /**
     * Tests the 'delete' method
     */
    public function testDelete()
    {
        $map = $this->_mockFactory()->get('MockAccount');
        $map->getEntityType()->hasMany('verifiedAgain', array('class'=>'MockBug','id'=>'verifiedBy'));
        $entity = $map->get('doublecompile');
        $bmap = $this->_mockFactory()->get('MockBug');
        $bug1 = $bmap->get(1);
        $bug2 = $bmap->get(2);
        $bug3 = $bmap->get(3);
        $entity->reported->add($bug1);
        $entity->assigned->add($bug2);
        $entity->verified->add($bug3);
        $return = $this->object->delete($entity);
        $this->assertType('array', $return);
        $this->assertTrue(in_array($bug1, $return, true));
        $this->assertFalse(in_array($bug2, $return, true));
        $this->assertTrue(in_array($bug3, $return, true));
    }

    /**
     * Tests the 'delete' method with a NoAction action
     */
    public function testDeleteRestrict()
    {
        $map = $this->_mockFactory()->get('MockAccount');
        $map->getEntityType()->hasMany('verifiedAgain', array('class'=>'MockBug','id'=>'verifiedBy','onUpdate'=>Xyster_Db_ReferentialAction::NoAction(), 'onDelete'=>Xyster_Db_ReferentialAction::NoAction()));
        $entity = $map->get('doublecompile');
        $bmap = $this->_mockFactory()->get('MockBug');
        $bug1 = $bmap->get(1);
        $entity->verifiedAgain->add($bug1);
        $this->setExpectedException('Xyster_Orm_Mapper_Exception', 'Cannot delete entity because others depend on it');
        $return = $this->object->delete($entity);
    }
    
    /**
     * Tests the 'delete' method with database integrity emulated
     */
    public function testDeleteEmulated()
    {
        $map = $this->_mockFactory()->get('MockAccount');
        $entity = $map->get('doublecompile');
        $bmap = $this->_mockFactory()->get('MockBug');
        $bug1 = $bmap->get(1);
        $bug2 = $bmap->get(2);
        $bug3 = $bmap->get(3);
        $entity->reported->add($bug1);
        $entity->assigned->add($bug2);
        $entity->verified->add($bug3);
        $return = $this->object->delete($entity, true);
        $this->assertType('array', $return);
        $this->assertFalse(in_array($bug1, $return, true));
        $this->assertFalse(in_array($bug2, $return, true));
        $this->assertFalse(in_array($bug3, $return, true));
        $this->assertNull($bug1->reportedBy);
        $this->assertTrue($bmap->wasDeleted($bug2));
        $this->assertNull($bug3->verifiedBy);
    }

    /**
     * Tests the 'update' method
     */
    public function testUpdate()
    {
        $map = $this->_mockFactory()->get('MockAccount');
        $map->getEntityType()->hasMany('verifiedAgain', array('class'=>'MockBug','id'=>'verifiedBy'));
        $entity = $map->get('doublecompile');
        $bmap = $this->_mockFactory()->get('MockBug');
        $bug1 = $bmap->get(1);
        $bug2 = $bmap->get(2);
        $bug3 = $bmap->get(3);
        $entity->reported->add($bug1);
        $entity->assigned->add($bug2);
        $entity->verified->add($bug3);
        $entity->accountName = 'doublecompile2';
        $return = $this->object->update($entity);
        $this->assertType('array', $return);
        $this->assertTrue(in_array($bug1, $return, true));
        $this->assertTrue(in_array($bug2, $return, true));
        $this->assertTrue(in_array($bug3, $return, true));
    }
    
    /**
     * Tests the 'update' method with database integrity emulated
     */
    public function testUpdateEmulated()
    {
        $map = $this->_mockFactory()->get('MockAccount');
        $entity = $map->get('doublecompile');
        $bmap = $this->_mockFactory()->get('MockBug');
        $bug1 = $bmap->get(1);
        $bug2 = $bmap->get(2);
        $bug3 = $bmap->get(3);
        $entity->reported->add($bug1);
        $entity->assigned->add($bug2);
        $entity->verified->add($bug3);
        $entity->accountName = 'doublecompile2';
        $return = $this->object->update($entity, true);
        $this->assertType('array', $return);
        $this->assertFalse(in_array($bug1, $return, true));
        $this->assertFalse(in_array($bug2, $return, true));
        $this->assertFalse(in_array($bug3, $return, true));
        $this->assertNull($bug1->reportedBy);
        $this->assertEquals('doublecompile2', $bug2->assignedTo);
        $this->assertNull($bug3->verifiedBy);
    }
}

// Call Xyster_Orm_Mapper_IntegrityTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Orm_Mapper_IntegrityTest::main') {
    Xyster_Orm_Mapper_IntegrityTest::main();
}