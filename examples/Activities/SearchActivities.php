<?php
	namespace Route4Me;
	
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';

    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\Route4Me;
	use Route4Me\Route;
	
	// Example refers to activities by activity_type parameter.
	
	// Set the api key in the Route4Me class
	Route4Me::setApiKey('11111111111111111111111111111111');
	
	$activityParameters=ActivityParameters::fromArray(array(
		"activity_type"	=> "area-removed",
		"limit"		=> 5,
		"offset"	=> 0
	));
	
	// Possible values of the parameter activity_type are as follows:
	// "delete-destination", "insert-destination", "mark-destination-departed", "move-destination", "update-destinations", 
	// "mark-destination-visited", "member-created", "member-deleted", "member-modified", "note-insert", "route-delete", "route-optimized", 
	// "route-owner-changed"
	
	$activities=new ActivityParameters();
	
	$results=$activities->searcActivities($activityParameters);
	
	foreach ($results as $key => $activity) {
		Route4Me::simplePrint($activity);
		echo "<br>";
	}
?>