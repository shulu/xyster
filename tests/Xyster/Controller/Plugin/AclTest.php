<?php
// Call Xyster_Controller_Plugin_AclTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Controller_Plugin_AclTest::main');
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'TestHelper.php';

require_once 'Xyster/Controller/Plugin/Acl.php';
require_once 'Zend/Controller/Request/Http.php';
require_once 'Zend/Controller/Response/Cli.php';
require_once 'Zend/Controller/Front.php';
require_once 'Zend/Auth.php';
require_once 'Zend/Auth/Storage/NonPersistent.php';
require_once 'Xyster/Acl.php';
require_once 'Zend/Acl/Role.php';

/**
 * Test class for Xyster_Controller_Plugin_Acl.
 * Generated by PHPUnit on 2007-09-11 at 19:39:03.
 */
class Xyster_Controller_Plugin_AclTest extends PHPUnit_Framework_TestCase
{
    /**
     * Request object
     * @var Zend_Controller_Request_Http
     */
    public $request;

    /**
     * Response object
     * @var Zend_Controller_Response_Http
     */
    public $response;

    /**
     * Acl plugin
     * @var Xyster_Controller_Plugin_Acl
     */
    public $plugin;
    
    /**
     * ACL
     * @var Xyster_Acl
     */
    public $acl;
    
    /**
     * Runs the test methods of this class.
     * 
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';

        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Controller_Plugin_AclTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     */
    protected function setUp()
    {
        $this->acl = new Xyster_Acl();
        $auth = Zend_Auth::getInstance();
        $auth->setStorage(new Zend_Auth_Storage_NonPersistent());
        $auth->clearIdentity();
        $auth->authenticate(new Xyster_AclTest_Success_Adapter());
        $this->acl->addRole(new Zend_Acl_Role('doublecompile'));
        
        Zend_Controller_Front::getInstance()->resetInstance();
        $this->request  = new Zend_Controller_Request_Http();
        $this->response = new Zend_Controller_Response_Cli();
        $this->plugin   = new Xyster_Controller_Plugin_Acl($this->acl);

        $this->plugin->setRequest($this->request);
        $this->plugin->setResponse($this->response);
    }
    
    /**
     * Tears down the test
     *
     */
    protected function tearDown()
    {
        Zend_Auth::getInstance()->clearIdentity();
    }

    /**
     * Tests the plugin does nothing if access is granted
     *
     */
    public function testPostDispatchWithoutException()
    {
        $this->plugin->allow('doublecompile', null); // allow all
        
        $this->request->setModuleName('foo')
                      ->setControllerName('bar')
                      ->setActionName('baz');
        $this->plugin->preDispatch($this->request);
        
        $this->assertEquals('baz', $this->request->getActionName());
        $this->assertEquals('bar', $this->request->getControllerName());
        $this->assertEquals('foo', $this->request->getModuleName());
    }

    /**
     * Tests the error handler information is correct
     *
     */
    public function testPostDispatchErrorRequestIsClone()
    {
        $this->request->setModuleName('foo')
                      ->setControllerName('bar')
                      ->setActionName('baz');
        $this->plugin->preDispatch($this->request);

        $errorHandler = $this->request->getParam('error_handler');
        $this->assertType('ArrayObject', $errorHandler);
        $this->assertType('Zend_Controller_Request_Http', $errorHandler->request);
        $this->assertNotSame($this->request, $errorHandler->request);
    }
    
    /**
     * Tests the 'setAccessDenied' method
     *
     */
    public function testSetAccessDenied() 
    {
        $return = $this->plugin->setAccessDenied(array(
            'module'     => 'myfoo',
            'controller' => 'bar',
            'action'     => 'boobaz',
        ));

        $this->assertEquals('myfoo', $this->plugin->getAccessDeniedModule());
        $this->assertEquals('bar', $this->plugin->getAccessDeniedController());
        $this->assertEquals('boobaz', $this->plugin->getAccessDeniedAction());
        $this->assertSame($this->plugin, $return);
    }

    /**
     * Tests the 'setAccessDeniedModule' method
     *
     */
    public function testSetAccessDeniedModule() 
    {
        $return = $this->plugin->setAccessDeniedModule('boobah');
        $this->assertEquals('boobah', $this->plugin->getAccessDeniedModule());
        $this->assertSame($this->plugin, $return);
    }

    /**
     * Tests the 'setAccessDeniedController' method
     *
     */
    public function testSetAccessDeniedController() 
    {
        $return = $this->plugin->setAccessDeniedController('boobah');
        $this->assertEquals('boobah', $this->plugin->getAccessDeniedController());
        $this->assertSame($this->plugin, $return);
    }

    /**
     * Tests the 'setAccessDeniedAction' method
     *
     */
    public function testSetAccessDeniedAction() 
    {
        $return = $this->plugin->setAccessDeniedAction('boobah');
        $this->assertEquals('boobah', $this->plugin->getAccessDeniedAction());
        $this->assertSame($this->plugin, $return);
    }
}

/**
 * Zend_Auth_Adapter_Interface
 */
require_once 'Zend/Auth/Adapter/Interface.php';
/**
 * Zend_Auth_Result
 */
require_once 'Zend/Auth/Result.php';
/**
 * Just a simple stub object
 *
 */
class Xyster_AclTest_Success_Adapter implements Zend_Auth_Adapter_Interface
{
    public function authenticate()
    {
        return new Zend_Auth_Result(1, 'doublecompile');
    }
}

// Call Xyster_Controller_Plugin_AclTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Controller_Plugin_AclTest::main') {
    Xyster_Controller_Plugin_AclTest::main();
}