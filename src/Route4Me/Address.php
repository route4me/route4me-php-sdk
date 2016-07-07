<?php

namespace Route4Me;

use Route4Me\Exception\BadParam;
use Route4Me\Route4Me;
use GuzzleHttp\Client;
use Route4Me\Common;

class Address extends Common
{
    static public $apiUrl = '/api.v4/address.php';
	static public $apiUrlMove='/actions/route/move_route_destination.php';

    public $route_destination_id;
    public $alias;
    public $member_id;
    public $address;
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

    public static function fromArray(array $params)
    {
        /*if (!isset($params['address'])) {
            throw new BadParam('address must be provided');
        }

        if (!isset($params['lat'])) {
            throw new BadParam('lat must be provided');
        }

        if (!isset($params['lng'])) {
            throw new BadParam('lng must be provided');
        }*/

        $address = new Address();
        foreach($params as $key => $value) {
            if (property_exists($address, $key)) {
                $address->{$key} = $value;
            }
        }

        return $address;
    }

    public static function getAddress($routeId, $addressId)
    {
        $address = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'GET',
            'query'  => array(
                'route_id'             => $routeId,
                'route_destination_id' => $addressId,
            )
        ));

        return Address::fromArray($address);
    }

    public function update()
    {
        $address = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'PUT',
            'body'   => $this->toArray(),
            'query'  => array(
                'route_id'             => $this->route_id,
                'route_destination_id' => $this->route_destination_id,
            ),
        ));

        return Address::fromArray($address);
    }
	
	public function markAddress($params, $body)
    {
        $result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'PUT',
            'query'  => array(
                'route_id'  => isset($params['route_id']) ? $params['route_id']: null, 
                'route_destination_id' => isset($params['route_destination_id']) ? $params['route_destination_id'] : null,
            ),
            'body'   => $body
        ));

        return $result;
    }

    public function delete()
    {
        $address = Route4Me::makeRequst(array(
            'url'    => self::$apiUrl,
            'method' => 'DELETE',
            'query'  => array(
                'route_id'             => $this->route_id,
                'route_destination_id' => $this->route_destination_id,
            )
        ));

        return (bool)$address['deleted'];
    }
	
	public function MoveDestinationToRoute($params)
	{
		$result = Route4Me::makeRequst(array(
            'url'    => self::$apiUrlMove,
            'method' => 'POST',
            'query'  => array(
                'to_route_id' => isset($params['to_route_id']) ? $params['to_route_id'] : null,
                'route_destination_id' => isset($params['route_destination_id']) ? $params['route_destination_id'] : null,
                'after_destination_id' => isset($params['after_destination_id']) ? $params['after_destination_id'] : null
            )
        ));

        return $result;
		
	}

    function getAddressId()
    {
        return $this->route_destination_id;
    }
}
