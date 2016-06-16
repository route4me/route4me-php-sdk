<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';
	
	require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$geocodingParameters=array(
		'format' => 'xml',
		'addresses' => '42.35863,-71.05670'
	);

	$fGeoCoding = new Geocoding();
	
	$fgResult = $fGeoCoding->forwardGeocoding($geocodingParameters);
	echo $fgResult;
?>