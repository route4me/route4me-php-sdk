<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;

/**
 * Data structure of the response from the process of adding a note to a route destination.
 */
class AddressNoteResponse extends Common
{
    public $status;
    public $note_id;
    public $upload_id;
    public $note;

    public static function fromArray(array $params)
    {
        $addressNoteResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($addressNoteResponse, $key)) {
                $addressNoteResponse->{$key} = $value;
            } else {
                throw new BadParam("Correct parameter must be provided. Wrong Parameter: $key");
            }
        }

        return $addressNoteResponse;
    }
}