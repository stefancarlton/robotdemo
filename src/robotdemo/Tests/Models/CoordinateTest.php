<?php

namespace robotdemo\Tests\Models;

use robotdemo\Models\Coordinate;
use robotdemo\Tests\TestBase;

class CoordinateTest extends TestBase
{

  /**
   * tests that the create function returns a Coordinate with the specified
   * coordinates
   */
  public function testCreate()
  {
    $x = 0;
    $y = 1;

    $coord = $this->getCoordinate( $x, $y );

    $this->isInstanceOf( '\robotdemo\Models\Coordinate', $coord );
    $this->assertEquals( $x, $coord->x );
    $this->assertEquals( $y, $coord->y );
  }

  /**
   * 
   * @param \robotdemo\Models\Coordinate $coord1
   * @param \robotdemo\Models\Coordinate $coord2
   * @param boolean $equal
   * @depends testCreate
   * @dataProvider provider_isEqual
   */
  public function testIsEqual(Coordinate $coord1, Coordinate $coord2, $equal)
  {
    $this->assertEquals( $equal, $coord1->isEqual( $coord2 ) );
  }

  /**
   * 
   * @return array
   */
  public function provider_isEqual()
  {
    $arr = array();

    $test = new \robotdemo\Models\Coordinate();
    $arr[] = array($this->getCoordinate( 0, 0 ), $this->getCoordinate( 0, 0 ), true);
    $arr[] = array($this->getCoordinate( 5, 5 ), $this->getCoordinate( 5, 5 ), true);
    $arr[] = array($this->getCoordinate( 1, 0 ), $this->getCoordinate( 0, 0 ), false);
    $arr[] = array($this->getCoordinate( 0, 1 ), $this->getCoordinate( 0, 0 ), false);
    $arr[] = array($this->getCoordinate( 0, 0 ), $this->getCoordinate( 1, 0 ), false);
    $arr[] = array($this->getCoordinate( 0, 0 ), $this->getCoordinate( 0, 1 ), false);

    return $arr;
  }

  /**
   * 
   * @param \robotdemo\Models\Coordinate $coord1
   * @param \robotdemo\Models\Coordinate $coord2
   * @param boolean $equal
   * @depends testCreate
   * @dataProvider provider_isGreaterEqual
   */
  public function testIsGreaterEqual(Coordinate $coord1, Coordinate $coord2, $equal)
  {
    $this->assertEquals( $equal, $coord2->isGreaterEqual( $coord1 ) );
  }

  /**
   * @return array
   */
  public function provider_isGreaterEqual()
  {
    $arr = array();

    $test = new \robotdemo\Models\Coordinate();
    $arr[] = array($this->getCoordinate( 0, 0 ), $this->getCoordinate( 0, 0 ), true);
    $arr[] = array($this->getCoordinate( 5, 5 ), $this->getCoordinate( 5, 5 ), true);
    $arr[] = array($this->getCoordinate( 0, 0 ), $this->getCoordinate( 1, 0 ), true);
    $arr[] = array($this->getCoordinate( 0, 0 ), $this->getCoordinate( 1, 1 ), true);

    $arr[] = array($this->getCoordinate( 5, 0 ), $this->getCoordinate( 1, 1 ), false);
    $arr[] = array($this->getCoordinate( 0, 5 ), $this->getCoordinate( 1, 1 ), false);
    $arr[] = array($this->getCoordinate( 5, 5 ), $this->getCoordinate( 1, 1 ), false);

    return $arr;
  }

  /**
   * 
   * @param \robotdemo\Models\Coordinate $coord1
   * @param \robotdemo\Models\Coordinate $coord2
   * @param boolean $equal
   * @depends testCreate
   * @dataProvider provider_isLessEqual
   */
  public function testIsLessEqual(Coordinate $coord1, Coordinate $coord2, $equal)
  {
    $this->assertEquals( $equal, $coord2->isLessEqual( $coord1 ) );
  }

  /**
   * 
   * @return array
   */
  public function provider_isLessEqual()
  {
    $arr = array();

    $test = new \robotdemo\Models\Coordinate();
    $arr[] = array($this->getCoordinate( 0, 0 ), $this->getCoordinate( 0, 0 ), true);
    $arr[] = array($this->getCoordinate( 5, 5 ), $this->getCoordinate( 5, 5 ), true);
    $arr[] = array($this->getCoordinate( 1, 0 ), $this->getCoordinate( 0, 0 ), true);
    $arr[] = array($this->getCoordinate( 1, 1 ), $this->getCoordinate( 0, 0 ), true);

    $arr[] = array($this->getCoordinate( 1, 1 ), $this->getCoordinate( 5, 5 ), false);
    $arr[] = array($this->getCoordinate( 1, 1 ), $this->getCoordinate( 5, 1 ), false);
    $arr[] = array($this->getCoordinate( 1, 1 ), $this->getCoordinate( 1, 5 ), false);

    return $arr;
  }

}
