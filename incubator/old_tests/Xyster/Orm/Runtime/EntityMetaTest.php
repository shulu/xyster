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
// Call Xyster_Orm_Runtime_EntityMetaTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Orm_Runtime_EntityMetaTest::main');
}
require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'Xyster/Orm/Runtime/EntityMeta.php';
require_once 'Xyster/Orm/Session/Factory/Interface.php';
require_once 'Xyster/Orm/Mapping/Component.php';
require_once 'Xyster/Orm/Mapping/Class.php';
require_once 'Xyster/Orm/Mapping/Join.php';
require_once 'Xyster/Orm/Mapping/Subclass.php';
require_once 'Xyster/Orm/Mapping/Value.php';
require_once 'Xyster/Orm/Type/Integer.php';
require_once 'Xyster/Orm/Runtime/Property/Identifier.php';
require_once 'Xyster/Orm/Tuplizer/Entity/Interface.php';

/**
 * Test class for Xyster_Orm_Runtime_EntityMeta.
 * Generated by PHPUnit on 2008-08-02 at 15:08:44.
 */
class Xyster_Orm_Runtime_EntityMetaTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Xyster_Orm_Session_Factory_Interface
     */
    protected $sessionFactory;
    
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $em;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Orm_Runtime_EntityMetaTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->sessionFactory = $this->getMock('Xyster_Orm_Session_Factory_Interface');
        $this->em = $this->getMock('Xyster_Orm_Mapping_Class_Abstract');
    }

    /**
     * Tests the 'isIdentifier' method
     */
    public function testGetIdentifier()
    {
        $gen = $this->getMock('Xyster_Orm_Id_Generator_Interface');
        $this->sessionFactory->expects($this->any())
            ->method('getIdentifierGenerator')
            ->will($this->returnValue($gen));
        $prop = $this->_getProperty('foobarId', 'Integer');
        $this->em->expects($this->any())
            ->method('getIdProperty')
            ->will($this->returnValue($prop));
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        $object = $this->_getFixture();
        
        $id = $object->getIdentifier();
        $this->assertType('Xyster_Orm_Runtime_Property_Identifier', $id);
        $this->assertEquals('foobarId', $id->getName());
        $this->assertType('Xyster_Orm_Type_Integer', $id->getType());
    }

    /**
     * Tests the 'getName' method
     */
    public function testGetName()
    {
        $this->em->expects($this->any())
            ->method('getClassName')
            ->will($this->returnValue('foobar'));
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        $object = $this->_getFixture();
        
        $this->assertEquals('foobar', $object->getName());
    }

    /**
     * Tests the 'getOptimisticLockMode' method
     */
    public function testGetOptimisticLockMode()
    {
        $this->em->expects($this->any())
            ->method('getOptimisticLockMode')
            ->will($this->returnValue(Xyster_Orm_Engine_Versioning::Dirty()));
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        $object = $this->_getFixture();
        
        $this->assertSame(Xyster_Orm_Engine_Versioning::Dirty(), $object->getOptimisticLockMode());
    }

    /**
     * Tests the 'getProperties' method
     */
    public function testGetProperties()
    {
        $prop1 = $this->_getProperty('foobarId', 'integer', false);
        $prop2 = $this->_getProperty('username', 'string');
        $prop3 = $this->_getProperty('modifiedOn', 'timestamp', false, false, true);
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $props = $object->getProperties();
        $this->assertType('array', $props);
        $this->assertType('Xyster_Orm_Runtime_Property', $props[0]);
        $this->assertEquals('foobarId', $props[0]->getName());
        $this->assertEquals('integer', $props[0]->getType()->getName());
        $this->assertType('Xyster_Orm_Runtime_Property', $props[1]);
        $this->assertEquals('username', $props[1]->getName());
        $this->assertEquals('string', $props[1]->getType()->getName());
        $this->assertType('Xyster_Orm_Runtime_Property', $props[2]);
        $this->assertEquals('modifiedOn', $props[2]->getName());
        $this->assertEquals('timestamp', $props[2]->getType()->getName());
    }

    /**
     * Tests the 'getPropertyIndex' method
     */
    public function testGetPropertyIndex()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn');
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $this->assertEquals(2, $object->getPropertyIndex('modifiedOn'));
        $this->assertNull($object->getPropertyIndex('notthere', true));
        $this->setExpectedException('Xyster_Orm_Exception');
        $object->getPropertyIndex('notthere');
    }

    /**
     * Tests the 'getPropertyLaziness' method
     */
    public function testGetPropertyLaziness()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username', 'string', true, true);
        $prop3 = $this->_getProperty('modifiedOn');
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $this->assertEquals(array(false, true, false), $object->getPropertyLaziness());
    }

    /**
     * Tests the 'getPropertyNames' method
     */
    public function testGetPropertyNames()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn');
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $this->assertEquals(array('title', 'username', 'modifiedOn'), $object->getPropertyNames());
    }

    /**
     * Tests the 'getPropertyNullability' method
     */
    public function testGetPropertyNullability()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username', 'string', false);
        $prop3 = $this->_getProperty('modifiedOn', 'timestamp', false);
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $this->assertEquals(array(true, false, false), $object->getPropertyNullability());
    }

    /**
     * Tests the 'getPropertySpan' method
     */
    public function testGetPropertySpan()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn');
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $this->assertEquals(3, $object->getPropertySpan());
    }

    /**
     * Tests the 'getPropertyTypes' method
     */
    public function testGetPropertyTypes()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn', 'timestamp');
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $types = $object->getPropertyTypes();
        $this->assertType('array', $types);
        $this->assertEquals(3, count($types));
        $this->assertEquals('string', $types[0]->getName());
        $this->assertEquals('string', $types[1]->getName());
        $this->assertEquals('timestamp', $types[2]->getName());
    }

    /**
     * Tests the 'getPropertyVersionability' method
     */
    public function testGetPropertyVersionability()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn', 'timestamp', false, false, true);
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $this->em->expects($this->any())
            ->method('getVersion')
            ->will($this->returnValue($prop3));
        $object = $this->_getFixture();
        
        $this->assertEquals(array(false, false, true), $object->getPropertyVersionability());
    }

    /**
     * Tests the 'getSessionFactory' method
     */
    public function testGetSessionFactory()
    {
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        
        $object = $this->_getFixture();
        $this->assertSame($this->sessionFactory, $object->getSessionFactory());
    }

    /**
     * Tests the 'getTuplizer' method
     */
    public function testGetTuplizer()
    {
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        
        $object = $this->_getFixture();
        $tuplizer = $object->getTuplizer();
        $this->assertType('Xyster_Orm_Tuplizer_Entity_Interface', $tuplizer);
    }

    /**
     * Tests the 'getVersion' and 'getVersionIndex' methods
     */
    public function testGetVersionAndGetVersionIndex()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn', 'timestamp', false, false, true);
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $this->em->expects($this->any())
            ->method('isVersioned')
            ->will($this->returnValue(true));
        $this->em->expects($this->any())
            ->method('getVersion')
            ->will($this->returnValue($prop3));
        $object = $this->_getFixture();
        
        $this->assertEquals(2, $object->getVersionIndex());
        $version = $object->getVersion();
        $this->assertType('Xyster_Orm_Runtime_Property_Version', $version);
        $this->assertEquals('modifiedOn', $version->getName());
        $this->assertEquals('timestamp', $version->getType()->getName());
    }

    /**
     * @todo Implement testHasCollections().
     */
    public function testHasCollections()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
          'This test has not been implemented yet.'
        );
    }

    /**
     * Tests the 'hasInsertGeneratedValues' method
     */
    public function testHasInsertGeneratedValues()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn')->setGeneration(Xyster_Orm_Mapping_Generation::Insert());
              
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $this->assertTrue($object->hasUpdateGeneratedValues());
    }

    /**
     * Tests the 'hasMutableProperties' method
     */
    public function testHasMutableProperties()
    {
        $prop1 = $this->_getProperty('id');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn', 'timestamp');
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $this->assertTrue($object->hasMutableProperties());
    }

    /**
     * Tests the 'hasNonIdentifierPropertyNamedId' method
     */
    public function testHasNonIdentifierPropertyNamedId()
    {
        $prop1 = $this->_getProperty('id');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn');
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $this->assertTrue($object->hasNonIdentifierPropertyNamedId());
    }

    /**
     * Tests the 'hasUpdateGeneratedValues' method
     */
    public function testHasUpdateGeneratedValues()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn')->setGeneration(Xyster_Orm_Mapping_Generation::Always());
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $this->assertTrue($object->hasUpdateGeneratedValues());
    }

    /**
     * Tests the 'isLazy' method with no lazy properties
     */
    public function testIsLazyFalse()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn');
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $object = $this->_getFixture();
        
        $this->assertFalse($object->isLazy());
        $this->assertFalse($object->hasLazyProperties());
    }
    
    /**
     * Tests the 'isLazy' method with lazy properties
     */
    public function testIsLazyTrue()
    {
        $prop1 = $this->_getProperty('title');
        $prop2 = $this->_getProperty('username');
        $prop3 = $this->_getProperty('modifiedOn', 'timestamp', false, true);
        
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new ArrayIterator(array($prop1, $prop2, $prop3))));
        $this->em->expects($this->any())
            ->method('isLazy')
            ->will($this->returnValue(true));
        $object = $this->_getFixture();
        
        $this->assertTrue($object->isLazy());
        $this->assertTrue($object->hasLazyProperties());
    }
    
    /**
     * Tests the 'isLazy' and 'setLazy' method
     */
    public function testIsAndSetLazy()
    {
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        
        $object = $this->_getFixture();
        
        $this->assertFalse($object->isLazy());
        $this->assertSame($object, $object->setLazy());
        $this->assertTrue($object->isLazy());
        $object->setLazy(false);
        $this->assertFalse($object->isLazy());
    }
    
    /**
     * Tests the 'isMutable' method
     */
    public function testIsMutable()
    {
        $this->em->expects($this->any())
            ->method('isMutable')
            ->will($this->returnValue(true));
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        $object = $this->_getFixture();
        
        $this->assertTrue($object->isMutable());
    }

    /**
     * Tests the 'isSelectBeforeUpdate' method
     */
    public function testIsSelectBeforeUpdate()
    {
        $this->em->expects($this->any())
            ->method('isSelectBeforeUpdate')
            ->will($this->returnValue(true));
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        $object = $this->_getFixture();
        
        $this->assertTrue($object->isSelectBeforeUpdate());
    }

    /**
     * Tests the 'isVersioned' method
     */
    public function testIsVersioned()
    {
        $this->em->expects($this->any())
            ->method('isVersioned')
            ->will($this->returnValue(true));
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        $object = $this->_getFixture();
        
        $this->assertTrue($object->isVersioned());
    }

    /**
     * Tests the 'isVersioned' method
     */
    public function testIsVersionedFalse()
    {
        $this->em->expects($this->any())
            ->method('isVersioned')
            ->will($this->returnValue(false));
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        $object = $this->_getFixture();
        
        $this->assertFalse($object->isVersioned());
    }

    /**
     * Tests the 'toString' method
     */
    public function test__toString()
    {
        $this->em->expects($this->any())
            ->method('getClassName')
            ->will($this->returnValue('Foobar'));
        $this->em->expects($this->any())
            ->method('getPropertyIterator')
            ->will($this->returnValue(new EmptyIterator()));
        $object = $this->_getFixture();
        
        $this->assertEquals('EntityMeta(Foobar)', $object->__toString());
    }
    
    /**
     * Gets the fixture
     *
     * @return Xyster_Orm_Runtime_EntityMeta
     */
    protected function _getFixture()
    {
        return new Xyster_Orm_Runtime_EntityMeta($this->em, $this->sessionFactory);
    }
    
    /**
     * Gets a property for testing
     *
     * @param string $name
     * @param string $typeName
     * @param boolean $nullable
     * @param boolean $lazy
     * @param boolean $optLock
     * @return Xyster_Orm_Mapping_Property
     */
    protected function _getProperty( $name, $typeName = 'string', $nullable = true, $lazy = false, $optLock = false )
    {
        $typeClass = 'Xyster_Orm_Type_' . ucfirst($typeName);
        Zend_Loader::loadClass($typeClass);
        $type = new $typeClass;
        $column = new Xyster_Db_Column($name);
        $column->setNullable($nullable);
        $value = new Xyster_Orm_Mapping_Value;
        $value->setType($type)->addColumn($column);
        $prop = new Xyster_Orm_Mapping_Property;
        $prop->setName($name)->setValue($value)->setLazy($lazy)->setOptimisticLocked($optLock);
        return $prop;
    }
}

// Call Xyster_Orm_Runtime_EntityMetaTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Orm_Runtime_EntityMetaTest::main') {
    Xyster_Orm_Runtime_EntityMetaTest::main();
}