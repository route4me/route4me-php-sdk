<?php
	$vdir=$_SERVER['DOCUMENT_ROOT'].'/route4me/examples/';
    require $vdir.'/../vendor/autoload.php';
	
	use Route4Me\MyQ;
	
	$conf = parse_ini_file($_SERVER['DOCUMENT_ROOT'].'/route4me/myq_config.ini');
	$door = new MyQ();
	$door->login($conf['username'], $conf['password']);
	$door->getState();
?>