<?php
namespace Route4Me;

use Route4Me\Common;
use Route4Me\Exception\BadParam;
use Route4Me\Enum\Endpoint;

class Territory extends Common
{
	public $territory_id;  // Territory id
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
        
		foreach($params as $key => $value) {
			if (property_exists($territoryparameters, $key)) {
				$territoryparameters->{$key} = $value;
			}
		}
		
		return $territoryparameters;
	}
	
	public static function getTerritory($params)
	{
		$territory = Route4Me::makeRequst(array(
			'url'    => Endpoint::TERRITORY_V4,
			'method' => 'GET',
			'query'  => array(
				'territory_id' => isset($params['territory_id']) ? $params['territory_id'] : null,
				'addresses'    => isset($params['addresses']) ? $params['addresses'] : null,
			)
		));

		return $territory;
	}
	
	public static function getTerritories($params)
	{
		$response = Route4Me::makeRequst(array(
			'url'    => Endpoint::TERRITORY_V4,
			'method' => 'GET',
			'query'  => array(
				'offset'  => isset($params->offset) ? $params->offset : null,
				'limit'   => isset($params->limit) ? $params->limit : null,
				'addresses'    => isset($params['addresses']) ? $params['addresses'] : null,
			)
		));

		return $response;
	}

	public static function addTerritory($params)
	{
	    $terParams = array();

        if (isset($params->territory['type'])) $terParams['type'] = $params->territory['type'];
        if (isset($params->territory['data'])) $terParams['data'] = $params->territory['data'];
        
		$response = Route4Me::makeRequst(array(
			'url'    => Endpoint::TERRITORY_V4,
			'method' => 'ADD',
			'query'  => array(
				'territory_name'  => isset($params->territory_name) ? $params->territory_name : null,
				'territory_color' => isset($params->territory_color) ? $params->territory_color : null,
				'territory'       => $terParams
			)
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
	    //var_dump($params); die("");
		$response = Route4Me::makeRequst(array(
			'url'    => Endpoint::TERRITORY_V4,
			'method' => 'PUT',
			'query'  => array(
                'territory_id'  => isset($params->territory_id) ? $params->territory_id : null
            ),
            'body'   => array(
                'territory_name'   => isset($params->territory_name) ? $params->territory_name : null,
                'member_id'        => isset($params->member_id) ? $params->member_id : null,
                'territory_color'  => isset($params->territory_color) ? $params->territory_color : null,
                'territory'        => isset($params->territory) ? $params->territory : null
            ) 

		));

		return $response;
	}
}

