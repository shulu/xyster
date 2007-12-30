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
 * @copyright Copyright (c) 2007 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */

// Call Xyster_Container_Injection_ConstructorTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Container_Injection_ConstructorTest::main');
}

require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'TestHelper.php';

require_once 'PHPUnit/Framework.php';
require_once 'Xyster/Container/Injection/Constructor.php';

/**
 * Test class for Xyster_Container_Injection_Constructor.
 * Generated by PHPUnit on 2007-12-30 at 15:41:59.
 */
class Xyster_Container_Injection_ConstructorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Xyster_Container_Injection_Constructor
     */
    protected $object;

    protected $container;
    
    protected $key;
    
    /**
     * Runs the test methods of this class.
     *
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';

        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Container_Injection_ConstructorTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        require_once 'Xyster/Container.php';
        $this->container = new Xyster_Container;
        require_once 'Xyster/Type.php';
        $this->key = new Xyster_Type('ConstructorTestControllerAction');
        require_once 'Zend/Controller/Response/Cli.php';
        require_once 'Zend/Controller/Request/Http.php';
        require_once 'Xyster/Container/Parameter/Basic.php';
        $this->container->addComponent('http://localhost/index/index', 'uri');
        $uriParam = $this->container->getComponent('uri');
        $this->container->addComponent(new Xyster_Type('Zend_Controller_Response_Cli'));
        $this->container->addComponent(new Xyster_Type('Zend_Controller_Request_Http'),
            null, array(new Xyster_Container_Parameter_Basic('uri')));
        $this->container->addComponent(new Xyster_Type('array'));
        $this->object = new Xyster_Container_Injection_Constructor($this->key, $this->key);
    }
    
    /**
     * Tests the 'accept' method
     */
    public function testAccept()
    {
        require_once 'Xyster/Container/Visitor/Mock.php';
        $visitor = new Xyster_Container_Visitor_Mock;
        $this->object->accept($visitor);
        $this->assertEquals(1, $visitor->getCalled('visitComponentAdapter'));
    }
    
    /**
     * Tests the 'getInstance' method
     */
    public function testGetInstance()
    {
        $inst = $this->object->getInstance($this->container);
        $this->assertType('ConstructorTestControllerAction', $inst);
    }

    /**
     * Tests the 'verify' method
     */
    public function testVerify()
    {
        $this->object->verify($this->container);
    }

    /**
     * Tests the 'toString' method
     */
    public function test__toString()
    {
        $this->assertSame('ConstructorInjector-Class ConstructorTestControllerAction', $this->object->__toString());
    }
}

require_once 'Zend/Controller/Action.php';

class ConstructorTestControllerAction extends Zend_Controller_Action
{        
}

// Call Xyster_Container_Injection_ConstructorTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Container_Injection_ConstructorTest::main') {
    Xyster_Container_Injection_ConstructorTest::main();
}
