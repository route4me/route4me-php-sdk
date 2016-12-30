<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Member;
	
	// Example refers to the process of updating existing configuration key data.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$params = Member::fromArray(array (
		"config_key"=> "destination_icon_uri",
		"config_value"=> "555"
	));
	
	$member = new Member();
	
	$response = $member->updateMemberConfigKey($params);

	Route4Me::simplePrint($response);
	
?>