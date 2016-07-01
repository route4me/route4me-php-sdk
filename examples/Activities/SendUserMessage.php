<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\AvtivityParameters;
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$postParameters=ActivityParameters::fromArray(array(
		"activity_type"	=> "user_message",
		"activity_message"	=> "Hello - php!",
		"route_id"	=> "2EA70721624592FC41522A708603876D"
	));
	
	$activities=new ActivityParameters();
	
	$results=$activities->sendUserMessage($postParameters);
	
	foreach ($results as $key => $result) {
		echo "$key ----> <br>";
		Route4Me::simplePrint($result);
		echo " ----- <br>";
	}
	
	
?>