<?php


namespace Route4Me\V5\Addresses;

/**
 * Class AddressCustomNote
 * @package Route4Me\V5\Addresses
 * The class for the custom note of a route destination.
 */
class AddressCustomNote extends \Route4Me\Common
{
    /** A unique ID (40 chars) of a custom note entry.
     * @var string $note_custom_entry_id
     */
    public $note_custom_entry_id;

    /** The custom note ID.
     * @var string $note_id
     */
    public $note_id;

    /**  The custom note type ID.
     * @var string $note_custom_type_id
     */
    public $note_custom_type_id;

    /** The custom note value.
     * @var string $note_custom_value
     */
    public $note_custom_value;

    /** The custom note type.
     * @var string $note_custom_type
     */
    public $note_custom_type;
}