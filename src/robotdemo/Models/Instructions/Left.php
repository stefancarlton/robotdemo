<?php

namespace robotdemo\Models\Instructions;

use robotdemo\Interfaces\InstructionInterface;
use robotdemo\Models\Instructions\RotateAbstract;
use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Interfaces\EnvironmentInterface;

class Left extends RotateAbstract implements InstructionInterface
{

  /**
   * @param \robotdemo\Interfaces\ObjectInterface $object
   * @param \robotdemo\Interfaces\EnvironmentInterface $environment
   */
  public function actionInstruction(ObjectInterface $object, EnvironmentInterface $environment)
  {
    $object->setHorizontalDirection( $this->previousHorizontalDirection( $object->getHorizontalDirection() ) );
  }

}
