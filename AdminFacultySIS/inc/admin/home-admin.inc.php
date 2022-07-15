<?php
if (isset($_SESSION['userRole'])) {
  if ($_SESSION['userRole'] == 'admin') {
    
    require_once 'inc/admin/class.admin.php';

    $adminID = $_SESSION['loggedin'];
    $adminObj = new Admin();

    $acadYears = $adminObj->getAcadYr();
    if (empty($acadYears)) {
      echo    '<script language="javascript">alert("Please add first an Academic Year!"); 
                            window.location.href = "index.php?content=add-academicyear";
                        </script>';
    } else {
    $acadyrSet = null;
    $acadYearID = null;
    $semPres = null;

    $semesters = $adminObj->getSem();

    foreach ($acadYears as $acadYear) {
      $acadyrSet ="SY: " . $acadYear['year_start'] . " - " . $acadYear['year_end'];
      $semPres = " / " . $acadYear['semester'];
      $acadYearID = $acadYear['acad_yearid'];
    }
    

    $yearSem = $acadyrSet . $semPres;

    
    $total_colleges = $adminObj->collegeTotal();
    $total_faculties = $adminObj->facultyTotal();
    $total_programs = $adminObj->programTotal();
    $total_students = $adminObj->studentTotal();
?>

<div class="main-contents d-flex flex-column justify-content-center align-middle">
  <div class="header" style="border: none!important">
    <h6 class="lead">ADMIN DASHBOARD</h6>
  </div>
  <div class="sub-head">
    <p><?php echo $yearSem; ?></p>

    <a href="index.php?content=add-academicyear"><i class="fas fa-edit"></i>
      <span class="tooltiptext">Update School Year</span>
      
    </a>
 
    <!-- <a href="index.php?content=edit-academicyear&acad-yrid=<?php echo $acadYearID?>"><i class="fas fa-edit"></i></a> -->
  </div>
</div>

<!-- Stats -->
<div class="container margin-top sub-head">
  <div class="d-flex justify-content-center align-middle text-align-center">

   <!--  <div class="row">
      <div class="num-rows">
        <h2><?php //echo $total_colleges; ?></h2>
      </div>
      <div class="num-label">
        <p>COLLEGES</p>
      </div>
    </div> -->
    <div class="row">
      <div class="num-rows">
        <h2 class="display-3"><?php echo $total_faculties; ?></h2>
      </div>
      <div class="num-label">
        <p>FACULTIES</p>
      </div>
    </div>
   <!--  <div class="row">
      <div class="num-rows">
        <h2><?php //echo $total_programs; ?></h2>
      </div>
      <div class="num-label">
        <p>PROGRAMS</p>
      </div>
    </div> -->
    <div class="row">
      <div class="num-rows">
        <h2 class="display-3"><?php echo $total_students; ?></h2>
      </div>
      <div class="num-label">
        <p>STUDENTS</p>
      </div>
    </div>

    </div>
</div>


<div class="main-contents container justify-content-center align-middle">

<div class="row">

<div class="column">
    <!-- Faculty Header -->
  <div class="header">
    <h6>Faculty</h6>
  </div>
<!-- Faculty Table --> 
<div class=" mb-5">
  <div class="justify-content-center align-middle">
      <table class="table-custom h-50">
        <thead>
          <th>No.</th>
          <th>Faculty Name</th>
          <th>Position</th>
          <th>College</th>
        </thead>
        <tbody style="border-width: 1px!important;">
        
        <?php
        $faculties = $adminObj->allFaculty();
        
        if (!empty($faculties)) {          
          for ($i=0; $i < 3; $i++) { 
            $name = $faculties[$i]['faculty_lname'] . ", " .  $faculties[$i]['faculty_fname'] . " " . $faculties[$i]['faculty_mname'] ;
            $position = $faculties[$i]['faculty_level'];
            $college = $faculties[$i]['college_name']
        ?>

          <tr style="text-align: center;">
            <td><?php echo $i+1; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $position; ?></td>
            <td><?php echo $college; ?></td>
          </tr>

        <?php
          }
        } else {
          echo "<tr>
                  <td colspan=\"4\"> No data</td>
                </tr>";
        }
        ?>
          <tr>
            <td colspan="4"><a href="index.php?content=faculty-list"><button class="admin-viewBtn">View All Faculties<i class="fas fa-arrow-right"></i></button></a></td>
          </tr>
        </tbody>
      </table>
  </div>
</div>
</div>

<div class="column">
  <!-- Students Header -->
  <div class="header">
    <h6>Students</h6>
  </div>
<!-- Students Table -->
<div class=" mb-5">
  <div class=" justify-content-center align-middle">
      <table class="table-custom h-50">
        <thead>
          <th>No.</th>
          <th>Student Name</th>
          <th>Year</th>
          <th>Program</th>
        </thead>
        <tbody style="border-width: 1px!important;">

        <?php
          $students = $adminObj->getStudentInfo();

          if (!empty($students)) {
            for ($k=0; $k < 3; $k++) { 
              $student_name = $students[$k]['lastname'] . ", " . $students[$k]['firstname']; 
              $block = $students[$k]['block'];
               switch ($block) {
                case '1':
                  $block = 'A';
                  break;
                case '2':
                  $block = 'B';
                  break;
                case '3':
                  $block = 'C';
                  break;
                case '4':
                  $block = 'D';
                  break;
                 
                default:
                  $block = 'Out of range';
                  break;
              }

              $year = $students[$k]['yearlevel'];
              switch ($year) {
                case '1':
                  $year = '1st';
                  break;
                case '2':
                  $year = '2nd';
                  break;
                case '3':
                  $year = '3rd';
                  break;
                case '4':
                  $year = '4th';
                  break;
                case '5':
                  $year = '5th';
                  break;
                default:
                  $year = 'Out of range';
                  break;
              }

              $student_program = $students[$k]['program'];
              if (!empty($student_program)) {

                $programs = $adminObj->getProgramlist(); //return array data from catsu_program

                for ($i=0; $i < $total_programs; $i++) { 
                  $program_id = $programs[$i]['program_id']; //get the id from catsu_program tbl

                  if ($program_id == $student_program) {
                    $student_program = $programs[$i]['program_code']; //assign program code
                  }

                }

              }
        ?>

          <tr style="text-align: center;">
            <td><?php echo $k+1; ?></td>
            <td><?php echo $student_name; ?></td>
            <td><?php echo $year; ?></td>
            <td><?php echo $student_program; ?></td>
          </tr>
        
        <?php
        
          }
        } else {
          echo "<tr>
                  <td colspan=\"4\"> No data</td>
                </tr>";
        }
        ?>
        
          <tr>
            <td colspan="4"><a href="index.php?content=student-view-college "><button class="admin-viewBtn">View All Students<i class="fas fa-arrow-right"></i></button></a></td>
          </tr>
        </tbody>
      </table>
  </div>
</div>
</div>
</div>

</div>
<?php
    }
  }
} else {
  header("location: index.php");
  exit();
}
?>
    



      

