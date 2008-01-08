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

// Call Xyster_Container_Injection_Factory_AdaptiveTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Container_Injection_Factory_AdaptiveTest::main');
}

require_once dirname(__FILE__) . '/CommonTest.php';
require_once 'Xyster/Container/Injection/Factory/Adaptive.php';
require_once 'Xyster/Container/Monitor/Null.php';
require_once 'Xyster/Collection/Map/String.php';
require_once 'Xyster/Container/Features.php';
require_once 'Xyster/Type.php';

/**
 * Test class for Xyster_Container_Injection_Factory_Adaptive.
 * Generated by PHPUnit on 2007-12-31 at 09:30:26.
 */
class Xyster_Container_Injection_Factory_AdaptiveTest extends Xyster_Container_Injection_Factory_CommonTest
{
    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';

        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Container_Injection_Factory_AdaptiveTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new Xyster_Container_Injection_Factory_Adaptive;
    }

    /**
     * Tests the 'createComponentAdapter' with setter injection
     *
     */
    public function testSetterInjection()
    {
        $monitor = new Xyster_Container_Monitor_Null;
        $properties = new Xyster_Collection_Map_String;
        $properties->merge(Xyster_Container_Features::SDI());
        $key = new Xyster_Type('SplObjectStorage');
        $parameters = array();
        
        $adapter = $this->object->createComponentAdapter($monitor, $properties, $key, $key, $parameters);
        $this->assertType('Xyster_Container_Injection_Setter', $adapter);
    }
    
    /**
     * Tests the 'createComponentAdapter' with method injection
     *
     */
    public function testMethodInjection()
    {
        $monitor = new Xyster_Container_Monitor_Null;
        $properties = new Xyster_Collection_Map_String;
        $properties->merge(Xyster_Container_Features::METHOD_INJECTION());
        $key = new Xyster_Type('SplObjectStorage');
        $parameters = array();
        
        $adapter = $this->object->createComponentAdapter($monitor, $properties, $key, $key, $parameters);
        $this->assertType('Xyster_Container_Injection_Method', $adapter);
    }
}

// Call Xyster_Container_Injection_Factory_AdaptiveTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Container_Injection_Factory_AdaptiveTest::main') {
    Xyster_Container_Injection_Factory_AdaptiveTest::main();
}
