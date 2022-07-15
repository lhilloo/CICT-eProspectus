<?php

	/**
	 * 
	 */
	class Block
	{
		
		public function getBlock($student_block)
		{
			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
			$query  = "SELECT block_id, block_name FROM student_blocking WHERE block_id ='$student_block';";
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