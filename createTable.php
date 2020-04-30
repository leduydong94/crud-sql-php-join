<?php 
	include "connection.php";

	// $sql = "CREATE TABLE users(
	// 		id int primary key auto_increment,
	// 		username varchar(255),
	// 		password varchar(255),
	// 		gender tinyint,
	// 		address varchar(255),
	// 		created_at datetime
	// )";

	// $sql ="ALTER TABLE users
	// 		MODIFY created_at datetime";

	// $sql = "ALTER TABLE users
	// 		CHANGE COLUMN username name varchar(255)";

	// $sql = "ALTER TABLE users
	// 		ADD COLUMN username varchar(255) AFTER name";

	// $sql = "ALTER TABLE users
	// 		ADD COLUMN class_id int AFTER address";

	// $sql = "CREATE TABLE classes(
	// 		class_id int primary key auto_increment,
	// 		classname varchar(255)
	// 		)";

	$sql = "ALTER TABLE users
			ADD FOREIGN KEY (class_id) REFERENCES classes(class_id);"


	if ($conn->query($sql)) {
		echo "Create OK";
	} else {
		die("e");
	}	
 ?>	
