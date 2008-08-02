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
 * An entity or component property
 *
 * @category  Xyster
 * @package   Xyster_Orm
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Xyster_Orm_Mapping_Property
{
    /**
     * @var boolean
     */
    protected $_lazy = false;
    /**
     * @var Xyster_Data_Field_Mapper_Interface
     */
    protected $_mapper;
    /**
     * @var string
     */
    protected $_name;
    /**
     * @var Xyster_Orm_Mapping_PersistentClass
     */
    protected $_pc;
    /**
     * @var Xyster_Orm_Mapping_Value_Interface
     */
    protected $_value;
    
    /**
     * Gets the columns in the property
     *
     * @return array of {@link Xyster_Db_Column} objects
     */
    public function getColumns()
    {
        return $this->_value->getColumns();
    }
    
    /**
     * Gets the number of columns in the property
     *
     * @return int
     */
    public function getColumnSpan()
    {
        return $this->_value->getColumnSpan();
    }
    
    /**
     * Gets a mapper for this property
     *
     * @return Xyster_Data_Field_Mapper_Interface
     */
    public function getMapper()
    {
        return $this->_mapper;
    }
    
    /**
     * Gets the name of the property
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }
    
    /**
     * Gets the entity class information
     *
     * @return Xyster_Orm_Mapping_PersistentClass
     */
    public function getPersistentClass()
    {
        return $this->_pc;
    }
    
    /**
     * Gets the type of the property
     *
     * @return Xyster_Orm_Type_Interface
     */
    public function getType()
    {
        return $this->_value->getType();
    }
    
    /**
     * Gets the value of the property
     *
     * @return Xyster_Orm_Mapping_Value_Interface
     */
    public function getValue()
    {
        return $this->_value;
    }
    
    /**
     * Gets whether this property is a composite type
     *
     * @return boolean
     */
    public function isComposite()
    {
        return $this->_value instanceof Xyster_Orm_Mapping_Component;
    }
    
    /**
     * Gets whether this property is lazy-loaded
     *
     * @return boolean
     */
    public function isLazy()
    {
        return $this->_lazy;
    }

    /**
     * Sets that this property is lazy-loaded
     *
     * @param boolean $flag
     * @return Xyster_Orm_Mapping_Property provides a fluent interface
     */
    public function setLazy( $flag = true )
    {
        $this->_lazy = $flag;
        return $this;
    }
    
    /**
     * Sets the mapper for this property
     *
     * @param Xyster_Data_Field_Mapper_Interface $mapper
     * @return Xyster_Orm_Mapping_Property provides a fluent interface
     */
    public function setMapper( Xyster_Data_Field_Mapper_Interface $mapper )
    {
        $this->_mapper = $mapper;
        return $this;
    }
    
    /**
     * Sets the property name
     *
     * @param string $name
     * @return Xyster_Orm_Mapping_Property provides a fluent interface
     */
    public function setName( $name )
    {
        $this->_name = $name;
        return $this;
    }
    
    /**
     * Sets the entity class information
     *
     * @param Xyster_Orm_Mapping_PersistentClass $pc
     * @return Xyster_Orm_Mapping_Property provides a fluent interface
     */
    public function setPersistentClass( Xyster_Orm_Mapping_PersistentClass $pc )
    {
        $this->_pc = $pc;
        return $this;
    }
    
    /**
     * Sets the value
     *
     * @param Xyster_Orm_Mapping_Value_Interface $value
     * @return Xyster_Orm_Mapping_Property provides a fluent interface
     */
    public function setValue( Xyster_Orm_Mapping_Value_Interface $value )
    {
        $this->_value = $value;
        return $this;
    }
}