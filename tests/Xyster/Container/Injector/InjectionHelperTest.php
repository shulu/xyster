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
use Xyster\Container\Injector\InjectionHelper;
use Xyster\Container\Definition;
use Xyster\Container\Container;
require_once dirname(dirname(__FILE__)) . '/_files/Cdi.php';
require_once dirname(dirname(__FILE__)) . '/_files/Sdi.php';

/**
 * Test class for InjectionHelper.
 * Generated by PHPUnit on 2011-02-13 at 17:23:13.
 */
class InjectionHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests findInContainer
     */
    public function testFindInContainer()
    {
        $value = new \XysterTest\Container\RocketFuel();
        $container = $this->getMock('\Xyster\Container\IContainer');
        $container->expects($this->any())
            ->method("contains")
            ->will($this->returnValue(true));
        $container->expects($this->any())
            ->method('get')
            ->will($this->returnValue($value));
        $this->assertSame($value, InjectionHelper::findInContainer($container, 'foo'));
    }

    /**
     * @expectedException \Xyster\Container\Injector\Exception
     */
    public function testFindInContainerFail()
    {
        $container = $this->getMock('\Xyster\Container\IContainer');
        $container->expects($this->any())
            ->method("contains")
            ->will($this->returnValue(false));
        InjectionHelper::findInContainer($container, 'foo');
    }

    /**
     * Tests getMemberArguments().
     */
    public function testGetMemberArguments()
    {
        $container = $this->getMock('\Xyster\Container\IContainer');
        $capn = new \XysterTest\Container\SubmarineCaptain(new \XysterTest\Container\ScubaGear(), "Cap'n Crunch");
        $fuel = new \XysterTest\Container\SubFuel();
        $container->expects($this->any())
            ->method('contains')
            ->will($this->onConsecutiveCalls(true, true, false));
        $container->expects($this->any())
            ->method('get')
            ->will($this->onConsecutiveCalls($capn, $fuel));
        $args = InjectionHelper::getMemberArguments($container,
            new \Xyster\Type\Type('\XysterTest\Container\Submarine'),
            array('capnCrunch', 'subFuel'));
        $this->assertEquals(array($capn, $fuel, array()), $args);
    }

    /**
     * Tests getMemberArguments with a class that has no constructor
     */
    public function testGetMemberArgumentsEmpty()
    {
        $this->assertEquals(array(),
            InjectionHelper::getMemberArguments($this->getMock('\Xyster\Container\IContainer'),
                new \Xyster\Type\Type('\XysterTest\Container\RocketFuel')));
    }

    /**
     * Tests injectProperties
     */
    public function testInjectProperties()
    {
        $ship = new \XysterTest\Container\RocketShip();
        $fuel = new \XysterTest\Container\RocketFuel();
        $properties = array('fuel' => $fuel);
        $dependsOn = array('pilot' => 'captainStarblazer');
        $astronaut = new \XysterTest\Container\RocketPilot();
        $astronaut->setSuit(new \XysterTest\Container\SpaceSuit());
        $container = $this->getMock('\Xyster\Container\IContainer');
        $container->expects($this->any())
            ->method('contains')
            ->will($this->returnValue(true));
        $container->expects($this->any())
            ->method('get')
            ->will($this->returnValue($astronaut));
        InjectionHelper::injectProperties($ship, $container, $properties, $dependsOn, null);
    }
}
