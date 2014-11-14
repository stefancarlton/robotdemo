<?php

namespace robotdemo\Interfaces;

use robotdemo\Interfaces\CoordinateInterface;

interface ObjectInterface
{

  /**
   * returns boolean if all constituent components (e.g. direction & coordinate)
   * are set
   * 
   * @return boolean
   */
  public function hasComponents();

  /**
   * sets the co-ordinate
   * 
   * @param \robotdemo\Interface\CoordinateInterface $coordinate
   * @return \robotdemo\Interfaces\ObjectInterface
   */
  public function setCoordinate(CoordinateInterface $coordinate);

  /**
   * returns the current coordinate
   * 
   * @return robotdemo\Models\Coordinate
   */
  public function getCoordinate();

  /**
   * returns if a coordinate has been set
   * 
   * @return boolean
   */
  public function hasCoordinate();

  /**
   * sets the current direction
   * 
   * @param string $direction
   * @return \robotdemo\Interfaces\ObjectInterface
   */
  public function setHorizontalDirection($direction);

  /**
   * returns the current direction
   * 
   * @return mixed false | string
   */
  public function getHorizontalDirection();

  /**
   * returns if a horizontal direction has been set
   * 
   * @return boolean
   */
  public function hasHorizontalDirection();
}
