<?php
	include_once ('block.inc.php');
	/**
	 * 
	 */
	class YearLevel extends Block
	{
		public function getYearLevel($student_yearlevel)
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
			$query  = "SELECT year_id, year_level FROM student_yearlevel WHERE year_id ='$student_yearlevel';";
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

		public function getAllYearLevel()
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
			$query  = "SELECT year_id, year_level, year_name FROM student_yearlevel;";
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