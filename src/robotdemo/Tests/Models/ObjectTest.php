<?php

namespace robotdemo\Tests\Models;

use robotdemo\Models\Object;
use robotdemo\Tests\TestBase;

class ObjectTest extends TestBase
{

  /**
   * tests that the boolean has function return correct results
   * and that the hasComponents reacts appropriately
   */
  public function testHasCoordinate()
  {
    $object = $this->getObject();

    $this->assertFalse( $object->hasCoordinate() );

    $object->setCoordinate( $this->getCoordinate( 0, 1 ) );

    $this->assertTrue( $object->hasCoordinate() );
    $this->assertFalse( $object->hasComponents(), 'Components should be false' );
  }

  /**
   * tests that the boolean has function return correct results
   * and that the hasComponents reacts appropriately
   */
  public function testHasHorizontalDirection()
  {
    $object = new Object();
    $this->assertFalse( $object->hasHorizontalDirection() );

    $object->setHorizontalDirection( 'NORTH' );
    $this->assertTrue( $object->hasHorizontalDirection() );
    $this->assertFalse( $object->hasComponents(), 'Components should be false' );
  }

  /**
   * checks that the has components returns true when the object is completely loaded
   * 
   * @depends testHasHorizontalDirection
   * @depends testHasCoordinate
   */
  public function testHasComponents()
  {
    $object = new Object();

    //check that it's false to start witl
    $this->assertFalse( $object->hasComponents() );

    //set a direction and a coordinate
    $object->setHorizontalDirection( 'NORTH' );
    $object->setCoordinate( $this->getCoordinate( 0, 1 ) );

    $this->assertTrue( $object->hasComponents() );
  }

}
