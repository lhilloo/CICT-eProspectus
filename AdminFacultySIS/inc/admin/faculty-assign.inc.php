<?php 
require_once 'inc/admin/class.admin.php';
$adminObj = new Admin;

if (isset($_POST['submit'])) {
	$facultyID = $_POST['facultyID'];
	$course = $_POST['course'];
	$program = $_POST['programid'];
	$year = $_POST['yearid'];
	$block = $_POST['block'];

	require_once 'inc/admin/class.admin.php';
	$adminObj = new Admin;

	$assignFaculty = $adminObj->getAssignedFac($facultyID);

	foreach ($assignFaculty as $row) {
		if ($row['faculty_id'] == $facultyID && $row['course_code'] == $course && $row['program'] == $program && $row['year'] == $year && $row['block'] == $block) {
			echo 
			'<script language="javascript">
              alert("Already assigned!");
              window.location.href = "index.php?content=faculty-list&assign=failed";
            </script>';
            exit();
		}
	}

	$result = $adminObj->assignFaculty($facultyID, $course, $program, $year, $block);

	if ($result) {
		echo
            '<script language="javascript">
              alert("Faculty assigned successfully!");
              window.location.href = "index.php?content=faculty-list&assign=success";
            </script>';
		
	} else {
		echo
            '<script language="javascript">
              alert("Faculty assign failed!");
              window.location.href = "index.php?content=faculty-assign&error=assign-failed";
            </script>';
	}
} // post submit condition end
 else {
	if (isset($_GET['id'])) {
		$facultyID = $_GET['id'];

		$faculty = $adminObj->getFaculty($facultyID);
		foreach ($faculty as $row) {
			// code...
		}
		$name = $row['faculty_fname'] . " " . $row['faculty_mname'] . " " . $row['faculty_lname'];
		$college = $row['college_name'];

?>


<div class="main-contents">
	<h6 class="header">Assign Faculty</h6>
</div>

<div class="d-flex justify-content-center align-middle">
	<div class="form">
		<div class="login-form">
			<form action="index.php?content=faculty-assign" method="post" id="regForm">
				<div class="form-group">
	                <label class="form-label">Faculty Details</label>
	                <div class="input-group">
	                    <div class="input-group-prepend">
	                        <div class="input-group-text">Name</div>
	                    </div>
	                <p class="form-control" style="width: 200px;"><?php echo $name; ?></p>
	                <hr class="mx-1">
	                <div class="input-group-prepend">
	                        <div class="input-group-text">College</div>
	                    </div>
	                <p class="form-control"  style="width: 200px;"><?php echo $college; ?></p>
	                    
	                </div>
                </div>


                <div class="form-group">
					<label class="form-label">Program</label>
					<select id="program" class="form-select" name="programid" required>
						<option value="">Select a program</option>
						<!-- Get Programs  -->
<?php 
$programs = $adminObj->programByCollege($college);
if (!empty($programs)) {
	foreach ($programs as $program) {
		$programName = $program['program_name'];
		$programId = $program['program_id'];

		echo '
			<option value="'.$programId.'">'.$programName.'</option>
		';
	}
} else {
	echo 
	'<option value="">No program loaded</option>';
}

?>
						
						
					</select>
				</div>

				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
	                        <div class="input-group-text">Year Level</div>
	                    </div>
					<select id="year" class="form-select" name="yearid" required style="width: 180px;">
						<option value="">Select year level</option>

					</select>
					<hr class="mx-1">
						<div class="input-group-prepend">
                            <div class="input-group-text">Block</div>
                        </div>
					<input style="width: 180px;" class="form-control" type="text" name="block" placeholder="Example: A" required>
					</div>
				</div>


				<div class="form-group">
					<label class="form-label">Course</label>
					<select id="course" class="form-select" name="course" required>
						<option value="">Select course</option>
					</select>
				</div>
				<input type="hidden" name="facultyID" value="<?php echo $facultyID;?>">
				 <div class="form-group mt-3" style="text-align: center;">
                        <input type="submit" name="submit" class="button btn-primary" value="Assign Faculty" style="width:200px; padding: 10px; border: none;">
                        <a href="index.php?content=faculty-list" class="btn-danger" style="color: #FFF; width:200px; padding: 10.5px 60px; border: none;">Cancel</a>
                    </div>   
			</form>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
    $('#program').on('change', function(){
        var programID = $(this).val();
        if(programID){
            $.ajax({
                type:'POST',
                url:'inc/ajaxCourseData.php',
                data:'programID=' +programID,
                success:function(html){
                    $('#year').html(html);
                    $('#course').html('<option value="">Select year level first</option>'); 
                }

            }); 
        }else{
            $('#year').html('<option value="">Select program first</option>');
            $('#course').html('<option value="">Select year level first</option>'); 
        }
    });
    
    $('#year').on('change', function(){
        var yearID = $(this).val();
        
        if(yearID){
            $.ajax({
                type:'POST',
                url:'inc/ajaxCourseData.php',
               	 data:'year_id=' +yearID,
                success:function(html){
                    $('#course').html(html);
                }
            }); 
        }else{
            $('#course').html('<option value="">Select year level first</option>'); 
        }
    });
});
</script>


<?php 
	} //isset get id condition end
} // else condition post end

?>