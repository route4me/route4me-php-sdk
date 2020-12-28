<?php

namespace Route4Me;

use Route4Me\Enum\Endpoint;
use Route4Me\Exception\BadParam;

class AddressNote extends Common
{
    public $note_id;
    public $route_id;
    public $route_destination_id;
    public $upload_id;
    public $ts_added;
    public $lat;
    public $lng;
    public $activity_type;
    public $contents;
    public $upload_type;
    public $upload_url;
    public $upload_extension;
    public $device_type;
    public $custom_types;

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
