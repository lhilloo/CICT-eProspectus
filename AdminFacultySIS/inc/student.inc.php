<?php
	if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }

	include_once 'inc/program.inc.php';
	/**
	 * 
	 */
	class Student extends Program
	{
		public function getStudent($student_id)
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        	$query = "SELECT student_id, student_no, firstname, lastname, gender, program, block, yearlevel FROM catsu_student WHERE student_id = '$student_id'";
        	$data = null;

				if ($sql = $conn->query($query)) {
					while ($row = mysqli_fetch_assoc($sql)) {
						$data[] = $row;
					}
				}

				return $data; 
$conn->close();
		}

		public function getStudentInfo()
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        	$query = "SELECT student_id, student_no, firstname, lastname, gender, program, block, yearlevel, status FROM catsu_student ORDER BY lastname";
        	$data = null;

				if ($sql = $conn->query($query)) {
					while ($row = mysqli_fetch_assoc($sql)) {
						$data[] = $row;
					}
				}

				return $data; 
$conn->close();
		}

        public function getStudentByProgram($program_id)
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        	$query = "SELECT student_id, student_no, firstname, lastname, gender, program, block, yearlevel, status FROM catsu_student WHERE program = '$program_id' ORDER BY lastname";
        	$data = null;

				if ($sql = $conn->query($query)) {
					while ($row = mysqli_fetch_assoc($sql)) {
						$data[] = $row;
					}
				}

				return $data; 
$conn->close();
		}


		public function getStudentPF($student_id) {
			
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query_img = "SELECT * FROM student_profileimg WHERE student_id = '$student_id';";
        $result_img = mysqli_query($conn, $query_img);
        $studentprofile = "<img src='http://catsusis-student.epizy.com/uploads/profiledefault.png' class='student-profileimg'>";
        while ($row_img = mysqli_fetch_assoc($result_img)) {
            /**
             * displays the correct photo on homepage
             * */
            if ($row_img['status'] == 0) {
                $studentprofile = "<img src='http://catsusis-student.epizy.com/uploads/profile-student-".$student_id.".jpg?'".mt_rand()." class='student-profileimg'>";
            }
        }

        return $studentprofile;
$conn->close();
    	}

    	public function getStudDetails($studentId)
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        	$query = "SELECT student_id, student_no, firstname, lastname, gender, program, block, yearlevel, address FROM catsu_student WHERE student_no = '$studentId';";
        	$data = null;

				if ($sql = $conn->query($query)) {
					while ($row = mysqli_fetch_assoc($sql)) {
						$data[] = $row;
					}
				}

				return $data; 
				$conn->close();
		}
		public function getBlockByCollege() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "SELECT block_id, block_name FROM student_blocking";
        $data = null; 

				if ($sql = $conn->query($query)) {
					while ($row = mysqli_fetch_assoc($sql)) {
						$data[] = $row;
					}
				}

				return $data; 
$conn->close();
    }

	

	}

?>