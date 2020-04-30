<?php 
	include "connection.php";

	$id  	= $_GET['id'];

	$page	= $_GET['page'];


	$sql = "DELETE FROM users WHERE id = '$id'";

	$success = $conn->query($sql);


	$limit = 5;

	$offset = $limit * ($page - 1);

	if (isset($_GET['keyword'])) {
		$keyword = $_GET['keyword'];
	} else {
		$keyword = null;
	}

	$sqlLimit = "SELECT * FROM users LIMIT $limit OFFSET $offset";
	$url = "readData.php?page=";

	if ($keyword != null) {
		$sqlLimit = "SELECT * FROM users WHERE name LIKE '%{$keyword}%' LIMIT $limit OFFSET $offset";
		$url = "readData.php?keyword=" . $keyword . "&page=";
	}

	// var_dump($sqlLimit); exit;

	$successLimit = $conn->query($sqlLimit);

	// var_dump($successLimit); exit;

	

	if ($successLimit->num_rows == 0) {
		$url =  $url . ($page - 1);
	}  else {
		$url =  $url . $page;
	}
	// echo $url; exit;


	if ($success) {
		header("Location:" . $url);
	}

?>