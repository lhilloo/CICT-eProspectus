<?php
	/**
	 * include file
	 * */
	include ('inc/inc_files.inc.php');

	/**
	 * start session
	 * */
	session_start();

	/**
	 * logs out user if session var is unset
	 * */
	if (!isset($_SESSION['loggedin'])) {
		header('location: login');
		exit();
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="icon" href="uploads/catsu_logo.png" type="image/icon type">
	<title>CatSU SIS | Student Portal</title>
</head>
<body style="background: linear-gradient(193deg, rgba(140,171,255,1) 0%, rgba(189,255,252,1) 43%, rgba(255,255,255,1) 100%); background-size: cover; background-repeat: no-repeat;">

<div class="container-fluid px-0">
	<div class="row flex-nowrap">
		<div class="col px-0 content">
			<!--header-->
			<header>
				<?php
					include ('inc/header.inc.php');
				?>
			</header>
			<!-- end of header -->
			<!--main content-->
			<main class="container-fluid px-0 mx-auto py-0 mt-0" style="background-color: #fff;">
				<?php
					if (isset($_SESSION['loggedin'])) {
						if (isset($_REQUEST['content'])) {
							include ('inc/student/'.$_REQUEST['content'].'.inc.php');
						} else {
							include ('inc/student/home.inc.php');
						}
					} else {
						header('location: login');
					}
				?>
			</main>
			<!-- end of main -->

		</div>
	</div>
</div>
	<script src="js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>