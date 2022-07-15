<?php

    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {

        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        die();

    }

	$db_host = "sql200.epizy.com";
	$db_user = "epiz_30552523";
	$db_pass = "B7lYpyFcFjwnp";
	$db_name = "epiz_30552523_catsuinfosys";
	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

	if (mysqli_connect_errno()) {
		die("Connection Failed: ".$conn->connect_error);
	}

?>