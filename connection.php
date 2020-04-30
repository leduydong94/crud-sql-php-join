<?php 
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpwd  = "";
	$dbname = "sqlphpontap";

	$conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);

	if ($conn->connect_error) {
		die("Connect Failed");
	}

	$conn->set_charset('utf8');
 ?>