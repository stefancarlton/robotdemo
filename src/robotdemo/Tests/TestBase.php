<?php

namespace robotdemo\Tests;

use robotdemo\Models\Environment;
use robotdemo\Models\Object;
use robotdemo\Models\Arena;
use robotdemo\Models\Coordinate;
use robotdemo\Models\Instructions\Place;
use robotdemo\Models\Instructions\Left;
use robotdemo\Models\Instructions\Right;
use robotdemo\Models\Instructions\Move;

class TestBase extends \PHPUnit_Framework_TestCase
{

  protected $arena_length = 5;
  protected $arena_width = 5;

  /**
   * returns fully formed coordinate object from supplied coordinates
   * 
   * @param int $x
   * @param int $y
   * @return \robotdemo\Models\Coordinate
   */
  protected function getCoordinate($x, $y)
  {
    return Coordinate::create( $x, $y );
  }

  /**
   * Returns a default arena of size denoted by variables
   * 
   * @return \robotdemo\Models\Arena
   */
  protected function getArena()
  {
    $bottom_left = Coordinate::create( 0, 0 );
    $top_right = Coordinate::create( $this->arena_length, $this->arena_width );

    return new Arena( $bottom_left, $top_right );
  }

  /**
   * returns a blank object
   * 
   * @return \robotdemo\Models\Object
   */
  protected function getObject()
  {
    return new Object();
  }

  /**
   * returns a default environment with arena
   * 
   * @return \robotdemo\Models\Environment
   */
  protected function getEnvironment()
  {
    $arena = $this->getArena();

    return new Environment( $arena );
  }

  /**
   * returns a valid place instruction
   * 
   * @return \robotdemo\Models\Instructions\Place
   */
  protected function getPlaceInstruction()
  {
    return new Place( $this->getCoordinate( 1, 1 ), 'NORTH' );
  }

  /**
   * returns left instruction
   * 
   * @return \robotdemo\Models\Instructions\Left
   */
  protected function getLeftInstruction()
  {
    return new Left();
  }

  /**
   * returns right instruction
   * 
   * @return \robotdemo\Models\Instructions\Right
   */
  protected function getRightInstruction()
  {
    return new Right();
  }

  /**
   * returns move instruction
   * 
   * @return \robotdemo\Models\Instructions\Move
   */
  protected function getMoveInstruction()
  {
    return new Move();
  }

}
