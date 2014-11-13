<?php

namespace robotdemo\Tests\Models;

use robotdemo\Models\Coordinate;
use robotdemo\Models\Object;
use robotdemo\Tests\TestBase;

class EnvironmentTest extends TestBase
{
	
	/**
	 * Tests an object can be added to the environment
	 */
    public function testAddObject()
    {
        $environment = $this->getEnvironment();
        $environment->addObject($this->getObject(), 'obj1');
        
        $this->assertTrue( $environment->hasObject('obj1') );
    }
    
    /**
	 * Tests that the same object can't be used twice
	 * 
     * @depends testAddObject
     * @expectedException \robotdemo\Exceptions\ObjectAlreadyAddedException
     */
    public function testAddSameObject()
    {
        $environment = $this->getEnvironment();
        $environment->addObject($this->getObject(), 'obj1');
        $environment->addObject($this->getObject(), 'obj1');
    }
    
    /**
     * tests that the coordinate is used function reports true when used
     */
    public function testIsCoordinateUsed()
    {
        $environment = $this->getEnvironment();
        
        $object = $this->getObject();
        $object->setCoordinate( $this->getCoordinate(1, 1) );
        
        $environment->addObject($object, 'obj1');
        
        $this->assertTrue( $environment->isCoordinateUsed( $object->getCoordinate() ) );
    }
    
    
}