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
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace Xyster\Collection;
/**
 * An immutable empty list
 *
 * @category  Xyster
 * @package   Xyster_Collection
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class EmptyList implements IList, ISet
{
    /**
     * Adds an item to the collection
     *
     * @param mixed $item The item to add
     * @return boolean Whether the collection changed as a result of this method
     * @throws UnmodifiableException Always
     */
    public function add( $item )
    {
        throw new UnmodifiableException('This list is immutable');
    }
    
    /**
     * Removes all items from the collection
     *
     * @throws UnmodifiableException Always
     */
    public function clear()
    {
        throw new UnmodifiableException('This list is immutable');
    }
    
    /**
     * Tests to see whether the collection contains the value supplied
     *
     * @param mixed $item The item to test
     * @return boolean Whether the collection contains the supplied value   
     */
    public function contains( $item )
    {
    	return false;
    }
    
    /**
     * Tests to see whether the collection contains all of the supplied values
     *
     * @param ICollection $values The values to test
     * @return boolean Whether the collection contains all of the supplied values
     */
    public function containsAll( ICollection $values )
    {
    	return false;
    }
    
    /**
     * Tests to see whether the collection contains any of the supplied values
     * 
     * Basically, implementations can safely return true on the first item that
     * is found.
     * 
     * @param ICollection $values The values to test
     * @return boolean Whether the collection contains any of the supplied values
     */
    public function containsAny( ICollection $values )
    {
    	return false;
    }
    
    /**
     * Gets the number of items in the collection
     * 
     * @return int The number of items
     */
    public function count()
    {
    	return 0;
    }
    
    /**
     * Gets the value at a specified index
     * 
     * This method is an alias to ArrayAccess::offsetGet
     *
     * @param int $index The index to get
     * @return mixed The value found at $index
     */
    public function get( $index )
    {
        throw new UnmodifiableException("Invalid index given");
    }
    
    /**
     * Gets an iterator for the values in the collection
     *
     * @return Iterator
     */
    public function getIterator()
    {
        return new \EmptyIterator;
    }
    
    /**
     * Returns the first index found for the specified value
     *
     * @param mixed $value
     * @return int The first index found, or null if the value isn't contained
     */
    public function indexOf( $value )
    {
    	return null;
    }
    
    /**
     * Inserts a value into the list at the specified index
     *
     * @param int $index The index at which to insert
     * @param mixed $value The value to insert
     * @throws UnmodifiableException Always
     */
    public function insert( $index, $value )
    {
        throw new UnmodifiableException('This list is immutable');
    }
    
    /**
     * Inserts the supplied values into the list at the specified index
     * 
     * The index must be greater than or equal to 0 and less than or equal to
     * the size of this collection.  In other words, an index is valid if  
     * <code>( $index < 0 || $index > count($list) )</code> is false.  
     * 
     * @param int $index The index at which to insert
     * @param ICollection $values The value to insert
     * @throws UnmodifiableException Always
     */
    public function insertAll( $index, ICollection $values )
    {
        throw new UnmodifiableException('This list is immutable');
    }
    
    /**
     * Tests to see if the collection contains no elements
     * 
     * The return value from this method should be equivalent to 
     * <code>( $collection->count() == 0 )</code>.
     *
     * @return boolean Whether this collection has no elements
     */
    public function isEmpty()
    {
        return true;
    }
        
    /**
     * Merges the values from the supplied collection into this one
     *
     * @param ICollection $values
     * @return boolean Whether the collection changed as a result of this method
     * @throws UnmodifiableException Always
     */
    public function merge( ICollection $values )
    {
        throw new UnmodifiableException('This list is immutable');
    }

    /**
     * Gets whether the specified index exists in the list
     *
     * @param int $index The index to test
     * @return boolean Whether the index is in the list
     */
    public function offsetExists( $index )
    {
        return false;
    }
    
    /**
     * Gets the value at a specified index
     *
     * @param int $index The index to get
     * @return mixed The value found at $index
     * @throws UnmodifiableException if the index is invalid
     */
    public function offsetGet( $index )
    {
        throw new UnmodifiableException("Invalid index given");
    }
    
    /**
     * Sets the value at a given index.
     * 
     * The index must be greater than or equal to 0 and less than or equal to
     * the size of this collection.  In other words, an index is valid if  
     * <code>( $index < 0 || $index > $this->count() )</code> is false.
     *
     * @param int $index The index to set
     * @param mixed $value The value to set
     * @throws OutOfBoundsException if the index is invalid
     */
    public function offsetSet( $index, $value )
    {
        throw new UnmodifiableException('This list is immutable');
    }
    
    /**
     * Removes a value at the specified index
     * 
     * The index must be greater than or equal to 0 and less than
     * the size of this collection.  In other words, an index is valid if  
     * <code>( $index < 0 || $index > $this->count() )</code> is false.  
     *
     * @param int $index The index to "unset"
     */
    public function offsetUnset( $index )
    {
        throw new UnmodifiableException('This list is immutable');
    }
        
    /**
     * Removes the specified value from the collection
     *
     * @param mixed $item The value to remove
     * @return boolean If the value was in the collection
     * @throws UnmodifiableException Always
     */
    public function remove( $item )
    {
        throw new UnmodifiableException('This list is immutable');
    }
    
    /**
     * Removes all of the specified values from the collection
     *
     * @param ICollection $values The values to remove
     * @return boolean Whether the collection changed as a result of this method
     * @throws UnmodifiableException Always
     */
    public function removeAll( ICollection $values )
    {
        throw new UnmodifiableException('This list is immutable');
    }
        
    /**
     * Removes a value at the specified index
     * 
     * This method is an alias to ArrayAccess::offsetUnset  
     *
     * @param int $index The index to "unset"
     * @throws UnmodifiableException Always
     */
    public function removeAt( $index )
    {
        throw new UnmodifiableException('This list is immutable');
    }
    
    /**
     * Removes all values from the collection except for the ones specified
     * 
     * If the collection doesn't contain any of the values supplied, it should
     * simply be emptied.
     *
     * @param ICollection $values The values to keep
     * @return boolean Whether the collection changed as a result of this method
     * @throws UnmodifiableException Always
     */
    public function retainAll( ICollection $values )
    {
        throw new UnmodifiableException('This list is immutable');
    }
        
    /**
     * Sets the value at a given index.
     * 
     * This method is an alias to ArrayAccess::offsetSet.
     * 
     * The index must be greater than or equal to 0 and less than or equal to
     * the size of this collection.  In other words, an index is valid if  
     * <code>( $index < 0 || $index > count($list) )</code> is false.
     *
     * @param int $index The index to set
     * @param mixed $value The value to set
     * @throws UnmodifiableException Always
     */
    public function set( $index, $value )
    {
        throw new UnmodifiableException('This list is immutable');
    }
    
    /**
     * Removes all elements between $from and $to, including $from.
     *
     * @param int $from The starting index
     * @param int $to The index to end before reaching
     * @throws UnmodifiableException Always
     */
    public function slice( $from, $to )
    {
        throw new UnmodifiableException('This list is immutable');
    }
    
    /**
     * Puts the items in this collection into an array
     * 
     * @return array The items in this collection
     */
    public function toArray()
    {
        return array();
    }
}
