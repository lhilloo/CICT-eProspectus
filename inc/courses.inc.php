<?php
	include_once ('programs.inc.php');
	/**
	 * 
	 */
	class Course extends Program
	{
		public function getCourses($student_program, $student_yearlevel, $current_sem)
		{
			$data = null;
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
			$query  = "SELECT * FROM catsu_courses WHERE course_program = '$student_program' AND course_level = '$student_yearlevel' AND course_sem = '$current_sem';";
			if ($sql = $conn->query($query)) {
            	while ($row = mysqli_fetch_assoc($sql)) {
                	$data[]=$row;
            	}
        	}

        return $data;
		}

		public function getAllCourses($student_program)
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
			$query  = "SELECT course_id, course_level, course_sem, course_code, course_desc, course_unit, course_student, course_program FROM catsu_courses WHERE catsu_courses.course_program ='$student_program';";
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

		public function getCourseInfo($course_program) {
    	$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT course_id, course_level, course_sem, course_code, course_csccode, course_desc, course_unit, course_student, course_program, course_faculty FROM catsu_courses WHERE course_program = '$course_program' ORDER BY course_level";
        $data = null;

			if ($sql = $conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data; 
    	}

		public function getSemester() 
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
	        $query = "SELECT sem_id, sem_name FROM catsu_semester";
	        $data = null;

				if ($sql = $conn->query($query)) {
					while ($row = mysqli_fetch_assoc($sql)) {
						$data[] = $row;
					}
				}
				return $data; 
		}
public function getPresAcadYear()
			{
				$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
		            $query = "SELECT * FROM catsu_academicyr WHERE status = '1'";
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