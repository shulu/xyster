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

// Call Xyster_Container_Behavior_AbstractTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Container_Behavior_AbstractTest::main');
}

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'CommonTest.php';

require_once 'PHPUnit/Framework.php';
require_once 'Xyster/Container/Adapter/Instance.php';
require_once 'Xyster/Container/Behavior/Abstract.php';

/**
 * Test class for Xyster_Container_Behavior_Abstract.
 * Generated by PHPUnit on 2007-12-30 at 14:19:09.
 */
class Xyster_Container_Behavior_AbstractTest extends Xyster_Container_Behavior_CommonTest
{
    /**
     * @var Xyster_Container_Behavior_Stub
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';

        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Container_Behavior_AbstractTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new Xyster_Container_Behavior_Stub($this->delegate);
    }
    
    /**
     * Tests that an adapter with no monitor throws an exception
     *
     */
    public function testNoMonitor()
    {
        $delegate = new Xyster_Container_Adapter_NoMonitorStub;
        $behavior = new Xyster_Container_Behavior_Stub($delegate);
        $this->setExpectedException('Xyster_Container_Behavior_Exception');
        $behavior->currentMonitor();
    }
}

class Xyster_Container_Behavior_Stub extends Xyster_Container_Behavior_Abstract
{
    public function getDescriptor()
    {
        return 'BehaviorStub:';
    }
}

class Xyster_Container_Adapter_NoMonitorStub implements Xyster_Container_Adapter
{
    public function accept(Xyster_Container_Visitor $visitor)
    {
    }

    public function getDelegate()
    {
    }
    
    public function getDescriptor()
    {
        return 'NoMonitorStub:';
    }

    public function getImplementation()
    {
    }

    public function getInstance(Xyster_Container_Interface $container)
    {
    }

    public function getKey()
    {
    }

    public function verify(Xyster_Container_Interface $container)
    {
    }
}

// Call Xyster_Container_Behavior_AbstractTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Container_Behavior_AbstractTest::main') {
    Xyster_Container_Behavior_AbstractTest::main();
}