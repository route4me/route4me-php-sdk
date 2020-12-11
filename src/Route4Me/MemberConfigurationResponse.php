<?php

namespace Route4Me;

/*
 * Response structure for the member's configuration data request.
 */
class MemberConfigurationResponse extends Common
{
    /*
     * Configuration result
     */
    public $result;

    /*
     * How many configuration key -> data pairs affected
     */
    public $affected;

    /*
     *
     */
    public $data = [];



}