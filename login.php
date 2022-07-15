<?php
    require_once ('inc/inc_files.inc.php');

    session_start();

   if(isset($_SESSION["loggedin"])) {
    header("location: index");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="icon" href="uploads/CICT.png" type="image/icon type">
    <title>CICT e-Prospectus System | Student Portal</title>
</head>
<body>

<?php

    if (!isset($_SESSION['loggedin'])) {
        if (isset($_POST['submit'])) {
        
        $student_no  = $_POST['student_no'];
        $password    = $_POST['password'];

        $studentsObj = new Student();
        $student     = $studentsObj->getLogin($student_no, $password);
        }
    }
?>

<!--
    <div class="form">
        <img class="logo" src="uploads/catsu_logo.png" width="100px" height="100px">
            <div class="px-4">
                <form action="login" method="post">
                <div style="margin-top: 60px;">
                    <h2 class="title-head text-center fs-5">CatSU SIS Student Portal</h2>
                    <h2 class="title-head">SIGN IN</h2>
                </div>       
                <div class="form-group form-floating">
                    <input type="text" name="student_no" class="form-control" id="floatingStudenID" placeholder="Enter your student number" required="required">
                    <label class="form-label" for="floatingStudenID">Student ID no.</label>
                </div>
                <div class="form-group form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Enter your password" required="required">
                    <label class="form-label" for="floatingPassword">Password</label>
                </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="button" value="LOGIN">
                    </div>        
                </form>
                <p class="text-center"><a href="inc/signup">Create an Account</a></p>
            </div>
    </div>
-->


<section class="container-fluid col-lg-3 col-md-5 mt-2">
    <div class="form" style="margin-top: 150px;">
        <div class="login-form">
            <div class="login-form">
                <form action="login" method="post">
                    <h2 class="title-head">SIGN IN</h2>       
                    <div class="form-group form-floating">
                        <input type="text" name="student_no" class="form-control" id="floatingStudenID" placeholder="Enter your student number" required="required">
                        <label class="form-label" for="floatingStudenID">Student ID no.</label>
                    </div>
                    <div class="form-group form-floating">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Enter your password" required="required">
                        <label class="form-label" for="floatingPassword">Password</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="button" value="LOGIN">
                    </div>        
                </form>
                <p class="text-center"><a href="inc/signup">Create an Account</a></p>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html> 
