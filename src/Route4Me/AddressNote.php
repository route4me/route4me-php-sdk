<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;
use Route4Me\Exception\BadParam;

class AddressNote extends Common
{
    public $note_id;
    public $route_id;
    public $route_destination_id;
    public $upload_id;
    public $ts_added;
    public $lat;
    public $lng;
    public $activity_type;
    public $contents;
    public $upload_type;
    public $upload_url;
    public $upload_extension;
    public $device_type;
    public $custom_types;

    public function __construct()
    {

    }

    public static function fromArray(array $params)
    {
        $addressNote = new self();

        foreach ($params as $key => $value) {
            if (property_exists($addressNote, $key)) {
                $addressNote->{$key} = $value;
            } else {
                throw new BadParam("Correct parameter must be provided. Wrong Parameter: $key");
            }
        }

        return $addressNote;
    }
}