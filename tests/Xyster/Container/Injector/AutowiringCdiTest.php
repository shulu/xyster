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
 * @package   UnitTests
 * @subpackage Xyster_Container
 * @copyright Copyright LibreWorks, LLC (http://libreworks.net)
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   $Id$
 */
namespace XysterTest\Container\Injector;
use Xyster\Container\Injector\Autowiring;
require_once dirname(dirname(__FILE__)) . '/_files/Cdi.php';
/**
 * Test class for Xyster_Container_Injector_Autowiring.
 * Generated by PHPUnit on 2009-06-15 at 09:01:33.
 */
class AutowiringCdiTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var    Autowiring
     */
    protected $object;

    /**
     * Sets up the fixture
     */
    protected function setUp()
    {
        $this->object = new \Xyster\Container\Injector\Autowiring(
            \Xyster\Container\Container::definition('\XysterTest\Container\Submarine'),
            \Xyster\Container\Autowire::Constructor());
    }

    public function testConstructor()
    {
        $injector = new \Xyster\Container\Injector\Autowiring(\Xyster\Container\Container::definition('\XysterTest\Container\ScubaGear'));
        self::assertAttributeEquals(\Xyster\Container\Autowire::None(), '_autowire', $injector);
    }
    
    public function testGet()
    {
        $container = new \Xyster\Container\Container();
        $container->add(\Xyster\Container\Container::definition('\XysterTest\Container\SubmarineCaptain')
            ->constructorArg('XysterTest\Container\ScubaGear'))
            ->add(new \Xyster\Container\Definition('\XysterTest\Container\SubFuel'))
            ->add(new \Xyster\Container\Definition('\XysterTest\Container\ScubaGear'));
        
        $object = $this->object->get($container);
        self::assertType('\XysterTest\Container\Submarine', $object);
    }

    /**
     * @expectedException \Xyster\Container\Injector\Exception
     */
    public function testGetNone()
    {
        $container = new \Xyster\Container\Container();
        //$this->setExpectedException('Xyster_Container_Injector_Exception', 'Cannot inject method argument capn into Submarine: no matching types were found in the container');
        $object = $this->object->get($container);
    }

    /**
     * @expectedException \Xyster\Container\Injector\Exception
     */
    public function testGetMulti()
    {
        $container = new \Xyster\Container\Container();
        $container->add(\Xyster\Container\Container::definition('\XysterTest\Container\SubmarineCaptain', 'capn1')
            ->constructorArg('\XysterTest\Container\ScubaGear'))
            ->add(new \Xyster\Container\Definition('\XysterTest\Container\SubFuel'))
            ->add(new \Xyster\Container\Definition('\XysterTest\Container\ScubaGear'))
            ->add(\Xyster\Container\Container::definition('\XysterTest\Container\SubmarineCaptain', 'capn2')
            ->constructorArg('\XysterTest\Container\ScubaGear'));
        //$this->setExpectedException('Xyster_Container_Injector_Exception', 'Cannot inject method argument capn into Submarine: more than one value is available in the container');
        $object = $this->object->get($container);
    }
    
    public function testGetMultiNamed()
    {
        $container = new \Xyster\Container\Container();
        $container->add(\Xyster\Container\Container::definition('\XysterTest\Container\SubmarineCaptain', 'capn')
            ->constructorArg('XysterTest\Container\ScubaGear'))
            ->add(new \Xyster\Container\Definition('\XysterTest\Container\SubFuel'))
            ->add(new \Xyster\Container\Definition('\XysterTest\Container\ScubaGear'))
            ->add(\Xyster\Container\Container::definition('\XysterTest\Container\SubmarineCaptain', 'firstMate')
            ->constructorArg('XysterTest\Container\ScubaGear'));
        $object = $this->object->get($container);
        self::assertType('\XysterTest\Container\Submarine', $object);
    }

    /**
     * @expectedException \Xyster\Container\Injector\Exception
     */
    public function testGetScalar()
    {
        $injector = new \Xyster\Container\Injector\Autowiring(\Xyster\Container\Container::definition('\Xyster\Type\Type'), \Xyster\Container\Autowire::Constructor());
        //$this->setExpectedException('Xyster_Container_Injector_Exception', 'Cannot inject method argument type into Xyster_Type: non-object parameters cannot be autowired');
        $injector->get(new \Xyster\Container\Container());
    }
    
    public function testGetNoArg()
    {
        $injector = new \Xyster\Container\Injector\Autowiring(\Xyster\Container\Container::definition('\XysterTest\Container\ScubaGear'), \Xyster\Container\Autowire::Constructor());
        $object = $injector->get(new \Xyster\Container\Container());
        self::assertType('\XysterTest\Container\ScubaGear', $object);
    }
    
    public function testGetLabel()
    {
        self::assertEquals('Autowiring', $this->object->getLabel());
    }
}
