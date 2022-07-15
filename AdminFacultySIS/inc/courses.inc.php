
<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }

include_once 'inc/year.inc.php';
class Courses extends Program {


    public function getCourselist() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT course_id, course_level, course_sem, course_college, course_code, course_csccode, course_desc, course_unit, course_student, course_program, course_faculty, status FROM catsu_courses ORDER BY course_level ";
        $data = null;

			if ($sql = $conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data; 
$conn->close();
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
$conn->close();
    }

    public function getCourseByCollege($college) {
    	$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT course_id, course_level, course_sem, course_code, course_csccode, course_desc, course_unit, course_student, course_program, course_faculty FROM catsu_courses WHERE course_college = '$course_program' ORDER BY course_level";
        $data = null;

			if ($sql = $conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data; 
$conn->close();
    }

	public function getCourse($id) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_courses WHERE courses_id = '$id'";
        $data = null;

			if ($sql = $conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data; 
$conn->close();
    }
    public function getCourseCode($courseCode) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_courses WHERE course_code = '$courseCode'";
        $data = null;

			if ($sql = $conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data; 
$conn->close();
    }

    public function getSemester() {
    	$conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT sem_id, sem_name FROM catsu_semester";
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
