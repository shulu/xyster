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
 * @package   Xyster_Orm
 * @copyright Copyright (c) Xyster contributors
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'Xyster/Orm/Meta/IdProperty.php';
require_once 'Xyster/Orm/Id/IGenerator.php';
require_once 'Xyster/Orm/Type/String.php';
require_once 'Xyster/Db/Column.php';
require_once 'Xyster/Db/Table.php';
require_once 'Xyster/Orm/Meta/Value/Basic.php';
require_once 'Xyster/Type/Property/Direct.php';
require_once 'Xyster/Orm/ISession.php';

/**
 * Test class for Xyster_Orm_Meta_IdProperty.
 */
class Xyster_Orm_Meta_IdPropertyTest extends PHPUnit_Framework_TestCase
{
    public function testBasic()
    {
        $column = new Xyster_Db_Column("test_property");
        $table = new Xyster_Db_Table("foobar");
        $type = new Xyster_Orm_Type_String;
        $value = new Xyster_Orm_Meta_Value_Basic($table, $type, array($column));
        $property = new Xyster_Type_Property_Direct("testProperty");
        $generator = $this->getMock('Xyster_Orm_Id_IGenerator');
        $object = new Xyster_Orm_Meta_IdProperty("foobar", $value, $property, $generator);
        
        self::assertEquals("foobar", $object->getName());
        self::assertFalse($object->isLazy());
        self::assertFalse($object->isNaturalId());
        self::assertSame($property, $object->getWrapper());
        self::assertType('Iterator', $object->getColumns());
        self::assertEquals(1, $object->getColumnSpan());
        self::assertSame($type, $object->getType());
        self::assertSame($value, $object->getValue());
        self::assertTrue($object->isNullable());
        self::assertSame($generator, $object->getIdGenerator());
        self::assertFalse($object->isIdPostInsert());
    }
}