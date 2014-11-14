<?php

namespace robotdemo\Models\Instructions;

use robotdemo\Models\Instructions\InstructionAbstract;
use robotdemo\Interfaces\InstructionInterface;
use robotdemo\Exceptions\InstructionException;
use robotdemo\Interfaces\ObjectInterface;
use robotdemo\Interfaces\EnvironmentInterface;
use robotdemo\Exceptions\OutOfBoundsException;

class Move extends InstructionAbstract implements InstructionInterface
{

  /**
   * number of units to move
   * 
   * @var int
   */
  public $units;

  /**
   * 
   * @param int $units
   */
  public function __construct($units = 1)
  {
    $this->units = $units;
  }

  /**
   * 
   * @param \robotdemo\Interfaces\ArenaInterface $arena
   * @param \robotdemo\Interfaces\ObjectInterface $object
   * @throws OutOfBoundsException
   */
  public function actionInstruction(ObjectInterface $object, EnvironmentInterface $environment)
  {
    $coordinate = clone $object->getCoordinate();

    switch ($object->getHorizontalDirection()) {
      case static::NORTH:
        $coordinate->y += $this->units;
        break;
      case static::SOUTH:
        $coordinate->y -= $this->units;
        break;
      case static::EAST:
        $coordinate->x += $this->units;
        break;
      case static::WEST:
        $coordinate->x -= $this->units;
        break;
      default:
        throw new InstructionException( 'Unknown direction' );
    }

    // check the arena location
    if (!$environment->getArena()->isWithinBounds( $coordinate )) {
      throw new OutOfBoundsException();
    }

    // check the space is available
    if ($environment->isCoordinateUsed( $coordinate )) {
      throw new OutOfBoundsException();
    }

    $object->setCoordinate( $coordinate );
  }

}
