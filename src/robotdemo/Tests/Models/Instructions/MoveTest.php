<?php

namespace robotdemo\Tests\Models\Instructions;

use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Models\Coordinate;
use robotdemo\Models\Instructions\Move;
use robotdemo\Tests\TestBase;

class MoveTest extends TestBase
{    
    /**
     * test that the action instruction for valid data works
     * 
     * @dataProvider provider_action
     */
    public function testActionInstruction(ObjectInterface $object, $starting_direction, Coordinate $coordinate)
    {
        $object->setHorizontalDirection($starting_direction);
        
        $environment = $this->getEnvironment();
        
        $this->getMoveInstruction()->actionInstruction($object, $environment);
        
        $this->assertTrue( $object->getCoordinate()->isEqual( $coordinate ) );
    }
    
    /**
     * tests that move rejects anything that will move out of the arena
     * 
     * @expectedException \robotdemo\Exceptions\OutOfBoundsException
     */
    public function testMoveOutOfBounds()
    {
        $environment = $this->getEnvironment();
        
        $object = $this->getObject();
        $object->setCoordinate( $this->getCoordinate(5, 5) );
        $object->setHorizontalDirection('NORTH');
        
        $this->getMoveInstruction()->actionInstruction($object, $environment);
    }
    
    /**
     * tests that move doesn't respect unknown directions
     * 
     * @expectedException \robotdemo\Exceptions\InstructionException
     */
    public function testUnknownDirection()
    {
        $environment = $this->getEnvironment();
        
        $object = $this->getObject();
        $object->setCoordinate( $this->getCoordinate(5, 5) );
        $object->setHorizontalDirection('NORTH-SOUTH');
        
        $this->getMoveInstruction()->actionInstruction($object, $environment);
    }
    
	/**
	 * tests that the move instuction can't be issued without the object first
	 * been placed
	 * 
	 * @expectedException \robotdemo\Exceptions\ObjectNotPlacedException
	 */
	public function testMoveBeforePlace()
	{
		$environment = $this->getEnvironment();
        
        $object = $this->getObject();
		
		$this->getMoveInstruction()->action($object, $environment);
	}
	
    /**
     * provides object, initial direction and end point for move tests
	 * 
     * @return array
     */
    public function provider_action()
    {
        $arr = array();
        
        $object = $this->getObject();
        $object->setCoordinate( $this->getCoordinate(3, 3) );
        
        $arr[] = array(clone $object, 'NORTH', $this->getCoordinate(3, 4));
        $arr[] = array(clone $object, 'WEST',  $this->getCoordinate(2, 3));
        $arr[] = array(clone $object, 'SOUTH', $this->getCoordinate(3, 2));
        $arr[] = array(clone $object, 'EAST',  $this->getCoordinate(4, 3));
        
        return $arr;
    }
}

