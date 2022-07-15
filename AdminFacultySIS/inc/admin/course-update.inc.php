<?php 
    include_once 'inc/config.inc.php';

   if (isset($_POST['submit'])) {
        $courseID = $_POST['courseID'];
        $courseCode = $_POST['courseCode'];
        $csuCourseCode = $_POST['csuCourseCode'];
        $courseUnit = $_POST['courseUnit'];
        $courseDesc = $_POST['courseDesc'];

        require_once "inc/admin/class.admin.php";
        $adminObj = new Admin;

        $result = $adminObj->updateCourse($courseID, $courseCode, $csuCourseCode, $courseDesc, $courseUnit);

        if ($result) {
            echo 
                '<script language="javascript">
                  alert("Course successfully updated!");
                  window.location.href = "index.php?content=course-list";
                </script>';
         } else {
            echo
            '<script language="javascript">
              alert("Course update failed!");
              window.location.href = "index.php?content=course-update";
            </script>';
        }

        
    } else {
        if (isset($_GET['id'])) {
            $courseCode = $_GET['id'];
            $courseID;
            $csuCourseCode; 
            $courseDesc;
            $courseUnit;
            require_once "inc/courses.inc.php";
            $courseObj = new Courses;

            $course = $courseObj->getCourseCode($courseCode);
            foreach ($course as $row) {
                $courseID = $row['course_id'];
                $csuCourseCode = $row['course_csccode'];
                $courseUnit = $row['course_unit'];
                $courseDesc = $row['course_desc'];
        
?>
<div class="main-contents d-flex justify-content-center align-middle ">
  <div class="header">
    <h6>Update Course</h6>
  </div>
</div>

<section class="d-flex justify-content-center align-middle">
    <div class="form">
            <div class="login-form">
                <form action="index.php?content=course-update" method="post" id="regForm">
                    
                           
                    <div>
                        <div class="form-group">
                    
                    <div class="input-group">
                        <div class="input-group-prepend" >
                            <div class="input-group-text">Course Code</div>
                        </div>
                        <input type="text" name="courseCode" class="form-control" style="width: 150px;" value="<?php echo $courseCode; ?>" required="required">
                    <hr class="mx-1">
                    <div class="input-group-prepend" style="margin-left:3px;">
                            <div class="input-group-text">CSU Course Code</div>
                        </div>
                    <input type="text" name="csuCourseCode" class="form-control" style="width: 150px;" value="<?php echo $csuCourseCode; ?>" >
                        <div class="input-group-prepend" style="margin-left:10px;">
                            <div class="input-group-text"> Course Unit</div>
                        </div>
                    <input type="text" name="courseUnit" class="form-control" style="width: 100px;" value="<?php echo $courseUnit; ?>" required="required">
                    </div>
                      </div>
                        <div class="form-group">
                            <label class="form-label">Course Description</label>
                            <input type="text" name="courseDesc" class="form-control" value="<?php echo $courseDesc; ?>" required="required">
                        </div>
                        
                            
                        
                    </div>

                  <input type="hidden" name="courseID" value="<?php echo $courseID; ?>">
                    <div class="form-group mt-3" style="text-align: center;">
                        <input type="submit" name="submit" class="button btn-primary" value="Update Course" style="width:200px; padding: 10px; border: none;">
                        <a href="index.php?content=course-list" class="btn-danger" style="color: #FFF; width:200px; padding: 10.5px 60px; border: none;">Cancel</a>
                    </div>        
                </form>

                
            </div>
    </div>
</section>


<?php 

    }
        }
    }
?>
