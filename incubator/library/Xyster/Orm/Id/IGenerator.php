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
 * @copyright Copyright (c) Xyster contributors
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
/**
 * Interface for an identifier generator.
 * 
 * Classes that implement this interface should only have a no-argument
 * constructor. They should be serializable and probably shouldn't have any
 * complex properties.
 *
 * @category  Xyster
 * @package   Xyster_Orm
 * @copyright Copyright (c) Xyster contributors
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
interface Xyster_Orm_Id_IGenerator
{
    /**
     * Generates a new identifier.
     *
     * @param Xyster_Orm_ISession $session
     * @param object $object The entity or collection 
     */
    function generate(Xyster_Orm_ISession $session, $object);
}