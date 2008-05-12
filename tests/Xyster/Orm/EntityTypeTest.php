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

// Call Xyster_Orm_Entity_TypeTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Orm_Entity_TypeTest::main');
}

/**
 * PHPUnit test case
 */
require_once dirname(__FILE__) . '/TestSetup.php';
require_once 'Xyster/Orm/Entity/Type.php';

/**
 * Test for Xyster_Orm_Entity_Field
 *
 */
class Xyster_Orm_Entity_TypeTest extends Xyster_Orm_TestSetup
{
    /**
     * @var Xyster_Orm_Entity_Type
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Orm_Entity_TypeTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }
    
    /**
     * Sets up the tests
     *
     */
    public function setUp()
    {
        parent::setUp();
        
        $map = $this->_mockFactory()->get('MockBug');
        $this->object = $map->getEntityType();
    }

    
    /**
     * Tests the 'assertValidFieldForClass' method
     *
     */
    public function testValidField()
    {
        $this->object->assertValidField('bugDescription');
        // should not throw exception
        
        $this->setExpectedException('Xyster_Orm_Entity_Exception');
        $this->assertFalse($this->object->assertValidField('doesntExist'));
    }
    
    /**
     * Tests the 'assertValidField' method with a relation
     *
     * No operations in this method should throw exceptions
     */
    public function testValidFieldRelation()
    {
        $this->object->assertValidField('max(reporter->accountName)');
        $this->object->assertValidField('products->count()');
    }
    
    /**
     * Tests the 'assertValidField' method with a method call
     *
     */
    public function testValidFieldMethod()
    {
        $this->object->assertValidField('getCapitalOfNebraska(1,"test",createdOn)');
        // should not throw exception
        
        $this->setExpectedException('Xyster_Orm_Entity_Exception');
        $this->object->assertValidField('nonExistantMethod()');
    }
    
    /**
     * Tests the 'isRuntime' method
     *
     */
    public function testIsRuntime()
    {
    	$this->assertFalse($this->object->isRuntime(Xyster_Data_Field::named('MAX(bugId)')));
        $this->assertFalse($this->object->isRuntime(Xyster_Data_Field::named('bugDescription')));
        $this->assertFalse($this->object->isRuntime(Xyster_Data_Field::named('reporter->accountName')));
        $this->assertFalse($this->object->isRuntime(Xyster_Data_Field::named('MAX(reporter->accountName)')));
        
        $this->assertTrue($this->object->isRuntime(Xyster_Data_Field::named('reporter->accountName->somePublicField')));
        $this->assertTrue($this->object->isRuntime(Xyster_Data_Field::named('assignee->isDirty()')));
        $this->assertTrue($this->object->isRuntime(Xyster_Data_Field::named('getCapitalOfNebraska()')));
    }
    
    /**
     * Tests the 'isRuntime' method with criteria
     *
     */
    public function testIsRuntimeCriteria()
    {
        $field = Xyster_Data_Field::named('bugDescription');
        $criteria = Xyster_Data_Junction::all($field->notLike('foo%'),
            $field->notLike('bar%'));
            
        $this->assertFalse($this->object->isRuntime($criteria));
        
        $field = Xyster_Data_Field::named('getCapitalOfNebraska()');
        $criteria = Xyster_Data_Junction::all($field->notLike('foo%'),
            $field->notLike('bar%'));
            
        $this->assertTrue($this->object->isRuntime($criteria));
    }
    
    /**
     * Tests the 'isRuntime' method with sorts
     *
     */
    public function testIsRuntimeSort()
    {
        require_once 'Xyster/Data/Sort.php';
        
        $this->assertFalse($this->object->isRuntime(Xyster_Data_Sort::asc('bugDescription')));
        
        $this->assertTrue($this->object->isRuntime(Xyster_Data_Sort::asc('getCapitalOfNebraska()')));
    }
    
    /**
     * Tests the 'isRuntime' method
     *
     */
    public function testIsRuntimeBadType()
    {
    	require_once 'Xyster/Data/Field/Clause.php';
        $this->setExpectedException('Xyster_Orm_Exception');
        $this->object->isRuntime(new Xyster_Data_Field_Clause);
    }
    
    /**
     * Tests the 'getEntityName' method
     *
     */
    public function testGetEntityName()
    {
        $this->object->getEntityName();
    }
    
    /**
     * Tests the 'getFields' method
     *
     */
    public function testGetFields()
    {
        $fields = $this->object->getFields();
        $this->assertType('array', $fields);
        foreach( $fields as $field ) {
            $this->assertType('Xyster_Orm_Entity_Field', $field);
        }
    }
    
    /**
     * Tests the 'getFieldNames' method
     *
     */
    public function testGetFieldNames()
    {
        $names = $this->object->getFieldNames();
        $this->assertEquals(array_keys($this->object->getFields()), $names);
    }
    
    /**
     * Tests the 'getMapperFactory' method
     *
     */
    public function testGetMapperFactory()
    {
        $this->assertSame($this->_mockFactory(), $this->object->getMapperFactory());
    }
    
    /**
     * Tests the 'getMembers' method
     *
     */
    public function testGetMembers()
    {
        $membs = array();
        $membs = array_merge($membs, $this->object->getFieldNames());
        $membs = array_merge($membs, $this->object->getRelationNames());
        $membs = array_merge($membs, get_class_methods($this->object->getEntityName()));
        
        $this->assertEquals($membs, $this->object->getMembers());
    }
    
    /**
     * Tests the 'getPrimary' method
     *
     */
    public function testGetPrimary()
    {
        $primary = $this->object->getPrimary();
        $this->assertEquals(array('bugId'), $primary);
    }
    
    /**
     * Tests the 'getRelation' method
     *
     */
    public function testGetRelation()
    {
        $rel = $this->object->getRelation('reporter');
        $this->assertType('Xyster_Orm_Relation', $rel);
        $this->assertEquals('reporter', $rel->getName());
    }
    
    /**
     * Tests that 'getRelation' throws an exception for a bad name
     *
     */
    public function testGetRelationWithBadName()
    {
        $this->setExpectedException('Xyster_Orm_Relation_Exception');
        $this->object->getRelation('foobar');
    }
    
    /**
     * Tests the 'getRelations' method
     *
     */
    public function testGetRelations()
    {
        $relations = $this->object->getRelations();
        $this->assertType('array', $relations);
        foreach( $relations as $rel ) {
            $this->assertType('Xyster_Orm_Relation', $rel);
        }
    }
    
    /**
     * Tests the 'getRelationNames' method
     *
     */
    public function testGetRelationNames()
    {
        $names = $this->object->getRelationNames();
        $this->assertType('array', $names);
        $this->assertEquals($names, array_keys($this->object->getRelations()));
    }
    
    /**
     * Tests the 'isRelation' method
     *
     */
    public function testIsRelation()
    {
        $this->assertTrue($this->object->isRelation('assignee'));
        $this->assertFalse($this->object->isRelation('foobar'));
    }
    
    public function testBelongsTo()
    {
        
    }

    public function testHasJoined()
    {
        
    }
    
    public function testHasMany()
    {
        
    }
    
    public function testHasOne()
    {
        $this->object->hasOne('reportingAccount', array('class'=>'MockAccount','id'=>'reportedBy'));
    }

    /**
     * Tests the creating an existing relation throws an exception
     *
     */
    public function testCreateExistingRelation()
    {
        $this->setExpectedException('Xyster_Orm_Relation_Exception');
        $this->object->belongsTo('reporter', array('class'=>'MockAccount','id'=>'reportedBy'));
    }
}

// Call Xyster_Orm_Entity_TypeTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Orm_Entity_TypeTest::main') {
    Xyster_Orm_Entity_TypeTest::main();
}