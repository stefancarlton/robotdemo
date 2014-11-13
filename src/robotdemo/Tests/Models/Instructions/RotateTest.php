<?php

namespace robotdemo\Tests\Models\Instructions;

use robotdemo\Interfaces\InstructionInterface;
use robotdemo\Tests\TestBase;

class RotateTest extends TestBase
{    
    /**
     * test that the action instruction for valid data works
     * 
     * @dataProvider provider_rotate
     */
    public function testActionInstruction(InstructionInterface $instruction, $previous_state, $next_state)
    {
        $object = $this->getObject();
        $object->setCoordinate( $this->getCoordinate(1,1) );
        $object->setHorizontalDirection($previous_state);
        
        $environment = $this->getEnvironment();
        
        $instruction->actionInstruction($object, $environment);
        
        $this->assertEquals( $next_state, $object->getHorizontalDirection() );
    }
    
	/**
	 * tests that the move instuction can't be issued without the object first
	 * been placed
	 * 
	 * @expectedException \robotdemo\Exceptions\ObjectNotPlacedException
	 * @dataProvider provider_beforePlace
	 */
	public function testBeforePlace(InstructionInterface $instruction)
	{
		$environment = $this->getEnvironment();
        
        $object = $this->getObject();
		
        $instruction->action($object, $environment);
	}
	
	
	/**
	 * Returns rotate instructions and expected output
	 * 
	 * @return array
	 */
    public function provider_rotate()
    {
        $arr = array();
        
        $left = $this->getLeftInstruction();
        $right = $this->getRightInstruction();
        
        $arr[] = array($left, 'NORTH', 'WEST');
        $arr[] = array($left, 'WEST', 'SOUTH');
        $arr[] = array($left, 'SOUTH', 'EAST');
        $arr[] = array($left, 'EAST', 'NORTH');
        
        $arr[] = array($right, 'NORTH', 'EAST');
        $arr[] = array($right, 'EAST', 'SOUTH');
        $arr[] = array($right, 'SOUTH', 'WEST');
        $arr[] = array($right, 'WEST', 'NORTH');
        
        return $arr;
    }
	
	
	/**
	 * Returns rotate instructions
	 * 
	 * @return array
	 */
	public function provider_beforePlace()
	{
		$arr = array();
		
		$arr[] = array( $this->getLeftInstruction() );
		$arr[] = array( $this->getRightInstruction() );
		
		return $arr;
	}
}

