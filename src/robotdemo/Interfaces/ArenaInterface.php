<?php

namespace robotdemo\Interfaces;

use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Interfaces\CoordinateInterface;
use robotdemo\Models\Instructions\Place;

Interface ArenaInterface 
{
    /**
     * @param \robotdemo\Interfaces\CoordinateInterface $bottom_left
     * @param \robotdemo\Interfaces\CoordinateInterface $top_right
     */
	public function __construct(CoordinateInterface $bottom_left, CoordinateInterface $top_right);

    
    /**
     * Checks that supplied co-ordinates are within bounds
     * 
     * @param \robotdemo\Interfaces\CoordinateInterface $coordinate
     * @return bool
     */
    public function isWithinBounds(CoordinateInterface $coordinate);
    

	
}