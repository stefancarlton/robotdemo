<?php

namespace robotdemo\Models\Instructions;

use robotdemo\Models\Instructions\InstructionsAbstract;
use robotdemo\Interfaces\InstructionInterface;
use robotdemo\Exceptions\InstructionException;
use robotdemo\Exceptions\ObjectNotPlacedException;

use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Interfaces\EnvironmentInterface;

class Report extends InstructionAbstract implements InstructionInterface
{
    /**
     * 
     * @param \robotdemo\Interfaces\ObjectInterface $object
     * @param \robotdemo\Interfaces\EnvironmentInterface $environment
     * @return string
     */
    public function action(ObjectInterface $object, EnvironmentInterface $environment) 
    {
        try
        {
           return parent::action($object, $environment);
        }
        catch (ObjectNotPlacedException $ex) 
        {
            return $ex->getMessage();
        }
    }
    
    /**
     * 
     * @param \robotdemo\Interfaces\ObjectInterface $object
     * @param \robotdemo\Interfaces\EnvironmentInterface $environment
     * @return string
     */
    public function actionInstruction( ObjectInterface $object, EnvironmentInterface $environment )
    {
        return $object->getCoordinate()->x.' '.$object->getCoordinate()->y.' '.$object->getHorizontalDirection();
    }
    
}
