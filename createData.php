<?php 
	include "connection.php";

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = "";
	}

	$sqlClasses = "SELECT * FROM classes";

	$successClasses = $conn->query($sqlClasses);

	if (isset($_POST['btnCreate'])) {
		$fullname 	= $_POST['fullname'];
		$username 	= $_POST['username'];
		$password 	= $_POST['password'];
		$gender		= $_POST['gender'];
		$address 	= $_POST['address'];
		$class 		= $_POST['class'];
		date_default_timezone_set('asia/ho_chi_minh');
		$time = date("Y-m-d H:i:s");

		$sql = "INSERT INTO users(name, username, password, gender, address, class_id, created_at) VALUES ('$fullname', '$username', '$password', '$gender', '$address', $class, '$time')";

		$success = $conn->query($sql);

		$limit = 5;

		// $offset = $limit * ($page - 1);

		// $sqlLimit = "SELECT * FROM users LIMIT $limit OFFSET $offset";

		// // var_dump($sqlLimit); exit;

		// $successLimit = $conn->query($sqlLimit);

		// var_dump($successLimit); exit;

		$sqlTotal = "SELECT count(*) as total FROM users";

		$successTotal = $conn->query($sqlTotal);

		if ($successTotal->num_rows > 0) {
			$totalRecord = $successTotal->fetch_assoc()['total'];
		}

		$url = "";

		if ($totalRecord <= ($limit * $page)) {
			$url =  "readData.php?page=" . $page;
		}  else {
			$url =  "readData.php?page=" . ($page + 1);
		}
		// $url = "readData.php?page=" . $page;

		if ($success) {
			header("Location:" . $url);
		}
	}
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<title>Add New User</title>
 	<!-- Latest compiled and minified CSS & JS -->
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
 	<script src="//code.jquery.com/jquery.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
 </head>
 <body>
 	<div class="container" style="padding-top: 25px">
 		<div class="row">
 			<div class="col-md-12">
 				<form action="" method="POST" role="form">
 					<legend>Add New User</legend>
 				
 					<div class="form-group">
 						<label for="">Full Name</label>
 						<input type="text" class="form-control" id="" placeholder="Input Full Name" name="fullname">
 					</div>
 				
 					<div class="form-group">
 						<label for="">Username</label>
 						<input type="text" class="form-control" id="" placeholder="Input Username" name="username">
 					</div>
 				
 					<div class="form-group">
 						<label for="">Password</label>
 						<input type="text" class="form-control" id="" placeholder="Input Password" name="password">
 					</div>
 				
					<div class="radio">
						<label>
							<input type="radio" name="gender" id="input" value="1" checked="checked">
							Male
						</label>
						<label>
							<input type="radio" name="gender" id="input" value="0">
							Female
						</label>
					</div>
 				
 					<div class="form-group">
 						<label for="">Address</label>
 						<input type="text" class="form-control" id="" placeholder="Input Address" name="address">
 					</div>

 					<div class="form-group">
 						<label for="">Class</label>
 						<select name="class" id="input" class="form-control">
 							<?php 
 								while ($rows = $successClasses->fetch_assoc()) {
 								echo "<option value='".$rows['class_id']."'>".$rows['classname']."</option>";
 								}

 							 ?>
 						</select>
 					</div>
 				
 				
 					<button type="submit" class="btn btn-primary" name="btnCreate">Create</button>
 				</form>
 			</div>
 		</div>
 	</div>
 </body>
 </html>