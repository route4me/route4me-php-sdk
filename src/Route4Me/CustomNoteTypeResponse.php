<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;

class CustomNoteTypeResponse extends Common
{
    /**
     * Note custom type ID
     * @var integer
     */
    public $note_custom_type_id;

    /**
     * Note custom type
     * @var CustomNoteType
     */
    public $note_custom_type;

    /**
     * ID of a root owner of the account
     * @var integer
     */
    public $root_owner_member_id;

    /**
     * Values of the custom note type
     * @var array
     */
    public $note_custom_type_values=[];
}
