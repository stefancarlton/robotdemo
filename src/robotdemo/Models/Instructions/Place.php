<?php

namespace robotdemo\Models\Instructions;

use robotdemo\Interfaces\InstructionInterface;
use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Interfaces\EnvironmentInterface;
use robotdemo\Interfaces\CoordinateInterface;
use robotdemo\Exceptions\OutOfBoundsException;
use robotdemo\Exceptions\ObjectAlreadyPlacedException;
use robotdemo\Models\Instructions\InstructionAbstract;

class Place extends InstructionAbstract implements InstructionInterface
{

  /**
   * @var \robotdemo\Interfaces\CoordinateInterface 
   */
  public $coordinate;

  /**
   * @var string 
   */
  public $f;

  /**
   * 
   * @param robotdemo\Interfaces\CoordinateInterface $coordinate
   * @param string $f
   */
  public function __construct(CoordinateInterface $coordinate, $f)
  {
    $this->setCoordinate( $coordinate );
    $this->f = $f;
  }

  /**
   * 
   * @param \robotdemo\Interfaces\CoordinateInterface $coordinate
   * @return \robotdemo\Models\Instructions\Place
   */
  public function setCoordinate(CoordinateInterface $coordinate)
  {
    $this->coordinate = $coordinate;
    return $this;
  }

  /**
   * @return \robotdemo\Interfaces\CoordinateInterface
   */
  public function getCoordinate()
  {
    return $this->coordinate;
  }

  /**
   * Always be able to place an object
   * 
   * @param \robotdemo\Interfaces\ObjectInterface $object
   * @return boolean
   */
  public function isInstructable(ObjectInterface $object)
  {
    return true;
  }

  /**
   * 
   * @param \robotdemo\Interfaces\ObjectInterface $object
   * @param \robotdemo\Interfaces\EnvironmentInterface $environment
   * @throws \robotdemo\Exceptions\OutOfBoundsException
   * @throws \robotdemo\Exceptions\ObjectAlreadyPlacedException
   */
  public function actionInstruction(ObjectInterface $object, EnvironmentInterface $environment)
  {
    if ($object->hasComponents()) {
      throw new ObjectAlreadyPlacedException();
    }

    if (!$environment->getArena()->isWithinBounds( $this->getCoordinate() )) {
      throw new OutOfBoundsException();
    }

    // check the space is available
    if ($environment->isCoordinateUsed( $this->getCoordinate() )) {
      throw new OutOfBoundsException();
    }

    $object->setCoordinate( $this->getCoordinate() );
    $object->setHorizontalDirection( $this->f );
  }

}
