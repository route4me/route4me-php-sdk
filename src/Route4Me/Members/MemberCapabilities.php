<?php

namespace Route4Me\Members;

/*
 * Member capabilities data structure
 */
class MemberCapabilities extends \Route4Me\Common
{
    /*
     * Array of the avoidance zone IDs.
     */
    public $avoid = [];

    /*
     * Road avoid options: "Highways", "Tolls", "highways,tolls".
     */
    public $avoid_roads = [];

    /*
     * Restriction options.
     */
    public $features = [];

    /*
     * Travel modes: "Highways", "Tolls", "highways,tolls".
     */
    public $travelModes = [];

    /*
     * Navigate options
     */
    public $navigateBy = [];

    /*
     * Array of the license modules
     */
    public $LicensedModules = [];

    /*
     * If true, the member subscription is commercial.
     */
    public $commercial;

    public static function fromArray(array $params)
    {
        $memberCapabilities = new self();

        foreach ($params as $key => $value) {
            if (property_exists($memberCapabilities, $key)) {
                $memberCapabilities->{$key} = $value;
            }
        }

        return $memberCapabilities;
    }
}
