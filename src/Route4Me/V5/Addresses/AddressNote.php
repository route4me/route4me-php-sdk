<?php

namespace Route4Me\V5\Addresses;

use Route4Me\Enum\Endpoint;
use Route4Me\Exception\BadParam;
use Route4Me\Common;
use Route4Me\Route4Me;

/**
 * Class AddressNote
 * @package Route4Me\V5\Addresses
 * The class for address note
 */
class AddressNote extends Common
{
    /** An unique ID of a note
     * @var integer $note_id
     */
    public $note_id;

    /** The route ID
     * @var string $route_id
     */
    public $route_id;

    /** The route destination ID
     * @var integer $route_destination_id
     */
    public $route_destination_id;

    /** An unique ID of an uploaded file
     * @var string $upload_id
     */
    public $upload_id;

    /** When the note was added
     * @var integer $ts_added
     */
    public $ts_added;

    /** The position latitude where the address note was added
     * @var double $lat
     */
    public $lat;

    /** The position longitude where the address note was added
     * @var double $lng
     */
    public $lng;

    /** The activity type
     * @var string $activity_type
     */
    public $activity_type;

    /** The note text contents
     * @var string $contents
     */
    public $contents;

    /** An upload type of the note
     * @var string $upload_type
     */
    public $upload_type;

    /** An upload url - where a file-note was uploaded.
     * @var string $upload_url
     */
    public $upload_url;

    /** An extension of the uploaded file.
     * @var string $upload_extension
     */
    public $upload_extension;

    /** The device a note was uploaded from
     * @var string $device_type
     */
    public $device_type;

    /** Array of the custom type notes
     * @var AddressCustomNote[] $custom_types
     */
    public $custom_types = [];

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

    /*Get notes from the specified route destination
     * Returns an address object with notes, if an address exists, otherwise - return null.
     */
    public static function GetAddressesNotes($noteParams)
    {
        $address = Route4Me::makeRequst([
            'url'       => Endpoint::ADDRESS_V4,
            'method'    => 'GET',
            'query'     => [
                'route_id'              => isset($noteParams['route_id']) ? $noteParams['route_id'] : null,
                'route_destination_id'  => isset($noteParams['route_destination_id'])
                    ? $noteParams['route_destination_id'] : null,
                'notes' => 1,
            ],
        ]);

        return $address;
    }

    public function createCustomNoteType($params)
    {
        $allBodyFields = ['type', 'values'];

        $result = Route4Me::makeRequst([
            'url'       => Endpoint::NOTE_CUSTOM_TYPES_V4,
            'method'    => 'POST',
            'body'      => Route4Me::generateRequestParameters($allBodyFields, $params),
        ]);

        return $result;
    }

    public function removeCustomNoteType($params)
    {
        $result = Route4Me::makeRequst([
            'url'       => Endpoint::NOTE_CUSTOM_TYPES_V4,
            'method'    => 'DELETE',
            'body'      => [
                'id' => isset($params['id']) ? $params['id'] : null,
            ],
        ]);

        return $result;
    }

    public function getAllCustomNoteTypes()
    {
        $result = Route4Me::makeRequst([
            'url'       => Endpoint::NOTE_CUSTOM_TYPES_V4,
            'method'    => 'GET',
        ]);

        return $result;
    }

    public function getCustomNoteTypeByKey($params)
    {
        $result = Route4Me::makeRequst([
            'url'       => Endpoint::NOTE_CUSTOM_TYPES_V4,
            'method'    => 'GET',
        ]);

        if (is_null($result) || !is_array($result)) return null;

        foreach ($result as $custNoteType) {
            if (isset($custNoteType["note_custom_type"]) && $custNoteType["note_custom_type"] == $params) {
                return $custNoteType;
            }
        }
    }

    public function AddAddressNote($params)
    {
        $allQueryFields = ['route_id', 'address_id', 'dev_lat', 'dev_lng', 'device_type'];
        $allBodyFields = ['strNoteContents', 'strUpdateType'];

        $result = Route4Me::makeRequst([
            'url'           => Endpoint::ROUTE_NOTES_ADD,
            'method'        => 'POST',
            'query'         => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
            'HTTPHEADER'    => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }

    public function AddNoteFile($params)
    {
        $fname = isset($params['strFilename']) ? $params['strFilename'] : null;

        $allQueryFields = ['route_id', 'address_id', 'dev_lat', 'dev_lng', 'device_type'];
        $allBodyFields = ['strFilename', 'strUpdateType', 'strNoteContents'];

        $result = Route4Me::makeRequst([
            'url'           => Endpoint::ROUTE_NOTES_ADD,
            'method'        => 'POST',
            'query'         => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'          => Route4Me::generateRequestParameters($allBodyFields, $params),
            'FILE'          => $fname,
            'HTTPHEADER'    => 'Content-Type: multipart/form-data'
        ]);

        return $result;
    }

    public function addCustomNoteToRoute($params)
    {
        $customArray = [];

        foreach ($params as $key => $value) {
            if (false !== strpos($key, 'custom_note_type')) {
                $customArray[$key] = $value;
            }
        }

        $allQueryFields = ['route_id', 'address_id', 'format', 'dev_lat', 'dev_lng'];
        $allBodyFields = ['strUpdateType', 'strUpdateType', 'strNoteContents'];

        $result = Route4Me::makeRequst([
            'url'           => Endpoint::ROUTE_NOTES_ADD,
            'method'        => 'POST',
            'query'         => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'          => array_merge(Route4Me::generateRequestParameters($allBodyFields, $params), $customArray),
            'HTTPHEADER'    => 'Content-Type: multipart/form-data',
        ]);

        return $result;
    }
}
