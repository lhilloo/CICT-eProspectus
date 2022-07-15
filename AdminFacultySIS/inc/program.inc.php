
<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }

include_once 'inc/year.inc.php';
class Program extends YearLevel {


    public function getProgramlist() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_programs";
        $data = null;

			if ($sql = $conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data; 
$conn->close();
    }

    public function getProgramByCollege($college) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_programs WHERE program_college = '$college'";
        $data = null;

			if ($sql = $conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data; 
$conn->close();
    }


	public function getProgram($program_id) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT program_id, program_name FROM catsu_programs WHERE program_id = '$program_id'";
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

/**
 * 
 */
class College extends Program
{
	
	 public function getCollege() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT college_name, college_desc FROM catsu_colleges";
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