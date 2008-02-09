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
 * @subpackage Xyster_Data
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */

// Call Xyster_Data_Sort_ClauseTest::main() if this source file is executed directly.
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Xyster_Data_Sort_ClauseTest::main');
}

require_once dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'ClauseTest.php';
require_once 'Xyster/Data/Sort/Clause.php';

/**
 * Test class for Xyster_Data_Sort_Clause.
 * Generated by PHPUnit on 2008-02-08 at 12:28:23.
 */
class Xyster_Data_Sort_ClauseTest extends Xyster_Data_ClauseTest
{
    /**
     * @var    Xyster_Data_Sort_Clause
     */
    protected $object;

    /**
     * Runs the test methods of this class.
     */
    public static function main()
    {
        require_once 'PHPUnit/TextUI/TestRunner.php';

        $suite  = new PHPUnit_Framework_TestSuite('Xyster_Data_Sort_ClauseTest');
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }
    
    protected function _getType()
    {
    	return new Xyster_Type('Xyster_Data_Sort_Clause');
    }
    
    protected function _getItems()
    {
        return array(
                Xyster_Data_Sort::asc('test123'),
                Xyster_Data_Sort::desc('anotherTest'),
                Xyster_Data_Sort::desc('lastName'),
            );
    }
}

// Call Xyster_Data_Sort_ClauseTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == 'Xyster_Data_Sort_ClauseTest::main') {
    Xyster_Data_Sort_ClauseTest::main();
}
