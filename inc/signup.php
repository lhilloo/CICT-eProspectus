<?php 
   require_once ('inc_files.inc.php');
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="icon" href="../uploads/CICT.png" type="image/icon type">
    <title>CICT e-Prospectus System | Student Portal</title>>
</head>
<body>

<?php
   if (isset($_POST['submit'])) {
        $student_no      = $_POST['student_no'];
        $firstname       = $_POST['firstname'];
        $lastname        = $_POST['lastname'];
        $block           = $_POST['block'];
        $gender          = $_POST['gender'];
        $address         = $_POST['address'];
        $program         = $_POST['program'];
        $yearlevel       = $_POST['yearlevel'];
        $password        = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $status = 1;

        $studentsObj     = new Student();
        $student         = $studentsObj->getSignUp($student_no, $firstname, $lastname, $block, $gender, $address, $program, $yearlevel, $password, $status);
    }
?>

<section class="container-fluid col-lg-3 col-md-5">
    <div class="form my-5">
            <div class="login-form">
                <form action="signup.php" method="post" id="regForm">
                    <h2 class="title-head">SIGN UP</h2>

                        <label class="fw-lighter text-sm text-muted" style="font-size: 14px;">*you can't change your Student ID# after registration!</label>
                        <div class="form-group form-floating">
                            <input type="text" name="student_no" class="form-control" id="floatingID" placeholder="ex. 2077-00123" required>
                            <label class="form-label" for="floatingID">Student ID no.</label>
                        </div>
                         <div class="form-group form-floating">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Must be 8 to 20 characters long." required>
                            <label class="form-label" for="floatingPassword">Password</label>
                        </div>
                        <div class=" form-group row g-1">
                            <div class="col">
                                <div class="form-group form-floating">
                                    <input type="text" name="firstname" class="form-control" id="floatingFirstName" placeholder="Enter your first name" required>
                                    <label class="form-label" for="floatingFirstName">First Name</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group form-floating">
                                    <input type="text" name="lastname" class="form-control" id="floatingLastName" placeholder="Enter your last name" required>
                                    <label class="form-label" for="floatingLastName">Last Name</label>
                                </div>
                            </div>
                        </div>

                        <label class="fw-lighter text-sm text-muted" style="font-size: 14px;">*enter your permanent address! ex. barangay, municipality, province</label>
                        <div class="form-group form-floating">
                            <input class="form-control" type="text" name="address" id="floatingAddress" placeholder="Barangay/ Municipality/ Province" required>
                            <label class="form-label" for="floatingAddress">Address</label>
                        </div>
                        
                        <label class="fw-lighter text-sm text-muted" style="font-size: 14px;">*for newly enrolled students without assigned class block <br> *PLEASE DO NOT INPUT A BLOCK.</label>
                        <div class="form-group form-floating">
                                <select class="form-select" id="floatingBlock" name="block">
                                    <option selected disabled>Select assigned block</option>
                        <?php
                             $value = 0;
                             foreach(range('A','F') as $block){
                                 $value++;
                        ?>
                                    <option value="<?php echo $value; ?>">Block <?php echo $block?></option>
                        <?php
                             }                               
                        ?>
                                </select>
                            <label class="form-label" id="floatingBlock">Block</label>
                        </div>

                        <div class="form-group row g-1">
                            <div class="col">
                                <div class="form-group form-floating">
                                    <select class="form-select" id="floatingGender" name="gender" required>
                                        <option selected disabled>Select gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <label class="form-label" for="floatingGender">Gender</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group form-floating">
                                    <select class="form-select" id="floatingYear" name="yearlevel" required>
                                        <option selected disabled>Select year level</option>
                                        <option value="1">1st Year</option>
                                        <option value="2">2nd Year</option>
                                        <option value="3">3rd Year</option>
                                        <option value="4">4th Year</option>
                                    </select>
                                    <label class="form-label" for="floatingYear">Year Level</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-floating">
                                <select class="form-select" id="floatingProgram" name="program" required>
                                    <option selected disabled>Select enrolled program</option>
                                    <option value="1">BS INFORMATION TECHNOLOGY</option>
                                    <option value="2">BS INFORMATION SYSTEM</option>
                                    <option value="3">BS COMPUTER SCIENCE</option>
                                </select>
                            <label class="form-label" id="floatingProgram">Program</label>
                        </div>
                    <div class="form-group mt-3">
                        <input type="submit" name="submit" class="button" value="REGISTER">
                    </div>        
                </form>

                <p class="text-center mt-1 mb-5"><a href="../login">Already have an Account? Login here</a></p>
            </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html> 
