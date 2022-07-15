<?php
		include_once ('courses.inc.php');

		/**
		 * 
		 */
		class Student extends Course
		{
			/**
			 * get student profile img
			 * */
			public function getStudentPF($student_id)
			{
				$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
				$query  = "SELECT id, student_id, status FROM student_profileimg WHERE student_id = '$student_id'";
				$stmt 	= $conn->prepare($query);
				$stmt->execute();
				$result = $stmt->get_result();
				$profileimg = "<img src='uploads/profiledefault.png' class='profileimg'>";
				while ($row = mysqli_fetch_assoc($result)) {
					/**
		             * displays the correct photo on homepage
		             * */
					if ($row['status'] == 0) {
		                $allowed_exts = array("jpg", "jpeg", "png");
		                $profileimg = "<img src='uploads/profile-student-".$student_id.".jpg?'".mt_rand()." class='profileimg'>";
		            }
				}

				return $profileimg;
			}

			public function getStudentInfo($student_id)
			{
				$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
				$query  = "SELECT student_id, student_no, firstname, lastname, gender, address, program, block, yearlevel FROM catsu_student WHERE student_id = '$student_id'";
				$stmt 	= $conn->prepare($query);
				$data = null;
				if ($stmt->execute()) {
					$result = $stmt->get_result();
					while ($row = mysqli_fetch_assoc($result)) {
						$data[] = $row;
					}
				}
				return $data;
			}

			public function getSignUp($student_no, $firstname, $lastname, $block, $gender, $address, $program, $yearlevel, $password, $status)
			{
				$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
				$query  = "SELECT student_id FROM catsu_student WHERE student_no = '$student_no'";
				$stmt 	= $conn->prepare($query);
				$stmt->execute();
				$result = $stmt->get_result();

				if (mysqli_num_rows($result) > 0) {
					echo '<script language="javascript">alert("Student ID # is already registered!"); 
                        window.location.href = "signup.php";
                    </script>';
				} else {
					$pattern = "/(\d){4}-(\d){5}/";

            		if (preg_match($pattern, $student_no)) {
            			$sql  = "INSERT INTO catsu_student (student_no, firstname, lastname, block, gender, address, program, yearlevel, password, status) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )";
            			$stmt = $conn->prepare($sql);
            			$stmt->bind_param("sssissiisi", $student_no, $firstname, $lastname, $block, $gender, $address, $program, $yearlevel, $password, $status);
            			$result = $stmt->execute();
            			if ($result == false) {
            				echo '<script language="javascript">alert("Failed to execute registration"); 
			                        window.location.href = "../login";   
			                        </script>';
			                exit();
            			}
            			$query = "SELECT * FROM catsu_student WHERE student_no ='$student_no' AND firstname ='$firstname'";
            			$result = mysqli_query($conn, $query);

            			if (mysqli_num_rows($result) > 0) {
            				while ($rows = mysqli_fetch_assoc($result)) {
            					$student_id = $rows['student_id'];
			                    $status  = 1;

			                    $query = "INSERT INTO student_profileimg (student_id, status) VALUES ( '$student_id', '$status')";
			                    if(mysqli_query($conn, $query)){
			                    	 echo    '<script language="javascript">alert("Successfully registered!"); 
			                        window.location.href = "../login";   
			                        </script>';
			                    } else {
			                    	 echo    '<script language="javascript">alert("Failed to register!"); 
			                        window.location.href = "../signup";   
			                        </script>';
			                    }

			                   
            				}
            			} else {
            				echo    '<script language="javascript">alert("There is a problem saving your data!"); 
			                        window.location.href = "signup";
			                        </script>';
            			}

            		} else {
            			echo    '<script language="javascript">alert("You entered an invalid Student ID no.!"); 
		                        window.location.href = "signup";
		                        </script>';
            		}
				}
				$conn->close();
			}

			public function getLogin($student_no, $password)
			{
				if (!empty($student_no) || !empty($password)) {
					$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
		            $query = "SELECT * FROM catsu_student WHERE student_no = '$student_no'";
		            $stmt  = $conn->prepare($query);
		            $stmt->execute();
		            $result = $stmt->get_result();
		            $count = $result->num_rows;
		                if ($count == 1) {
		                    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					if($row['status'] == 0) {
						echo '<script language="javascript">alert("Account disabled, please contact your admin. ");</script>';
exit();
					}
		                        $userpass = $row['password'];

		                        if (password_verify($password, $userpass)) {
		                            $_SESSION['loggedin']   = $row['student_id'];

		                            header("location: index");
		                        } else {
		                            echo '<script language="javascript">alert("Invalid Password");</script>';
		                        }
		                    }
		                } else {
		                    echo '<script language="javascript">alert("Invalid Student ID");</script>';
		                }
		        } else {
		            echo '<script language="javascript">alert("Student ID and password is required");</script>';
		        }
			}

			public function getPresAcadYear()
			{
				$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
		            $query = "SELECT * FROM catsu_academicyear WHERE status = '1'";
		            $stmt  = $conn->prepare($query);
		            $stmt->execute();
		           $data = null;
					if ($stmt->execute()) {
						$result = $stmt->get_result();
						while ($row = mysqli_fetch_assoc($result)) {
							$data[] = $row;
						}
				}
				return $data;
				$conn->close();
			}

		}	
?>