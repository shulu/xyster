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
 * @see Xyster_Collection_Abstract
 */
require_once 'Xyster/Collection/Abstract.php';
/**
 * Implementation of Xyster_Collection_Abstract with static helper methods
 *
 * @category  Xyster
 * @package   Xyster_Collection
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Xyster_Collection extends Xyster_Collection_Abstract
{
    private $_immutable = false;
    
    /**
     * @var Xyster_Container_List_Empty
     */
    static private $_emptyList = null;

	/**
	 * Creates a new simple collection
	 *
	 * @param Xyster_Collection_Interface $collection
	 * @param boolean $immutable
	 */
	public function __construct( Xyster_Collection_Interface $collection = null, $immutable = false )
    {
        if ( $collection ) {
            $this->merge($collection);
        }
        $this->_immutable = $immutable;
	}

	/**
	 * Adds an item to the collection
	 *
	 * @param mixed $item The item to add
	 * @return boolean Whether the collection changed as a result of this method
	 * @throws Xyster_Collection_Exception if the collection cannot be modified
	 */
	public function add( $item )
	{
		$this->_failIfImmutable();
	    return parent::add($item);
	}
	
	/**
	 * Removes all items from the collection
	 *
	 * @throws Xyster_Collection_Exception if the collection cannot be modified
	 */
	public function clear()
	{
		$this->_failIfImmutable();
	    parent::clear();
	}
	
	/**
	 * Removes the specified value from the collection
	 *
	 * @param mixed $item The value to remove
	 * @return boolean If the value was in the collection
	 * @throws Xyster_Collection_Exception if the collection cannot be modified
	 */
	public function remove( $item )
	{
		$this->_failIfImmutable();
	    return parent::remove($item);
	}
	
	/**
	 * Removes all of the specified values from the collection
	 *
	 * @param Xyster_Collection_Interface $values The values to remove
	 * @return boolean Whether the collection changed as a result of this method
	 * @throws Xyster_Collection_Exception if the collection cannot be modified
	 */
	public function removeAll( Xyster_Collection_Interface $values )
	{
		$this->_failIfImmutable();
		return parent::removeAll($values);
	}

	/**
	 * Removes all values from the collection except for the ones specified
	 *
	 * @param Xyster_Collection_Interface $values The values to keep
	 * @return boolean Whether the collection changed as a result of this method
	 * @throws Xyster_Collection_Exception if the collection cannot be modified
	 */
	public function retainAll( Xyster_Collection_Interface $values )
	{
		$this->_failIfImmutable();
		return parent::retainAll($values);
	}

	/**
	 * Gets an immutable, empty list
	 *
	 * @return Xyster_Container_List_Interface
	 */
	static public function emptyList()
	{
		if ( self::$_emptyList === null ) {
			require_once 'Xyster/Collection/List/Empty.php';
			self::$_emptyList = new Xyster_Collection_List_Empty;
		}
		return self::$_emptyList;
	}
	
	/**
	 * Returns a new unchangable collection containing all the supplied values
	 *
	 * @param Xyster_Collection_Interface $collection
	 * @return Xyster_Collection_Interface
	 */
	static public function fixedCollection( Xyster_Collection_Interface $collection )
	{
		return new Xyster_Collection($collection, true);
	}

	/**
	 * Returns a new unchangable list containing all the supplied values
	 *
	 * @param Xyster_Collection_List_Interface $list
	 * @return Xyster_Collection_List_Interface
	 */
	static public function fixedList( Xyster_Collection_List_Interface $list )
	{
	    require_once 'Xyster/Collection/List.php';
		return new Xyster_Collection_List($list, true);
	}

	/**
	 * Returns a new unchangable map containing all the supplied key/value pairs
	 *
	 * @param Xyster_Collection_Map_Interface $map
	 * @return Xyster_Collection_Map_Interface
	 */
	static public function fixedMap( Xyster_Collection_Map_Interface $map )
	{
	    require_once 'Xyster/Collection/Map.php';
		return new Xyster_Collection_Map($map, true);
	}

	/**
	 * Returns a new unchangable set containing all the supplied values
	 *
	 * @param Xyster_Collection_Set_Interface $set
	 * @return Xyster_Collection_Set_Interface
	 */
	static public function fixedSet( Xyster_Collection_Set_Interface $set )
	{
	    require_once 'Xyster/Collection/Set.php';
		return new Xyster_Collection_Set($set, true);
	}

    /**
     * Creates a new collection containing the values
     *
     * @param array $values
     * @param boolean $immutable
     * @return Xyster_Collection_Interface
     */
    static public function using( array $values, $immutable = false )
    {
        $collection = new Xyster_Collection(null, $immutable);
        $collection->_items = array_values($values);
        return $collection;
    }
    	
	/**
	 * A convenience method to fail on modification of immutable collection
	 *
	 * @throws Xyster_Collection_Exception if the collection is immutable
	 */
	private function _failIfImmutable()
	{
	    if ( $this->_immutable ) {
	        require_once 'Xyster/Collection/Exception.php';
			throw new Xyster_Collection_Exception("This collection cannot be changed");
		} 
	}
}