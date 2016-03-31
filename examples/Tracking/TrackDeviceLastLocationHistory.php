<?php
	namespace Route4me;
		
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';
	
	require $vdir.'/../vendor/autoload.php';
	//require __DIR__.'/../vendor/autoload.php';;
	
	use Route4me\Enum\DeviceType;
	use Route4me\Enum\Format;
	use Route4me\TrackSetParams;
	use Route4me\Track;
	use Route4me\Route;
	
	Route4me::setApiKey('11111111111111111111111111111111');
	
	$params = TrackSetParams::fromArray(array(
	    'format'           => Format::SERIALIZED,
	    'route_id'         => '8B4E277A54990986CD80BE36977517E2',
	    'member_id'        => 1,
	    'course'           => 3,
	    'speed'            => 100,
	    'lat'              => 41.8927521,
	    'lng'              => -109.0803888,
	    'device_type'      => DeviceType::IPHONE,
	    'device_guid'      => 'qweqweqwe',
	    'device_timestamp' => date('Y-m-d H:i:s')
	));

	$status = Track::set($params);
	
	if (!$status) {
		echo "Setting of GPS position failed";
		return;
	}
	
	$params = array(
		'route_id'  =>  '8B4E277A54990986CD80BE36977517E2',
		'device_tracking_history'  =>  '1'
	);
	
	$route = new Route();
	
	$result = $route->GetLastLocation($params);
	//var_dump($result);die("");
	if (isset($result->tracking_history))
	foreach ($result->tracking_history as $history) {
		echo "Speed --> ".$history['s']."<br>";
		echo "course --> ".$history['d']."<br>";
		echo "Timestamp --> ".$history['ts_friendly']."<br>";
		echo "Latitude --> ".$history['lt']."<br>";
		echo "Longitude --> ".$history['lg']."<br>";
		echo "========================================<br><br>";
	
		//Route4me::simplePrint($history);
	}
	//Route4me::simplePrint($result);
	
?>