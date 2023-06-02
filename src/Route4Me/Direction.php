<?php


namespace Route4Me;

use Route4Me\Common as Common;

/**
 * Movement direction structure
 * @package Route4Me
 */
class Direction extends Common
{
    /**
     * Starting location of a direction
     * @var DirectionLocation
     */
    public $location = [];

    /**
     * The direction steps
     * @var DirectionStep[]
     */
    public $steps = [];
}
