<?php
	if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {

        header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );

        die();

     }
	session_start();
	//include('config.inc.php');
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
				if ($img_size < 50000000) {
					$new_img_name = 'profile-student-'.$_SESSION['loggedin'].'.'.$img_ext_lc;
					$img_upload_path = '../uploads/'.$new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);

					$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

					$sql = "UPDATE student_profileimg SET status = '0' WHERE student_id = '$id';";
					$stmt = $conn->prepare($sql);
					$result = $stmt->execute();

					if ($result) {
						echo '<script>alert("USERID: '.$_SESSION['loggedin'].'-- Upload path: '.$img_upload_path.'"); window.location.href = "../index.php";</script>';;
						//echo '<script>alert("Successfully uploaded your profile image.");window.location.href = "../index.php";</script>';
					} else {
						echo '<script>alert("Execution failed!");
					window.location.href = "../index.php";</script>';
					}
					
					$conn->close();
				}else {
					echo '<script>alert("Too large file size!");
					window.location.href = "../index.php";</script>';
					echo '<script>window.location.href = "../index.php";</script>';
				}
			}else {
				echo '<script>alert("There was an error uploading your file!");
				window.location.href = "../index.php";</script>';
				echo '<script>window.location.href = "../index.php";</script>';
			}
		}else{
			echo '<script>alert("Invalid file type!");
			window.location.href = "../index.php";</script>';
			echo '<script>window.location.href = "../index.php";</script>';
		}
		// die();
	}
?>