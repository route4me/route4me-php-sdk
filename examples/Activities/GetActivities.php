<?php
	namespace Route4me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4me\Route4me;
	use Route4me\Route;
	
	// Set the api key in the Route4me class
	Route4me::setApiKey('11111111111111111111111111111111');
	
	$routeId = '3F48838FB3F25B59B372ABC951A79F8F';
	
	$activityParameters=ActivityParameters::fromArray(array(
		"route_id"	=> $routeId,
		"limit"		=> 10,
		"offset"	=> 0
	));
	
	$activities=new ActivityParameters();
	$actresults=$activities->get($activityParameters);
	
	$results=$activities->getValue($actresults,"results");
	
	Route4me::simplePrint($results);
	 
?>