<?php
/**
 * Xyster Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/bsd-license.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to xyster@devweblog.org so we can send you a copy immediately.
 *
 * @category  Xyster
 * @package   UnitTests
 * @subpackage Xyster_Collection
 * @copyright Copyright (c) 2007 Irrational Logic (http://devweblog.org)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */

/**
 * PHPUnit test case
 */
require_once 'Xyster/Collection/ImmutableCollectionTest.php';
/**
 * Xyster_Collection_Set
 */
require_once 'Xyster/Collection/Set.php';
/**
 * Test class for immutable collection
 */
class Xyster_Collection_ImmutableSetTest extends Xyster_Collection_ImmutableCollectionTest
{
    /**
     * @var Xyster_Collection_Set
     */
    protected $_c;
    
    public function setUp()
    {
        $this->_c = new Xyster_Collection_Set($this->_getNewCollectionWithRandomValues(),true);
    }

    /**
     * @return Xyster_Collection_Set
     */
    protected function _getNewCollection( $arg = null )
    {
        $class = 'Xyster_Collection_Set';
        return new $class( $arg );    
    }
}