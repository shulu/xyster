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
namespace Xyster\Container\Provider;
/**
 * Provides instances of the component type
 *
 * @category  Xyster
 * @package   Xyster_Container
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
interface IProvider
{
    /**
     * Get an instance of the provided component.
     * 
     * This method will usually create a new instance each time it is called,
     * but that is not required.  For example, a provider could keep a reference
     * to the same object or store it in an external scope.
     * 
     * @param \Xyster\Container\IContainer $container The container (used for dependency resolution)
     * @param \Xyster\Type\Type $into Optional. The type into which this component will be injected
     * @return mixed The component
     */
    function get(\Xyster\Container\IContainer $container, \Xyster\Type\Type $into = null);
    
    /**
     * Gets the label for the type of provider (for instance Caching or Singleton).
     * 
     * @return string The provider label
     */
    function getLabel();
    
    /**
     * Gets the name of the component.
     * 
     * @return string The component name
     */
    function getName();
    
    /**
     * Gets the type of component.
     * 
     * @return \Xyster\Type\Type THe component type
     */
    function getType();
    
    /**
     * Verify that all dependencies for this component can be satisifed.
     * 
     * Normally, the details should verify this by checking that the associated
     * Container contains all the needed dependnecies.
     * 
     * @param \Xyster\Container\IContainer $container The container
     * @throws \Xyster\Container\Exception if one or more required dependencies aren't met
     */
    function validate(\Xyster\Container\IContainer $container);
    
    /**
     * Converts the object into a string value
     * 
     * @magic
     * @return string
     */
    function __toString();
}