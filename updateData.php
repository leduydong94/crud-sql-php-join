<?php
	include "connection.php";

	$page = $_GET['page'];

	$keyword = $_GET['keyword'];

	// echo $keyword; exit;

	if (isset($_POST['btnUpdate'])) {
		$id 		= $_POST['id'];
		$fullname 	= $_POST['fullname'];
		$username 	= $_POST['username'];
		// $password 	= $_POST['password'];
		$gender 	= $_POST['gender'];
		$address 	= $_POST['address'];
		$class 		= $_POST['class'];
	}


	$sql = "UPDATE users JOIN classes SET name ='$fullname', username = '$username', gender = '$gender', address = '$address', users.class_id = '$class' WHERE id = '$id'";

	$success = $conn->query($sql);

	$url = "readData.php?page=" . $page;

	if ($keyword != null) {
		$url = "readData.php?keyword=".$keyword."&page=".$page;
	}

	if ($success) {
		header("Location:" . $url);
	}

  ?>

