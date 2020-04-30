<?php 
	session_start();

	if (!isset($_SESSION['loginSuccess']) || $_SESSION['loginSuccess'] != 1) {
		header("Location: login.php");
	}

	include "connection.php";

	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}

	$limit = 5;

	$offset = $limit * ($page - 1);

	// $keyword = "";

	if (isset($_GET['keyword'])) {
		$keyword = $_GET['keyword'];
	} else {
		$keyword = "";
	}

	$url = "readData.php?";

	$sql = "SELECT * FROM users as u JOIN classes as c ON u.class_id = c.class_id LIMIT $limit OFFSET $offset";
	$sqlTotal 	= "SELECT COUNT(*) AS total FROM users";


	if ($keyword != null) {
		$sql 		= "SELECT * FROM users as u JOIN classes as c ON u.class_id = c.class_id WHERE name LIKE '%{$keyword}%' LIMIT $limit OFFSET $offset";
		$sqlTotal 	= "SELECT count(*) AS total FROM users WHERE name LIKE '%{$keyword}%'";
		$url 		= "readData.php?keyword=" . $keyword . "&"; 
	}

	// var_dump($sqlTotal); exit;

	$successTotal = $conn->query($sqlTotal);
	// var_dump($successTotal); exit;

	if ($successTotal) {
			$totalRecord = $successTotal->fetch_assoc()['total'];
	}

	// $totalPage = ceil($totalRecord/$limit);
	// var_dump($totalPage); exit;

	$success = $conn->query($sql);

	$users = [];

	if ($success) {
		if ($success->num_rows >0) {
			while ($row = $success->fetch_assoc()) {
				$users[] = $row;
			}
		}
	}

	$totalPage = ceil($totalRecord/$limit);
	// var_dump($users); exit;


	// var_dump($totalRecord); exit;
	
	
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
 	<div class="container">
 		<div class="row">
 			<div class="col-md-12">
 				<nav class="navbar navbar-default" role="navigation">
 					<div class="container-fluid">
 						<!-- Brand and toggle get grouped for better mobile display -->
 						<div class="navbar-header">
 							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
 								<span class="sr-only">Toggle navigation</span>
 								<span class="icon-bar"></span>
 								<span class="icon-bar"></span>
 								<span class="icon-bar"></span>
 							</button>
 							<a class="navbar-brand" href="readData.php">User Information</a>
 						</div>
 				
 						<!-- Collect the nav links, forms, and other content for toggling -->
 						<div class="collapse navbar-collapse navbar-ex1-collapse">
 <!-- 							<ul class="nav navbar-nav">
 								<li class="active"><a href="#">Link</a></li>
 								<li><a href="#">Link</a></li>
 							</ul> -->
 							<form class="navbar-form navbar-left" role="search" method="GET">
 								<div class="form-group" style="padding-left: 75px">
 									<input type="text" class="form-control" placeholder="Input Keyword" name="keyword" value="<?php echo $keyword ?>">
 								</div>
 								<button type="submit" class="btn btn-primary">Search</button>
 							</form>
 								<p class="navbar-nav" style="padding-top: 14px; padding-left: 50px;">
    								<b>Total Record: <?php echo $totalRecord; ?></b>
    							</p>
 							<ul class="nav navbar-nav navbar-right">
 								<!-- <li><a href="#">Link</a></li> -->
 								<li class="dropdown">
 									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['name'] ?> <b class="caret"></b></a>
 									<ul class="dropdown-menu">
 										<li><a href="createData.php?page=<?php echo $totalPage ?>">Add New User</a></li>
 										<li><a href="logout.php">Log out</a></li>
 										
<!--  										<li><a href="#">Something else here</a></li>
 										<li><a href="#">Separated link</a></li> -->
 									</ul>
 								</li>
 							</ul>
 						</div><!-- /.navbar-collapse -->
 					</div>
 				</nav>
 			</div>
 		</div>
 		<div class="row">
 			<div class="col-md-12">
 				<table class="table table-hover">
 					<thead>
	 					<tr>
	 						<th>ID</th>
	 						<th>Full Name</th>
	 						<th>Username</th>
	 						<th>Password</th>
	 						<th>Gender</th>
	 						<th>Address</th>
	 						<th>Class</th>
	 						<th>Created At</th>
	 						<th>Option</th>
	 					</tr>
 					</thead>
 					<tbody>
 						<?php foreach ($users as $user): ?>
 							<tr>
 							<td><?php echo $user['id'] ?></td>
 							<td><?php echo $user['name'] ?></td>
 							<td><?php echo $user['username'] ?></td>
 							<td><?php echo $user['password'] ?></td>
 							<td><?php echo $user['gender'] == 1 ? "Male" : "Female"; ?></td>
 							<td><?php echo $user['address'] ?></td>
 							<td><?php echo $user['classname']; ?></td>
 							<td><?php echo $user['created_at'] ?></td>
 							<td>
 								<a href="formUpdate.php?keyword=<?= $keyword ?>&id=<?= $user['id'] ?>&page=<?= $page ?>" class="btn btn-primary">Edit</a>
 								<a href="deleteData.php?keyword=<?= $keyword ?>&id=<?= $user['id'] ?>&page=<?= $page ?>" class="btn btn-primary">Delete</a>
 							</td>
 						</tr>
 						<?php endforeach ?>
 						
 					</tbody>
 				</table>
 				<div>
 					<ul class="pagination">
 						<?php if ($page > 1): ?>
 							<li><a href="<?php echo $url ?>page=<?= $page - 1 ?>">&laquo;</a></li>
 						<?php endif ?>
 						
 						<?php 
 							for ($i=1; $i <= $totalPage ; $i++) { 
						?>
 								<li class="<?php echo $page == $i ? 'active' : '' ?>">
 									<a href="<?php echo $url ?>page=<?= $i ?>"><?php echo $i; ?></a>
 								</li>
 						<?php
 							}
 						 ?>
 						 <?php if ($page <= $totalPage - 1): ?>
 						 	<li><a href="<?php echo $url ?>page=<?= $page + 1 ?>">&raquo;</a></li>
 						 <?php endif ?>
 						
 					</ul>
 				</div>
 			</div>
 		</div>
 	</div>
 </body>
 </html>