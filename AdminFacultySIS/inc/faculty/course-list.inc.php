<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }

  require_once ('inc/program.inc.php');
  require_once ('inc/courses.inc.php');
 require_once ('inc/block.inc.php');

  require_once ('inc/faculty/faculty.inc.php');
  require_once ('inc/student.inc.php');

?>

<div class="main-contents text-align-center col-auto col-md-3 col-xl-2 px-sm-2 px-0 mx-auto ">
  <div class="header">
    <h4>Assigned Courses</h4>
  </div>
</div>

<!-- Table for the Courses -->

<div class="main-contents-table container text-center justify-content-center">
  <div class="row">
    <div class="col-sm table-custom">
    <?php
    $programObj = new Program();
    $faculty = new Faculty();
    $id = $_SESSION['loggedin'];
    $programs = $programObj->getProgramlist();
    if (empty($programs)) {
      echo '<h1>No data</h1>';
    } else {
      for ($k=0; $k < count($programs); $k++) { 
        $program_name = $programs[$k]['program_name'];
        $program_id = $programs[$k]['program_id'];
    ?>
      <!-- Table Creation -->
      <div class="accordion-body m-3">
        <button class="accordion shadow">List of courses in <?php echo $program_name; ?></button>

        <div class="panel shadow">
            <table class="table table-bordered table-hover mb-0" style="table-layout: fixed;">
              <thead>
                <th style="color: #4879FF; width: 80px; text-align: center;">Year</th>
                <th style="color: #4879FF; width: 100px; text-align: center;">Block</th>
                <th style="color: #4879FF; width: 100px; text-align: center;">Course Code</th>
              <!--   <th style="color: #4879FF; width: 300px;">Course Description</th>
                <th style="color: #4879FF; width: 100px;">No. of Students Enrolled</th> 
                <th style="color: #4879FF; width: 100px;">Course Units</th>-->
                <th style="color: #4879FF; width: 150px;">Add Course to Dashboard</th>
              </thead>
<!-- Assigned Courses -->
              <tbody>
<?php 
$courses = $faculty->getAssignedCourses($id);
// if not empty start
if (!empty($courses)) {

  //foreach start
  foreach ($courses as $course) {
    $courseCode = $course['course_code'];
    


    $course_id = $faculty->getCourseID($courseCode);
    if (empty($course_id)) {
      echo '<script>alert(); </script';
    }
    $courseProgram = $course['program'];
    $courseYear = $course['year'];
    $courseBlock = $course['block'];

    

    $years = $faculty->getAllYearLevel();
    foreach ($years as $yearlevel) {
      if ($courseYear == $yearlevel['year_id']) {
      $courseYear = $yearlevel['year_level'];
      }
    }

    $blocksObj = new Block;
    $blocks = $blocksObj->getBlockByCollege();
    foreach ($blocks as $block) {
      if ($courseBlock == $block['block_id']) {
        $courseBlock = $block['block_name'];
      }
    }

    // course program condition start
    if ($courseProgram == $program_id) {
      // $courseProgram = $program_name;
    

?>
<tr>
                    <td style="color: #1c1c1c; text-align: center; padding-left: 10px;"><?php echo $courseYear; ?></td>
                    <td style="color: #1c1c1c; text-align: center; padding-left: 10px;"><?php echo $courseBlock; ?></td>
                    <td style="color: #1c1c1c; text-align: center; padding-left: 10px;"><?php echo $courseCode; ?></td>
                    <!-- 
                    <td style="color: #1c1c1c; text-align: left; padding-left: 10px;"><?php //echo $enrolled; ?></td>
                    <td style="color: #1c1c1c; text-align: center; padding-left: 10px;"><?php //echo $course_unit; ?></td> -->
                    <td>
                    <form method="POST" action="index.php?content=home-faculty">
                        <input type="hidden" name="course_id" value="<?php echo $course_id['course_id'] ?>">
                        <button type="submit" name="add" style="width: 150px; font-size: 12px;" class="btn btn-sm btn-primary rounded-pill py-2 shadow-sm">Add to dashboard</button> 
                      </form>
                    </td>
                  </tr>


<?php  
    }
    // course program condition end
    else {
      // echo '<tr><td colspan="4" style="text-align: center; font-size: 20px; font-weight:700;">No assigned Courses. Contact your admin</td></tr>';
    }  
  }
  //foreach end

} else {
  echo '<tr><td colspan="4" style="text-align: center; font-size: 20px; font-weight:700;">No assigned Courses. Contact your admin</td></tr>';

}
// if not empty end 

?>
              </tbody>
<!-- End of Assigned Courses -->
            </table>
        </div>
      </div>
      <?php
          }
        }
      ?>

    </div>
  </div>
</div>

<script src="js/app.js" type="text/javascript"></script>
<!-- End of Table Div -->


