
<div class="mt-2 ml-4">
<?php 
if (isset($_GET['view'])) {
  echo '
<a href="index.php?content=archive" style="margin-left: 3em; text-decoration: none;">
  ';
} else {
  echo '
<a href="index.php" style="margin-left: 3em; text-decoration: none;">
  ';
}
?>

<div class="fixed-left">
      <i class="fas fa-arrow-left" style="margin-right: 0.5em"></i>Go back
    </a>
      <h6 class="text-center lead mt-3">Select to view archive table</h6>
    </div>
  </div>

<div class="container">
  <div class="row justify-content-center">
    <div class="card" style="max-width: 20%; margin-top: 10px!important; margin-left: 0!important; margin-right: 0!important; padding: 0!important">
      <a href="index.php?content=archive&view=faculties"><button class="admin-viewBtn"><i class="fas fa-chalkboard-teacher" style="margin-right:5px;"></i>Faculties</button></a>
    </div>
    <div class="card" style="max-width: 20%; margin-top: 10px!important; margin-left: 0!important; margin-right: 0!important; padding: 0!important">
      <a href="index.php?content=archive&view=students"><button class="admin-viewBtn"><i class="fas fa-users" style="margin-right:5px;"></i> Students</button></a>
    </div>
    <div class="card" style="max-width: 20%; margin-top: 10px!important; margin-left: 0!important; margin-right: 0!important; padding: 0!important">
      <a href="index.php?content=archive&view=course"><button class="admin-viewBtn"><i class="fas fa-sticky-note" style="margin-right:5px;"></i> Courses</button></a>
    </div>

<?php 
if (isset($_GET['view'])) {
  $view = $_GET['view'];
  if ($view == 'faculties') {

?>

<div class="main-contents-table container justify-content-center">
    <div class="mt-4 justify-content-center">
        <div>
            <table class="table table-bordered table-hover" id="dataTable" width="100%">
                <thead class="table-head">
                    <tr>
                        <th>Name</th>
                        <th>College</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
require_once 'inc/admin/class.admin.php';

        $adminObj = new Admin();
        $faculties = $adminObj->getFacultyRemoved();
         if (!empty($faculties)) {
    foreach ($faculties as $faculty) {
    $facultyID = $faculty['facultyID'];
    $facultyName = $faculty['faculty_lname'] . ", " . $faculty['faculty_fname'] . " " . $faculty['faculty_mname'];
    $college = $faculty['college_name'];
    $status = $faculty['status'];
if ($status == 0) {
       echo '
        <tr>
                <td>'.$facultyName.'</td>
                
                <td style="text-align:center;">'.$college.'</td>
             
                <td style="text-align:center;">
                    <a href="index.php?content=archive&view=faculties&id='.$facultyID.'"><button class="btn-success" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px;"><i class="fas fa-plus-square" style="margin-right:5px;"></i>Restore</button></a>
                </td>
       </tr>';
         }
       }
     } else {
  echo 
                '<script language="javascript">
                  alert("No faculty have been archived!");
                  window.location.href = "index.php?content=archive";
                </script>';
                exit();

     }

     if (isset($_GET['id'])) {
      $facultyID = $_GET['id'];
      $result = $adminObj->restoreFaculty($facultyID);

      if ($result) {
        echo 
                '<script language="javascript">
                  alert("Faculty is restored!");
                  window.location.href = "index.php?content=archive&view=faculties";
                </script>';
                exit();
      } else {
         echo 
                '<script language="javascript">
                  alert("Failed to restore faculty!");
                  window.location.href = "index.php?content=archive&view=faculties";
                </script>';
                exit();
      }
    } //isset get id

  } elseif ($view == 'students') {
    // code if student is selected
?>

<div class="main-contents-table container justify-content-center">
    <div class="mt-4 justify-content-center">
        <div>
            <table class="table table-bordered table-hover" id="dataTable" width="100%">
                <thead class="table-head">
                    <tr>
                        <th>Name</th>
                        <th>Program</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
require_once 'inc/admin/class.admin.php';

        $adminObj = new Admin();
        $students = $adminObj->getStudentRemoved();
        if (empty($students)) {
  echo 
                '<script language="javascript">
                  alert("No students have been archived!");
                  window.location.href = "index.php?content=archive";
                </script>';
                exit();
}

        foreach ($students as $student) {
          $studentID = $student['student_no'];
          $name = $student['lastname'] . ', ' . $student['firstname'];
          $program = $student['program'];
          $rows = $adminObj->getProgramlist();
          foreach ($rows as $row) {
            if ($program == $row['program_id']) {
              $program = $row['program_name'];
            }
          }

         echo '
        <tr>
                <td>'.$name.'</td>
                
                <td style="text-align:center;">'.$program.'</td>
             
                <td style="text-align:center;">
                    <a href="index.php?content=archive&view=students&id='.$studentID.'"><button class="btn-success" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px;"><i class="fas fa-plus-square" style="margin-right:5px;"></i>Restore</button></a>
                </td>
       </tr>'; 
        }
      if (isset($_GET['id'])) {
      $studentID = $_GET['id'];
      $result = $adminObj->restoreStudent($studentID);

      if ($result) {
        echo 
                '<script language="javascript">
                  alert("Student is restored!");
                  window.location.href = "index.php?content=archive&view=students";
                </script>';
                exit();
      } else {
         echo 
                '<script language="javascript">
                  alert("Failed to restore student!");
                  window.location.href = "index.php?content=archive&view=students";
                </script>';
                exit();
      }
    } //isset get id
  } 



  elseif ($view == 'course') {
    // code if course is selected
?>


<div class="main-contents-table container justify-content-center">
    <div class="mt-4 justify-content-center">
        <div>
            <table class="table table-bordered table-hover" id="dataTable" width="100%">
                <thead class="table-head">
                    <tr>
                        <th>Course Desc</th>
                        <th>College</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php
require_once 'inc/admin/class.admin.php';

        $adminObj = new Admin();
        $courses = $adminObj->getCourseRemoved();
if (empty($courses)) {
  echo 
                '<script language="javascript">
                  alert("No courses have been archived!");
                  window.location.href = "index.php?content=archive";
                </script>';
                exit();
}
        foreach ($courses as $course) {
          $courseCode = $course['course_code'];
          $courseDesc = $course['course_desc'];
          $college = $course['course_college'];
          

         echo '
        <tr>
                <td>'.$courseDesc.'</td>
                
                <td style="text-align:center;">'.$college.'</td>
             
                <td style="text-align:center;">
                    <a href="index.php?content=archive&view=course&id='.$courseCode.'"><button class="btn-success" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px;"><i class="fas fa-plus-square" style="margin-right:5px;"></i>Restore</button></a>
                </td>
       </tr>'; 
        }
if (isset($_GET['id'])) {
      $courseCode = $_GET['id'];
      $result = $adminObj->restoreCourse($courseCode);

      if ($result) {
        echo 
                '<script language="javascript">
                  alert("Course is restored!");
                  window.location.href = "index.php?content=archive&view=course";
                </script>';
                exit();
      } else {
         echo 
                '<script language="javascript">
                  alert("Failed to restore course!");
                  window.location.href = "index.php?content=archive&view=course";
                </script>';
                exit();
      }
    } //isset get id

  } 


  //code if nothing is selected
  else {
?>


<?php
}


// code if no view is set
} else {

?>

<div class="text-align-center">
  <h4 class="sub-head">Click Faculties, Students, or Courses</h4>
</div>

<?php
    }

?>
</tbody>
</table>
</div>

  </div>
</div>
</div>
</div>
  <script>
        $(document).ready(function() {
              $('#dataTable').DataTable({
      'columnDefs': [{
        'targets': [2], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
     }]
   });
        });
    </script>
