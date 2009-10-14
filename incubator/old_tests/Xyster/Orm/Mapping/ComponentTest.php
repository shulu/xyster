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
// Call Xyster_Orm_Mapping_ComponentTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Orm_Mapping_ComponentTest::main');
}
require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'Xyster/Orm/Mapping/Component.php';
require_once 'Xyster/Orm/Mapping/Class.php';

/**
 * Test class for Xyster_Orm_Mapping_Component.
 * Generated by PHPUnit on 2008-08-13 at 19:17:48.
 */
class Xyster_Orm_Mapping_ComponentTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Xyster_Orm_Mapping_Component
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Orm_Mapping_ComponentTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new Xyster_Orm_Mapping_Component;
    }

    /**
     * Tests the 'addColumn' method
     */
    public function testAddColumn()
    {
        $this->setExpectedException('Xyster_Orm_Mapping_Exception', 'Columns cannot be added to components');
        $column = new Xyster_Db_Column;
        $this->object->addColumn($column);
    }

    /**
     * Tests the 'addProperty' method
     */
    public function testAddProperty()
    {
        $prop = new Xyster_Orm_Mapping_Property;
        $this->assertSame($this->object, $this->object->addProperty($prop));
        $propIt = $this->object->getPropertyIterator();
        $props = iterator_to_array($propIt);
        $this->assertTrue(in_array($prop, $props));
    }

    /**
     * Tests the 'getColumns' method
     */
    public function testGetColumns()
    {
        $value = new Xyster_Orm_Mapping_Value;
        $value->addColumn(new Xyster_Db_Column)->addColumn(new Xyster_Db_Column)->addColumn(new Xyster_Db_Column);
        $property = new Xyster_Orm_Mapping_Property;
        $property->setValue($value)->setName('prop1');
        
        $value2 = new Xyster_Orm_Mapping_Value;
        $value2->addColumn(new Xyster_Db_Column)->addColumn(new Xyster_Db_Column);
        $property2 = new Xyster_Orm_Mapping_Property;
        $property2->setValue($value2)->setName('prop2');
        
        $value3 = new Xyster_Orm_Mapping_Value;
        $value3->addColumn(new Xyster_Db_Column);
        $property3 = new Xyster_Orm_Mapping_Property;
        $property3->setValue($value3)->setName('prop3');
        
        $this->object->addProperty($property)->addProperty($property2)->addProperty($property3);
        $columns = $this->object->getColumnIterator();
        $i = 0;
        foreach( $columns as $column ) {
            ++$i;
            $this->assertType('Xyster_Db_Column', $column);
        }
        $this->assertEquals(6, $i);
    }

    /**
     * Tests the 'getColumnSpan' method
     */
    public function testGetColumnSpan()
    {
        $value = new Xyster_Orm_Mapping_Value;
        $value->addColumn(new Xyster_Db_Column)->addColumn(new Xyster_Db_Column)->addColumn(new Xyster_Db_Column);
        $property = new Xyster_Orm_Mapping_Property;
        $property->setValue($value)->setName('prop1');
        
        $value2 = new Xyster_Orm_Mapping_Value;
        $value2->addColumn(new Xyster_Db_Column)->addColumn(new Xyster_Db_Column);
        $property2 = new Xyster_Orm_Mapping_Property;
        $property2->setValue($value2)->setName('prop2');
        
        $value3 = new Xyster_Orm_Mapping_Value;
        $value3->addColumn(new Xyster_Db_Column);
        $property3 = new Xyster_Orm_Mapping_Property;
        $property3->setValue($value3)->setName('prop3');
        
        $this->object->addProperty($property)->addProperty($property2)->addProperty($property3);
        $this->assertEquals(6, $this->object->getColumnSpan());
    }

    /**
     * Tests the 'getComponentType' and 'setComponentType' methods
     */
    public function testGetAndSetComponentType()
    {
        $type = new Xyster_Type('ArrayObject');
        $this->assertNull($this->object->getComponentType());
        $this->assertSame($this->object, $this->object->setComponentType($type));
        $this->assertSame($type, $this->object->getComponentType());
    }

    /**
     * Tests the 'getOwner' and 'setOwner'
     */
    public function testGetAndSetOwner()
    {
        $owner = new Xyster_Orm_Mapping_Class;
        $this->assertNull($this->object->getOwner());
        $this->assertSame($this->object, $this->object->setOwner($owner));
        $this->assertSame($owner, $this->object->getOwner());
    }

    /**
     * Tests the 'getParentProperty' and 'setParentProperty'
     */
    public function testGetAndSetParentProperty()
    {
        $this->assertNull($this->object->getParentProperty());
        $this->assertSame($this->object, $this->object->setParentProperty('foobar'));
        $this->assertEquals('foobar', $this->object->getParentProperty());
    }

    /**
     * Tests the 'getProperty' method
     */
    public function testGetProperty()
    {
        $property = new Xyster_Orm_Mapping_Property;
        $property->setName('foobar');
        $this->object->addProperty($property);
        $return = $this->object->getProperty('foobar');
        $this->assertSame($property, $return);
        $this->setExpectedException('Xyster_Orm_Mapping_Exception');
        $this->object->getProperty('not-there');
    }

    /**
     * Tests the 'getPropertySpan' method
     */
    public function testGetPropertySpan()
    {
        $this->assertEquals(0, $this->object->getPropertySpan());
        $prop1 = new Xyster_Orm_Mapping_Property;
        $prop1->setName('prop1');
        $prop2 = new Xyster_Orm_Mapping_Property;
        $prop2->setName('prop2');
        $prop3 = new Xyster_Orm_Mapping_Property;
        $prop3->setName('prop3');
        $this->object->addProperty($prop1)->addProperty($prop2)->addProperty($prop3);
        $this->assertEquals(3, $this->object->getPropertySpan());
    }

    /**
     * Tests the 'getRoleName' and 'setRoleName' methods
     */
    public function testGetAndSetRoleName()
    {
        $this->assertNull($this->object->getRoleName());
        $this->assertSame($this->object, $this->object->setRoleName('foobar'));
        $this->assertEquals('foobar', $this->object->getRoleName());
    }

    /**
     * Tests the 'getTuplizerType' and 'setTuplizerType' methods
     */
    public function testGetAndSetTuplizerType()
    {
        $type = new Xyster_Type('ArrayObject');
        $this->assertNull($this->object->getTuplizerType());
        $this->assertSame($this->object, $this->object->setTuplizerType($type));
        $this->assertSame($type, $this->object->getTuplizerType());
    }

    /**
     * Tests the 'getType' method
     */
    public function testGetType()
    {
        $this->assertType('Xyster_Orm_Type_Component', $this->object->getType());
    }

    /**
     * Tests the 'isKey' and 'setKey' methods
     */
    public function testIsAndSetKey()
    {
        $this->assertFalse($this->object->isKey());
        $this->assertSame($this->object, $this->object->setKey());
        $this->assertTrue($this->object->isKey());
        $this->object->setKey(false);
        $this->assertFalse($this->object->isKey());
    }
}

// Call Xyster_Orm_Mapping_ComponentTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Orm_Mapping_ComponentTest::main') {
    Xyster_Orm_Mapping_ComponentTest::main();
}