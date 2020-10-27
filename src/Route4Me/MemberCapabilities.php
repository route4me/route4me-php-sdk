<?php

namespace Route4Me;

/*
 * Member capabilities data structure
 */
class MemberCapabilities extends Common
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
}
