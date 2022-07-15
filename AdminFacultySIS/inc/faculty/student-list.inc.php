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
  include_once 'inc/faculty/faculty.inc.php';
//unset postdata
  if (isset($_POST['showallstudent'])) {
      unset($_SESSION['postdata']);
  }
//input sched script
    $facObj = new Faculty;

    if (isset($_POST['sched'])) {
    $sched_firstday         = $_POST['first_day'];
    $sched_firststarttime   = date('h:i:s ', strtotime($_POST['first_starttime']));
    $sched_firstendtime     = date('h:i:s ', strtotime($_POST['first_endtime']));
    $sched_secondday        = $_POST['second_day'];
    $sched_secondstarttime  = date('h:i:s ', strtotime($_POST['second_starttime']));
    $sched_secondendtime    = date('h:i:s ', strtotime($_POST['second_endtime']));
    $course_id  = $_POST['course_id'];
    $program_id = $_POST['program_id'];
    $faculty_id = $_POST['faculty_id'];
    $year_id    = $_POST['year_id'];
    $block_id   = $_POST['block_id'];

    $result = $facObj->addSchedule($sched_firstday, $sched_secondday, $sched_firststarttime, $sched_firstendtime, $sched_secondstarttime, $sched_secondendtime, $course_id, $program_id, $faculty_id, $block_id, $year_id, );

   }

//remark script
    $gradeObj   = new Grades();
        if (isset($_POST['remark'])){
            $grade_remark       = $_POST['grade_remark'];
            $grade_courseid     = $_POST['course_id'];
            $grade_studentid    = $_POST['student_id'];
            $grade_facultyid  = $_POST['faculty_id'];

            $inputGradeRemark = $gradeObj->inputRemark($grade_remark, $grade_courseid, $grade_studentid, $grade_facultyid);
        }

//grading script
    $gradeObj   = new Grades();

      if (isset($_POST['midterm'])) {
        $grade_midterm   = $_POST['grade_midterm'];
        $grade_programid = $_POST['grade_programid'];
        $grade_courseid  = $_POST['grade_courseid'];
        $grade_yearlevel = $_POST['grade_yearlevel'];
        $grade_semid     = $_POST['grade_semid'];
        $grade_studentid = $_POST['grade_studentid'];
        $grade_facultyid = $_POST['grade_facultyid'];
  
        $inputMidtermGrade = $gradeObj->inputMidtermGrade($grade_midterm, $grade_programid, $grade_courseid, $grade_yearlevel, $grade_semid, $grade_studentid, $grade_facultyid);
      } elseif (isset($_POST['final'])) {
        $grade_final     = $_POST['grade_final'];
        $grade_courseid  = $_POST['grade_courseid'];
        $grade_studentid = $_POST['grade_studentid'];
        $grade_facultyid = $_POST['grade_facultyid'];

        $inputFinalGrade = $gradeObj->inputFinalGrade($grade_final, $grade_courseid, $grade_facultyid, $grade_studentid);
      }

?>
<!-- start of main content -->
<div class="main-contents col-auto col-md-3 col-xl-2 px-sm-2 px-0 mx-auto">

<?php
  if ($_SESSION['loggedin']) {
    $id = $_SESSION['loggedin'];
    //start retrieving data= 
    $postdataObj = new Faculty();
    $session_data = $postdataObj->getPostData();
    if (!empty($_SESSION['postdata'])) {
      //retrieve data per course
      $postdata = array_values($_SESSION['postdata']);
      for ($i=0; $i < count($postdata); $i++) { 
        $postcourse_code = $_SESSION['postdata']['course_code'];
        $postprogram = $_SESSION['postdata']['program'];
        $postyear = $_SESSION['postdata']['year_level'];
      }
?>
<!--header-->
  <div class="header">
    <h4>Student List For <?php echo $postcourse_code;?></h4>
  
  <form action="index.php?content=student-list" method="POST">
      <button class=" btn btn-warning text-light rounded-pill px-4" style="top: 85px; right: 70px; position: absolute;" onclick="return confirm('Do you want to show list of all students from all programs?');" name="showallstudent">Show List of All Students</button>
    </form>
  </div>
  <!-- header end -->
</div>

<!--table start-->
<div class="main-contents-table mb-5 container text-left justify-content-center">
  <div class="row">
    <div class="col-sm table-custom">
<?php
  $programObj = new Program();
  $programs   = $programObj->getProgramlist();
  $block_id;

  foreach ($programs as $program) {
    if ($program['program_id'] == $postprogram) {

      $collegeObj = new College();
      $colleges   = $collegeObj->getCollege();
      foreach ($colleges as $college) {
        if ($program['program_college'] == $college['college_name']) {
          
          $facultyobj = new Faculty();
          $faculties    = $facultyobj->getFaculty($id);
          foreach ($faculties as $faculty) {

            $courseObj = new Courses();
            $courses   = $courseObj->getCourselist();
            foreach ($courses as $course) {
              if ($course['course_code'] == $postcourse_code) {
                $course_id = $course['course_id'];
                
                $blockingObj = new Block();
                $blockings   = $blockingObj->getBlockByCollege();

                foreach ($blockings as $blocking) {
                      
                  $countStudents = 1;

?>
<?php
  $studentsObj = new Student();
  $students    = $studentsObj->getStudentInfo();

  $enrolled = 0;
  $countEnrolled = 0;
  foreach ($students as $student) {
    if ($student['yearlevel'] == $course['course_level']) {
      if ($student['program'] == $course['course_program']) {
        if ($student['block'] == $blocking['block_id']) {
          $block_id = $blocking['block_id'];
          if ($student['block'] != null) {
            $countEnrolled++;
            $enrolled = $countEnrolled;
          }
        } else {
          $enrolled = 0;
          }
      }
    }
  }
?>
      <div class="accordion-body">
        <button class="accordion">Block <?php echo $blocking['block_name']; ?></button>
        <div class="panel">
<!---------accordion content---------->
<?php
  $college_desc = $college['college_desc'];
  $program_name = $program['program_name'];
  $program_id   = $program['program_id'];
  $course_id    = $course['course_id'];
  $course_info  = $course['course_code'] ." | ". $course['course_desc'];
  $course_year  = $course['course_level'];
  $block_name   = $blocking['block_name'];
  $block_id     = $blocking['block_id'];
  $course_csc   = $course['course_csccode'];
  $faculty_info = $faculty['faculty_fname'] .' '. $faculty['faculty_mname'] .' '. $faculty['faculty_lname'] .', '. $faculty['faculty_level'];

?> 
      <table class="table table-bordered table-hover mt-4 mb-0" style="border-bottom: none;">
        <thead>
          <tr style="border-bottom: none;">
            <th style="border-right: none; text-align: left; width: 200px; ">College Department: </th>
              <td colspan="8" style="border-left: none;"><?php echo $college_desc; ?></td>
          </tr>
          <tr style="border: none;">
            <th style="border-right: none; text-align: left;">Program: </th>
              <td colspan="8" style="border-left: none;"><?php echo $program_name; ?></td>
          </tr>
          <tr style="border: none;">
            <th style="border-right: none; text-align: left;">Course: </th>
              <td colspan="8" style="border-left: none;"><?php echo $course_info; ?></td>
          </tr>
<!---------------------------------------------------------------->
          <tr style="border: none;">
            <th style="border-right: none; text-align: left;">Block: </th>
              <td style="border-right: none; border-left: none;"><?php echo $block_name; ?></td>
            <th style="border-right: none; border-left: none; text-align: left;">CSC Code: </th>
              <td style="border-right: none; border-left: none;"><?php echo $course_csc; ?></td>
            <th style="border-right: none; border-left: none; text-align: left; width: 100px;">Schedule: </th>
<?php
    $facultyObj = new Faculty;
    $schedule = $facultyObj->getCourseSchedule($course_id, $block_id);
    $course_schedule = "";

        foreach($schedule as $class_sched) {
/*********************************************************************class schedule condition*******************************************************************/
            if ($class_sched['sched_facultyid'] == $id) {
                $firststarttime = date("h:i a",strtotime($class_sched['sched_firststarttime']));     //first day start time
                $firstendtime = date("h:i a",strtotime($class_sched['sched_firstendtime']));         // first day end time
                $secstarttime = date("h:i a",strtotime($class_sched['sched_secstarttime']));         // second day start time
                $secendtime = date("h:i a",strtotime($class_sched['sched_secendtime']));             // second day end time

                if(empty($class_sched['sched_id'])){
                    $course_schedule = "";
                } else {
                    $course_schedule = $class_sched['sched_firstday'] . ": " . $firststarttime . "-" . $firstendtime . " | " . $class_sched['sched_secday'] . ": " . $secstarttime . "-" . $secendtime;
                }
            }
        }

            if($course_schedule == ""){
?>
            <td style="border-right: none; border-left: none;"><a href="#addSchedule" class="btn btn-primary btn-sm" data-toggle="modal" data-block-id="<?php echo $block_id ?>">Input Schedule</a></td>
<!-------------->
              <!-- Modal -->
              <div id="addSchedule" class="modal fade" role="dialog">
                <div class="modal-dialog">

                <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title lead">Input class schedule for <?php echo $postcourse_code?></h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <form  id="modal-form" method="post" action="index.php?content=student-list">
                        <label class="form-label">First Schedule</label>
                          <div class="form-group">
                          <select class="form-select mb-2" name="first_day" required>
                            <option selected hidden disabled>Select day</option>
                            <option value="M">Monday</option>
                            <option value="T">Tuesday</option>
                            <optio value="W">Wednesday</option>
                            <option value="Th">Thursday</option>
                            <option value="F">Friday</option>
                            <option value="Sat">Saturday</option>
                            <option value="Sun">Sunday</option>
                          </select>
                          <input class="form-control" type="time" name="first_starttime" min="6:00" max="20:00" required>
                          -
                          <input class="form-control" type="time" name="first_endtime" min="6:00" max="20:00" required>
                        </div>
                        <label class="form-label">Second Schedule</label>
                          <div class="form-group">
                          <select class="form-select mb-2" name="second_day" required>
                            <option selected hidden disabled>Select day</option>
                            <option value="M">Monday</option>
                            <option value="T">Tuesday</option>
                            <option value="W">Wednesday</option>
                            <option value="Th">Thursday</option>
                            <option value="F">Friday</option>
                            <option value="Sat">Saturday</option>
                            <option value="Sun">Sunday</option>
                          </select>
                          <input class="form-control" type="time" name="second_starttime" min="6:00" max="20:00" required>
                          -
                          <input class="form-control" type="time" name="second_endtime" min="6:00" max="20:00" required>
                        </div>
                        <input type="hidden" name="faculty_id" value="<?php echo $id;?>">
                        <input type="hidden" name="program_id" value="<?php echo  $program_id ?>">
                        <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
                        <input type="hidden" name="block_id" value="">
                        <input type="hidden" name="year_id" value="<?php echo $course_year; ?> ">
                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success" form="modal-form" name="sched">Submit</button>
                  </div>
                </div>

                </div>
              </div>
<!-------------->
<?php
            } else {
?>
            <td style="border-right: none; border-left: none;"><?php echo $course_schedule; ?></td>
<?php
            }
/*********************************************************************end of class schedule condition*******************************************************************/
?>

        
            <th style="border-right: none; border-left: none; text-align: left; width: 230px;">Room: </th>
              <td colspan="2" style="border-left: none;"></td>
          </tr>
<!---------------------------------------------------------------->
          <tr style="border: none;">
            <th style="border-right: none; text-align: left;">Enrollees: </th>
              <td style="border-right: none; border-left: none;"><?php echo $enrolled; ?></td>
            <th style="border-right: none; border-left: none; text-align: left; width: 120px;">Instructor: </th>
              <td colspan="6" style="border-left: none;"><?php echo $faculty['faculty_fname'] . " " . $faculty['faculty_mname'] . " " . $faculty['faculty_lname'] . ", " . $faculty['faculty_level']; ?></td>
          </tr>
        </thead>
      </table>
      <table class="table table-bordered table-hover">
        <thead>
          <th style="width:;">No</th>
          <th style="width:;">Student No</th>
          <th style="width:;">Student Name</th>
          <th style="width:;">Sex</th>
          <th style="width:;">Program Code</th>
          <th style="width:;">Year</th>
          <th style="width:;">Midterm Grade</th>
          <th style="width:;">Final Grade</th>
          <th style="width:;">Remarks</th> 
        </thead>    
      <tbody>
<?php
//print_r($students);
foreach ($students as $key => $student) {
  $student_id = $students[$key]['student_id'];
    if ($program['program_id'] == $students[$key]['program']) {
      if ($blocking['block_id'] == $students[$key]['block']) {
        if ($postyear == $student['yearlevel']) {


?>
          <tr>
            <td class="text-center"><?php echo $countStudents; ?></td>
            <td class="text-center"><?php echo $students[$key]['student_no']; ?></td>
            <td class="text-center">
              <form action="index.php?content=prospectus" method="post">
                <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                <button class=" btn btn-link" name="post" type="submit"><?php echo $students[$key]['lastname'] . ", " . $students[$key]['firstname']; ?></button>
              </form>
            </td>
            <td class="text-center"><?php echo $students[$key]['gender']; ?></td>
            <td class="text-center"><?php echo $program['program_code']; ?></td>
            <td class="text-center"><?php echo $students[$key]['yearlevel']; ?></td>
<?php
                
          
                $gradeObj = new Grades();
                $grades   = $gradeObj->getGrades($student_id, $course_id);
                $grade_midterm = "";
                $grade_final = "";
                $remark = "";

                foreach ($grades as $grade) {
                  if (empty($grade['grade_remark'])) {
                    $remark = "";
                  } else {
                    $remark = $grade['grade_remark'];
                  }

                  if (empty($grade['grade_midterm'])) {
                    $grade_midterm  = "";
                  } else {
                    $grade_midterm  = number_format($grade['grade_midterm'], 1);
                  }

                  if (empty($grade['grade_final'])) {
                    $grade_final  = "";
                  } else {
                    $grade_final  = number_format($grade['grade_final'], 1);
                  }
                }

                //$on = 1;
/*********************************************************************grades condition*******************************************************************/

                if (!empty($grade_midterm) && !empty($grade_final)) { /// both midterm and final is graded
?>
            <td class="text-center"><?php echo $grade_midterm; ?></td>
            <td class="text-center"><?php echo $grade_final;?></td>
<?php
                } elseif (!empty($grade_midterm) && empty($grade_final)) { /// only midterm is graded

?>
            <td class="text-center"><?php echo $grade_midterm; ?></td>
            <td>
              <form method="POST" action="index.php?content=student-list">
                  <div class="input-group">
                    <input class="form-control form-control-sm" type="number" step="0.1" min="1.0" max="5.0" name="grade_final" placeholder="Input here" required>
                    <input type="hidden" name="grade_courseid" value="<?php echo $course['course_id'] ?>">
                    <input type="hidden" name="grade_studentid" value="<?php echo $students[$key]['student_id'] ?>">
                    <input type="hidden" name="grade_facultyid" value="<?php echo $id ?>">
                    <div class="input-group-append">
                      <input class="btn btn-primary btn-sm" type="submit" name="final" value="Input">
                    </div>
                  </div>
              </form>
            </td>           
<?php
                } elseif (!empty($grade_final) && empty($grade_midterm)) { /// if only final is graded
?>
            <td>
              <form method="POST" action="index.php?content=student-list">
                  <div class="input-group">
                    <input class="form-control form-control-sm" type="number" step="0.1" min="1.0" max="5.0" name="grade_midterm" placeholder="Input here" required>
                    <input type="hidden" name="grade_programid" value="<?php echo $program['program_id'] ?>">
                    <input type="hidden" name="grade_courseid" value="<?php echo $course['course_id'] ?>">
                    <input type="hidden" name="grade_yearlevel" value="<?php echo $students[$key]['yearlevel'] ?>">
                    <input type="hidden" name="grade_semid" value="<?php echo $course['course_sem'] ?>">
                    <input type="hidden" name="grade_studentid" value="<?php echo $students[$key]['student_id'] ?>">
                    <input type="hidden" name="grade_facultyid" value="<?php echo $id ?>">
                    <div class="input-group-append">
                      <input class="btn btn-primary btn-sm" type="submit" name="midterm" value="Input">
                    </div>
                  </div>
              </form>
            </td>
            <td class="text-center"><?php echo $grade_final;?></td>
<?php
                } else { ///////////////////////////////////////////////////////////////// if both midterm and final is not graded 
?>
                <td>
                    <form method="POST" action="index.php?content=student-list">
                        <div class="input-group">
                            <input class="form-control form-control-sm" type="number" step="0.1" min="1.0" max="5.0" name="grade_midterm" placeholder="Input here" required>
                            <input type="hidden" name="grade_programid" value="<?php echo $program['program_id'] ?>">
                            <input type="hidden" name="grade_courseid" value="<?php echo $course['course_id'] ?>">
                            <input type="hidden" name="grade_yearlevel" value="<?php echo $students[$key]['yearlevel'] ?>">
                            <input type="hidden" name="grade_semid" value="<?php echo $course['course_sem'] ?>">
                            <input type="hidden" name="grade_studentid" value="<?php echo $students[$key]['student_id'] ?>">
                            <input type="hidden" name="grade_facultyid" value="<?php echo $id ?>">
                            <div class="input-group-append">
                            <input class="btn btn-primary btn-sm" type="submit" name="midterm" value="Input">
                            </div>
                        </div>
                    </form>
                    </td>
                <td>
                    <form method="POST" action="index.php?content=student-list">
                        <div class="input-group">
                            <input class="form-control form-control-sm" type="number" step="0.1" min="1.0" max="5.0"  name="grade_final" placeholder="Input here" required>
                            <input type="hidden" name="grade_courseid" value="<?php echo $course['course_id'] ?>">
                            <input type="hidden" name="grade_studentid" value="<?php echo $students[$key]['student_id'] ?>">
                            <input type="hidden" name="grade_facultyid" value="<?php echo $id ?>">
                            <div class="input-group-append">
                            <input class="btn btn-primary btn-sm" type="submit" name="final" value="Input">
                            </div>
                        </div>
                    </form>
                </td>

<?php
/*********************************************************************end of grades condition*******************************************************************/
                }
/*********************************************************************remark condition*******************************************************************/
                if(!empty($remark)){
?>
                    <td  class="text-center"><?php echo $remark;?></td>
<?php
                } else {
?>
                    <td class="text-center">
                        <form action="index.php?content=student-list" method="post">
                            <div class="input-group">
                                <select class="form-select form-select-sm" name="grade_remark" required>
                                <option selected hidden>Select</option>
                                <option value="PASSED">Passed</option>
                                <option value="INC">INC</option>
                                <option value="FAILED">Failed</option>
                                </select>
                                <div class="input-group-append">
                                    <input type="hidden" name="course_id" value="<?php echo $course_id ?>">
                                    <input type="hidden" name="student_id" value="<?php echo $student_id ?>">
                                    <input type="hidden" name="faculty_id" value="<?php echo $id ?>">
                                    <input class="btn btn-primary btn-sm" type="submit" name="remark" value="submit">
                                </div>  
                            </div>
                        </form>
                    </td>
<?php
                }
/*********************************************************************remark condition********************************************/
?>
            
            
          </tr>
        </tbody>
<?php
          $countStudents++;
        }
      }
    }
  }

?>
      </table>
<!---------end of accordion content---------->
<!------------------------------------------------------------------------------------------------------------- PDF BUTTON ---------------------------------------------------------------->
      <form action="inc/faculty/export_pdf.php" method="post">
        <input type="hidden" name="college_desc" value="<?php echo $college_desc; ?>">
        <input type="hidden" name="program_id" value="<?php echo $program_id; ?>">
        <input type="hidden" name="program_name" value="<?php echo $program_name; ?>">
        <input type="hidden" name="course_info" value="<?php echo $course_info; ?>">
        <input type="hidden" name="block_name" value="<?php echo $block_name; ?>">
        <input type="hidden" name="course_csc" value="<?php echo $course_csc; ?>">
        <input type="hidden" name="enrolled" value="<?php echo $enrolled; ?>">
        <input type="hidden" name="faculty" value="<?php echo $faculty_info; ?>">
        <input type="hidden" name="block_id" value="<?php echo $block_id; ?>">
        <input type="hidden" name="class_sched" value="<?php echo $course_schedule; ?>">
        <input type="submit" name="export" class="btn btn-danger btn-md" value="Export PDF">
      </form>    
    </div>
  </div>
  <!-- table end -->

<?php
                } //blockings
              } //if course == course_post
            } //courses
          } //faculty
        } //if college == program_college
      } //colleges
    } //if program == program_post
  } //programs 
?>  
    </div>
  </div>
</div>
<!--seperator---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
<?php
    } else { //retrieve data per block
?>

<?php
    $facultyObj = new Faculty();
    $programObj = new Program();
    $studentObj = new Student();
    $yearObj    = new YearLevel();
    $blockingObj = new Block();

    $facultyInfo    = $facultyObj->getFaculty($id);
    foreach ($facultyInfo as $faculty) {
      $facultyCollege = $faculty['college_name'];
    }
    
    $programs   = $programObj->getProgramByCollege($facultyCollege);
    if (!empty($programs)) {
?>
    <div class="my-5 ml-4">
      <h6 class="text-center lead mt-3">Select a program to view students</h6>
    </div>

    <div class="container">
      <div class="row justify-content-center">

<?php
    foreach ($programs as $program) 
    {
      $programID = $program['program_id'];
      $programCode = $program['program_code'];
      $programName = $program['program_name'];
?>
      <div class="card" style="max-width: 30%; margin-top: 10px!important; margin-left: 0!important; margin-right: 0!important; padding: 0!important">
        <a href="index.php?content=student-list&college_name=<?php echo $facultyCollege;?>&program_code=<?php echo $programID;?>"><button class="admin-viewBtn"><?php echo $programCode;?></button></a>
      </div>
<?php
    } //program loop for buttons

      if (isset($_GET['program_code'])) {
        $programID = $_GET['program_code'];

        if ($_GET['program_code'] == $programID) {
          $programName = null;

?>
        <div class="container mb-5">
          <div class="container justify-content-center align-middle">
              <table class="table table-bordered table-hover" id="studentTable" cellspacing="0" style="width:100%">
                <thead class="table-head">
                  <th scope="col" style="width: 15%;">ID #</th>
                  <th scope="col" style="width: 25%;">Name</th>
                  <th scope="col" style="width: 10%;">Sex</th>
                  <th scope="col" style="width: 5%;">Block</th>
                  <th scope="col" style="width: 5%;">Year</th>
                  <th scope="col" style="width: 30%;">Program</th>
                  <th style="width: 15%;">Remarks</th>
                </thead>
                <tbody style="border-width: 1px!important;">

<?php

          $programs = $programObj->getProgramlist();
          foreach ($programs as $key => $value) {
            if ($programID == $programs[$key]['program_id']) {
              $programName = $programs[$key]['program_name'];
              $programCode = $programs[$key]['program_code'];
            }
          } //program loop defining values

          
          $students = $studentObj->getStudentByProgram($programID);
          if (!empty($students)) {
            foreach ($students as $student) {
              $student_name = $student['lastname'] . ", " . $student['firstname'];
              $student_no   = $student['student_no'];
              $student_gender   = $student['gender'];
              $block_id     = $student['block'];
              $yearlevel_id = $student['yearlevel'];

              $blocking = $blockingObj->getBlockByCollege();
              foreach ($blocking as $block) {
                if ($block_id == $block['block_id']) {
                  $student_block = $block['block_name'];
                }
              }

              $yearlevel = $yearObj->getAllYearLevel();
              foreach ($yearlevel as $year) {
                if ($yearlevel_id == $year['year_id']) {
                  $student_yearlevel = $year['year_level'];
                }
              }

?>
      <tr style="text-align: center;">
            <td data-table-header="ID #"><?php echo $student_no; ?></td>
            <td style="text-align: left; padding-left: 2em!important;"><?php echo $student_name; ?></td>
            <td><?php echo $student_gender; ?></td>
            <td><?php echo $student_block; ?></td>
            <td><?php echo $student_yearlevel; ?></td>
            <td><?php echo $programName; ?></td>
            <td style="text-align: center;"></td>
          </tr>
<?php              

            }
          } else {

            echo '<tr style="text-align: center;">
                  <td colspan="7"><img src="./uploads/nodata.png" alt="No Data" style="margin-top: 100px;" width="300">
                  <p  style="margin-bottom: 100px;" >Sorry, no student is loaded for ' . $programCode . '</p></td>
                </tr>';

          }

        } //if get programId == to programId variable
      }
?>
          </tbody>
        </table>
      </div>
    </div>
<?php
    } else {

    }
?>

    

<?php
    }
  } else {
    //logout user
    header('location: ../inc/logout.inc.php');
  }
?>
<!--end of table-->
<script src="js/app.js" type="text/javascript"></script>
<script type="text/javascript">

  $(document).ready(function() {
    $('#studentTable').DataTable({
      'columnDefs': [{
        'targets': [5], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
     }]});
    });

    //$('.openmodal').click(function () { 
      //    $('#addSchedule').modal('show',$(this)); 
    //});

    //$(document).on("click", ".openmodal", function () {
     //var block_id = $(this).data('id');
     //$('#classblock').text( block_id );
    //});

    $('#addSchedule').on('show.bs.modal', function(e) {
        var classblock = $(e.relatedTarget).data('block-id');
        $(e.currentTarget).find('input[name="block_id"]').val(classblock);
    });

</script>

<!-- End of main content Div -->

<script>
  
</script>