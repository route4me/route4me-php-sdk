<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Member;
	
	// The example refers to the process of getting a specified single configuration key data.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$params = Member::fromArray(array (
		"config_key"=> "destination_icon_uri"
	));
	
	$member = new Member();
	
	$response = $member->getMemberConfigData($params);
	
	foreach ($response as $key => $value)
	{
		if (is_array($value))
		{
			Route4Me::simplePrint($value);
		}
		else 
		{
			echo "$key => $value <br>";
		}
	}
?>