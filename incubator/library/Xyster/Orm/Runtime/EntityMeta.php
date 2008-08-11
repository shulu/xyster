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
 * Runtime metamodel entity information
 *
 * @category  Xyster
 * @package   Xyster_Orm
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Xyster_Orm_Runtime_EntityMeta
{
    /**
     * @var string
     */
    private $_name;
    /**
     * @var boolean
     */
    private $_hasInsertGeneratedValues;
    /**
     * @var boolean
     */
    private $_hasUpdateGeneratedValues = false;
    /**
     * @var boolean
     */
    private $_hasCollections = false;
    /**
     * @var boolean
     */
    private $_hasMutableProperties = false;
    /**
     * @var boolean
     */
    private $_hasLazyProperties = false;
    /**
     * @var boolean
     */
    private $_hasNonIdentifierPropertyNamedId = false;
    /**
     * @var Xyster_Orm_Runtime_Property_Identifier
     */
    private $_identifierProperty;
    /**
     * @var array
     */
    private $_insertInclusions = array();
    /**
     * @var boolean
     */
    private $_lazy = false;
    /**
     * @var boolean
     */
    private $_mutable = false;
    /**
     * @var Xyster_Orm_Engine_Versioning
     */
    private $_optimisticLockMode;
    /**
     * @var array
     */
    private $_properties = array();
    /**
     * @var array
     */
    private $_propertyIndexes = array();
    /**
     * @var array
     */
    private $_propertyLaziness = array();
    /**
     * @var array
     */
    private $_propertyNames = array();
    /**
     * @var array
     */
    private $_propertyNullability = array();
    /**
     * @var int
     */
    private $_propertySpan = 0;
    /**
     * @var array
     */
    private $_propertyTypes = array();
    /**
     * @var array
     */
    private $_propertyVersionability = array();
    /**
     * @var boolean
     */
    private $_selectBeforeUpdate = false;
    /**
     * @var Xyster_Orm_Session_Factory_Interface
     */
    private $_sessionFactory;
    /**
     * @var Xyster_Orm_Tuplizer_Entity_Interface
     */
    private $_tuplizer;
    /**
     * @var array 
     */
    private $_updateInclusions = array();
    /**
     * @var boolean
     */
    private $_versioned = false;
    /**
     * @var int
     */
    private $_versionPropertyIndex = -1;
    
    /**
     * Creates a new runtime entity meta object
     *
     * @param Xyster_Orm_Mapping_Entity $em
     * @param Xyster_Orm_Session_Factory_Interface $sessionFactory
     */
    public function __construct( Xyster_Orm_Mapping_Entity $em, Xyster_Orm_Session_Factory_Interface $sessionFactory )
    {
        $this->_sessionFactory = $sessionFactory;
        $this->_name = $em->getClassName();
        
        $this->_optimisticLockMode = $em->getOptimisticLockMode();
        $this->_mutable = (boolean)$em->isMutable();
        $this->_versioned = (boolean)$em->isVersioned();
        $this->_selectBeforeUpdate = (boolean)$em->isSelectBeforeUpdate();
        $this->_lazy = (boolean)$em->isLazy();
        
        $props = (array)$em->getProperties();
        $this->_propertySpan = count($props);
        $foundCollection = false;
        $foundInsertGenerated = false;
        $foundUpdateGenerated = false;
        foreach( $props as $i => $prop ) {
            /* @var $prop Xyster_Orm_Mapping_Property */
            if ( $prop === $em->getVersion() ) {
                $this->_versionPropertyIndex = $i;
                // $this->_properties[$i] = 
                $this->_properties[$i] = null;
            } else {
                // $this->_properties[$i] = 
                $this->_properties[$i] = null;
            }
            if ( $prop->getName() == 'id' ) {
                $this->_hasNonIdentifierPropertyNamedId = true;
            }
            $lazy = $prop->isLazy();
            if ( $lazy ) { 
                $this->_hasLazyProperties = true;
            }
            $this->_propertyLaziness[$i] = $prop->isLazy();
            $this->_propertyNames[$i] = $prop->getName();
            $this->_propertyTypes[$i] = $prop->getType();
            $this->_propertyNullability[$i] = $prop->isNullable();
            // $this->_propertyVersionability[$i] =
            if ( $prop->getType()->isMutable() ) {
                $this->_hasMutableProperties = true;
            }
            $this->_propertyIndexes[$prop->getName()] = $i;
        }
    }
    
    /**
     * Gets the identifier property
     *
     * @return Xyster_Orm_Runtime_Property_Identifier
     */
    public function getIdentifier()
    {
        return $this->_identifierProperty;
    }
    
    /**
     * Gets the class name of the entity
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }
    
    /**
     * Gets the optimistic lock mode
     *
     * @return Xyster_Orm_Engine_Versioning
     */
    public function getOptimisticLockMode()
    {
        return $this->_optimisticLockMode;
    }
    
    /**
     * Gets the properties on this entity type
     * 
     * This array does not include the identifier.
     *
     * @return array of {@link Xyster_Orm_Runtime_Property_Standard} objects
     */
    public function getProperties()
    {
        return array() + $this->_properties;
    }
    
    /**
     * Gets the numeric index of the property name given
     *
     * @param string $name
     * @param boolean $nullIfNone Return null if property not found?
     * @return int
     * @throws Xyster_Orm_Exception if the property wasn't found
     */
    public function getPropertyIndex( $name, $nullIfNone = false )
    {
        if ( array_key_exists($name, $this->_propertyIndexes) ) {
            return $this->_propertyIndexes[$name];
        } else if ( $nullIfNone) {
            return null;
        }
        
        require_once 'Xyster/Orm/Exception.php';
        throw new Xyster_Orm_Exception('Property not found: ' . $name);
    }
    
    /**
     * Gets an array of booleans representing whether properties are lazy
     *
     * @return array
     */
    public function getPropertyLaziness()
    {
        return $this->_propertyLaziness;
    }
    
    /**
     * Gets an array of property names
     *
     * @return array
     */
    public function getPropertyNames()
    {
        return $this->_propertyNames;
    }
    
    /**
     * Gets an array of booleans representing whether properties are nullable
     *
     * @return array
     */
    public function getPropertyNullability()
    {
        return $this->_propertyNullability;
    }
    
    /**
     * Gets the number of properties in the type
     *
     * @return int
     */
    public function getPropertySpan()
    {
        return $this->_propertySpan;
    }
    
    /**
     * Gets an array of {@link Xyster_Orm_Type_Interface} objects
     *
     * @return array
     */
    public function getPropertyTypes()
    {
        return $this->_propertyTypes;
    }
    
    /**
     * Gets an array of booleans representing whether properties are versioned
     *
     * @return array
     */
    public function getPropertyVersionability()
    {
        return $this->_propertyVersionability;
    }
    
    /**
     * Gets the session factory
     *
     * @return Xyster_Orm_Session_Factory_Interface
     */
    public function getSessionFactory()
    {
        return $this->_sessionFactory;
    }
    
    /**
     * Gets the tuplizer
     *
     * @return Xyster_Orm_Tuplizer_Entity_Interface
     */
    public function getTuplizer()
    {
        return $this->_tuplizer;
    }
    
    /**
     * Gets the version property
     *
     * @return Xyster_Orm_Runtime_Property_Version
     */
    public function getVersion()
    {
        return ( $this->_versioned ) ?
            $this->_properties[$this->_versionPropertyIndex] : null;
    }
    
    /**
     * Gets the numeric index of the version property
     *
     * @return int
     */
    public function getVersionIndex()
    {
        return $this->_versionPropertyIndex;
    }
    
    /**
     * Whether the entity has collections
     *
     * @return boolean
     */
    public function hasCollections()
    {
        return $this->_hasCollections;
    }
    
    /**
     * Whether the entity has values generated by the database on insert
     *
     * @return boolean
     */
    public function hasInsertGeneratedValues()
    {
        return $this->_hasInsertGeneratedValues;
    }
    
    /**
     * Whether the entity has lazy properties
     *
     * @return boolean
     */
    public function hasLazyProperties()
    {
        return $this->_hasLazyProperties;
    }
    
    /**
     * Whether the entity has mutable properties
     *
     * @return boolean
     */
    public function hasMutableProperties()
    {
        return $this->_hasMutableProperties;
    }
    
    /**
     * Whether the entity has a property named id that isn't the identifier
     *
     * @return boolean
     */
    public function hasNonIdentifierPropertyNamedId()
    {
        return $this->_hasNonIdentifierPropertyNamedId;
    }
    
    /**
     * Whether the entity has values generated by the database on update
     *
     * @return boolean
     */
    public function hasUpdateGeneratedValues()
    {
        return $this->_hasUpdateGeneratedValues;
    }
    
    /**
     * Whether this type is lazy loaded
     *
     * @return boolean
     */
    public function isLazy()
    {
        return $this->_lazy;
    }
    
    /**
     * Whether this entity type is mutable
     *
     * @return boolean
     */
    public function isMutable()
    {
        return $this->_mutable;
    }
    
    /**
     * Whether this type should be selected before it's updated
     *
     * @return boolean
     */
    public function isSelectBeforeUpdate()
    {
        return $this->_selectBeforeUpdate;
    }
    
    /**
     * Whether this entity type has a version property
     * 
     * @return boolean
     */
    public function isVersioned()
    {
        return $this->_versioned;
    }
    
    /**
     * Sets this entity to be lazy-loaded
     *
     * @param boolean $lazy
     * @return Xyster_Orm_Runtime_EntityMeta provides a fluent interface
     */
    public function setLazy( $lazy = true )
    {
        $this->_lazy = $lazy;
        return $this;
    }
    
    /**
     * Returns a string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return 'EntityMeta(' . $this->getName() . ')';
    }
    
    protected static function _buildIdentifierProperty(Xyster_Orm_Mapping_Entity $em, Xyster_Orm_Engine_IdGenerator_Interface $generator)
    {
        $unsavedValue = null;
    }
}