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
 * @see Xyster_Orm_Type_Float
 */
require_once 'Xyster/Orm/Type/Float.php';
/**
 * Maps a SQL DECIMAL/NUMERIC to a PHP float
 *
 * @category  Xyster
 * @package   Xyster_Orm
 * @copyright Copyright (c) Xyster contributors
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class Xyster_Orm_Type_Decimal extends Xyster_Orm_Type_Float
{
    /**
     * Gets the underlying database type
     *
     * @return Xyster_Db_DataType
     */
    public function getDataType()
    {
        return Xyster_Db_DataType::Decimal();
    }
    
    /**
     * Returns the type name
     *
     * @return string
     */
    public function getName()
    {
        return 'decimal';
    }
}