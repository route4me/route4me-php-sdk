<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Member;
	
	// Example refers to member authentication.
	
	// Set the API key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$recordParameters=Member::fromArray(array(
		'strEmail' => 'oooooo@yahoo.com',
   		'strPassword' => 'oooooo',
   		'format' => 'json',
	));
	
	$member = new Member();
	
	$response = $member->memberAuthentication($recordParameters);
	var_dump($response);
?>