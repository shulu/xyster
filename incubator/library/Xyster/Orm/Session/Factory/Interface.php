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
 * A factory for {@link Xyster_Orm_Session_Interface} objects
 *
 * @category  Xyster
 * @package   Xyster_Orm
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
interface Xyster_Orm_Session_Factory_Interface
{
    /**
     * Gets the persister for the collection role given
     * 
     * @param string $role
     * @return Xyster_Orm_Persister_Collection_Interface
     */
    function getCollectionPersister($role);
    
    /**
     * Gets the persister for the entity name given
     * 
     * @param string $entityName
     * @return Xyster_Orm_Persister_Entity_Interface
     */
    function getEntityPersister($entityName);
    
    /**
     * Gets the identifier generator
     *
     * @param string $className
     * @return Xyster_Orm_Id_Generator_Interface
     */
    function getIdentifierGenerator($className);
}