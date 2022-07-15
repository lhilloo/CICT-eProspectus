<?php
  if (isset($_SESSION['loggedin'])) {
    $id = $_SESSION['loggedin'];
?>
    <div class="container">
      <div class="float-end">
        <button type="button" class="back-btn" onclick="history.back(-1)">Go Back</button>
      </div>
    </div>

    <section>
<?php
//object creation    
    $studentsObj = new Student();
    $students    = $studentsObj->getStudentInfo($id);
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
      } //student looop
?>
    <!-- start of prospectus -->
     <div class="mx-2 container">
      <table class="table mt-5 table-borderless table-sm table-hover">
        <thead>
          <tr>
            <th class="dtahead" style="width: 100px;">Student No.: </th>
            <td class="text"><?php echo $student_no; ?></td>
          </tr>
          <tr>
            <th class="dtahead" style="width: 100px;">Name: </th>
            <td class="text"><?php echo $student_name; ?></td>
          </tr>
          <tr>
            <th class="dtahead" style="width: 100px;">Address: </th>
            <td class="text"><?php echo $student['address']; ?></td>
          </tr>
          <tr>
            <th class="dtahead" style="width: 100px;">Block & Year: </th>
            <td class="text">Block <?php echo $student_block ." - ". $student_year; ?> Year</td>
          </tr>
          <tr>
            <th class="dtahead" style="width: 100px;">Program: </th>
            <td class="text"><?php echo $student_program; ?></td>
          </tr>
        </thead>
      </table>
    </div>
  </section>
<!-- courses -->
<div class="container">
<?php
  $yearObj = new YearLevel();
    $years   = $yearObj->getAllYearLevel();
    foreach ($years as $year) {
?>
    <table class="table table-sm text-center table-bordered table-hover mb-3">
      <thead style="background-color: #4879ff;"><tr><th style="font-size: 20px; color: #fff;" colspan="6"> <?php echo $year['year_name']?> Year</th></tr></thead>
<?php
      $semesterObj = new Course();
      $semester = $semesterObj->getSemester();
      foreach ($semester as $sem) {
?>        
        <thead><tr><td colspan="6" class="font-weight-normal" style="background-color: #fff566; border: none; color: #1c1c1c;"><?php echo $sem['sem_name']?> Semester</td></tr></thead>
        <thead class="rowhead">
          <th style="background-color: #fff; color: #4879ff; width: 60px;">Sem</th>
          <th style="background-color: #fff; color: #4879ff; width: 100px;">Course Code</th>
          <th style="background-color: #fff; color: #4879ff; width: 400px;">Course Description</th>
          <th style="background-color: #fff; color: #4879ff; width: 60px;">Units</th>
          <th style="background-color: #fff; color: #4879ff; width: 100px;">Final Grade</th>
        </thead>
<?php
        $courseObj = new Course();
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
            <td><?php echo $course['course_code']?></td>
            <td><?php echo $course['course_desc']?></td>
            <td><?php echo $course['course_unit']?></td>
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
                $finalsum += $grade_final;
              } // if sem
            } // if year
          } // course loop
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
      } //sem loop
    } //year loop
?>
        </tbody>
      </table>

</div>
  <div class="container">
    <div class="float-end">
      <button type="button" class="back-btn mb-5" onclick="history.back(-1)">Go Back</button>
    </div>
  </div>
<?php
    } //else empty
  } else {
    header('location: login.php');
  }
?>