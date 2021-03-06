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
 * @package   Xyster_Container
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
namespace Xyster\Container;
use Xyster\Type\Type;
/**
 * Component definition class
 *
 * @category  Xyster
 * @package   Xyster_Container
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Definition
{
    protected $_name;
    protected $_type;
    protected $_initMethod;
    protected $_constructorArguments = array();
    protected $_depends = array();
    protected $_properties = array();

    /**
     * Creates a new definition
     *
     * @param mixed $type A Type or the name of a class
     * @param string $name Optional. The component name.
     */
    public function __construct($type, $name = null)
    {
        $this->_type = ( $type instanceof Type ) ? $type : new Type($type);
        $this->_name = $name;
    }

    /**
     * Adds a constructor argument.
     *
     * Call this method multiple times for several constructor arguments.  The
     * value argument can either be a literal value or the name of another
     * component in the container.
     *
     * @param mixed $value The argument value
     * @return Definition provides a fluent interface
     */
    public function constructorArg($value)
    {
        $this->_constructorArguments[] = $value;
        return $this;
    }

    /**
     * Adds a property dependency to be injected.
     * 
     * As opposed to {@link property()}, this method is used for class
     * properties that should be resolved from the container.
     * 
     * @param string $name The property name
     * @param string $value The name of the referenced component in the container
     * @return Definition provides a fluent interface
     */
    public function dependsOn($name, $value)
    {
        $this->_depends[$name] = $value;
        return $this;
    }

    /**
     * Gets the constructor arguments 
     * 
     * @return array
     */
    public function getConstructorArgs()
    {
        return $this->_constructorArguments;
    }

    /**
     * Gets the referenced properties
     * 
     * @return array
     */
    public function getDependsOn()
    {
        return $this->_depends;
    }

    /**
     * Gets the initialization method
     * 
     * @return string
     */
    public function getInitMethod()
    {
        return $this->_initMethod;
    }

    /**
     * Gets the name
     * 
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Gets the literal properties

     * @return array
     */
    public function getProperties()
    {
        return $this->_properties;
    }

    /**
     * Gets the type
     * 
     * @return Type
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Sets the name of the method to be invoked when an object has been created
     *
     * The method must exist or the class must have a <code>__call</code>
     * method available.
     *
     * @param string $name The method name
     * @return Definition provides a fluent interface
     * @throws ContainerException if the method wasn't found
     */
    public function initMethod($name)
    {
        if (!$this->_type->getClass()->hasMethod($name) &&
                !method_exists($this->_type->getName(), '__call')) {
            throw new ContainerException('Method not found: ' .
                    $this->_type->getName() . '::' . $name);
        }
        $this->_initMethod = $name;
        return $this;
    }

    /**
     * Adds a literal property to be injected.
     *
     * The value argument must be a literal value (string, boolean, array, etc.)
     *
     * @param string $name The property name
     * @param mixed $value The property value
     * @return Definition provides a fluent interface
     */
    public function property($name, $value)
    {
        $this->_properties[$name] = $value;
        return $this;
    }
}