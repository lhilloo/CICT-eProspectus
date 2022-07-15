<?php 
if (isset($_SESSION['userRole'])) 
{
  if ($_SESSION['userRole'] == 'admin') 
  {
  	if (isset($_GET['college_name'])) 
  	{
  		$collegeName = $_GET['college_name'];
			
        if ($_GET['college_name'] == $collegeName) 
        {
            require_once 'inc/admin/class.admin.php';
            $adminObj = new Admin();        
            $total_students = $adminObj->studentTotal();
						$total_programs = $adminObj->programTotal();
?>


<?php 
	$programs = $adminObj->programByCollege($collegeName);
	if (!empty($programs)) 
	{
		// Displays if there is program loaded
?> 

<div class="mt-2 ml-4">
	<?php
	if (isset($_GET['program_code'])) {
		
	
	?>
	<a href="index.php?content=student-view-program&college_name=<?php echo $collegeName; ?>" style="margin-left: 3em; text-decoration: none;">
<?php 
	
	} elseif (isset($_GET['college_name'])) {

  ?>
  <a href="index.php?content=student-view-college" style="margin-left: 3em; text-decoration: none;">
  <?php
  	}
  ?>
		<div class="fixed-left">
      <i class="fas fa-arrow-left" style="margin-right: 0.5em"></i>Go back
    </a>
      <h6 class="text-center lead mt-3">Select a program to view students</h6>
    </div>
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



<div class="card" style="max-width: 20%; margin-top: 10px!important; margin-left: 0!important; margin-right: 0!important; padding: 0!important">
	<!-- <img class="mx-auto" src="./uploads/programs/<?php echo $programCode;?>.png" alt="<?php echo $programCode; ?>" > -->
	<a href="index.php?content=student-view-program&college_name=<?php echo $collegeName;?>&program_code=<?php echo $programID;?>"><button class="admin-viewBtn"><?php echo $programCode;?></button></a>
</div>


<?php
		}
		if (isset($_GET['program_code'])) {
			$programID = $_GET['program_code'];

            $prog_students = $adminObj->studentByProgram($programID);
			

			if ($_GET['program_code'] == $programID) {
				$programName = null;

?>
<div class="container mb-5">
  <div class="container justify-content-center align-middle">
      <table class="table table-bordered table-hover" id="studentTable" cellspacing="0" style="width:100%">
        <thead class="table-head">
          <th scope="col" style="width: 15%;">ID #</th>
          <th scope="col" style="width: 20%;">Name</th>
          <th scope="col" style="width: 5%;">Year</th>
          <th scope="col" style="width: 10%;">Block</th>
          <th scope="col" style="width: 25%;">Program</th>
          <th style="width: 25%;">Action</th>
        </thead>
        <tbody style="border-width: 1px!important;">

<?php
        $programs = $adminObj->getProgramlist();

				for ($i=0; $i < $total_programs; $i++) { 
					if ($programID == $programs[$i]['program_id']) {
						$programName = $programs[$i]['program_name']; //get the program name from catsu_program tbl
						$programCode = $programs[$i]['program_code'];
					}

				}

        $students = $adminObj->getStudentProg($programID);



          if (!empty($students)) {
            for ($k=0; $k < $prog_students; $k++) { 
              $student_name = $students[$k]['lastname'] . ", " . $students[$k]['firstname']; 
              $student_id = $students[$k]['student_no'];
              $block = $students[$k]['block'];
              $status = $students[$k]['status'];
              if ($status == 1) {

               $blocks = $adminObj->getBlockByCollege();

               foreach ($blocks as $row) {
                 if ($block == $row['block_id']) {
                   $block = $row['block_name'];
                 }
               }

              $year = $students[$k]['yearlevel'];
              $rows = $adminObj->getAllYearLevel();
              foreach ($rows as $row) {
                if ($year == $row['year_id']) {
                  $year = $row['year_level'];
                }
              }

  
        ?>

          <tr style="text-align: center;">
            <td data-table-header="ID #"><?php echo $student_id; ?></td>
            <td style="text-align: left; padding-left: 2em!important;"><?php echo $student_name; ?></td>
            <td><?php echo $year; ?></td>
            <?php 
            if (!empty($block)) {
              echo '<td>'.$block.'</td>';
            } else {
              echo '
              <td><a href="index.php?content=student-block-assign&id='.$student_id.'&college='.$collegeName.'">Add Block</a></td>
              ';
            }
            ?>
            <td><?php echo $programName; ?></td>
            <td style="text-align: center;">

                    <a href="index.php?content=student-view-details&college=<?php echo $collegeName; ?>&studentid=<?php echo $student_id;?>"><button class="btn-primary" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px; width: 90px;"><i class="fas fa-info-circle" style="margin-right:5px;"></i>View</button></a>

                    <a href="index.php?content=student-remove&college=<?php echo $collegeName; ?>&id=<?php echo $student_id;?>"><button class="btn-danger" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px; width: 90px;"><i class="fas fa-minus-circle" style="margin-right:5px;"></i>Remove</button></a>
                </td>
          </tr>
        
        <?php
            } // if student status condition end
          }
        } else {
        	$data = print_r($students);
          echo '<tr style="text-align: center;">
                  <td colspan="6"><img src="./uploads/nodata.png" alt="No Data" style="margin-top: 100px;" width="300">
                  <p  style="margin-bottom: 100px;" >Sorry, no student is loaded for ' . $programCode . '</p></td>
                </tr>';
        }
        ?>
        </tbody>
      </table>
  </div>
</div>

<?php 
				
				

?>


<?php
			} //if end $_get progcode



		} //if isset end 
		else {
?>
<!-- Show all students table in selected college -->
<div class="container mb-5">
  <div class=" justify-content-center align-middle">

      <table class="table table-hover table-bordered" id="studentTable" width="100%">
        <thead class="table-head">
          <th scope="col" style="width: 15%;">ID #</th>
          <th scope="col" style="width: 20%;">Name</th>
          <th scope="col" style="width: 5%;">Year</th>
          <th scope="col" style="width: 10%;">Block</th>
          <th scope="col" style="width: 25%;">Program</th>
          <th style="width: 25%;">Action</th>
        </thead>
        <tbody style="border-width: 1px!important;">

        <?php
          $students = $adminObj->getStudentInfo();

          if (!empty($students)) {
            for ($k=0; $k < $total_students; $k++) { 
              $student_name = $students[$k]['lastname'] . ", " . $students[$k]['firstname']; 
              $student_id = $students[$k]['student_no'];
              $block = $students[$k]['block'];
              $status = $students[$k]['status'];
              if ($status == 1) {
               

              $blocks = $adminObj->getBlockByCollege();
              foreach ($blocks as $row) {
                 if ($block == $row['block_id']) {
                   $block = $row['block_name'];
                 }
               }

              $year = $students[$k]['yearlevel'];
              $rows = $adminObj->getAllYearLevel();
              foreach ($rows as $row) {
                if ($year == $row['year_id']) {
                  $year = $row['year_level'];
                }
              }

              $student_program = $students[$k]['program'];
              if (!empty($student_program)) {

                $programs = $adminObj->getProgramlist(); //return array data from catsu_program

                for ($i=0; $i < $total_programs; $i++) { 
                  $program_id = $programs[$i]['program_id']; //get the id from catsu_program tbl

                  if ($program_id == $student_program) {
                    $student_program = $programs[$i]['program_name']; //assign program code
                  }

                }

              }
        ?>

          <tr style="text-align: center;  padding: 2em!important;">
            <td data-table-header="ID #"><?php echo $student_id; ?></td>
            <td data-table-header="Name" style="text-align: left; padding-left: 2em!important;" ><?php echo $student_name; ?></td>
            <td data-table-header="Year"><?php echo $year; ?></td>
            <?php 
            if (!empty($block)) {
              echo '<td>'.$block.'</td>';
            } else {
              echo '
              <td><a href="index.php?content=student-block-assign&id='.$student_id.'&college='.$collegeName.'">Add Block</a></td>
              ';
            }
            ?>
            <td data-table-header="Program"><?php echo $student_program; ?></td>
            <td style="text-align: center;">
                <a href="index.php?content=student-view-details&college=<?php echo $collegeName; ?>&studentid=<?php echo $student_id;?>"><button class="btn-primary" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px; width: 90px;"><i class="fas fa-info-circle" style="margin-right:5px;"></i>View</button></a>

                <a href="index.php?content=student-remove&college=<?php echo $collegeName; ?>&id=<?php echo $student_id;?>"><button class="btn-danger" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px; width: 90px;"><i class="fas fa-minus-circle" style="margin-right:5px;"></i>Remove</button></a>
            </td>
          </tr>
        
        <?php
            }
          }
        } else {
          echo '<tr>
                  <td colspan="6"><img src="./uploads/nodata.png" alt="No Data" width="400"></td>
                </tr>';
        }
        ?>
        
         
        </tbody>
      </table>
  </div>
</div>


<?php
		} //else isset end
?>

  </div>
</div>

<?php
	} //if isset college closing
	else {
		// Display when there is no program loaded
?>


<div class="container margin-top">
	<div class="row justify-content-center text-align-center"></div>
  <div class="row justify-content-center">
  	<div style="max-width: 450px; text-align: center;">
  		<img src="./uploads/nodata.png" alt="No Data" width="500">
  		<p>Sorry, no data is loaded from the database.</p>
  		<a href="index.php?content=student-view-college"><button class="round-viewBtn">Click here to go back to previous page</button></a>
  	</div>
 </div>
</div>



<?php
	}
		} else {
			echo 
		  	'<script language="javascript">
		      alert("No college selected! Returning to previous page.");
		      window.location.href = "index.php?content=student-view-college";
		  	</script>';
		}
	} else {
		echo 
	  	'<script language="javascript">
	      alert("No college selected! Returning to previous page.");
	      window.location.href = "index.php?content=student-view-college";
	  	</script>';
	}

  } else {
  	echo 
  	'<script language="javascript">
      alert("Unauthorized Access! Redirecting to login page");
      window.location.href = "login.php";
  	</script>';
  }
} else {
	echo 
  	'<script language="javascript">
      alert("Please login first! Redirecting to login page");
      window.location.href = "login.php";
  	</script>';
}
?>
<script>
    $(document).ready(function() {
          $('#studentTable').DataTable({
            "order": [[ 1, "asc" ]],
      'columnDefs': [{
        'targets': [4], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
     }]
   });
    });
</script>