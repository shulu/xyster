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
 * @subpackage Xyster_Validate
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id: IntTest.php 189 2008-01-07 22:34:16Z doublecompile $
 */
// Call Xyster_Validate_IntTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Validate_IntTest::main');
}
require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'Xyster/Validate/Int.php';

/**
 * Test class for Xyster_Validate_Int.
 * Generated by PHPUnit on 2008-06-07 at 17:00:25.
 */
class Xyster_Validate_IntTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Xyster_Validate_Int
     */
    public $validator;
    
    /**
     * Runs the test methods of this class.
     *
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Validate_IntTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    /**
     * Sets up the fixture
     * 
     */
    protected function setUp()
    {
        $this->validator = new Xyster_Validate_Int();
    }
    
    /**
     * Tests basic validation for a Int
     *
     */
    public function testBasic()
    {
        $valuesExpected = array(
            array('', false),
            array(1, true),
            array('292340982340981239857401928374092830987', true),
            array(10.53, true),
            array('moo', false)
            );
        foreach ($valuesExpected as $element) {
            $this->assertEquals($element[1], $this->validator->isValid($element[0]));
        }
    }
    
    /**
     * Ensures that getMessages() returns expected default value
     *
     * @return void
     */
    public function testGetMessages()
    {
        $this->assertEquals(array(), $this->validator->getMessages());
    }
    
}

// Call Xyster_Validate_IntTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Validate_IntTest::main') {
    Xyster_Validate_IntTest::main();
}