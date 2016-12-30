<?php
	namespace Route4Me;
		
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';
	
	require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Enum\DeviceType;
	use Route4Me\Enum\Format;
	use Route4Me\TrackSetParams;
	use Route4Me\Track;
	use Route4Me\Route;
	
	// The example refers to the process of an asset tracking by sending HTTP parameters.
	
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$params = array(
		'tracking'         => 'Q7G9P1L9'
	);
	
	$route = new Route();
	
	$result = $route->GetAssetTracking($params);

	foreach ($result as $key => $value)
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