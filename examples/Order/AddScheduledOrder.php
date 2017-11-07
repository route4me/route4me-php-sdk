<?php
    namespace Route4Me;

    $vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';

    use Route4Me\Route4Me;
    use Route4Me\Order;

    // Set the api key in the Route4me class
    Route4Me::setApiKey('11111111111111111111111111111111');

    $orderParameters=Order::fromArray(array(
        "address_1" => "318 S 39th St, Louisville, KY 40212, USA",
        "cached_lat" => 38.259326,
        "cached_lng" => -85.814979,
        "curbside_lat" => 38.259326,
        "curbside_lng" => -85.814979,
        "address_alias" => "318 S 39th St 40212",
        "address_city" => "Louisville",
        "EXT_FIELD_first_name" => "Lui",
        "EXT_FIELD_last_name" => "Carol",
        "EXT_FIELD_email" => "lcarol654@yahoo.com",
        "EXT_FIELD_phone" => "897946541",
        "EXT_FIELD_custom_data" => array("order_type" => "scheduled order"),
        "day_scheduled_for_YYMMDD" => "2017-12-20",
        "local_time_window_end" => 39000,
        "local_time_window_end_2" => 46200,
        "local_time_window_start" => 37800,
        "local_time_window_start_2" => 45000,
        "local_timezone_string" => "America/New_York",
        "order_icon" => "emoji/emoji-bank"
    ));

    $order = new Order();

    $response = $order->addOrder($orderParameters);

    Route4Me::simplePrint($response);


