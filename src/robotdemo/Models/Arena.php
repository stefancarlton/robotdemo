<?php

namespace robotdemo\Models;

use robotdemo\Interfaces\ArenaInterface;
use robotdemo\Interfaces\CoordinateInterface;

class Arena implements ArenaInterface
{

  /**
   * @var \robotdemo\Interfaces\CoordinateInterface 
   */
  protected $bottom_left;

  /**
   * @var \robotdemo\Interfaces\CoordinateInterface 
   */
  protected $top_right;

  /**
   * 
   * @param \robotdemo\Interfaces\CoordinateInterface $bottom_left
   * @param \robotdemo\Interfaces\CoordinateInterface $top_right
   */
  public function __construct(CoordinateInterface $bottom_left, CoordinateInterface $top_right)
  {
    $this->bottom_left = $bottom_left;
    $this->top_right = $top_right;
  }

  /**
   * 
   * @return \robotdemo\Interfaces\CoordinateInterface
   */
  public function getBottomLeft()
  {
    return $this->bottom_left;
  }

  /**
   * 
   * @return \robotdemo\Interfaces\CoordinateInterface
   */
  public function getTopRight()
  {
    return $this->top_right;
  }

  /**
   * @param \robotdemo\Interfaces\CoordinateInterface $coordinate
   * @return boolean
   */
  public function isWithinBounds(CoordinateInterface $coordinate)
  {
    if (!$coordinate->isGreaterEqual( $this->bottom_left )) {
      return false;
    }

    if (!$coordinate->isLessEqual( $this->top_right )) {
      return false;
    }

    return true;
  }

}
