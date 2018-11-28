<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Order;
	
	// Example refers to adding of an order to an optimization.
	
	// Set the api key in the Route4me class
	Route4Me::setApiKey('11111111111111111111111111111111');
    
    //$optimization = new OptimizationProblem();
    //$optimizationProblemID = $optimization->getRandomOptimizationId(0, 10);
    
    //die($optimizationProblemID);
	
	$orderParameters=array(
		"optimization_problem_id"	=> '5BB30F31FCB17CE761C98F967553EFD9',
		"redirect"	=> 0,
		"device_type" => "web",
	);
	
	$jfile = file_get_contents("add_order_to_optimization_data.json");
	
	$body = json_decode($jfile);
    
    //echo "-- <br>"; var_dump($jfile); echo " --- <br>";

	$order = new Order();
	
	$response = $order->addOrder2Destination($orderParameters,$body);
	
	Route4Me::simplePrint($response);
?>