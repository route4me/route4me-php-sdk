<?php
namespace Route4Me;

use Route4Me\Exception\BadParam;
use Route4Me\Route4Me;
use Route4Me\Common;
use Route4Me\Enum\Endpoint;

class Address extends Common
{
    public $route_destination_id;
    public $alias;
    public $member_id;
    public $address;
    public $addressUpdate;
    public $is_depot = false;
    public $lat;
    public $lng;
    public $route_id;
    public $original_route_id;
    public $optimization_problem_id;
    public $sequence_no;
    public $geocoded;
    public $preferred_geocoding;
    public $failed_geocoding;
    public $geocodings = array();
    public $contact_id;
    public $is_visited;
    public $customer_po;
    public $invoice_no;
    public $reference_no;
    public $order_no;
    public $weight;
    public $cost;
    public $revenue;
    public $cube;
    public $pieces;
    public $email;
    public $phone;
    public $tracking_number;
    public $destination_note_count;
    public $drive_time_to_next_destination;
    public $distance_to_next_destination;
    public $generated_time_window_start;
    public $generated_time_window_end;
    public $time_window_start;
    public $time_window_end;
    public $time;
    public $notes;
    public $timestamp_last_visited;
    public $custom_fields = array();
    public $manifest = array();
    
    public $first_name;
    public $last_name;
    public $is_departed;
    public $timestamp_last_departed;
    public $order_id;
    public $priority;
    public $curbside_lat;
    public $curbside_lng;
    public $time_window_start_2;
    public $time_window_end_2;

    public static function fromArray(array $params)
    {
        $address = new Address();
        foreach ($params as $key => $value) {
            if (property_exists($address, $key)) {
                $address->{$key} = $value;
            }
        }
        
        return $address;
    }

    public static function getAddress($routeId, $addressId)
    {
        $address = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_V4,
            'method' => 'GET',
            'query'  => array(
                'route_id'             => $routeId,
                'route_destination_id' => $addressId,
            )
        ));
    
        return Address::fromArray($address);
    }
    
    /*Get notes from the specified route destination
     * Returns an address object with notes, if an address exists, otherwise - return null.
     */
    public static function GetAddressesNotes($noteParams)
    {
        $address = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_V4,
            'method' => 'GET',
            'query'  => array(
                'route_id'             => isset($noteParams['route_id']) ? $noteParams['route_id'] : null, 
                'route_destination_id' => isset($noteParams['route_destination_id']) 
                                             ? $noteParams['route_destination_id'] : null,
                'notes'                => 1,
            )
        ));
    
        return $address;
    }

    public function update()
    {
        $addressUpdate = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_V4,
            'method' => 'PUT',
            'body'   => $this->toArray(),
            'query'  => array(
                'route_id'             => $this->route_id,
                'route_destination_id' => $this->route_destination_id,
            ),
        ));
    
        return Address::fromArray($addressUpdate);
    }
    
    public function markAddress($params, $body)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_V4,
            'method' => 'PUT',
            'query'  => array(
                'route_id'             => isset($params['route_id']) ? $params['route_id'] : null, 
                'route_destination_id' => isset($params['route_destination_id']) ? $params['route_destination_id'] : null,
            ),
            'body'   => $body
        ));
    
        return $result;
    }
    
    public function markAsDeparted($params)
    {
        $address = Route4Me::makeRequst(array(
            'url'    => Endpoint::MARK_ADDRESS_DEPARTED,
            'method' => 'GET',
            'query'  => array(
                'route_id'     => isset($params['route_id']) ? $params['route_id'] : null,
                'address_id'   => isset($params['address_id']) ? $params['address_id'] : null,
                'is_departed'  => isset($params['is_departed']) ? $params['is_departed'] : null,
                'member_id'    => isset($params['member_id']) ? $params['member_id'] : null,
            ),
        ));
    
        return $address;
    }
    
    public function markAsVisited($params)
    {
        $address = Route4Me::makeRequst(array(
            'url'    => Endpoint::UPDATE_ADDRESS_VISITED,
            'method' => 'GET',
            'query'  => array(
                'route_id'   => isset($params['route_id']) ? $params['route_id'] : null,
                'address_id' => isset($params['address_id']) ? $params['address_id'] : null,
                'member_id'  => isset($params['member_id']) ? $params['member_id'] : null,
            ),
            'body'  =>  array(
                'is_visited' => isset($params['is_visited']) ? $params['is_visited'] : null
            )
        ));
    
        return $address;
    }

    public function delete()
    {
        $address = Route4Me::makeRequst(array(
            'url'    => Endpoint::ADDRESS_V4,
            'method' => 'DELETE',
            'query'  => array(
                'route_id'             => $this->route_id,
                'route_destination_id' => $this->route_destination_id,
            )
        ));
    
        return (bool)$address['deleted'];
    }
    
    public function moveDestinationToRoute($params)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::MOVE_ROUTE_DESTINATION,
            'method' => 'POST',
            'body'  => array(
                'to_route_id'          => isset($params['to_route_id']) ? $params['to_route_id'] : null,
                'route_destination_id' => isset($params['route_destination_id']) ? $params['route_destination_id'] : null,
                'after_destination_id' => isset($params['after_destination_id']) ? $params['after_destination_id'] : null
            ),
            'HTTPHEADER'  => 'Content-Type: multipart/form-data'
        ));

        return $result;
    }
    
    public function AddAddressNote($params)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_NOTES_ADD,
            'method' => 'POST',
            'query'  => array(
                'route_id'     =>  isset($params['route_id']) ? $params['route_id'] : null,
                'address_id'   =>  isset($params['address_id']) ? $params['address_id'] : null,
                'dev_lat'      =>  isset($params['dev_lat']) ? $params['dev_lat'] : null,
                'dev_lng'      =>  isset($params['dev_lng']) ? $params['dev_lng'] : null,
                'device_type'  =>  isset($params['device_type']) ? $params['device_type'] : null
            ),
            'body'  => array(
                'strNoteContents' => isset($params['strNoteContents']) ? $params['strNoteContents'] : null,
                'strUpdateType'   => isset($params['strUpdateType']) ? $params['strUpdateType'] : null
            ),
            'HTTPHEADER'  => 'Content-Type: multipart/form-data'
        ));

        return $result;
    }

    public function AddNoteFile($params)
    {
        $result = Route4Me::fileUploadRequest(array(
            'url'    => Endpoint::ROUTE_NOTES_ADD,
            'method' => 'POST',
            'query'  => array(
                'route_id'      =>  isset($params['route_id']) ? $params['route_id'] : null,
                'address_id'    =>  isset($params['address_id']) ? $params['address_id'] : null,
                'dev_lat'       =>  isset($params['dev_lat']) ? $params['dev_lat'] : null,
                'dev_lng'       =>  isset($params['dev_lng']) ? $params['dev_lng'] : null,
                'device_type'   =>  isset($params['device_type']) ? $params['device_type'] : null,
                'strUpdateType' =>  isset($params['strUpdateType']) ? $params['strUpdateType'] : null
            ),
            'body'  => array(
                'strFilename' => isset($params['strFilename']) ? $params['strFilename'] : null
            ),
            'HTTPHEADER'  => 'Content-Type: multipart/form-data'
        ));

        return $result;
    }

    public function createCustomNoteType($params)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::NOTE_CUSTOM_TYPES_V4,
            'method' => 'POST',
            'body'   => array(
                'type'   => isset($params['type']) ? $params['type'] : null,
                'values' => isset($params['values']) ? $params['values'] : null
            )
        ));

        return $result;
    }
    
    public function removeCustomNoteType($params)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::NOTE_CUSTOM_TYPES_V4,
            'method' => 'DELETE',
            'body'   => array(
                'id' => isset($params['id']) ? $params['id'] : null
            )
        ));

        return $result;
    }
    
    public function getAllCustomNoteTypes()
    {
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::NOTE_CUSTOM_TYPES_V4,
            'method' => 'GET'
        ));

        return $result;
    }
    
    public function addCustomNoteToRoute($params)
    {
        $customArray = array();
        
        foreach ($params as $key => $value) {
            $kpos = strpos($key, "custom_note_type");
            
            if ($kpos!==false) {
                $customArray[$key] = $value;
            }
        }
        
        $result = Route4Me::makeRequst(array(
            'url'    => Endpoint::ROUTE_NOTES_ADD,
            'method' => 'POST',
            'query'  => array(
                'route_id'      =>  isset($params['route_id']) ? $params['route_id'] : null,
                'address_id'    =>  isset($params['address_id']) ? $params['address_id'] : null,
                'format'        =>  isset($params['format']) ? $params['format'] : null,
                'dev_lat'       =>  isset($params['dev_lat']) ? $params['dev_lat'] : null,
                'dev_lng'       =>  isset($params['dev_lng']) ? $params['dev_lng'] : null
            ),
            'body'  => array_merge(array(
                'strUpdateType'   =>  isset($params['strUpdateType']) ? $params['strUpdateType'] : null,
                'strUpdateType'   =>  isset($params['strUpdateType']) ? $params['strUpdateType'] : null,
                'strNoteContents' =>  isset($params['strNoteContents']) ? $params['strNoteContents'] : null
            ), $customArray),
            'HTTPHEADER'  => 'Content-Type: multipart/form-data'
        ));

        return $result;
    }

    function getAddressId()
    {
        return $this->route_destination_id;
    }
}
