<?php

namespace robotdemo\Tests\Models\Instructions;

use robotdemo\Models\Instructions\Place;
use robotdemo\Models\Instructions\Move;
use robotdemo\Models\Instructions\Left;
use robotdemo\Models\Instructions\Right;
use robotdemo\Models\Instructions\Report;
use robotdemo\Models\Instructions\Translator;
use robotdemo\Models\Coordinate;

use robotdemo\Tests\TestBase;

class TranslatorTest extends TestBase 
{
    
    /**
     * tests that the line produces model of correct instance
	 * 
     * @param string $line
     * @param string $expected_instance
     * @dataProvider provider_instructions
     */
    public function testconvertString($line, $expected_instance)
    {
        $translator = new Translator();
        
        $this->isInstanceOf( $expected_instance, $translator->convertString($line) );
    }
    
	
	/**
	 * tests that a place command is converted correctly
	 */
    public function testConvertPlace()
    {
        $translator = new Translator();
        
        $place = $translator->convertString( 'PLACE 0,0,NORTH' );
        
        $this->assertTrue( $place->getCoordinate()->isEqual( $this->getCoordinate(0, 0) ) );
        $this->assertEquals( 'NORTH', $place->f );
    }
    
	
	/**
	 * returns command and expected class
	 * 
	 * @return array
	 */
    public function provider_instructions()
    {
        $arr = array();
        
        $arr[] = array('PLACE 0,0,NORTH', 'robotdemo/Models/Instructions/Place');
        $arr[] = array('LEFT', 'robotdemo/Models/Instructions/Left');
        $arr[] = array('RIGHT', 'robotdemo/Models/Instructions/Right');
        $arr[] = array('MOVE', 'robotdemo/Models/Instructions/Move');
        $arr[] = array('Report', 'robotdemo/Models/Instructions/Report');

        return $arr;
    }
    
}

