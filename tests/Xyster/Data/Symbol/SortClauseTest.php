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
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
namespace XysterTest\Data\Symbol;
use Xyster\Data\Symbol\SortClause,
        Xyster\Data\Symbol\Sort;
/**
 * Test class for Sort_Clause.
 * Generated by PHPUnit on 2008-02-08 at 12:28:23.
 */
class SortClauseTest extends ClauseTest
{
    /**
     * @var    SortClause
     */
    protected $object;
    
    protected function _getType()
    {
    	return new \Xyster\Type\Type('\Xyster\Data\Symbol\SortClause');
    }
    
    protected function _getItems()
    {
        return array(
                Sort::asc('test123'),
                Sort::desc('anotherTest'),
                Sort::desc('lastName'),
            );
    }
}
