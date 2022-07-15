<?php
	include_once('courses.inc.php');
	/**
	 * 
	 */
	class Grades extends Course
	{
		
		public function getGrades($student_id, $course_id)
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
			$query  = "SELECT grade_midterm, grade_final, grade_programid, grade_courseid, grade_yearlevel, grade_studentid FROM student_grade WHERE student_grade.grade_studentid ='$student_id' AND student_grade.grade_courseid = '$course_id';";
			$stmt 	= $conn->prepare($query);
			$data = array();
			if ($stmt->execute()) {
				$result = $stmt->get_result();
				while ($row = mysqli_fetch_assoc($result)) {
					$data[] = $row;
				}
			}
			return $data;
		}
	}
?>