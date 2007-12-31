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
 * @subpackage Xyster_Container
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'PHPUnit/Framework.php';
require_once 'Xyster/Container/Monitor/Null.php';
require_once 'Xyster/Collection/Map/String.php';
require_once 'Xyster/Type.php';

/**
 * Test class for Xyster_Container_Injection_Factory_Adaptive.
 * Generated by PHPUnit on 2007-12-31 at 09:30:26.
 */
abstract class Xyster_Container_Injection_Factory_CommonTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Xyster_Container_Injection_Factory
     */
    protected $object;
    
    protected $monitor;
    
    protected $properties;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->monitor = new Xyster_Container_Monitor_Null;
        $this->properties = new Xyster_Collection_Map_String;
    }

    /**
     * Tests the 'createComponentAdapter' method
     */
    public function testCreateComponentAdapter()
    {
        $key = new Xyster_Type('ArrayObject');
        $adapter = $this->object->createComponentAdapter($this->monitor, $this->properties, $key, $key, array());
        $this->assertType($this->_getInjectorClass(), $adapter);
        $this->assertSame($adapter->getImplementation(), $key);
    }
    
    protected function _getInjectorClass()
    {
        return 'Xyster_Container_Injection_Abstract';
    }
}