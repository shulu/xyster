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
 * @subpackage Xyster_Controller
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
namespace XysterTest\Controller\Dispatcher;
use Xyster\Controller\Dispatcher\Container;
require_once dirname(dirname(__FILE__)) . '/_files/BarController.php';

/**
 * Test class for Xyster_Controller_Dispatcher_Container.
 * Generated by PHPUnit on 2008-05-28 at 15:24:03.
 */
class ContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var    Container
     */
    protected $object;
    
    /**
     * @var \Xyster\Container\Container
     */
    protected $container;
    
    /**
     * @var array
     */
    protected $params = array('foo' => 'bar', 'abc' => 123);

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->container = new \Xyster\Container\Container;
        $this->object = new Container($this->container, $this->params);
        $this->object->setControllerDirectory(dirname(dirname(__FILE__)) . '/_files');
    }

    /**
     * Tests the 'dispatch' method
     */
    public function testDispatch()
    {
        \BarController::$called['baz'] = 0;
        \BarController::$called['test'] = 0;
        \BarController::$called['setObject'] = 0;
        
        $request = new \Zend_Controller_Request_Simple('baz', 'bar', null, $this->params);
        $response = new \Zend_Controller_Response_Cli;
        $this->container->autowire('\SplObjectStorage');
        $this->object->dispatch($request, $response);
        $this->object->dispatch($request, $response);
        $this->assertEquals(1, \BarController::$called['baz']);
        $this->assertEquals(1, \BarController::$called['test']);
        $this->assertEquals(2, \BarController::$called['setObject']);
    }

    /**
     * Tests the 'getContainer' class
     */
    public function testGetContainer()
    {
        $this->assertSame($this->container, $this->object->getContainer());
    }
}
