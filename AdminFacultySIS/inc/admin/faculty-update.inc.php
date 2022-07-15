<?php 
if (isset($_POST['submit'])) {
    $facultyID = $_POST['facultyID'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $facultyLevel = $_POST['facultyLevel'];
    $collegeName = $_POST['college'];

    require_once "inc/admin/class.admin.php";
    $adminObj = new Admin();
    $result = $adminObj->updateFaculty($facultyID, $firstname, $middlename, $lastname, $facultyLevel, $collegeName);

    if ($result) {
          echo
            '<script language="javascript">
              alert("Successfully updated faculty!");
              window.location.href = "index.php?content=faculty-list";
            </script>';
    } else {
          echo
            '<script language="javascript">
              alert("Failed to update faculty!");
              window.location.href = "index.php?content=faculty-list";
            </script>';
    }

}

if (isset($_GET['id'])) {
    $facultyID = $_GET['id'];

    require_once "inc/admin/class.admin.php";
    $adminObj = new Admin();
    $faculty = $adminObj->getFaculty($facultyID);




?>

<div class="main-contents d-flex justify-content-center align-middle ">
  <div class="header">
    <h6>Edit Faculty Details</h6>
  </div>
</div>

<section class="d-flex justify-content-center align-middle">
    <div class="form">
            <div class="login-form">
                <form action="index.php?content=faculty-update" method="post" id="regForm">
                    
                           
                    <div>
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <input type="text" name="firstname" class="form-control" value="<?php echo $faculty[0]['faculty_fname'] ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middlename" class="form-control" value="<?php echo $faculty[0]['faculty_mname'] ?>" required="required">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="lastname" class="form-control" value="<?php echo $faculty[0]['faculty_lname'] ?>" required="required">
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
                                <input class="form-control" type="text" name="facultyLevel" value="<?php echo $faculty[0]['faculty_level'] ?>"required>
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
                                <option value="<?php echo $collegeName; ?>" <?php if ($faculty[0]['college_name'] == $collegeName) {
                                    echo 'selected';
                                } ?>><?php echo $collegeDesc;?></option>
<?php } ?>

                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="facultyID" value="<?php echo $facultyID;?>">

                  
                    <div class="form-group mt-3" style="text-align: center;">
                        <input type="submit" name="submit" class="button btn-success" value="Update Faculty" style=" padding: 10px; border: none;">
                        <button class="button btn-danger" style="padding: 10px; border: none;"><a href="index.php?content=faculty-list" style="color:#FFF; ">Cancel</a></button>
                    </div>        
                </form>

                
            </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<?php 

//isset getid end
}

?>