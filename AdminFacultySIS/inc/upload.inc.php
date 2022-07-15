<?php
	if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {

        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        die();

    }

	session_start();
	include('config.inc.php');
	$id = $_SESSION['loggedin'];

	if (isset($_POST['submit']) && isset($_FILES['profile_img'])) {

		$img_name 	= $_FILES['profile_img']['name'];
		$img_size 	= $_FILES['profile_img']['size'];
		$tmp_name 	= $_FILES['profile_img']['tmp_name'];
		$error 		= $_FILES['profile_img']['error'];

		$img_ext = explode('.', $img_name);
		$img_ext_lc = strtolower(end($img_ext));
		$allowed_exts = array("jpg", "jpeg");

		if (in_array($img_ext_lc, $allowed_exts)) {
			if ($error === 0 ) {
				if ($img_size < 500000000) {
					$new_img_name = "profile-faculty".$id.".".$img_ext_lc;
					$img_upload_path = '../uploads/'.$new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);

					$sql = "UPDATE faculty_profileimg SET status = 0 WHERE faculty_id = '$id'";
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					header('location: ../index.php?uploadsuccess');
				}else {
					echo '<script>alert("Too large file size!");</script>';
					echo '<script>window.location.href = "../index.php";</script>';
				}
			}else {
				echo '<script>alert("There was an error uploading your file!");</script>';
				echo '<script>window.location.href = "../index.php";</script>';
			}
		}else{
			echo '<script>alert("Invalid file type!");</script>';
			echo '<script>window.location.href = "../index.php";</script>';
		}
		die();
	}
?>