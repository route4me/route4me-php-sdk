<!DOCTYPE html>
<html>
<body>
<?php
$url="https://www.route4me.com/actions/addRouteNotes.php";

$route_id="5C15E83A4BE005BCD1537955D28D51D7";
$address_id=162916895;

$query=array(
		"route_id"		=> $route_id,
		"address_id"	=> $address_id,
		"dev_lat"  => 33.132675170898,
		"dev_lng" => -83.244743347168,
		"device_type"  => "web",
		"strUpdateType"  => "ANY_FILE"
	); 
	
$url = $url . '?' . http_build_query(array_merge(
            array( 'api_key' => '11111111111111111111111111111111'), $query
        ));
?>

<form action="<?php echo $url ?>" method="post" encript="text/csv">
	Select csv file to upload:
	<input type="file" name="strFilename" id="strFilename"	>
	<br><br>
	<input type="submit" value="Upload File" name="submit">
</form> 
	
</body>
</html>