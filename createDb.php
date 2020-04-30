<?php 
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpwd 	= "";

	$conn = new mysqli($dbhost, $dbuser, $dbpwd);

	if ($conn->connect_error) {
		die("Error");
	}

	$sql = "CREATE DATABASE sqlphpontap CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

	if ($conn->query($sql)) {
		echo "OK";
	}

 ?>