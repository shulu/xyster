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
 * @copyright Copyright (c) 2007 Irrational Logic (http://devweblog.org)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
/**
 * @see Xyster_Container_Injection_Factory
 */
require_once 'Xyster/Container/Injection/Factory.php';
/**
 * @see Xyster_Container_Injection_Constructor
 */
require_once 'Xyster/Container/Injection/Constructor.php';
/**
 * Creates constructor injection adapters 
 *
 * @category  Xyster
 * @package   Xyster_Container
 * @copyright Copyright (c) 2007 Irrational Logic (http://devweblog.org)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Xyster_Container_Injection_Factory_Constructor implements Xyster_Container_Injection_Factory
{
    /**
     * Create a new constructor adapter
     * 
     * {@inherit}
     * 
     * @param Xyster_Container_Monitor $componentMonitor the component monitor
     * @param Zend_Config $componentProperties the component properties
     * @param mixed $componentKey the key to be associated with this adapter.
     * @param string $componentImplementation 
     * @param mixed $parameters 
     * @throws Exception if the creation of the component adapter fails
     * @return Xyster_Container_Adapter The component adapter
     */
    public function createComponentAdapter(Xyster_Container_Monitor $componentMonitor, Zend_Config $componentProperties, $componentKey, $componentImplementation, $parameters)
    {
        return new Xyster_Container_Injection_Constructor($componentKey,
            $componentImplementation, $parameters, $componentMonitor);
    }
}