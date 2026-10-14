<?php

namespace Route4Me\V5\Addresses;

/**
 * Class AddressCustomNote.
 */
class AddressCustomNote extends \Route4Me\Common
{
    /** A unique ID (40 chars) of a custom note entry.
     * @var string
     */
    public $note_custom_entry_id;

    /** The custom note ID.
     * @var string
     */
    public $note_id;

    /**  The custom note type ID.
     * @var string
     */
    public $note_custom_type_id;

    /** The custom note value.
     * @var string
     */
    public $note_custom_value;

    /** The custom note type.
     * @var string
     */
    public $note_custom_type;
}
