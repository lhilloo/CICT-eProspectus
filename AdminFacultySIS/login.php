<?php
    require_once 'inc/config.inc.php';

    session_start();

   if(isset($_SESSION["loggedin"])) {
    header("location: index.php");
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
    <title>Student Information System</title>
</head>
<body>

<?php

    if (!isset($_SESSION['loggedin'])) {
    if (isset($_POST['submit'])) {
        
        $userType = $_POST['userType'];
        $username = $_POST['username'];
        $password = $_POST['userpass'];

        if (!empty($username) || !empty($userpass)) {
            if ($userType == "faculty"){
                $query = "SELECT * FROM catsu_faculty WHERE username = '$username'";
                $result = $conn->query($query);
                $count = $result->num_rows;
                    if ($count == 1) {
                        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                            $userpass = $row['user_pass'];
                            $status = $row['status'];

                            if ($status == 1) {
                                // active faculty user
                            

                            if (password_verify($password, $userpass)) {
                                $_SESSION['loggedin']   = $row['facultyID']; 
                                $_SESSION['faculty_username'] = $row['faculty_fname'] . " " . $row['faculty_lname'];
                                $_SESSION['userRole'] = $row['user_role'];
                                header("Location: index.php");
                            } else {
                                echo '<script language="javascript">alert("Wrong username or password");</script>';
                            }
                            } // end status
                            elseif ($status == 0) {
                                echo '<script language="javascript">
                                alert("Account disabled, please contact the admin for further notice.");
                                window.location.href = "login.php";
                                </script>';
                            }
                            else {
                                echo '<script language="javascript">
                                alert("Account disabled, please contact the admin for further notice.");
                                window.location.href = "login.php";
                                </script>';
                            }
                        } //while row end
                    } // end count == 1 
                    else {
                        echo '<script language="javascript">alert("Wrong username or password");</script>';
                    }
            } else if ($userType == "admin"){
                $query = "SELECT admin_id FROM catsu_admin WHERE admin_username = ? AND admin_password = SHA2(?,256)";
                $result = $conn->prepare($query);
                $result->bind_param("ss", $username,$password);
                $result->execute();
                $result->bind_result($adminID);
                $result->fetch();

                if (isset($adminID)) {
                    $_SESSION['loggedin'] = $adminID; 
                    $_SESSION['userRole'] = "admin";
                    header("Location: index.php");
                } else {
                    echo '<script language="javascript">alert("Wrong username or password");</script>';
                }
                     
            }
            
            
        } else {
            echo '<script language="javascript">alert("Username and password is required");</script>';
        }
    }
        $conn->close();
    }
?>

<section class="container-fluid col-lg-3 col-md-5 mt-2 justify-content-center align-content-center">
    <div class="form ">
        <div class="login-form">
            <div class="login-form">
                <form action="login.php" method="post">
                    <h2 class="title-head">SIGN IN</h2>
                    <div class="form-group">
                        <label class="form-label">User Type</label>
                        <select name="userType" id="userType" style="margin: 0 0 20px 30px;" autofocus>
                            <option value="faculty">Faculty</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>       
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter your username" required="required" >
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="userpass" class="form-control" placeholder="Enter your password" required="required">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="button" value="LOGIN">
                    </div>        
                </form>
                
            </div>
        </div>
    </div>
</section>
  <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html> 
