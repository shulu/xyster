<?php
/**
 * Xyster Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.opensource.org/licenses/bsd-license.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to xyster@devweblog.org so we can send you a copy immediately.
 *
 * @category  Xyster
 * @package   Xyster_Acl
 * @copyright Copyright (c) 2007 Irrational Logic (http://devweblog.org)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
/**
 * Interface for classes that dynamically determine rules for an ACL 
 *
 * @category  Xyster
 * @package   Xyster_Acl
 * @copyright Copyright (c) 2007 Irrational Logic (http://devweblog.org)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
interface Xyster_Acl_Authorizer_Interface
{
    /**
     * Checks to see if this authorizer can issue rules for the resource
     *
     * @param Zend_Acl_Resource_Interface $resource
     * @return boolean
     */
	function applies( Zend_Acl_Resource_Interface $resource );
	
	/**
	 * Builds a rule for a role's access to a resource with a privilege
	 *
	 * @param Zend_Acl_Role_Interface $role
	 * @param Zend_Acl_Resource_Interface $resource
	 * @param string $privilege
	 * @return boolean
	 */
	function isAllowed( Zend_Acl_Role_Interface $role = null, Zend_Acl_Resource_Interface $resource = null, $privilege = null );
}