<?php
/**
 * This file contains test classes for unit testing setter injection 
 */
namespace XysterTest\Container;

class Submarine
{
    protected $_capn;
    protected $_fuel;
    protected $_crew;
    protected $_name;
    protected $_location;
    
    public function __construct( Sailor $capn, SubFuel $fuel, array $crew = array() )
    {
        $this->_capn = $capn;
        $this->_fuel = $fuel;
        $this->_crew = $crew;
    }
    
    public function getCaptain()
    {
        return $this->_capn;
    }
    
    public function setLocation( $location )
    {
        $this->_location = $location;
    }
    
    public function setName( $name )
    {
        $this->_name = $name;
    }
    
    public function setX( $x )
    {
        // nothing
    }
    
    protected function setError( $error )
    {
        // do nothing
    }
}

interface Sailor
{
    function navigate();
}

class SubmarineCaptain implements Sailor, \Xyster\Container\IContainerAware
{
    protected $_suit;
    protected $_name;
    protected $_container;
    protected $_navigated = false;
    
    public function __construct( ScubaGear $suit, $name = 'Capn' )
    {
        $this->_suit = $suit;
    }
    
    public function navigate()
    {
        $this->_navigated = true;
    }
    
    public function setContainer(\Xyster\Container\IContainer $container)
    {
        $this->_container = $container;
    }
}

class SubFuel
{
}

class ScubaGear
{
}

class SeaUrchin
{
    protected function __construct()
    {
    }
}