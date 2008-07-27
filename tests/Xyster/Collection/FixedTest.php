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
 * @subpackage Xyster_Collection
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
// Call Xyster_Collection_FixedTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Collection_FixedTest::main');
}
require_once dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'TestHelper.php';
require_once 'Xyster/Collection/Fixed.php';
require_once 'Xyster/Collection.php';

/**
 * Test class for Xyster_Collection_Fixed.
 * Generated by PHPUnit on 2008-07-16 at 13:24:24.
 */
class Xyster_Collection_FixedTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var    Xyster_Collection_Fixed
     */
    protected $object;

    /**
     * @var Xyster_Collection
     */
    protected $coll;
    
    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';
        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Collection_FixedTest');
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
        $this->coll = new Xyster_Collection;
        $this->object = new Xyster_Collection_Fixed($this->coll);
    }

    /**
     * Tests the 'add' method
     */
    public function testAdd()
    {
        $this->setExpectedException('Xyster_Collection_Exception', 'This collection cannot be changed');
        $this->object->add('aoeu');
    }

    /**
     * Tests the 'clear' method
     */
    public function testClear()
    {
        $this->setExpectedException('Xyster_Collection_Exception', 'This collection cannot be changed');
        $this->object->clear();
    }

    /**
     * Tests the 'remove' method
     */
    public function testRemove()
    {
        $this->setExpectedException('Xyster_Collection_Exception', 'This collection cannot be changed');
        $this->object->remove('aoeu');
    }

    /**
     * Tests the 'removeAll' method
     */
    public function testRemoveAll()
    {
        $this->setExpectedException('Xyster_Collection_Exception', 'This collection cannot be changed');
        $this->object->removeAll($this->coll);
    }

    /**
     * Tests the 'retainAll' method
     */
    public function testRetainAll()
    {
        $this->setExpectedException('Xyster_Collection_Exception', 'This collection cannot be changed');
        $this->object->retainAll($this->coll);
    }
}

// Call Xyster_Collection_FixedTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Collection_FixedTest::main') {
    Xyster_Collection_FixedTest::main();
}