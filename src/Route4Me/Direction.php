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

    public static function fromArray(array $params)
    {
        $thisParams = new self();

        foreach ($params as $key => $value) {
            if (property_exists($thisParams, $key)) {
                $thisParams->{$key} = $value;
            }
        }

        return $thisParams;
    }
}