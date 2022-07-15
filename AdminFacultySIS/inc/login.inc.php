<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }

include "config.inc.php";

if(isset($_POST["submit"])) {
    $userType = $_POST["userType"];
    $username = $_POST["username"];
	$pwd = $_POST["password"];

    if($userType == "faculty") {

        $sql = "SELECT * FROM catsu_faculty WHERE username = ? AND user_pass = ?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../login.php?error=stmtfailed");
			exit();
		} else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $user_pass);
		    mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
		    
            if ($row = mysqli_fetch_assoc($resultData)) {
                if($row==1){
                    $_SESSION['username'] = $username;
                    // Redirect user to index.php
                    header("Location: ../index.php");
                    exit();
                } else {
                    header("location: ../login.php?error=wrongcredentials");
                    exit();
                }
            }
        }
    } else if ($userType == "admin") {
        $sql = "SELECT * FROM catsu_admin WHERE admin_username = ? AND admin_password = SHA2(?,256);";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("location: ../login.php?error=stmtfailed");
			exit();
		} else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $user_pass);
		    mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
		    
            if ($row = mysqli_fetch_assoc($resultData)) {
                if($row==1){
                    $_SESSION['username'] = $username;
                    // Redirect user to index.php
                    header("Location: ../index.php");
                    exit();
                } else {
                    header("location: ../login.php?error=wrongcredentials");
                    exit();
                }
            }
        } 

    }
}
else {
	header("location: ../login.php");
	exit();
	}