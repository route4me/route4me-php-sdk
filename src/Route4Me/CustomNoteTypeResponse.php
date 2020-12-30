<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;

class CustomNoteTypeResponse extends Common
{
    /*
     * Note custom type ID
     */
    public $note_custom_type_id;

    /*
     * Note custom type
     */
    public $note_custom_type;

    /*
     * ID of a root owner of the account
     */
    public $root_owner_member_id;

    /*
     * Values of the custom note type
     */
    public $note_custom_type_values=[];

    public static function fromArray(array $params)
    {
        $customNoteTypeResponse = new self();

        foreach ($params as $key => $value) {
            if (property_exists($customNoteTypeResponse, $key)) {
                $customNoteTypeResponse->{$key} = $value;
            } else {
                throw new BadParam("Correct parameter must be provided. Wrong Parameter: $key");
            }
        }

        return $customNoteTypeResponse;
    }
}