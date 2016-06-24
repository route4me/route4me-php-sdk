<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Member;
	
	// Example refers to validating of user's session.
	
	// Set the API key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$params = Member::fromArray(array(
		'session_guid' => '4552222222',
   		'member_id' => 1,
   		'format' => 'json',
	));
	
	$member = new Member();
	
	$response = $member->validateSession($params);
	
	Route4Me::simplePrint($response);

?>