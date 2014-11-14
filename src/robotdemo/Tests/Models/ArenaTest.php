<?php

namespace robotdemo\Tests\Models;

use robotdemo\Models\Coordinate;
use robotdemo\Tests\TestBase;

class ArenaTest extends TestBase
{

  /**
   * tests that the boolean has function return correct results
   * and that the hasComponents reacts appropriately
   * 
   * @param \robotdemo\Models\Coordinate
   * @param boolean $equals
   * @dataProvider provider_isWithinBounds
   */
  public function testIsWithinBounds(Coordinate $coordinate, $equals)
  {
    $arena = $this->getArena();

    $this->assertEquals( $equals, $arena->isWithinBounds( $coordinate ) );
  }

  /**
   * tests that the boolean has function return correct results
   * and that the hasComponents reacts appropriately
   * 
   * @return array
   */
  public function provider_isWithinBounds()
  {
    $arr = array();
    $arr[] = array($this->getCoordinate( 0, 0 ), true);
    $arr[] = array($this->getCoordinate( 1, 1 ), true);
    $arr[] = array($this->getCoordinate( 5, 5 ), true);

    $arr[] = array($this->getCoordinate( -1, 0 ), false);
    $arr[] = array($this->getCoordinate( 0, -1 ), false);
    $arr[] = array($this->getCoordinate( -1, -1 ), false);

    return $arr;
  }

}
