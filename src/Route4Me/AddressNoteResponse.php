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
}
