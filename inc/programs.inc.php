<?php
	include_once ('yearlevel.inc.php');
	/**
	 * 
	 */
	class Program extends YearLevel
	{
		public function getProgram($student_program)
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
			$query  = "SELECT program_id, program_name FROM catsu_programs WHERE program_id ='$student_program';";
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
	}
?>