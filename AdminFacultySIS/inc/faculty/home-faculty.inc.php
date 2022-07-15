<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }
  require_once('inc/faculty/faculty.inc.php');
  require_once('inc/courses.inc.php');
  require_once('inc/program.inc.php');
  require_once('inc/grades.inc.php');
  require_once('inc/student.inc.php');
?>

  <?php
    if (isset($_POST['remove'])) {
      if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['addedcourse'] as $key => $value) {
          if ($value['course_id'] == $_GET['id']) {
            unset($_SESSION['addedcourse'][$key]);
            unset($_SESSION['postdata']);
            echo "<script language\"javascript\">alert('Selected course has been removed from your dashboard.')</script>";
          }
        }
      }
    }
  ?>

<div class="main-contents d-flex justify-content-center align-middle col-auto col-md-3 col-xl-2 px-sm-2 px-0 ">
  <div class="header">
    <h4>Courses Teaching</h4>
  </div>
</div>


<!-- Table for the Courses -->

<div class="main-contents-table container text-center">
  <?php
    $numCols   = 3;
    $countRow  = 0;
    $bootstrapColWidth = 12 / $numCols;
  ?>
  <div class="row table-custom mx-auto mb-5">

  <?php

    $addedCourseObj = new Faculty();
    $addedCourse    = $addedCourseObj->addCourse();
    if (empty($_SESSION['addedcourse'])) {
      ?>
          <img src="uploads/nodata.png" class="w-50 h-auto mx-auto mt-5">
      <?php
      echo '<h6 class="lead" >No courses have been added to dashboard.</h6>';
    } else {
    $addedcourse_id = array_column($_SESSION['addedcourse'], 'course_id');
    $programObj = new Program();
    $programs   = $programObj->getProgramlist();
    if (empty($programs)) {
      echo "No Data.";
    } else {
      for ($p=0; $p < count($programs); $p++) { 
        $program_id   = $programs[$p]['program_id'];
        $program_name = $programs[$p]['program_name'];

        $courseObj = new Courses();
        $courses = $courseObj->getCourselist();
        if (empty($courses)) {
          echo "No Data.";
        } else {
          for ($c=0; $c < count($courses); $c++) { 
            if ($courses[$c]['course_program'] == $programs[$p]['program_id'] && $courses[$c]['course_college'] == $programs[$p]['program_college']) {
              $courses[$c]['course_faculty'] = $_SESSION['loggedin'];
              $course_id      = $courses[$c]['course_id'];
              $course_code    = $courses[$c]['course_code'];
              $course_program = $courses[$c]['course_program'];
              $course_faculty = $courses[$c]['course_faculty'];
              $course_level   = $courses[$c]['course_level'];

              foreach ($addedcourse_id as $id) {
                if ($course_id == $id) {

                  if ($course_level == 1) {
                    $yearlevel = " 1st Year";
                  } elseif ($course_level == 2) {
                    $yearlevel = " 2nd Year";
                  } elseif ($course_level == 3) {
                    $yearlevel = " 3rd Year";
                  } else {
                    $yearlevel = " 4th Year";
                  }

                 
  ?>
    <div class="col-md-<?php echo $bootstrapColWidth ?>">
      <!-- First Table -->

      <table class="table table-bordered">
        <thead>
          <th colspan="3" style="background-color: #fff566; color: #1c1c1c;"><?php echo $yearlevel; ?></th>
        </thead>
        <thead>
          <th scope="col" style="color:#4879FF; width: 200px;"><?php echo $course_code; ?></th>
          <th scope="col" style=" width: 150px;"></th>
          <th scope="col" style="">
            <form method="POST" action="index.php?action=remove&id=<?php echo $id?>">
              <button class="btn btn-danger float-end m-0 p-0" onclick="return confirm('Do you want to remove <?php echo $course_code; ?> from your dashboard?');" name="remove" style="width:40px; height: 40px;">
              <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
              </span>
              </button>
            </form>
          </th>
        </thead>
        <?php
          $studentsObj = new Student();
          $students    = $studentsObj->getStudentInfo();
          if (empty($students)) {
            echo "No data.";
          } else { 
            $count = 0;

            foreach ($students as $student) {
              $student_yearlevel = $student['yearlevel'];
              $student_program   = $student['program'];
                
              if ($course_level == $student['yearlevel']) {
                if ($course_program == $student['program']) {
                  if ($student['block'] != null) {
                    $count++;
                    $count;
                  }
                }
              }
              $studentsEnrolled = $count;
            }

                $gradeObj = new Grades();
                $grades   = $gradeObj->getStudentGraded();
                $gradedCount = 0;
                foreach($grades as $grade){
                    if($course_id == $grade['grade_courseid']){
                        $gradedCount++;
                        $gradedCount;
                    }
                    $gradedStudents = $gradedCount;
                }

                $ungradedStudents = $studentsEnrolled - $gradedStudents;
        ?>
        <tbody>
          <tr>
            <td>No. of Students Enrolled:</td>
            <td colspan="2"><?php  echo $studentsEnrolled; ?></td>
          </tr>
          <tr>
            <td>No. of Students Graded:</td>
            <td colspan="2"><?php echo $gradedStudents; ?></td>
          </tr>
          <tr>
            <td>No. of Students Ungraded:</td>
            <td colspan="2"><?php echo $ungradedStudents ?></td>
          </tr>
          <tr>
            <td colspan="3" class="col p-0" >
              <form action="index.php?content=student-list" method="post">
                <input type="hidden" name="course_code" value="<?php echo $course_code;   ?>">
                <input type="hidden" name="year_level"  value="<?php echo $course_level; ?>">
                <input type="hidden" name="program"     value="<?php echo $program_id;   ?>">
                <button type="submit" name="posted" class="viewBtn">View list of students</i></button>
               </form> 
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <?php           
                    }
                  //students loop
                  }
                }
              }
            }
          }
        }
      }
    }
    ?>

    
  <?php
    $countRow++;
    if ($countRow % $numCols == 0) {
      echo '</div><div class="row">';
    }
  ?>
  </div>
</div>
<!-- End of Table Div -->

<div class="main-contents d-flex justify-content-center align-middle col-auto col-md-3 col-xl-2 px-sm-2 px-0">
    <div class="footer mt-5">
      <div class="floating-btn fixed-button">
      <a href="index.php?content=course-list"><button type="button" name="button" class="btn btn-primary shadow rounded-pill mb-5"><i class="fas fa-plus" style="margin-right: 10px;"></i>View  All Courses</button></a>
    </div>
  </div>
</div>