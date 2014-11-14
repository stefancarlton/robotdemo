<?php

namespace robotdemo\Tests\Models\Instructions;

use robotdemo\Tests\TestBase;

class PlaceTest extends TestBase
{

  /**
   * tests that the instructable function always returns true
   * An object can always recieve the 'place' instruction (although 
   * it might be set)
   */
  public function testIsInstructable()
  {
    $place = $this->getPlaceInstruction();

    $this->assertTrue( $place->isInstructable( $this->getObject() ) );
  }

  /**
   * test that the action instruction for valid data works
   */
  public function testActionInstruction()
  {
    $object = $this->getObject();
    $environment = $this->getEnvironment();
    $place = $this->getPlaceInstruction();

    $place->actionInstruction( $object, $environment );

    $this->assertTrue( $object->getCoordinate()->isEqual( $place->getCoordinate() ) );
  }

  /**
   * Tests that the object can't be placed outside of the arena
   * 
   * @expectedException \robotdemo\Exceptions\OutOfBoundsException
   */
  public function testActionInstructionOutOfBounds()
  {
    $object = $this->getObject();
    $environment = $this->getEnvironment();
    $place = $this->getPlaceInstruction();

    //get the bottom left corner and move it out by one unit
    $bottom_left = clone $environment->getArena()->getBottomLeft();
    $bottom_left->x -= 1;
    $bottom_left->y -= 1;

    //this forces the place instruction out of bounds
    $place->setCoordinate( $bottom_left );

    $place->actionInstruction( $object, $environment );
  }

  /**
   * tests that the object can't be placed on top of another (assuming more than one object
   * is in the arena)
   * 
   * @expectedException \robotdemo\Exceptions\OutOfBoundsException
   */
  public function testActionInstructionConflictOutOfBounds()
  {
    $object = $this->getObject();
    $environment = $this->getEnvironment();
    $place = $this->getPlaceInstruction();

    $object->setCoordinate( $this->getCoordinate( 1, 1 ) );
    $environment->addObject( $object, 'obj1' );

    $place->actionInstruction( $object, $environment );
  }

  /**
   * tests that an object can't be placed twice
   * 
   * @expectedException \robotdemo\Exceptions\ObjectAlreadyPlacedException
   */
  public function testAlreadyPlaced()
  {
    $object = $this->getObject();
    $environment = $this->getEnvironment();
    $place = $this->getPlaceInstruction();

    $place->actionInstruction( $object, $environment );

    //causes exception
    $place_2 = $this->getPlaceInstruction();
    ;
    $place_2->actionInstruction( $object, $environment );
  }

}
