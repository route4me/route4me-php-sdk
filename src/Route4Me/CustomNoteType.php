<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;

/*
 * Data structure of the custom note type.
 */
class CustomNoteType extends Common
{
    /*
     * Note custom entry ID
     */
    public $note_custom_entry_id;

    /*
     * Note ID
     */
    public $note_id;

    /*
     * Note custom type ID
     */
    public $note_custom_type_id;

    /*
     * The value of a note custom type
     */
    public $note_custom_value;

    /*
     * Note custom type
     */
    public $note_custom_type;

    public static function fromArray(array $params)
    {
        $customNoteType = new self();

        foreach ($params as $key => $value) {
            if (property_exists($customNoteType, $key)) {
                $customNoteType->{$key} = $value;
            } else {
                throw new BadParam("Correct parameter must be provided. Wrong Parameter: $key");
            }
        }

        return $customNoteType;
    }
}