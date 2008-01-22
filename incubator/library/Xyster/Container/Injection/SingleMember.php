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
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
/**
 * @see Xyster_Container_Injection_Abstract
 */
require_once 'Xyster/Container/Injection/Abstract.php';
/**
 * This adapter will instantiate a new object for each call to getInstance 
 *
 * @category  Xyster
 * @package   Xyster_Container
 * @copyright Copyright (c) 2007-2008 Irrational Logic (http://irrationallogic.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
abstract class Xyster_Container_Injection_SingleMember extends Xyster_Container_Injection_Abstract
{
    /**
     * Gets the member arguments
     *
     * @param Xyster_Container_Interface $container
     * @param ReflectionMethod $member
     * @param array $parameterTypes an array of {@link Xyster_Type} objects
     */
    protected function _getMemberArguments( Xyster_Container_Interface $container, ReflectionMethod $member = null, array $parameterTypes = null )
    {
        if ( $member === null ) {
            return array();
        }
        
        if ( $parameterTypes === null ) {
            $parameterTypes = array();	
        }
        
    	$currentParameters = $this->_parameters !== null ?
    	   $this->_parameters : $this->_createDefaultParameters($parameterTypes);
        
    	$result = array();
    	for( $i=0; $i<count($currentParameters); $i++ ) {
    		$parameter = $currentParameters[$i];
    		/* @var $parameter Xyster_Container_Parameter */
    		$result[] = $parameter->resolveInstance($container, $this, $parameterTypes[$i],
    		  new Xyster_Container_NameBinding_Parameter($member, $i), $this->useNames());
    	}
    	
    	return $result;
    }
}