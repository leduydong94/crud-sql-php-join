<?php 
	session_start();

	if (isset($_SESSION['loginSuccess']) && $_SESSION['loginSuccess'] == 1) {
		header("Location: readData.php");
	}
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
 			<div class="col-md-6">
 				<form action="" method="POST" role="form">
 					<legend>Login</legend>

 					<?php 

 						include "connection.php";
						if (isset($_POST['btnLogin'])) {

							$username = $_POST['username'];
							$password = $_POST['password'];

 								if ($username == "" || $password =="") {
										echo "<p>Username or Password is empty</p>";
								}else{
									$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
									$success = $conn->query($sql);
									// var_dump($success); exit;
									$users = [];
													
									if ($success->num_rows==0) {
										echo "<p>Incorrect Information</p>";
									}else{

										while ($row = $success->fetch_assoc()) {
												$users[] = $row;
											}

										foreach ($users as $user) {
												$name = $user['name'];
											} 
										//tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này									
										$_SESSION['name'] = $name;
										$_SESSION['loginSuccess'] =  1;
				 						header("Location: readData.php");
				 					}
			 					}
			 				}

 					 ?>
 				
 					<div class="form-group">
 						<label for="">Username:</label>
 						<input type="text" class="form-control" id="" placeholder="Input Username" name="username">
 					</div>
 				
 					<div class="form-group">
 						<label for="">Password:</label>
 						<input type="text" class="form-control" id="" placeholder="Input Password" name="password">
 					</div>
 								
 					<button type="submit" class="btn btn-primary" name="btnLogin">Login</button>
 					&nbsp;
 					<a href="createData.php" class="btn btn-primary">Register</a>
 				</form>
 			</div>	
 		</div>
 	</div>
 </body>
 </html>