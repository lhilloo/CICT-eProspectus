<?php 

session_start();
include "inc/head.inc.php";
$user_role = ucwords($_SESSION['userRole']);
$title = "CATSU SIS | ";


?>
<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    
    <!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    

    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>



    <link rel="stylesheet" href="css/faculty.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/admin.css">
    <title><?php echo $title . $user_role; ?> </title>
</head>
<body>

<div class="container-fluid">
    <div class="row flex-nowrap">

        <!-- Sidebar -->
        <?php include "inc/sidenav.inc.php" ?>
        <!-- End of Sidebar -->

        <div class="col py-3 content">

        <!-- Header -->
            <header>
              <div class="banner-title">
	            	<a class="header-logo">
		            	<img src="uploads/catsu_logo.png" class="img-fluid d-inline-block align-center mx-2" alt="CATSU-LOGO">
		              CATSU STUDENT INFORMATION SYSTEM 
			          </a>
	        	  </div>
            </header>
        <!--End of Header -->

        <!-- Main -->
            <main style="margin-left: 250px;">
            <?php
		          if (isset($_SESSION['loggedin'])) {
                      if ($_SESSION['userRole'] == 'admin') {
                        if(isset($_REQUEST['content']))  {
                            include("inc/admin/".$_REQUEST['content'] . ".inc.php");
                        } else {
                            include("inc/admin/home-admin.inc.php");
                        }
                      } else {
                        if(isset($_REQUEST['content']))  {
                            include("inc/faculty/".$_REQUEST['content'] . ".inc.php");
                        } else {
                            include("inc/faculty/home-faculty.inc.php");
                        }
                      }
                
              } else {
                 header("location: login.php") ;
               } ?>
            </main>
        <!--End of Main -->

        </div>
    </div>
</div>

   <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.0/moment.min.js'></script>
    <script type="text/javascript" src="js/function.js"></script>


</body>
</html>
