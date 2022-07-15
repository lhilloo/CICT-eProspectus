<?php 
if (isset($_GET['studentid'])) {
  $studentId = $_GET['studentid'];
  $college = $_GET['college'];
  $studentNo;
  $name ;
  $gender;
  $address;
  $program;
  $block;
  $year;

  require_once 'inc/admin/class.admin.php';

  $adminObj = new Admin();
  $student = $adminObj->getStudDetails($studentId);

  foreach ($student as $row) {
   $studentNo = $row['student_id'];
   $studentId = $row['student_no'];
   $name = $row['firstname'] . " " . $row['lastname'];
   $gender = $row['gender'];
   $address = $row['address'];
   $program = $row['program']; 
   $block = $row['block'];
   $year = $row['yearlevel'];

    $programs = $adminObj->programByCollege($college);

    foreach ($programs as $value) {
      if ($program == $value['program_id']) {
        $program = $value['program_name'];

      } //if program condition end
    } // foreach program loop end

    $blocks = $adminObj->getBlockByCollege();

    foreach ($blocks as $row) {
      if ($block == $row['block_id']) {
        $block = $row['block_name'];

      } // if block condition end
    } //foreach loop block end

  } // foreach student end


 

  $profile = $adminObj->getStudentPF($studentNo);



?>
<div class="mt-2 ml-4 fixed-left">
<a href="index.php?content=student-view-program&college_name=<?php echo $college; ?>" style="margin-left: 3em; text-decoration: none;">
<i class="fas fa-arrow-left" style="margin-right: 0.5em"></i>Go back</a>
</div>

<div class="student-profile">
  <div class="container">
    <div class="row justify-content-center">
      
        <div class="card shadow-sm" style="width: 300px; max-width: 300px!important;">
          <div class="card-header bg-transparent text-center" style="height: 65%;">
            <?php echo $profile; ?>
          </div>
          <div class="card-body">
            
              <table class="table table-borderless">
                <tr>
                  <th class="table-active" width="35%">Name</th>
                  <td><?php echo $name; ?></td>
                </tr>
                <tr>
                  <th class="table-active" width="35%">ID No</th>
                  <td><?php echo $studentId; ?></td>
                </tr>
              </table>
          </div>
        </div>
      
        <div class="card card-bg shadow-sm" style="width: 400px; max-width: 400px!important;">
          <div class="card-header bg-transparent border-0">
            <h4 class="mb-0"><i class="far fa-clone pr-1"></i>Student Details</h4>
          </div>
          <div class="card-body pt-0">
            <table class="table table-borderless" style="margin-top: 20px!important">
               <tr>
                <th width="30%" class="table-active">College</th>
                <td ><?php echo $college; ?></td>
              </tr>
              <tr>
                <th width="30%" class="table-active">Program</th>
                <td ><?php echo $program; ?></td>
              </tr>
              
              <tr>
                  <th width="30%" class="table-active">Year </th>
                  <td ><?php echo $year; ?></td>
                </tr>
                <tr>
                  <th width="30%" class="table-active">Block </th>
                  <td><?php echo $block; ?></td>
                </tr>
              <tr>
                <th width="30%" class="table-active">Gender</th>
                <td><?php echo $gender; ?></td>
              </tr>
              <tr>
                <th width="30%" class="table-active">Address</th>
                <td><?php echo $address; ?></td>
              </tr>
              
            </table>
          </div>
        </div>
        
    </div>
  </div>
</div>

<?php 
} // if isset getid end
?>