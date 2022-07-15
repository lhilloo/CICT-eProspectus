<?php 
if (isset($_POST['remove'])) {
	$studentID = $_POST['studentID'];
	$college = $_POST['college'];

	if (!empty($studentID)) {
		require_once "inc/admin/class.admin.php";
  		$adminObj = new Admin();
  		$result = $adminObj->deactivateStudent($studentID);
  		if ($result == true) {
  			echo '<script language="javascript">
		alert("Student successfully removed!");
                            window.location.href = "index.php?content=student-view-program&college_name=' .  $college . ' ";
                </script>';
  		} // if result
  		else {
			echo '<script language="javascript">
					alert("Failed to remove student!");
                    window.location.href = "index.php?content=student-view-program&college_name=' . $college . ' ";
                </script>';
  		} // else result

	} // end if for !empty id
	else {
		echo '<script language="javascript">
		alert("Invalid action");
                            window.location.href = "index.php?content=student-view-program&college_name=' . $college . ' ";
                </script>';
	} //else !empty id

} else {

	if (isset($_GET['id'])) {
		$studID = $_GET['id'];
		$college = $_GET['college'];
?>


<div class="acad-year-form mt-5 justify-content-center">
	<div class="form" style="text-align: center;">
		<div class="login-form">
			<form action="index.php?content=student-remove" method="post">
				<p class="title-head text-align-center">Are you sure you want to remove this student?</p>
				<input type="hidden" name="studentID" value="<?php echo $studID;?>">
				<input type="hidden" name="college" value="<?php echo $college;?>">
				<div class="form-group">
					<input class="btn-success" type="submit" name="remove" value="YES" style="padding: 15px; border-radius: 20px; border: none;">
					<button class="btn-danger" style="padding: 15px; border-radius: 20px; border: none;"><a href="index.php?content=student-view-program&college_name=<?php echo $college;?>" style="color:#FFF;">NO</a></button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
	} // if isset get id 
} // else isset post remove
?>