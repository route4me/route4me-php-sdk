<?php
namespace Route4Me;

use Route4Me\Common;
use Route4Me\Exception\BadParam;
use Route4Me\Enum\Endpoint;

class Territory extends Common
{
	public $territory_id; // Territory id
	public $territory_name; 
	public $territory_color;
	public $addresses;
	public $member_id;
	public $territory; // Territory parameters
	
	public static function fromArray(array $params) {
		if (!isset($params['territory_name'])) {
			throw new BadParam('Territory name must be provided');
		}
		
		if (!isset($params['territory_color'])) {
			throw new BadParam('Territory color must be provided');
		}
		
		if (!isset($params['territory'])) {
			throw new BadParam('Territory must be provided');
		}
		
		$territoryparameters = new Territory();
        
		foreach ($params as $key => $value) {
			if (property_exists($territoryparameters, $key)) {
				$territoryparameters->{$key} = $value;
			}
		}
		
		return $territoryparameters;
	}
	
	public static function getTerritory($params)
	{
	    $allQueryFields = array('territory_id', 'addresses');
        
		$territory = Route4Me::makeRequst(array(
			'url'    => Endpoint::TERRITORY_V4,
			'method' => 'GET',
			'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
		));

		return $territory;
	}
	
	public static function getTerritories($params)
	{
	    $allQueryFields = array('offset', 'limit', 'addresses');
        
		$response = Route4Me::makeRequst(array(
			'url'    => Endpoint::TERRITORY_V4,
			'method' => 'GET',
			'query'  => Route4Me::generateRequestParameters($allQueryFields, $params)
		));

		return $response;
	}

	public static function addTerritory($params)
	{
	    $allBodyFields = array('territory_name', 'member_id', 'territory_color', 'territory');
        
		$response = Route4Me::makeRequst(array(
			'url'    => Endpoint::TERRITORY_V4,
			'method' => 'POST',
			'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
		));

		return $response;
	}
	
	public function deleteTerritory($territory_id)
	{
		$result = Route4Me::makeRequst(array(
			'url'    => Endpoint::TERRITORY_V4,
			'method' => 'DELETEARRAY',
			'query'  => array(
				'territory_id'  => $territory_id
			)
		));

		return $result;
	}
	
	public function updateTerritory($params)
	{
	    $allQueryFields = array('territory_id');
        $allBodyFields = array('territory_name', 'member_id', 'territory_color', 'territory');
        
		$response = Route4Me::makeRequst(array(
			'url'    => Endpoint::TERRITORY_V4,
			'method' => 'PUT',
			'query'  => Route4Me::generateRequestParameters($allQueryFields, $params),
            'body'   => Route4Me::generateRequestParameters($allBodyFields, $params)
		));

		return $response;
	}
}
