<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }

  include_once 'inc/year.inc.php';
  include_once 'inc/courses.inc.php';
  include_once 'inc/program.inc.php';
  include_once 'inc/student.inc.php';
  include_once 'inc/block.inc.php';
  include_once 'inc/year.inc.php';
  include_once 'inc/grades.inc.php';
?>

<!--start of main content-->
<div class="main-contents container-fluid justify-content-center align-middle col-auto col-md-3 col-xl-2 px-sm-2 px-0 ">
<?php
  if (isset($_SESSION['loggedin'])) {
    $id = $_SESSION['loggedin'];
    //start retrieving data= 
    $postdataObj = new Faculty();
    $session_data = $postdataObj->getStudentData();
    if (!empty($_SESSION['studentpost'])) {
     print_r($session_data);
     $studentpost = array_values($_SESSION['studentpost']);
     for ($i = 0; $i < count($studentpost); $i++) {
       $poststudent_id = $_SESSION['studentpost']['student_id'];
     }
?>
<!-- object creation -->
<?php
  $studentObj = new Student();
  $students = $studentObj->getStudent($poststudent_id);
  if (empty($students)) {
    echo "<h4>No Data.</h4>";
  } else {
    foreach ($students as $student) {
      $student_id   = $student['student_id'];
      $student_name = $student['firstname'] ." ". $student['lastname'];
      $student_no   = $student['student_no'];
      
      $blockObj = new Block();
      $blocking = $blockObj->getBlock($student['block']);
        foreach ($blocking as $block) {
          $student_block = $block['block_name'];
        }
      $yearObj = new YearLevel();
      $years   = $yearObj->getYearLevel($student['yearlevel']);
        foreach ($years as $year) {
          $student_year = $year['year_level'];
        }
      $programObj = new Program();
      $programs = $programObj->getProgram($student['program']);
      foreach ($programs as $program) {
        $student_programid = $program['program_id'];
        $student_program = $program['program_name'];
      }
    }
?>
  <!--start of prospectus-->
  <div class="border mx-auto mb-5">
  <!--header-->
    <div class="prospectus">
      <h3>Student Prospectus</h3>
    </div>

    <!--studentinfo-->
  <div class="student-profile justify-content-center align-middle">

    <div class="container">
      <div class="row">
          <div class="wrapper col-md-5" style="margin-right: 50px;">
              <?php 
                $studentProfile = $studentObj->getStudentPF($poststudent_id);
                echo $studentProfile;
              ?>
          </div>
          <div class="wrapper col-md-6">
            <div class="container" style="margin-top: 35px;">
              <table class="table table-bordered table-sm">
              <tbody>
                <tr>
                  <td style="width: 150px;">Name:</td>
                  <td style="width: 350px;"><?php echo $student_name ?></td>
                </tr>
                <tr>
                  <td style="width: 150px;">Student ID No.:</td>
                  <td style="width: 350px;"><?php echo $student_no ?></td>
                </tr>
                <tr>
                  <td style="width: 150px;">Block:</td>
                  <td style="width: 350px;"><?php echo $student_block ?></td>
                </tr>
                <tr>
                  <td style="width: 150px;">Year Level:</td>
                  <td style="width: 350px;"><?php echo $student_year ?> Year</td>
                </tr>
                <tr>
                  <td style="width: 150px;">Program:</td>
                  <td style="width: 350px;"><?php echo $student_program ?></td>
                </tr>
              </tbody>
            </table>
            </div>
          </div>
      </div>
    </div>
  </div>
  <!-- courses -->
  <?php
    $yearObj = new YearLevel();
    $years   = $yearObj->getAllYearLevel();
    foreach ($years as $year) {
  ?>
    <table class="table student-grades table-hover mb-2">
      <thead class="table-head"><tr><th style="font-size: 20px;" colspan="6"> <?php echo $year['year_name']?> Year</th></tr></thead>
  <?php
      $semesterObj = new Courses();
      $semester = $semesterObj->getSemester();
      foreach ($semester as $sem) {
  ?>
      <thead><tr><td colspan="6" class="font-weight-normal py-3" style="border: none; color: #4879FF;"><?php echo $sem['sem_name']?> Semester</td></tr></thead>
      <thead>
        <th style="color: #4879FF; width: 80px;">Semester</th>
        <th style="color: #4879ff; width: 80px;">CSU Code</th>
        <th style="color: #4879FF; width: 100px;">Course Code</th>
        <th style="color: #4879FF; width: 400px;">Course Description</th>
        <th style="color: #4879FF; width: 100px;">Course Units</th>
        <!--<th style="color: #4879FF; width: 150px;">Midterm Grade</th>-->
        <th style="color: #4879FF; width: 150px;">Final Grade</th>
      </thead>
  <?php
        $courseObj = new Courses();
        $courses = $courseObj->getCourseInfo($student['program']);
        if ($courses == null) {
  ?>
      <table class="table">
          <h4 class="mt-4 mb-3">No retrievable course data.</h4>
          <td style="border-color: #1c1c1c;"></td>
      </table>  
  <?php
          break;
        } else {
          //$midtermsum = 0;
          $finalsum   = 0;
          $count = 0;
          $count_empty = 0;
          foreach ($courses as $course) {
            $course_id = $course['course_id'];
            if ($course['course_level'] == $year['year_id']) {
              if ($course['course_sem'] == $sem['sem_id']) {

              $gradeObj = new Grades();
              $grades   = $gradeObj->getGrades($student_id, $course_id);
              $grade_final = 0;
              //$grade_midterm = 0;

              foreach ($grades as $grade) {
                /*if (empty($grade['grade_midterm'])) {
                  $grade_midterm = 0;
                } else {
                  $grade_midterm  = number_format($grade['grade_midterm'], 1);
                }*/

                if (empty($grade['grade_final'])) {
                  $grade_final = 0;
                } else {
                  $grade_final  = number_format($grade['grade_final'], 1);
                }
              }
              if ($grade_final == 0) {
                $count_empty++;
              } else {
                $count++;
              }
  ?>
      <tbody>
          <tr>
            <td><?php echo $course['course_sem']?></td>
            <td><?php echo $course['course_csccode'] ?></td>
            <td><?php echo $course['course_code']?></td>
            <td><?php echo $course['course_desc']?></td>
            <td><?php echo $course['course_unit']?></td>
            <!--<td>
              <?php 
                /*if ($grade_midterm == 0) {
                  echo "";
                } else {
                  echo $grade_midterm;
                }*/
              ?>
            </td>-->
            <td>
              <?php 
                if ($grade_final == 0) {
                  echo "";
                } else {
                  echo $grade_final;
                }
              ?>
            </td>
          </tr>
  <?php
                //$midtermsum += $grade_midterm;
                $finalsum += $grade_final;
              }
            }
          } //course loop
            
            /*if ($midtermsum == 0) {
              $gwamidterm = 0;
            } else {
              $gwamidterm = $midtermsum / $count;
            }*/

           $rem = fmod($count_empty, $count);
          if ($rem != 0) {
              $gwafinals = 0;
            } else {
              $gwafinals = $finalsum / $count;
            }
  ?>
        <tr><td colspan="4">GWA:</td><td colspan="2">
          <?php 
            if ($gwafinals == 0) {
              echo "";
            } else {
              echo number_format($gwafinals, 2);
            } 
          ?>
        </td></tr>

  <?php
        } //course not null
      } //semester loop
    } //year loop
  ?>
      </tbody>
    </table>
  <?php
  }
  ?>
  <!---end of prospectus -->
  </div>
<?php
    } else {
      echo "<h4>No retrievable data.</h4>";
    }
  } 
  
?>
  
  <!-- end of main -->
</div>
