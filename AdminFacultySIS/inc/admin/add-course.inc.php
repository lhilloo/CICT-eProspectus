<?php 
    include_once 'inc/config.inc.php';

   if (isset($_POST['submit'])) {
      
        $courseCode = $_POST['courseCode'];
        $csuCourseCode = $_POST['csuCourseCode'];
        $courseUnit = $_POST['courseUnit'];
        $courseDesc = $_POST['courseDesc'];
        $college = $_POST['college'];
        $program = $_POST['programID'];
        $courseLevel = $_POST['courseLevel'];
        $courseSem = $_POST['courseSem'];
        $status = 1;

        require_once "inc/admin/class.admin.php";
        require_once "inc/courses.inc.php";
        $courseObj = new Courses;
        $adminObj = new Admin();

        $courses = $courseObj->getCourselist();
        foreach ($courses as $course) {
            if ($courseCode == $course['course_code'] && $csuCourseCode == $course['course_csccode'] && $courseUnit == $course['course_unit'] && $courseDesc == $course['course_desc'] && $college == $course['course_college'] && $program == $course['course_program'] && $courseLevel == $course['course_level'] && $courseSem == $course['course_sem']) {
                echo 
                '<script language="javascript">
                  alert("Course already added!");
                  window.location.href = "index.php?content=add-course&error=courseexist";
                </script>';
                exit();
            }
        }

        $result = $adminObj->addCourse($courseCode, $college, $csuCourseCode, $courseDesc, $courseLevel, $courseSem, $program, $courseUnit, $status);

        if ($result) {
            echo 
                '<script language="javascript">
                  alert("Course successfully added!");
                  window.location.href = "index.php?content=add-course&error=none";
                </script>';
         } else {
            echo
            '<script language="javascript">
              alert("Course insertion failed!");
              window.location.href = "index.php?content=add-course";
            </script>';
        }

        
    }
?>
<div class="main-contents d-flex justify-content-center align-middle ">
  <div class="header">
    <h6>Add Course</h6>
  </div>
</div>

<section class="d-flex justify-content-center align-middle">
    <div class="form">
            <div class="login-form">
                <form action="index.php?content=add-course" method="post" id="regForm">
                    
                           
                    <div>
                        <div class="form-group">
                    
                    <div class="input-group">
                        <div class="input-group-prepend" >
                            <div class="input-group-text">Course Code</div>
                        </div>
                        <input type="text" name="courseCode" class="form-control" style="width: 150px;" placeholder="Enter course code" required="required">
                    <hr class="mx-1">
                    <div class="input-group-prepend" style="margin-left:3px;">
                            <div class="input-group-text">CSU Course Code</div>
                        </div>
                    <input type="text" name="csuCourseCode" class="form-control" style="width: 150px;" placeholder="Enter CSU course code" required="required">
                        <div class="input-group-prepend" style="margin-left:10px;">
                            <div class="input-group-text"> Course Unit</div>
                        </div>
                    <input type="text" name="courseUnit" class="form-control" style="width: 100px;" placeholder="Enter course unit" required="required">
                    </div>
                </div>
                        <div class="form-group">
                            <label class="form-label">Course Description</label>
                            <input type="text" name="courseDesc" class="form-control" placeholder="Enter course description" required="required">
                        </div>
                        <div class="form-group">
                            <label class="form-label">College</label>
                            <select id="college" class="form-select" name="college" required>
                                <option value="">-- Select college --</option>
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
                        <div class="form-group">
                            <label class="form-label">Program</label>
                            <select id="program" class="form-select" name="programID" required>
                                <option value="">-- Select program --</option>
                  

                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Course Details</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Course Level</div>
                                </div>
                            <select class="form-select" name="courseLevel" required>
                                <option value="">-- Select year level --</option>
                            <?php 
                            require_once 'inc/admin/class.admin.php';
                            $adminObj = new Admin();
                            $years = $adminObj->getAllYearLevel();

                            foreach ($years as $year) {
                                $yearID = $year['year_id'];
                                $yearLevel = $year['year_level'];

                                echo '
                                    <option value="'.$yearID.'">'.$yearLevel.'</option>
                                ';
                            }

                            ?>
                                
                            </select>

                            <hr class="mx-1">

                            <div class="input-group-prepend">
                                <div class="input-group-text">Course Sem</div>
                            </div>
                            <select class="form-select" name="courseSem" required>
                                <option value="">-- Select semester --</option>
                                <?php 
                            require_once 'inc/admin/class.admin.php';
                            $adminObj = new Admin();
                            $sem = $adminObj->getSem();

                            foreach ($sem as $row) {
                                $semID = $row['sem_id'];
                                $semName = $row['sem_name'];

                                echo '
                                    <option value="'.$semID.'">'.$semName.'</option>
                                ';
                            }

                            ?>
                                
                            </select>
                            </div>
                        </div>
                        
                    </div>

                  
                    <div class="form-group mt-3" style="text-align: center;">
                        <input type="submit" name="submit" class="button btn-primary" value="Add Course" style="width:200px; padding: 10px; border: none;">
                        <a href="index.php?content=course-list" class="btn-danger" style="color: #FFF; width:200px; padding: 10.5px 60px; border: none;">Cancel</a>
                    </div>        
                </form>

                
            </div>
    </div>
</section>
<script>
$(document).ready(function(){
    $('#college').on('change', function(){
        var college = $(this).val();
        if(college){
            $.ajax({
                type:'POST',
                url:'inc/ajaxProgramData.php',
                data:'college=' +college,
                success:function(html){
                    $('#program').html(html);
                }

            }); 
        }else{
            $('#program').html('<option value="">Select college first</option>');
            
        }
    });
    
   
});
</script>

<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html> 
