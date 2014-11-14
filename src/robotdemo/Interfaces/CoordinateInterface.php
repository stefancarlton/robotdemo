<?php

namespace robotdemo\Interfaces;

interface CoordinateInterface
{

  /**
   * returns if supplied coordinate equals current
   * 
   * @return boolean
   */
  public function isEqual(CoordinateInterface $coordinate);

  /**
   * returns if supplied coordinate is greater than current
   * 
   * @return boolean
   */
  public function isGreaterEqual(CoordinateInterface $coordinate);

  /**
   * returns if supplied coordinate is less than current
   * 
   * @return boolean
   */
  public function isLessEqual(CoordinateInterface $coordinate);
}
