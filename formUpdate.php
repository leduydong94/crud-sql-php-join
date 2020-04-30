<?php
	include "connection.php";

	$id = $_GET['id'];

	$page = $_GET['page'];

	$keyword = $_GET['keyword'];

	$sqlUser = "SELECT * FROM users WHERE id = '$id'";

	$successUser = $conn->query($sqlUser);

	$users = [];

	if ($successUser) {
		if ($successUser->num_rows > 0) {
			while ($row = $successUser->fetch_assoc()) {
				$users[] = $row;
			}
		}
	}

	$sqlClasses = "SELECT * FROM classes";

	$successClasses = $conn->query($sqlClasses);

	// $classes = [];

	// if ($successClasses) {
	// 	if ($successClasses->num_rows > 0) {
	// 		while ($rows = $successClasses->fetch_assoc()) {
	// 			$classes[] = $rows;
	// 		}
	// 	}
	// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<script src="//code.jquery.com/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>
	<div class="container" style="padding-top: 25px">
		<div class="row">
			<div class="col-md-12">
				<?php foreach ($users as $user): ?>

				<form action="updateData.php?keyword=<?= $keyword ?>&id=<?php echo $user['id'] ?>&page=<?php echo $page ?>" method="POST" role="form">
					<legend>Update Information</legend>

					<div class="form-group">
						<input type="hidden" class="form-control" id="" placeholder="Input Full Name" name="id" value="<?php echo $user['id'] ?>">
					</div>					
				
					<div class="form-group">
						<label for="">Full Name</label>
						<input type="text" class="form-control" id="" placeholder="Input Full Name" name="fullname" value="<?php echo $user['name'] ?>">
					</div>
				
					<div class="form-group">
						<label for="">Username</label>
						<input type="text" class="form-control" id="" placeholder="Input Username" name="username" value="<?php echo $user['username'] ?>">
					</div>

					<div class="radio">
						<label>
							<input type="radio" name="gender" id="input" value="0" <?php echo $user['gender'] == 0 ? 'Checked' : '' ?>>
							Female
						</label>
						<label>
							<input type="radio" name="gender" id="input" value="1" <?php echo $user['gender'] == 1 ? 'Checked' : '' ?>>
							Male
						</label>
					</div>
				
					<div class="form-group">
						<label for="">Address</label>
						<input type="text" class="form-control" id="" placeholder="Input Address" name="address" value="<?php echo $user['address'] ?>">
					</div>

					<div class="form-group">
						<label for="">Class</label>
						<select name="class" id="inputClass" class="form-control">
							<?php 
								while ($rows = $successClasses->fetch_assoc())
								{
							?>		
							<option value="<?= $rows['class_id'] ?>" <?php echo ($user['class_id'] == $rows['class_id']) ? "selected" :""  ?>><?= $rows['classname'] ?></option>
							<?php
								}
							?>   
						</select>
					</div>
	
					<button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
			

				</form>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</body>
</html>
