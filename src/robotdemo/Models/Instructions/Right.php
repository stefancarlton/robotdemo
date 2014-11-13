<?php

namespace robotdemo\Models\Instructions;

use robotdemo\Interfaces\InstructionInterface;
use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Interfaces\EnvironmentInterface;

use robotdemo\Models\Instructions\RotateAbstract;

class Right extends RotateAbstract implements InstructionInterface
{
	/**
	 * 
	 * @param \robotdemo\Interfaces\ObjectInterface $object
	 * @param \robotdemo\Interfaces\EnvironmentInterface $environment
	 */
    public function actionInstruction(ObjectInterface $object, EnvironmentInterface $environment)
    {
        $object->setHorizontalDirection( $this->nextHorizontalDirection( $object->getHorizontalDirection() ) );
    }
}

