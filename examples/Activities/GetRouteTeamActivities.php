<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$routeId = '06B655F27E0D6A74BD37F6F9758E4D2E';
	
	$activityParameters=ActivityParameters::fromArray(array(
		"route_id"	=> $routeId,
		"team"		=> "true"
	));
	
	
	$activities=new ActivityParameters();
	$actresults=$activities->get($activityParameters);
	
	$results=$activities->getValue($actresults,"results");
	
	Route4Me::simplePrint($results);
	 
?>