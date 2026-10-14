<?php

namespace Route4Me;

/*
 * Data structure of the custom note type.
 */
class CustomNoteType extends Common
{
    /**
     * Note custom entry ID.
     * @var int
     */
    public $note_custom_entry_id;

    /**
     * Note ID.
     * @var int
     */
    public $note_id;

    /**
     * Note custom type ID.
     * @var int
     */
    public $note_custom_type_id;

    /**
     * The value of a note custom type.
     * @var string
     */
    public $note_custom_value;

    /**
     * Note custom type.
     */
    public $note_custom_type;
}
