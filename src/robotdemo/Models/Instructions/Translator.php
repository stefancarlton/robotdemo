<?php

namespace robotdemo\Models\Instructions;

use robotdemo\Models\Instructions\Place;
use robotdemo\Models\Instructions\Move;
use robotdemo\Models\Instructions\Left;
use robotdemo\Models\Instructions\Right;
use robotdemo\Models\Instructions\Report;
use robotdemo\Models\Coordinate;

class Translator
{
    //@TODO - move this somewhere better / replace with class checker
    private $valid_classes = array('Place', 'Move', 'Left', 'Right', 'Report');
    
	/**
	 * reads a file and converts the instructions to models
	 * 
	 * @param string $filename
	 * @return array
	 */
    public function translateFile($filename)
    {
        $instructions = array();
        
        if(file_exists($filename) )
        {
            $file = file($filename);
            foreach($file as $line)
            {
                $instruction = $this->convertString($line);

                if( false !== $instruction )
                {
                    $instructions[] = $instruction;
                }
            }
        }
        return $instructions;
    }
    
    /**
     * 
     * @param string $line
     * @return \robotdemo\Models\Instructions\instruction|\robotdemo\Models\Instructions\Place
     */
    public function convertString($line)
    {
        $line = trim($line);
        
        $instruction_array = explode(' ', $line);
        
        $instruction = ucfirst(strtolower($instruction_array[0]));

        if( in_array($instruction, $this->valid_classes) )
        {
			//this is hardcoded to ensure we only respect these classes. 
            switch($instruction)
            {
                case 'Place':
                    $params = explode(',', $instruction_array[1]);
                    if( 3 == sizeof($params) )
                    {
                        return new Place( Coordinate::create($params[0], $params[1]), $params[2] );
                    }
                    break;
                case 'Move':
                    return new Move();
                case 'Left':
                    return new Left();
                case 'Right':
                    return new Right();
                case 'Report':
                    return new Report();
                
            }
        }
        
        return false;
    }
}

