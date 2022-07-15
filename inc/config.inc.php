<?php

    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {

        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        die();

    }

    /*
	$db_host = "sql211.epizy.com";
	$db_user = "epiz_32171910";
	$db_pass = "bRnD9w6Z3YFEN5";
	$db_name = "epiz_32171910_catsuinfosys";
	*/

	$db_host = "sql211.epizy.com";
	$db_user = "epiz_32171910";
	$db_pass = "bRnD9w6Z3YFEN5";
	$db_name = "epiz_32171910_catsuinfosys";
	$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

	if (mysqli_connect_errno()) {
		die("Connection Failed: ".$conn->connect_error);
	}

?>