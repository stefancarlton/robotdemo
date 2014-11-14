<?php

namespace robotdemo\Models;

use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Interfaces\CoordinateInterface;

class Object implements ObjectInterface
{

  /**
   * @var mixed boolean | \robotdemo\Interfaces\CoordinateInterface
   */
  protected $coordinate = false;

  /**
   *
   * @var mixed boolean | string 
   */
  protected $horizontal_direction = false;

  /**
   * 
   * @return boolean
   */
  public function hasComponents()
  {
    return $this->hasCoordinate() && $this->hasHorizontalDirection();
  }

  /**
   * 
   * @param \robotdemo\Interfaces\CoordinateInterface $coord
   * @return \robotdemo\Models\Object
   */
  public function setCoordinate(CoordinateInterface $coord)
  {
    $this->coordinate = $coord;
    return $this;
  }

  /**
   * 
   * @return \robotdemo\Interfaces\CoordinateInterface
   */
  public function getCoordinate()
  {
    return $this->coordinate;
  }

  /**
   * 
   * @return boolean
   */
  public function hasCoordinate()
  {
    return false !== $this->coordinate;
  }

  /**
   * 
   * @param string $direction
   * @return \robotdemo\Models\Object
   */
  public function setHorizontalDirection($direction)
  {
    $this->horizontal_direction = $direction;
    return $this;
  }

  /**
   * 
   * @return string
   */
  public function getHorizontalDirection()
  {
    return $this->horizontal_direction;
  }

  /**
   * 
   * @return boolean
   */
  public function hasHorizontalDirection()
  {
    return false !== $this->horizontal_direction;
  }

}
