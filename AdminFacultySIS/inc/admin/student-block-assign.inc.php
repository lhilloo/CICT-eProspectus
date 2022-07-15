<?php 
require_once 'inc/admin/class.admin.php';

$adminObj = new Admin;

if (isset($_POST['submit'])) {
	$studentID = $_POST['studentID'];
	$blockID = $_POST['blockID'];

	$result = $adminObj->updateStudentBlock($studentID, $blockID);
	if ($result) {
		echo 
			'<script language="javascript">
              alert("Successfully assign a block to student!");
              window.location.href = "index.php";
            </script>';
            exit();
	} else {
		echo 
			'<script language="javascript">
              alert("Failed to assign a block to student!");
              window.location.href = "index.php";
            </script>';
            exit();
	}

	exit();

}

if (isset($_GET['college']) && isset($_GET['id'])) {
	$college = $_GET['college'];
	$studentID = $_GET['id'];

?>

<div class="mt-2 ml-4">
	<div class="fixed-left">
		<a style="margin-left:50px;" href="index.php?content=student-view-program&college_name=<?php echo $college; ?>"><i class="fas fa-arrow-left" style="margin-right: 0.5em"></i>Go back</a>
	<h6 class="text-center lead mt-3">Select block for student <?php echo $studentID;?></h6>
	</div>
</div>

<div class="d-flex justify-content-center align-middle">
	<div class="form">
		<div class="login-form">
			<form action="index.php?content=student-block-assign" method="post" id="regForm">
				<div class="form-group">
					<select id="block" class="form-select" name="blockID" required>
						<option value="">Select a block</option>
<?php 
$blocks = $adminObj->getBlockByCollege();
foreach ($blocks as $block) {
	$blockID = $block['block_id'];
	$blockName = $block['block_name'];

	echo '
	<option value="'.$blockID.'">'.$blockName.'</option>
	';
}

?>
					</select>
				</div>
				<input type="hidden" name="studentID" value="<?php echo $studentID;?>">
				 <div class="form-group mt-3" style="text-align: center;">
                        <input type="submit" name="submit" class="button btn-primary" value="Submit" style="width:200px; padding: 10px; border: none;">
                        <a href="index.php?content=student-view-program&college_name=<?php echo $college; ?>" class="btn-danger" style="color: #FFF; width:200px; padding: 10.5px 60px; border: none;">Cancel</a>
                    </div>   
			</form>
		</div>
	</div>
</div>


<?php
}
?>