<?php

namespace Route4me;

use Route4me\Exception\BadParam;
use Route4me\Route4me;
use GuzzleHttp\Client;
use Route4me\Common;

class Address extends Common
{
    static public $apiUrl = 'http://route4me.com/api.v4/address.php';

    private $route_destination_id;
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
    public $timestamp_last_visited;
    public $custom_fields = array();
    public $manifest = array();

    public static function fromArray(array $params)
    {
        if (!isset($params['address'])) {
            throw new BadParam('address must be provided');
        }

        if (!isset($params['lat'])) {
            throw new BadParam('lat must be provided');
        }

        if (!isset($params['lng'])) {
            throw new BadParam('lng must be provided');
        }

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
        // TODO: throw NotFound Exception if address not found
        try {
            $client = new Client;
            $response = $client->get(self::$apiUrl, array(
                'query' => array(
                    'route_id'             => $routeId,
                    'route_destination_id' => $addressId,
                    'api_key'              => Route4me::getApiKey()
                ),
                'headers' => array(
                    'User-Agent' => 'Route4me php sdk'
                )
            ));

            return Address::fromArray($response->json());
        } catch (\Exception $e) {
            return null;
        }
    }

    public function update()
    {
        try {
            $client = new Client;
            $response = $client->put(self::$apiUrl, array(
                'query' => array(
                    'route_id'             => $this->route_id,
                    'route_destination_id' => $this->route_destination_id,
                    'api_key'              => Route4me::getApiKey()
                ),
                'body' => json_encode($this->toArray()),
                'headers' => array(
                    'User-Agent' => 'Route4me php sdk'
                )
            ));

            return (bool)$response->json();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete()
    {
        try {
            $client = new Client;
            $response = $client->delete(self::$apiUrl, array(
                'query' => array(
                    'route_id'             => $this->route_id,
                    'route_destination_id' => $this->route_destination_id,
                    'api_key'              => Route4me::getApiKey()
                ),
                'headers' => array(
                    'User-Agent' => 'Route4me php sdk'
                )
            ));

            $body = $response->json();
            return (bool)$body['deleted'];
        } catch (\Exception $e) {
            return false;
        }
    }

    function getAddressId()
    {
        return $this->route_destination_id;
    }
}
