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
 * @package   Xyster_Orm
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
/**
 * @see Xyster_Enum
 */
require_once 'Xyster/Enum.php';
/**
 * Optimistic lock types enum and helper for versioning information 
 *
 * @category  Xyster
 * @package   Xyster_Orm
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Xyster_Orm_Engine_Versioning extends Xyster_Enum
{
    const None = 0;
    const Version = 1;
    const Dirty = 2;
    const All = 3;
    
    /**
     * No optimistic lock
     *
     * @return Xyster_Orm_Engine_Versioning
     */
    static public function None()
    {
       return Xyster_Enum::_factory();
    }
    
    /**
     * Optimistic lock based on entity versioning property
     *
     * @return Xyster_Orm_Engine_Versioning
     */
    static public function Version()
    {
       return Xyster_Enum::_factory();
    }
    
    /**
     * Optimistic lock compares dirty properties
     *
     * @return Xyster_Orm_Engine_Versioning
     */
    static public function Dirty()
    {
       return Xyster_Enum::_factory();
    }
    
    /**
     * Optimistic lock compares all properties
     *
     * @return Xyster_Orm_Engine_Versioning
     */
    static public function All()
    {
       return Xyster_Enum::_factory();
    }
}