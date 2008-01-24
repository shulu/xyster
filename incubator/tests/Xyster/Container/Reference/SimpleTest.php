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

// Call Xyster_Container_Reference_SimpleTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Container_Reference_SimpleTest::main');
}

require_once dirname(dirname(dirname(dirname(__FILE__)))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'PHPUnit/Framework.php';
require_once 'Xyster/Container/Reference/Simple.php';

/**
 * Test class for Xyster_Container_Reference_Simple.
 * Generated by PHPUnit on 2008-01-24 at 16:09:17.
 */
class Xyster_Container_Reference_SimpleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Xyster_Container_Reference_Simple
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     *
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';

        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Container_Reference_SimpleTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new Xyster_Container_Reference_Simple;
    }
    
    /**
     * Tests the basic operation of this class
     * 
     */
    public function testGetAndSet()
    {
    	$this->assertAttributeSame(null, '_instance', $this->object);
    	
    	$test = new SplObjectStorage();
    	
    	$this->object->set($test);
    	
    	$this->assertAttributeSame($test, '_instance', $this->object);
    	
    	$return = $this->object->get();
    	
    	$this->assertSame($test, $return);
    }
}

// Call Xyster_Container_Reference_SimpleTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Container_Reference_SimpleTest::main') {
    Xyster_Container_Reference_SimpleTest::main();
}
