<?php

namespace robotdemo\Models;

use robotdemo\Interfaces\CoordinateInterface;

class Coordinate implements CoordinateInterface
{
    /**
	 * @var int
	 */
    public $y;
    
    /**
	 * @var int
	 */
	public $x;
    
	/**
	 * 
	 * @param int $x
	 * @param int $y
	 * @return \static
	 */
    public static function create($x, $y)
    {
        $coord = new static();
        $coord->x = $x;
        $coord->y = $y;
        
        return $coord;
    }
    
	/**
	 * 
	 * @param \robotdemo\Interfaces\CoordinateInterface $coordinate
	 * @return boolean
	 */
    public function isEqual(CoordinateInterface $coordinate)
    {
        return $this->x == $coordinate->x && $this->y == $coordinate->y;
    }
    
	/**
	 * 
	 * @param \robotdemo\Interfaces\CoordinateInterface $coordinate
	 * @return boolean
	 */
    public function isGreaterEqual(CoordinateInterface $coordinate)
    {
        return ($this->x >= $coordinate->x) && ($this->y >= $coordinate->y);
    }
    
	/**
	 * 
	 * @param \robotdemo\Interfaces\CoordinateInterface $coordinate
	 * @return boolean
	 */
    public function isLessEqual(CoordinateInterface $coordinate)
    {
        return ($this->x <= $coordinate->x) && ($this->y <= $coordinate->y);
    }
}

