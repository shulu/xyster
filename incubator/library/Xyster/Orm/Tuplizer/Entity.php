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
 * @see Xyster_Orm_Tuplizer_Entity_Interface
 */
require_once 'Xyster/Orm/Tuplizer/Entity/Interface.php';
/**
 * A tuplizer manages how to get/set and create a type of data
 *
 * @category  Xyster
 * @package   Xyster_Orm
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Xyster_Orm_Tuplizer_Entity implements Xyster_Orm_Tuplizer_Entity_Interface
{
    /**
     * @var Xyster_Orm_Runtime_EntityMeta
     */
    protected $_entityMeta;
    
    /**
     * @var Xyster_Data_Field_Mapper_Interface
     */
    protected $_idMapper;
    
    /**
     * @var Xyster_Orm_Type_Component
     */
    protected $_idMapperType;
    
    protected $_lazyPropertyNames = array();
    
    /**
     * @var Xyster_Data_Field_Mapper_Interface[]
     */
    protected $_mappers = array();
    
    /**
     * @var Xyster_Type
     */
    protected $_mappedType;
    
    /**
     * @var Xyster_Type
     */
    protected $_proxyInterface;
    
    protected $_propertySpan;
    
    /**
     * Creates a new entity tuplizer
     *
     * @param Xyster_Orm_Runtime_EntityMeta $entityMeta
     * @param Xyster_Orm_Mapping_Class_Abstract $mappedEntity
     */
    public function __construct( Xyster_Orm_Runtime_EntityMeta $entityMeta, Xyster_Orm_Mapping_Class_Abstract $mappedEntity )
    {
        $this->_entityMeta = $entityMeta;
        if ( $entityMeta->getIdentifier() ) {
            $this->_idMapper = $mappedEntity->getIdProperty()->getMapper();
        }
        $this->_propertySpan = $entityMeta->getPropertySpan();
        $props = (array)$mappedEntity->getProperties();
        foreach( $props as $prop ) {
            /* @var $prop Xyster_Orm_Mapping_Property */
            $this->_mappers[] = $prop->getMapper();
            if ( $prop->isLazy() ) {
                $this->_lazyPropertyNames[] = $prop->getName();
            }
        }
        if ( $entityMeta->isLazy() ) {
            // @todo build proxy factory
        }
        // @todo identifier mapper (component stuff?)
        $this->_mappedType = $mappedEntity->getMappedType();
        // @todo $this->_proxyInterface = $mappedEntity->getProxyInterface();
    }
    
    /**
     * Create a proxy for the entity 
     *
     * @param mixed $id
     * @param Xyster_Orm_Session_Interface $sess
     * @return object
     */
    public function createProxy( $id, Xyster_Orm_Session_Interface $sess )
    {
        // @todo create proxy
    }
    
    /**
     * Gets the value of a component
     *
     * @param Xyster_Orm_Type_Component $type
     * @param object $object
     * @param string $propertyPath
     * @return mixed
     */
    public function getComponentValue( Xyster_Orm_Type_Component $type, $object, $propertyPath )
    {
        $dot = strpos($propertyPath, '.');
        $basePropertyName = ($dot !== false) ?
            substr($propertyPath, 0, $dot) : $propertyPath;
        
        $names = $type->getPropertyNames();
        $key = array_search($basePropertyName, $names);
        if ( $key === false ) {
            require_once 'Xyster/Orm/Exception.php';
            throw new Xyster_Orm_Exception('Property not found: ' . $basePropertyName);
        }
        $value = $type->getPropertyValue($object, $key);
        if ( $dot !== false ) {
            $types = $type->getTypes();
            return $this->getComponentValue($types[$key], $value, substr($propertyPath, $dot+1));
        } else {
            return $value;
        }
    }
    
    /**
     * Gets the name of the entity
     *
     * @return string
     */
    public function getEntityName()
    {
        return $this->_entityMeta->getName();
    }
    
    /**
     * Get the session factory
     *
     * @return Xyster_Orm_Session_Factory_Interface
     */
    public function getFactory()
    {
        return $this->_entityMeta->getSessionFactory();
    }
    
    /**
     * Gets the identifier value from an entity
     *
     * @param mixed $entity
     * @return mixed
     */
    public function getIdentifier( $entity )
    {
        $id = null;
        if ( $this->_idMapper === null ) {
            if ( $this->_idMapperType == null ) { 
                require_once 'Xyster/Orm/Exception.php';
                throw new Xyster_Orm_Exception('No identifier property: ' . $this->getEntityName());
            } else {
                $copier = $this->_entityMeta->getIdentifier()->getType();
                $id = $copier->instantiate();
                $copier->setPropertyValues($id, $this->_idMapperType->getPropertyValues($entity));
            }
        } else {
            $id = $this->_idMapper->get($entity);
        }
        return $id;
    }
    
    /**
     * Return the class managed by this tuplizer
     *
     * @return Xyster_Type
     */
    public function getMappedType()
    {
        return $this->_mappedType;
    }
    
    /**
     * Get the value of a specified property from the given entity
     *
     * @param mixed $entity
     * @param int $i
     * @return mixed
     */
    public function getPropertyValue( $entity, $i )
    {
        if ( is_numeric($i) ) {
            return $this->_mappers[$i]->get($entity);
        } else {
            $dot = strpos($i, '.');
            $basePropertyName = ($dot !== false) ? substr($i, 0, $dot) : $i;
            $key = $this->_entityMeta->getPropertyIndex($basePropertyName);
            $value = $this->getPropertyValue($entity, $key);
            if ( $dot !== false ) {
                $types = $this->_entityMeta->getPropertyTypes();
                return $this->getComponentValue($types[$key], $value, substr($i, $dot+1));
            } else {
                return $value;
            }
        }
    }
    
    /**
     * Get all values on the given entity (essentially, turn into assoc. array)
     *
     * @param mixed $entity
     * @return array
     */
    public function getPropertyValues( $entity )
    {
        $all = !$this->hasUninitializedLazyProperties($entity);
        $result = array();
        foreach( $this->_entityMeta->getProperties() as $i=>$prop ) {
            /* @var $prop Xyster_Orm_Runtime_Property_Standard */
            if ( $all || !$prop->isLazy() ) {
                $result[] = $this->_mappers[$i]->get($entity);
            } else {
                $result[] = null; // @todo lazy initializer unfetched prop const  
            }
        }
        return $result;
    }
    
    /**
     * Gets the value of the version property
     *
     * @param object $entity
     * @return mixed
     */
    public function getVersion( $entity )
    {
        return ( $this->_entityMeta->isVersioned() ) ? 
            $this->_mappers[$this->_entityMeta->getVersionIndex()]->get($entity) : 
            null;
    }
    
    /**
     * Whether the entity can be proxied
     *
     * @return boolean
     */
    public function hasProxy()
    {
        return $this->_entityMeta->isLazy();
    }
    
    /**
     * Whether the given entity has uninitialized lazy properties
     *
     * @param object $entity
     * @return boolean
     */
    public function hasUninitializedLazyProperties( $entity )
    {
        // @todo proxy stuff
    }
    
    /**
     * Create a new instance of the entity
     *
     * @return mixed
     */
    public function instantiate()
    {
        return $this->instantiateWithId(null);
    }
    
    /**
     * Create an instanceof the entity type with the given id
     *
     * @param mixed $id
     * @return mixed
     */
    public function instantiateWithId( $id )
    {
        $result = $this->_mappedType->getClass()->newInstance();
        if ( $id !== null ) {
            $this->setIdentifier($result, $id);
        }
        return $result;
    }
    
    /**
     * Whether the supplied object is an instance of the entity supported
     *
     * @param mixed $entity
     */
    public function isInstance( $entity )
    {
        return $this->_mappedType->isInstance($entity);
    }
    
    /**
     * Sets the identifier property into an entity
     *
     * @param mixed $entity
     * @param mixed $id
     */
    public function setIdentifier( $entity, $id )
    {
        if ( $this->_idMapper != null ) {
            $this->_idMapper->set($entity, $id);
        }
    }
    
    /**
     * Sets the property value
     * 
     * $name can be either the name of the property or an integer denoting its
     * location.
     *
     * @param mixed $entity
     * @param mixed $name Either property name or property index
     * @param mixed $value The new value
     */
    public function setPropertyValue( $entity, $name, $value )
    {
        $i = is_numeric($name) ?
            $name : $this->_entityMeta->getPropertyIndex($name);
        $this->_mappers[$i]->set($entity, $value);
    }
        
    /**
     * Injects the values into the supplied entity 
     *
     * @param mixed $entity
     * @param array $values
     */
    public function setPropertyValues( $entity, array $values )
    {
        $all = !$this->_entityMeta->hasLazyProperties();
        foreach( $this->_mappers as $i=>$mapper ) {
            if ( $all ) { // @todo || $values[$i] != lazy initializer
                $mapper->set($entity, $values[$i]);
            }
        }
    }
}