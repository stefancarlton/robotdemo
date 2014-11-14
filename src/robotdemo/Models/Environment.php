<?php

namespace robotdemo\Models;

use robotdemo\Interfaces\ArenaInterface;
use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Interfaces\EnvironmentInterface;
use robotdemo\Interfaces\InstructionInterface;
use robotdemo\Interfaces\CoordinateInterface;
use robotdemo\Exceptions\OutOfBoundsException;
use robotdemo\Exceptions\ObjectAlreadyAddedException;
use robotdemo\Exceptions\ObjectDoesNotExistException;
use robotdemo\Models\Object;
use robotdemo\Models\Instructions\Place;

class Environment implements EnvironmentInterface
{

  /**
   *
   * @var array
   */
  protected $objects = array();

  /**
   *
   * @var \robotdemo\Models\Arena
   */
  protected $arena;

  /**
   * creates an environment, complete with arena and object
   * 
   * @param int $length
   * @param int $height
   * @return \static
   */
  public static function create($length = 5, $height = 5)
  {
    $arena = new Arena( Coordinate::create( 0, 0 ), Coordinate::create( $length, $height ) );

    $environment = new static( $arena );
    $environment->addObject( new Object() );

    return $environment;
  }

  /**
   * @param \robotdemo\Interfaces\ArenaInterface $arena
   */
  public function __construct(ArenaInterface $arena)
  {
    $this->setArena( $arena );
  }

  /**
   * 
   * @param \robotdemo\Interfaces\ArenaInterface $arena
   * @return \robotdemo\Models\Environment
   */
  public function setArena(ArenaInterface $arena)
  {
    $this->arena = $arena;
    return $this;
  }

  /**
   * 
   * @return \robotdemo\Interfaces\ArenaInterface
   */
  public function getArena()
  {
    return $this->arena;
  }

  /**
   * 
   * @param string $object_key
   * @return mixed boolean | \robotdemo\Interfaces\ObjectInterface
   */
  public function getObject($object_key = 'obj1')
  {
    if ($this->hasObject( $object_key )) {
      return $this->objects[$object_key];
    }
    return false;
  }

  /**
   * 
   * @param string $object_key
   * @return boolean
   */
  public function hasObject($object_key = 'obj1')
  {
    return isset( $this->objects[$object_key] );
  }

  /**
   * 
   * @return array
   */
  public function getObjects()
  {
    return $this->objects;
  }

  /**
   * 
   * @param \robotdemo\Interfaces\CoordinateInterface $coordinate
   * @return boolean
   */
  public function isCoordinateUsed(CoordinateInterface $coordinate)
  {
    foreach ($this->getObjects() as $obj) {
      if ($obj->hasCoordinate() && $obj->getCoordinate()->isEqual( $coordinate )) {
        return true;
      }
    }

    return false;
  }

  /**
   * 
   * @param \robotdemo\Interfaces\ObjectInterface $object
   * @param string $object_key
   * @throws \robotdemo\Exceptions\OutOfBoundsException
   * @throws \robotdemo\Exceptions\OjectAlreadyAddedException
   */
  public function addObject(ObjectInterface $object, $object_key = 'obj1')
  {
    if ($this->hasObject( $object_key )) {
      throw new ObjectAlreadyAddedException();
    }

    $this->objects[$object_key] = $object;
  }

  /**
   * 
   * @param \robotdemo\Interfaces\InstructionInterface $instruction
   * @param string $object_key
   * @throws \robotdemo\Exceptions\ObjectDoesNotExistException
   */
  public function issueInstruction(InstructionInterface $instruction, $object_key = 'obj1')
  {
    if (!$this->hasObject( $object_key )) {
      throw new ObjectDoesNotExistException();
    }

    return $instruction->action( $this->getObject( $object_key ), $this );
  }

}
