<!--get student profile pic-->
<?php

	if (isset($_SESSION['loggedin'])) {
		$id = $_SESSION['loggedin'];

		$studentsObj = new Student();
		$studentPF 	 = $studentsObj->getStudentPF($id);
?>

<section>
	<div class="row">
		<div class="p-0">
			<div class="bg-white">
				<div class="px-0 pt-0 cover">
					<div class="media-body align-items-end profile-head">
						<div class="profile">
							<?php echo $studentPF;?>
							<div class="btn-group-vertical mx-auto my-3">
								<button class="profile-btn" data-toggle="modal" data-target="#modal">Edit Photo</button>
								<input type="button" class="profile-btn" onclick="logout()" value="Log out">
							</div>
							<div class="media-body my-5 mx-3">
<?php
		$studentInfo = $studentsObj->getStudentInfo($id);
		foreach ($studentInfo as $key => $value) {
			$student_id 	   = $studentInfo[$key]['student_id'];
			$student_block 	   = $studentInfo[$key]['block'];
			$student_yearlevel = $studentInfo[$key]['yearlevel'];
			$student_program   = $studentInfo[$key]['program'];
			if (!empty($student_block)) {
				$blockingObj = new Block();
				$blockings 	 = $blockingObj->getBlock($student_block);
				foreach ($blockings as $key => $value) {
					$yearlevelObj = new YearLevel();
					$yearlevel 	  = $yearlevelObj->getYearLevel($student_yearlevel);
					foreach ($yearlevel as $key => $value) {		
						$programObj = new Program();
						$programs  	= $programObj->getProgram($student_program);
						foreach ($programs as $key => $value) {
?>
								<table class="table table-sm table-borderless">
									<thead>
										<tr>
											<th class="dtahead" style="width: 100px;">Student No.: </th>
											<td class="text"><?php echo $studentInfo[$key]['student_no']; ?></td>
										</tr>
										<tr>
											<th class="dtahead" style="width: 100px;">Name: </th>
											<td class="text"><?php echo $studentInfo[$key]['lastname'] .", ". $studentInfo[$key]['firstname']; ?></td>
										</tr>
										<tr>
											<th class="dtahead" style="width: 100px;">Address: </th>
											<td class="text"><?php echo $studentInfo[$key]['address']; ?></td>
										</tr>
										<tr>
											<th class="dtahead" style="width: 100px;">Block & Year: </th>
											<td class="text">Block <?php echo $blockings[$key]['block_name'] ." - ". $yearlevel[$key]['year_level']; ?> Year</td>
										</tr>
										<tr>
											<th class="dtahead" style="width: 100px;">Program: </th>
											<td class="text"><?php echo $programs[$key]['program_name']; ?></td>
										</tr>
									</thead>
								</table>
<?php
						} //program
					} //yearlevel
				} //blocking
?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<hr style="margin-top: 100px;">
</section>
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<h2 class="modal-title" id="ModalLabel">Change profile photo</h2>
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true" class="close">&times;</span>
	        		</button>
	      	</div>
	      	<div class="modal-body">
	      		<div class="imgmodal">
	      			<?php echo $studentPF; ?>
	      		</div>
	      	</div>
	      	<div class="modal-footer">
<?php
/**
 * upload button script, logs out user if session is not started
 * */
	if (isset($_SESSION['loggedin'])) {
?>
		    	<form action="inc/upload.inc.php" method="post" enctype="multipart/form-data">
		    		<div class="input-group">
					 	<div class="w-75 my-auto">
							<input type="file" name="profile_img" class="custom-file-input my-auto" required>
						</div>
						<div class="input-group-append">
							<button class="btn btn-primary my-auto" type="submit" name="submit">Upload</button>
						</div>
					</div>
	      		</form>
<?php
	} else {
		header('location: inc/logout.inc.php');
	}
?>
	      	</div>
	  	</div>
	</div>
</div>
<div class="container-fluid mx-auto text-center">
	<a class="btn btn-primary" style="width: 180px; font-size: 20px; padding: 10px;" href="index?content=prospectus">View Prospectus</a>
</div>
<div class="container-fluid mx-auto text-center mb-5">
	<div class="wrapper mx-auto">
		<h2>Enrolled Courses</h2>
			<hr>
		<div class="w-75 mx-auto">
<?php

	$courseObj 	= new Course();
	$activeSchoolYear = $courseObj->getPresAcadYear();
	$current_sem = "";
	foreach ($activeSchoolYear as $active) {
		$current_sem = $active['semester'];
	}
	switch ($current_sem) {
			case '1st':
				$current_sem = 1;
				break;
			case '2nd':
				$current_sem = 2;
				break;
			
			default:
				break;
		}

	// echo "<script>alert('".$current_sem."');</script>";
	$courses 	= $courseObj->getCourses($student_program,  $student_yearlevel, $current_sem);
	
	
	foreach ($courses as $course) {
		$course_id 	= $course['course_id'];
		$gradeObj  	=  new Grades();
		$grades 	= $gradeObj->getGrades($student_id, $course_id);
		
		$grade_midterm = "";
		$grade_final   = "";

		foreach ($grades as $grade) {
			if (empty($grade['grade_midterm']) && empty($grade['grade_final'])) {
				$grade_midterm = "";
				$grade_final   = "";
			} else {
				$grade_midterm = $grade['grade_midterm'];
				$grade_final   = $grade['grade_final'];
			}
		}
?> 
			<div class="accordion-body">
				<button class="accordion"><?php echo $course['course_code']; ?></button>
				<div class="panel">
					<div class="data">
						<table>
							<tbody>
								<tr>
									<th class="dtahead"><h6>Midterm Grade: </h6></th>
									<td class="text">
										<?php
											if ($grade_midterm != "") {
												echo number_format($grade_midterm , 1);
											} else {
												echo $grade_midterm;
											}
										?></td>
								</tr>
								<tr>
									<th class="dtahead"><h6>Final Grade: </h6></th>
									<td class="text">
										<?php
											if ($grade_final != "") {
												echo number_format($grade_final , 1);
											} else {
												echo $grade_final;
											}
										?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
<?php
	} //courses
?>
		</div>
	</div>
</div>
<?php
			} else {
?>
	<div class="container mx-auto text-center">
		<h2 class="lead pt-5">You do not belong to a class block! Contact your professor for more info.</h2>
	</div>

<?php
			}
			
		} //end of student class
?>
<?php
	} else {
		header('location: login.php');
	}
?>