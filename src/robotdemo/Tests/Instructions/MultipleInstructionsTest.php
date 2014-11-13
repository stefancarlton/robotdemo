<?php

namespace robotdemo\Tests\Instructions;

use robotdemo\Models\Coordinate;
use robotdemo\Models\Instructions\Place;
use robotdemo\Models\Instructions\Move;
use robotdemo\Models\Instructions\Left;
use robotdemo\Models\Instructions\Right;
use robotdemo\Models\Instructions\Report;

use robotdemo\Exceptions\ObjectNotPlacedException;
use robotdemo\Exceptions\OutOfBoundsException;

use robotdemo\Tests\TestBase;

class MultipleInstructionsTest extends TestBase
{
    
    /**
     * 
     * @param array $instructions
     * @param \robotdemo\Models\Coordinate $coordinate
     * @param string $direction
     * @dataProvider provider_instructions
     */
    public function testMultipleMoves(array $instructions, Coordinate $coordinate, $direction)
    {
        $environment = $this->getEnvironment();
        $environment->addObject($this->getObject(), 'obj1');
        
        foreach($instructions as $instruction)
        {
            try
            {
                $environment->issueInstruction($instruction, 'obj1');
            } 
            Catch(ObjectNotPlacedException $e)
            {
                //do nothing - system is just reporting the object hasn't been placed
            }
            Catch(OutOfBoundsException $e)
            {
                //do nothing - system is just reporting the object would move of the arena
                //or conflict with other object
            }
        }
        
        $this->assertEquals($direction, $environment->getObject('obj1')->getHorizontalDirection());
        $this->assertTrue($environment->getObject('obj1')->getCoordinate()->isEqual($coordinate) );
    }
    
    /**
     * 
     * @return array
     */
    public function provider_instructions()
    {
        $arr = array();
        
        $arr[] = $this->getRunOne();
        $arr[] = $this->getRunTwo();
        $arr[] = $this->getRunThree();
        $arr[] = $this->getRunFour();
		$arr[] = $this->getRunFive();
		$arr[] = $this->getRunSix();
        
        return $arr;
    }
    
    /**
     * Test example1
	 * 
     * @return array
     */
    protected function getRunOne()
    {
        $instructions = array();
        $instructions[] = new Place( $this->getCoordinate(0, 0), 'NORTH' );
        $instructions[] = new Move();
        
        return array( $instructions, $this->getCoordinate(0, 1), 'NORTH' );
    }
    
    /**
     * Test example2
	 * 
     * @return array
     */
    protected function getRunTwo()
    {
        $instructions = array();
        $instructions[] = new Place( $this->getCoordinate(0, 0), 'NORTH' );
        $instructions[] = new Left();
                
        return array($instructions, $this->getCoordinate(0, 0), 'WEST');
    }
    
    /**
     * Test example3
     * @return array
     */
    protected function getRunThree()
    {
        $instructions = array();
        $instructions[] = new Place( $this->getCoordinate(1, 2), 'EAST' );
        $instructions[] = new Move();
        $instructions[] = new Move();
        $instructions[] = new Left();
        $instructions[] = new Move();
        
        return array($instructions, $this->getCoordinate(3, 3), 'NORTH');
    }
    
    /**
     * Tests that instructions before place are ignored
	 * 
     * @return array
     */
    protected function getRunFour()
    {
        $instructions = array();
        $instructions[] = new Move();
        $instructions[] = new Left();
        $instructions[] = new Place( $this->getCoordinate(1, 2), 'EAST' );
        $instructions[] = new Move();
        $instructions[] = new Move();
        $instructions[] = new Left();
        $instructions[] = new Move();
        
        return array($instructions, $this->getCoordinate(3, 3), 'NORTH');
    }
	
    /**
     * Tests that instructions that would make the object fall to it's doom are ignored
	 * 
     * @return array
     */
    protected function getRunFive()
    {
        $instructions = array();
        $instructions[] = new Place( $this->getCoordinate(5, 5), 'EAST' );
        $instructions[] = new Move();
        
        return array($instructions, $this->getCoordinate(5, 5), 'EAST');
    }
	
    /**
     * Tests that an invalid Place is ignored
	 * 
     * @return array
     */
    protected function getRunSix()
    {
        $instructions = array();
        $instructions[] = new Place( $this->getCoordinate(-1, -1), 'EAST' );
        $instructions[] = new Move();
        $instructions[] = new Move();
        
		$instructions[] = new Place( $this->getCoordinate(1, 1), 'EAST' );
		$instructions[] = new Move();
		$instructions[] = new Left();
        $instructions[] = new Move();
        
        return array($instructions, $this->getCoordinate(2, 2), 'NORTH');
    }
}

