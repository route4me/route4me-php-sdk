<?php
	namespace Route4Me;
		
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';
	
	require $vdir.'/../vendor/autoload.php';
	//require __DIR__.'/../vendor/autoload.php';;
	
	use Route4Me\Enum\DeviceType;
	use Route4Me\Enum\Format;
	use Route4Me\TrackSetParams;
	use Route4Me\Track;
	use Route4Me\Route;
	
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$params = array(
		'route_id'  =>  '814FB49CEA8188D134E9D4D4B8B0DAF7',
		'format'    => 'json',
		'time_period'  =>  'custom',
		'start_date'   => '',
		'end_date'   => ''
	);
	
	$route = new Route();
	
	$result = $route->GetTrackingHistoryFromTimeRange($params);
	
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