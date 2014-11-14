<?php

namespace robotdemo\Models\Instructions;

use robotdemo\Models\Instructions\InstructionAbstract;

abstract class RotateAbstract extends InstructionAbstract
{

  private $ordered_horizontal_directions;

  /**
   * sets the ordered directions
   */
  public function __construct()
  {
    $this->ordered_horizontal_directions = array(static::NORTH, static::EAST, static::SOUTH, static::WEST);
  }

  /**
   * 
   * @param string $direction
   * @return string
   */
  protected function previousHorizontalDirection($direction)
  {
    $index = array_search( $direction, $this->ordered_horizontal_directions );
    if (0 == $index) {
      $index = sizeof( $this->ordered_horizontal_directions );
    }

    return $this->ordered_horizontal_directions[$index - 1];
  }

  /**
   * 
   * @param string $direction
   * @return string
   */
  protected function nextHorizontalDirection($direction)
  {
    $index = array_search( $direction, $this->ordered_horizontal_directions );

    if ($index == sizeof( $this->ordered_horizontal_directions ) - 1) {
      $index = -1;
    }

    return $this->ordered_horizontal_directions[$index + 1];
  }

}
