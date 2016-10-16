<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Member;
	
	// Example refers to creating of an user.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$params = Member::fromArray(array (
		"HIDE_ROUTED_ADDRESSES"=> "FALSE",
		"member_phone"=> "571-259-5939",
		"member_zipcode"=> "22102",
		"route_count"=> null,
		"member_email"=> 'skrynkovskyy+newdispatcher@gmail.com',
		"HIDE_VISITED_ADDRESSES"=> "FALSE",
		"READONLY_USER"=> "FALSE",
		"member_type"=> "SUB_ACCOUNT_DISPATCHER",
		"date_of_birth"=> "2010",
		"member_first_name"=> "Clay",
		"member_password"=> "123456",
		"HIDE_NONFUTURE_ROUTES"=> "FALSE",
		"member_last_name"=> "Abraham",
		"SHOW_ALL_VEHICLES"=> "FALSE",
		"SHOW_ALL_DRIVERS"=> "FALSE"
	));
	
	$member = new Member();
	
	$response = $member->createMember($params);

	Route4Me::simplePrint($response);
	
?>