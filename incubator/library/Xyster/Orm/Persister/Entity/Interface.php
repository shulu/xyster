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
 * @see Xyster_Orm_Meta_Entity
 */
require_once 'Xyster/Orm/Meta/Entity.php';
/**
 * @see Xyster_Orm_Cache_Source_Interface
 */
require_once 'Xyster/Orm/Cache/Source/Interface.php';
/**
 * @see Xyster_Orm_Session_Interface
 */
require_once 'Xyster/Orm/Session/Interface.php';
/**
 * Persisters are aware of mapping and persistence information for an entity
 *
 * @category  Xyster
 * @package   Xyster_Orm
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
interface Xyster_Orm_Persister_Entity_Interface extends Xyster_Orm_Meta_Entity, Xyster_Orm_Cache_Source_Interface
{
    /**
     * Delete the persistent instance
     *
     * @param mixed $id
     * @param mixed $version
     * @param object $entity
     * @param Xyster_Orm_Session_Interface $sess
     */
    function delete( $id, $version, $entity, Xyster_Orm_Session_Interface $sess );
    
    /**
     * Get the current version of the object or null if not found
     *
     * @param mixed $id
     * @param Xyster_Orm_Session_Interface $sess
     * @return mixed
     */
    function getCurrentVersion( $id, Xyster_Orm_Session_Interface $sess );
    
    /**
     * Get the underlying entity metamodel
     *
     * @return Xyster_Orm_Runtime_EntityMeta
     */
    function getEntityMetamodel();
        
    /**
     * Get the session factory that created this persister
     *
     * @return Xyster_Orm_Session_Factory_Interface
     */
    function getFactory();
    
    /**
     * Gets the identifier strategy
     *
     * @return Xyster_Orm_Id_Generator_Interface
     */
    function getIdGenerator();
        
    /**
     * Get the versionability (is optimistic locked?) of the properties
     *
     * @return array
     */
    function getPropertyVersionability();
    
    /**
     * Gets the root entity name
     * 
     * @return string
     */
    function getRootEntityName();
    
    /**
     * Return the type of the version property if the entity is indexed
     *
     * @return Xyster_Orm_Type_Interface
     */
    function getVersionType();
    
    /**
     * Whether the entity contains collections
     *
     * @return boolean
     */
    function hasCollections();
        
    /**
     * Whether the entity has any database-generated values on insert
     *
     * @return boolean
     */
    function hasInsertGeneratedProperties();
    
    /**
     * Whether the entity has lazy-loaded properties
     *
     * @return boolean
     */
    function hasLazyProperties();
    
    /**
     * Whether the entity has mutable properties
     * 
     * @return boolean
     */
    function hasMutableProperties();
    
    /**
     * Whether the entity has any database-generated values on update
     *
     * @return boolean
     */
    function hasUpdateGeneratedProperties();
    
    /**
     * Inserts an instance (with or without an ID)
     * 
     * If the ID is left blank, it is assumed that the data store will generate
     * the identifier.
     *
     * @param Xyster_Orm_Session_Interface $sess
     * @param object $entity
     * @param array $fields
     * @param mixed $id
     */
    function insert(Xyster_Orm_Session_Interface $sess, $entity, array $fields, $id = null);

    /**
     * Whether batch loading is enabled
     *  
     * @return boolean
     */
    function isBatchLoadable();
    
    /**
     * Whether the id is generated by insert into the data store
     * 
     * @return boolean
     */
    function isIdByInsert();
    
    /**
     * Whether the supplied object is an instance of the entity type
     *
     * @param mixed $object
     * @return boolean
     */
    function isInstance( $object );
        
    /**
     * Whether the option for selecting a snapshot before update is enabled
     *
     * @return boolean
     */
    function isSelectBeforeUpdate();
        
    /**
     * Loads the object
     *
     * @param mixed $id
     * @return object
     */
    function load( $id );
        
    /**
     * Updates the instance
     *
     * @param mixed $id
     * @param array $fields
     * @param array $dirtyFields
     * @param boolean $hasDirtyCollection
     * @param array $oldFields
     * @param mixed $oldVersion
     * @param object $object
     * @param mixed $rowId
     * @param Xyster_Orm_Session_Interface $sess
     */
    function update( $id, array $fields, array $dirtyFields, $hasDirtyCollection, array $oldFields, $oldVersion, $object, $rowId, Xyster_Orm_Session_Interface $sess );
}