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

// Call Xyster_Container_Behavior_Factory_AdaptiveTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Container_Behavior_Factory_AdaptiveTest::main');
}

require_once dirname(__FILE__) . '/CommonTest.php';
require_once 'Xyster/Container/Behavior/Factory/Adaptive.php';

/**
 * Test class for Xyster_Container_Behavior_Factory_Adaptive.
 * Generated by PHPUnit on 2008-01-06 at 13:33:47.
 */
class Xyster_Container_Behavior_Factory_AdaptiveTest extends Xyster_Container_Behavior_Factory_CommonTest
{
    /**
     * @var Xyster_Container_Behavior_Factory_Adaptive
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';

        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Container_Behavior_Factory_AdaptiveTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUp()
    {
        parent::setUp();
        $this->object = new Xyster_Container_Behavior_Factory_Adaptive;
    }
    
    /**
     * Tests the 'wrap' method throws an exception
     *
     */
    public function testWrap()
    {
        $this->setExpectedException('Exception');
        $this->object->wrap(new Xyster_Container_Injection_Factory_Constructor);
    }
}

// Call Xyster_Container_Behavior_Factory_AdaptiveTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Container_Behavior_Factory_AdaptiveTest::main') {
    Xyster_Container_Behavior_Factory_AdaptiveTest::main();
}
