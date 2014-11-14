<?php

namespace robotdemo\Models\Instructions;

use robotdemo\Interfaces\EnvironmentInterface;
use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Exceptions\ObjectNotPlacedException;

abstract class InstructionAbstract
{

  /**
   * @TODO - these need to moved to a central location
   */
  const NORTH = 'NORTH';
  const SOUTH = 'SOUTH';
  const WEST = 'WEST';
  const EAST = 'EAST';

  /**
   * implementation of an instruction
   * 
   * @param \robotdemo\Interfaces\ObjectInterface $object
   * @param \robotdemo\Interfaces\EnvironmentInterface $environment
   * @return void
   */
  abstract function actionInstruction(ObjectInterface $object, EnvironmentInterface $environment);

  /**
   * 
   * @param \robotdemo\Interfaces\ObjectInterface $object
   * @return boolean
   */
  public function isInstructable(ObjectInterface $object)
  {
    return $object->hasComponents();
  }

  /**
   * 
   * @param \robotdemo\Interfaces\ObjectInterface $object
   * @param \robotdemo\Interfaces\EnvironmentInterface $environment
   * @return mixed
   * @throws ObjectNotPlacedException
   */
  public function action(ObjectInterface $object, EnvironmentInterface $environment)
  {
    if (!$this->isInstructable( $object )) {
      throw new ObjectNotPlacedException();
    }

    return $this->actionInstruction( $object, $environment );
  }

}
