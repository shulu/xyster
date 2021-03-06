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
 * @package   Xyster_Data
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
namespace Xyster\Data\Symbol;
/**
 * A field clause
 *
 * @category  Xyster
 * @package   Xyster_Data
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
class FieldClause extends AbstractClause
{
    /**
     * @var Xyster_Type
     */
    static private $_type;
    
    /**
     * Creates a new Sort clause
     * 
     * @param Xyster_Data_Symbol $symbol The symbol or clause to add to this one
     */
    public function __construct( ISymbol $symbol = null )
    {
        if ( !self::$_type instanceof \Xyster\Type\Type ) {
            self::$_type = new \Xyster\Type\Type('\Xyster\Data\Symbol\Field');
        }
        parent::__construct(self::$_type, $symbol);
    }
}