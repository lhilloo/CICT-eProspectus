<?php 
    include_once 'inc/config.inc.php';

   if (isset($_POST['submit'])) {
        
        $firstname = $_POST['firstname'];
        $middlename = $_POST['middlename'];
        $lastname = $_POST['lastname'];
        $username = $firstname;
        $userpass = password_hash($lastname, PASSWORD_DEFAULT);
        $userRole = $_POST['userRole'];
        $facultyLevel = $_POST['facultyLevel'];
        $collegeName = $_POST['college'];
        $status = 1;

        require_once "inc/admin/class.admin.php";
        $adminObj = new Admin();

        $faculties = $adminObj->allFaculty();
        foreach ($faculties as $faculty) {
            if ($firstname == $faculty['faculty_fname'] && $middlename == $faculty['faculty_mname'] && $lastname == $faculty['faculty_lname'] && $userRole == $faculty['user_role'] && $facultyLevel == $faculty['faculty_level'] && $collegeName == $faculty['college_name']) {
                echo 
                '<script language="javascript">
                  alert("Faculty already added!");
                  window.location.href = "index.php?content=add-faculty&error=facultyexist";
                </script>';
                exit();
            }
        }

        $result = $adminObj->addFaculty($firstname, $middlename, $lastname, $username, $userpass, $userRole, $facultyLevel,$collegeName, $status);

        if ($result) {
            $facultyID = $adminObj->getFacultyID($firstname, $lastname);

            if (!empty($facultyID)) {
                $stmt = $adminObj->facultyProfileImg($facultyID);

                if ($stmt) {
                    echo
            '<script language="javascript">
              alert("Successfully inserted Faculty!");
              window.location.href = "index.php?content=faculty-list";
            </script>';

            //$stmt if end
                } else {
                    echo
                        '<script language="javascript">
                          alert("Failed to insert profile img!");
                          window.location.href = "index.php?content=faculty-list";
                        </script>';
                }
            } else {
                echo
            '<script language="javascript">
              alert("No faculty id gathered!");
              window.location.href = "index.php?content=faculty-list";
            </script>';
            }

         //end of if($result)   
        } else {
            echo
            '<script language="javascript">
              alert("Faculty insertion failed!");
              window.location.href = "index.php?content=faculty-list";
            </script>';
        }

        
    }
?>
<div class="main-contents d-flex justify-content-center align-middle ">
  <div class="header">
    <h6>Add Faculty</h6>
  </div>
</div>

<section class="d-flex justify-content-center align-middle">
    <div class="form">
            <div class="login-form">
                <form action="index.php?content=add-faculty" method="post" id="regForm">
                    
                           
                    <div>
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control" placeholder="Enter first name" required="required">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middlename" class="form-control" placeholder="Enter middle name" required="required">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastname" class="form-control" placeholder="Enter last name" required="required">
                        </div>
                        <div class="form-group">
                            <label class="form-label">User Role</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Role</div>
                                </div>
                            <select class="form-select" name="userRole" required>
                                <option value="faculty">Faculty</option>
                            </select>
                            <hr class="mx-1">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Faculty Level</div>
                                </div>
                                <input class="form-control" type="text" name="facultyLevel" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">College</label>
                            <select class="form-select" name="college" required>
                                <?php 
                                require_once 'inc/admin/class.admin.php';
                                $adminObj = new Admin();
                                $colleges = $adminObj->getColleges();
                                foreach ($colleges as $college) {
                                    $collegeName = $college['college_name'];
                                    $collegeDesc = $college['college_desc'];
                                

                                ?>
                                <option value="<?php echo $collegeName; ?>"><?php echo $collegeDesc;?></option>
<?php } ?>

                            </select>
                            <!-- <input type="text" name="college" class="form-control" placeholder="Enter college" required="required"> -->
                        </div>
                    </div>

                  
                    <div class="form-group mt-3" style="text-align: center;">
                        <input type="submit" name="submit" class="button btn-primary" value="Add Faculty" style="width:200px; padding: 10px; border: none;">
                    </div>        
                </form>

                
            </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html> 
