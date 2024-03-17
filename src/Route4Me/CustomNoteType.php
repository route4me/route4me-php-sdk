<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;

/*
 * Data structure of the custom note type.
 */
class CustomNoteType extends Common
{
    /**
     * Note custom entry ID
     * @var integer
     */
    public $note_custom_entry_id;

    /**
     * Note ID
     * @var integer
     */
    public $note_id;

    /**
     * Note custom type ID
     * @var integer
     */
    public $note_custom_type_id;

    /**
     * The value of a note custom type
     * @var string
     */
    public $note_custom_value;

    /**
     * Note custom type
     */
    public $note_custom_type;
}
