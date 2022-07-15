<?php
	if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {

        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        die();

    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Student Information System</title>
</head>
<body>
	<nav id="header" class="header fixed-top">
		<div class="banner-title">
			<a class="header-logo">
			<img src="uploads/catsu_logo.png" class="img-fluid d-inline-block align-center" alt="CATSU-LOGO">
		    CATSU STUDENT INFORMATION SYSTEM 
			</a>
		</div>
	</nav>

	<script>
		window.onscroll = function() {
			scrollFunction()
		};

		function scrollFunction() {
		  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
		    document.getElementById("header").style.top = "0";
		  } else {
		    document.getElementById("header").style.top = "-100px";
		  }
		}
	</script>
</body>
</html>