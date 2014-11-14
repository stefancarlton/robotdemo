<?php

namespace robotdemo\Interfaces;

use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Interfaces\EnvironmentInterface;

interface InstructionInterface
{

  /**
   * @return boolean
   */
  public function isInstructable(ObjectInterface $object);

  /**
   * 
   * @param \robotdemo\Interfaces\ObjectInterface $object
   * @param \robotdemo\Interfaces\EnvironmentInterface $environment
   * @throws \robotdemo\Exceptions\InstructionException
   * @throws \robotdemo\Exceptions\ObjectNotPlacedException
   */
  public function action(ObjectInterface $object, EnvironmentInterface $environment);

  /**
   * @param \robotdemo\Interfaces\ObjectInterface $object
   * @param \robotdemo\Interfaces\EnvironmentInterface $environment
   * @throws \robotdemo\Exceptions\InstructionException
   */
  public function actionInstruction(ObjectInterface $object, EnvironmentInterface $environment);
}
