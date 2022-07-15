<?php 
if (isset($_POST['remove'])) {
	$facultyID = $_POST['facultyID'];

	if (!empty($facultyID)) {
		require_once "inc/admin/class.admin.php";
  		$adminObj = new Admin();
  		$result = $adminObj->deactivateFaculty($facultyID);
  		if ($result == true) {
  			echo '<script language="javascript">
		alert("Faculty successfully removed!");
                            window.location.href = "index.php?content=faculty-list";
                </script>';
  		} // if result
  		else {
			echo '<script language="javascript">
					alert("Failed to remove faculty!");
                    window.location.href = "index.php?content=faculty-list";
                </script>';
  		} // else result

	} // end if for !empty id
	else {
		echo '<script language="javascript">
		alert("Invalid action");
                            window.location.href = "index.php?content=faculty-list";
                </script>';
	} //else !empty id

} else {

	if (isset($_GET['id'])) {
		$facID = $_GET['id'];
?>


<div class="acad-year-form mt-5 justify-content-center">
	<div class="form" style="text-align: center;">
		<div class="login-form">
			<form action="index.php?content=faculty-remove" method="post">
				<p class="title-head text-align-center">Are you sure you want to remove this faculty?</p>
				<input type="hidden" name="facultyID" value="<?php echo $facID;?>">
				<div class="form-group">
					<input class="btn-success" type="submit" name="remove" value="YES" style="padding: 15px; border-radius: 20px; border: none;">
				<a href="index.php?content=faculty-list" class="btn-danger" style="padding:15px;border-radius:20px; border:none;">NO</a>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
	} // if isset get id 
} // else isset post remove
?>