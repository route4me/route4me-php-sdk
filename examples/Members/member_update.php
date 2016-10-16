<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Member;
	
	// Example refers to updating of an user.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$params = Member::fromArray(array (
		"member_id"=> 220461,
		"member_phone"=> "555-777-888"
	));
	
	$member = new Member();
	
	$response = $member->updateMember($params);

	Route4Me::simplePrint($response);
	
?>