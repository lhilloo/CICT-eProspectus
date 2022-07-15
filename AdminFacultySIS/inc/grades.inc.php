<?php
include_once('inc/courses.inc.php');
  /**
   * 
   */
  class Grades extends Courses
  {
  	
  	 function inputRemark($grade_remark, $grade_courseid, $grade_studentid, $grade_facultyid)
  	{
  			$conn  = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
  			$query1 = "SELECT grade_id FROM student_grade WHERE student_grade.grade_studentid = '$grade_studentid' AND student_grade.grade_courseid = '$grade_courseid';";
  			$stmt1  = $conn->prepare($query1);
  			$stmt1->execute();
  			$result = $stmt1->get_result();
  			if ($result->num_rows > 0) {
  				$query = "UPDATE student_grade SET grade_remark = ?, grade_facultyid = ? WHERE student_grade.grade_studentid = '$grade_studentid' AND student_grade.grade_courseid = '$grade_courseid';";
		  		$stmt = $conn->prepare($query);
		  		$stmt->bind_param("si", $grade_remark, $grade_facultyid);
		  		$stmt->execute();
		  		echo '<script language="javascript"> alert("Successfully updated student grade remark!");
                        window.location.href = "index.php?content=student-list";
                    </script>';
  			} else {
  				echo '<script language="javascript"> alert("Input student grade first!");
                        window.location.href = "index.php?content=student-list";
                    </script>';
  			}
		  	$conn->close();
  	}

  	function inputFinalGrade($grade_final, $grade_courseid, $grade_facultyid, $grade_studentid)
  	{
  			$conn  = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
  			$query1 = "SELECT grade_id FROM student_grade WHERE student_grade.grade_studentid = '$grade_studentid' AND student_grade.grade_courseid = '$grade_courseid';";
  			$stmt1  = $conn->prepare($query1);
  			$stmt1->execute();
  			$result = $stmt1->get_result();
  			if ($result->num_rows > 0) {
  				$query = "UPDATE student_grade SET grade_final = ?, grade_facultyid = ? WHERE student_grade.grade_studentid = '$grade_studentid' AND student_grade.grade_courseid = '$grade_courseid';";
		  		$stmt = $conn->prepare($query);
		  		$stmt->bind_param("di", $grade_final, $grade_facultyid);
		  		$stmt->execute();
		  		echo '<script language="javascript"> alert("This student is successfully graded!");
                        window.location.href = "index.php?content=student-list";
                    </script>';
  			} else {
  				echo '<script language="javascript"> alert("Input midterm grade first!");
                        window.location.href = "index.php?content=student-list";
                    </script>';
  			}
		  	$conn->close();
  	}
  	
  	function inputMidtermGrade($grade_midterm, $grade_programid, $grade_courseid, $grade_yearlevel, $grade_semid, $grade_studentid, $grade_facultyid)
  	{
  			$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
		  		$query = "INSERT INTO student_grade (grade_midterm, grade_programid, grade_courseid, grade_yearlevel, sem_id, grade_studentid, grade_facultyid) VALUES (?,?,?,?,?,?,?);";
		  		$stmt = $conn->prepare($query);
		  		$stmt->bind_param("diiiiii", $grade_midterm, $grade_programid, $grade_courseid, $grade_yearlevel, $grade_semid, $grade_studentid, $grade_facultyid);
                $result = $stmt->execute();  
                  if($result){
                      echo '<script language="javascript"> alert("This student is successfully graded!");
                      window.location.href = "index.php?content=student-list";</script>';
                  } else {
                      
                      echo '<script language="javascript"> alert("This student is unsuccessfully graded!");
                      window.location.href = "index.php?content=student-list";</script>';
                  }
                  
		  		$conn->close();
  	}

  	function getGrades($student_id, $course_id)
  	{
  		$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT grade_id, grade_midterm, grade_final, grade_programid, grade_courseid, grade_yearlevel, grade_studentid, grade_facultyid, grade_remark FROM student_grade WHERE student_grade.grade_studentid = '$student_id' AND student_grade.grade_courseid = '$course_id';";
        $data = array();

			if ($sql = $conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data; 
      $conn->close();
  	}

    function getStudentGraded()
  	{
  		$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT grade_programid, grade_courseid, grade_yearlevel, grade_studentid, grade_facultyid FROM student_grade;";
        $data = array();

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