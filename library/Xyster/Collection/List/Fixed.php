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
 * @package   Xyster_Collection
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
/**
 * @see Xyster_Collection_List_Interface
 */
require_once 'Xyster/Collection/List/Interface.php';
/**
 * @see Xyster_Collection_Fixed
 */
require_once 'Xyster/Collection/Fixed.php';
/**
 * A list that cannot be changed
 *
 * @category  Xyster
 * @package   Xyster_Collection
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Xyster_Collection_List_Fixed extends Xyster_Collection_Fixed implements Xyster_Collection_List_Interface
{
    /**
     * Creates a new fixed list
     *
     * @param Xyster_Collection_List_Interface $list
     */
    public function __construct( Xyster_Collection_List_Interface $list )
    {
        $this->_setDelegate($list);
    }
    
    /**
     * Gets the value at a specified index
     * 
     * This method is an alias to ArrayAccess::offsetGet
     * 
     * The index must be greater than or equal to 0 and less than or equal to
     * the size of this collection.  In other words, an index is valid if  
     * <code>( $index < 0 || $index > count($list) )</code> is false.
     *
     * @param int $index The index to get
     * @return mixed The value found at $index
     * @throws OutOfBoundsException if the index is invalid
     */
    public function get( $index )
    {
        return $this->_getDelegate()->offsetGet($index);
    }
    
    /**
     * Returns the first index found for the specified value
     *
     * @param mixed $value
     * @return int The first index found, or null if the value isn't contained
     */
    public function indexOf( $value )
    {
        return $this->_getDelegate()->indexOf($value);
    }
        
    /**
     * This list is unmodifiable, so this method will always throw an exception
     *
     * @param int $index The index at which to insert
     * @param mixed $value The value to insert
     * @throws Xyster_Collection_Exception Always
     */
    public function insert( $index, $value )
    {
        require_once 'Xyster/Collection/Exception.php';
        throw new Xyster_Collection_Exception("This collection cannot be changed");
    }
    
    /**
     * This list is unmodifiable, so this method will always throw an exception
     * 
     * @param int $index The index at which to insert
     * @param Xyster_Collection_Interface $values The value to insert
     * @throws Xyster_Collection_Exception Always
     */
    public function insertAll( $index, Xyster_Collection_Interface $values )
    {
        require_once 'Xyster/Collection/Exception.php';
        throw new Xyster_Collection_Exception("This collection cannot be changed");
    }
    
    /**
     * Gets whether the specified index exists in the list
     *
     * @param int $index The index to test
     * @return boolean Whether the index is in the list
     */
    public function offsetExists( $index )
    {
        return $this->_getDelegate()->offsetExists($index);
    }
    
    /**
     * Gets the value at a specified index
     * 
     * The index must be greater than or equal to 0 and less than
     * the size of this collection.  In other words, an index is valid if  
     * <code>( $index < 0 || $index >= $this->count() )</code> is false.
     *
     * @param int $index The index to get
     * @return mixed The value found at $index
     * @throws OutOfBoundsException if the index is invalid
     */
    public function offsetGet( $index )
    {
        return $this->_getDelegate()->offsetGet($index);
    }
    
    /**
     * This list is unmodifiable, so this method will always throw an exception
     *
     * @param int $index The index to set
     * @param mixed $value The value to set
     * @throws Xyster_Collection_Exception Always
     */
    public function offsetSet( $index, $value )
    {
        require_once 'Xyster/Collection/Exception.php';
        throw new Xyster_Collection_Exception("This collection cannot be changed");
    }
    
    /**
     * This list is unmodifiable, so this method will always throw an exception
     *
     * @param int $index The index to "unset"
     * @throws Xyster_Collection_Exception Always
     */
    public function offsetUnset( $index )
    {
        require_once 'Xyster/Collection/Exception.php';
        throw new Xyster_Collection_Exception("This collection cannot be changed");
    }
    
    /**
     * This list is unmodifiable, so this method will always throw an exception  
     *
     * @param int $index The index to "unset"
     * @return mixed The value removed
     * @throws Xyster_Collection_Exception Always
     */
    public function removeAt( $index )
    {
        require_once 'Xyster/Collection/Exception.php';
        throw new Xyster_Collection_Exception("This collection cannot be changed");
    }
    
    /**
     * This list is unmodifiable, so this method will always throw an exception
     *
     * @param int $index The index to set
     * @param mixed $value The value to set
     * @throws Xyster_Collection_Exception Always
     */
    public function set( $index, $value )
    {
        require_once 'Xyster/Collection/Exception.php';
        throw new Xyster_Collection_Exception("This collection cannot be changed");        
    }
        
    /**
     * This list is unmodifiable, so this method will always throw an exception
     *
     * @param int $from The starting index
     * @param int $count The number of elements to remove
     * @throws Xyster_Collection_Exception Always
     */
    public function slice( $from, $count )
    {
        require_once 'Xyster/Collection/Exception.php';
        throw new Xyster_Collection_Exception("This collection cannot be changed");
    }    
}