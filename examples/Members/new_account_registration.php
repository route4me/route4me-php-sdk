<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Member;
	
	// Example refers to new account registration.
	
	// Set the API key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$registrParameters=Member::fromArray(array(
   		'strEmail' => 'oooooo@yahoo.com',
		'strPassword_1' => 'ooo111111',
		'strPassword_2' => 'ooo111111',
		'strFirstName' => 'Olman',
		'strLastName' => 'Guchi',
		'strIndustry' => 'Transportation',
		'chkTerms' => 1,
		'plan' => 'free'
	));
	
	$member = new Member();
	
	$response = $member->newAccountRegistration($registrParameters);
	
	Route4Me::simplePrint($response);
?>