<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Member;
	
	// Example refers to the process of removing of a specified configuration key belonging to an account.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$params = Member::fromArray(array (
		"config_key"=> "My height"
	));
	
	$member = new Member();
	
	$response = $member->removeMemberConfigKey($params);

	Route4Me::simplePrint($response);
	
?>