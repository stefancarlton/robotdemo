<?php

namespace robotdemo\Interfaces;

use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Interfaces\ArenaInterface;
use robotdemo\Interfaces\InstructionInterface;
use robotdemo\Interfaces\CoordinateInterface;

use robotdemo\Models\Instructions\Place;

interface EnvironmentInterface
{
    /**
     * @param \robotdemo\Interfaces\ArenaInterface $arena
     * @return \robotdemo\Interfaces\EnvironmentInterface
     */
    public function setArena(ArenaInterface $arena);
    
    /**
     * @return robotdemo\Interfaces\ArenaInterface
     */
    public function getArena();
    
    /**
     * @param \robotdemo\Interfaces\ObjectInterface $object
     * @param string $object_key
     */
    public function addObject(ObjectInterface $object, $object_key = 'obj1');
    
    /**
     * @param \robotdemo\Interfaces\CoordinateInterface
     */
    public function isCoordinateUsed(CoordinateInterface $coordinate);
    
    /**
     * @param \robotdemo\Interfaces\Instruction
     * @param string $object_key
     */
    public function issueInstruction(InstructionInterface $instruction, $object_key = 'obj1');
}

