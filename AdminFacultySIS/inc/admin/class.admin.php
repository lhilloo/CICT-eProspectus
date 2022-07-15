<?php

require_once 'inc/student.inc.php';


class Admin extends Student {
    
    public function getAdmin($adminID) {
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "SELECT * FROM catsu_admin WHERE admin_id= '$adminID';";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }

        return $data;
    }

    public function collegeTotal() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "SELECT * FROM catsu_colleges;";
        if ($sql = $conn->query($query)) {
            $rowcount = mysqli_num_rows($sql);
        }

        return $rowcount;
$conn->close();
    }

    public function courseTotal() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "SELECT * FROM catsu_courses;";
        if ($sql = $conn->query($query)) {
            $rowcount = mysqli_num_rows($sql);
        }

        return $rowcount;
$conn->close();
    }

    public function facultyTotal() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        
        $query = "SELECT * FROM catsu_faculty WHERE status = '1';";
        if ($sql = $conn->query($query)) {
            $row = mysqli_num_rows($sql);
        }
        return $row;
$conn->close();
    }

    public function allFaculty() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $data = null;
        
        $query = "SELECT * FROM catsu_faculty WHERE status = '1' ORDER BY faculty_lname;";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }
        return $data;
$conn->close();
    }
    public function getFacultyRemoved() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $data = null;
        
        $query = "SELECT * FROM catsu_faculty WHERE status = '0' ORDER BY faculty_lname;";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }
        return $data;
$conn->close();
    }
    public function getStudentRemoved() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $data = null;
        
        $query = "SELECT * FROM catsu_student WHERE status = '0' ;";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }
        return $data;
$conn->close();
    }
    public function getCourseRemoved() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $data = null;
        
        $query = "SELECT * FROM catsu_courses WHERE status = '0' ;";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }
        return $data;
$conn->close();
    }

    public function programTotal() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        
        $query = "SELECT * FROM catsu_programs;";
        if ($sql = $conn->query($query)) {
            $row = mysqli_num_rows($sql);
        }
        return $row;
$conn->close();
    }
    public function studentTotal() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        
        $query = "SELECT * FROM catsu_student WHERE status = '1';";
        if ($sql = $conn->query($query)) {
            $row = mysqli_num_rows($sql);
        }
        return $row;
$conn->close();
    }
    public function studentByProgram($programID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        
        $query = "SELECT * FROM catsu_student WHERE program = '$programID' AND status='1';";
        if ($sql = $conn->query($query)) {
            $row = mysqli_num_rows($sql);
        }
        return $row;
$conn->close();
    }

    public function allCollegeFaculty($course_college) {
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "SELECT * FROM catsu_faculty WHERE college_name= '$course_college';";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }

        return $data;
$conn->close();
    }

    public function getAcadYr(){
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_academicyr WHERE status=1;";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }

        return $data;
$conn->close();
    }

    public function setAcadYear($year_start, $year_end, $semester, $status) {
        
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");    
            $query = "INSERT INTO catsu_academicyr (year_start, year_end, semester, status) VALUES (?,?,?,?);";
            $stmt1 = $conn->prepare($query);
            $stmt1->bind_param("sssi", $year_start, $year_end, $semester, $status);
            $result= $stmt1->execute();
            if ($result) {
                return true;
            } else {
                return false;
            }
       
        $conn->close();
    }

    public function unsetAcadYear() {
        
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "UPDATE catsu_academicyr SET status = ?"; 
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", 0);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }

        $conn->close();
    }

    public function getAcadYear($yearID) {
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_academicyr WHERE acad_yearid  = '$yearID';";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }

        return $data;
    }
    

    public function getSem(){
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_semester;";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }

        return $data;
    }

    public function getColleges(){
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_colleges;";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }

        return $data;
    }
    public function programByCollege($collegeName){
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_programs  WHERE program_college = '$collegeName' ;";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }
        return $data;
    }

    public function getStudentProg($programID) {
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_student WHERE program = '$programID' AND status = '1';";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[]=$row;
            }
        }
        return $data;
    }

    
    public function addFaculty($firstname, $middlename, $lastname, $username, $userpass, $userRole, $facultyLevel,$collegeName, $status ) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "INSERT INTO catsu_faculty (faculty_fname, faculty_mname, faculty_lname, username, user_pass, user_role, faculty_level, college_name, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssi", $firstname, $middlename, $lastname, $username, $userpass, $userRole, $facultyLevel,$collegeName, $status);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
        $conn->close();
    }

    public function facultyProfileImg($facultyID) {
        $status = 1;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "INSERT INTO faculty_profileimg (faculty_id, status) VALUES (?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $facultyID, $status);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
        $conn->close();
    }

    public function getFacultyID($firstname, $lastname) {
        $facultyID = 0;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT facultyID FROM catsu_faculty WHERE faculty_fname = '$firstname' AND faculty_lname = '$lastname';";
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $facultyID = $row['facultyID'];
            }
        }
        return $facultyID;
        $conn->close();
    }

    public function deactivateFaculty($facultyID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "UPDATE catsu_faculty SET status = '0' WHERE facultyID = '$facultyID';";
        if ($sql = $conn->query($query)) {
                        
                        return true;
                    } else {

                        return false;
                    }
              $conn->close();       
    }
    public function restoreFaculty($facultyID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "UPDATE catsu_faculty SET status = '1' WHERE facultyID = '$facultyID';";
        if ($sql = $conn->query($query)) {
                        
                        return true;
                    } else {

                        return false;
                    }
              $conn->close();       
    }

    public function deactivateStudent($studentID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "UPDATE catsu_student SET status = '0' WHERE student_no = '$studentID';";
        if ($sql = $conn->query($query)) {
                        
                        return true;
                    } else {

                        return false;
                    }
              $conn->close();       
    }
    public function restoreStudent($studentID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "UPDATE catsu_student SET status = '1' WHERE student_no = '$studentID';";
        if ($sql = $conn->query($query)) {
                        
                        return true;
                    } else {

                        return false;
                    }
              $conn->close();       
    }

    public function deactivateCourse($courseID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "UPDATE catsu_courses SET status = '0' WHERE course_code = '$courseID';";
        if ($sql = $conn->query($query)) {
                        
                        return true;
                    } else {

                        return false;
                    }
              $conn->close();       
    }
    public function restoreCourse($courseCode) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "UPDATE catsu_courses SET status = '1' WHERE course_code = '$courseCode';";
        if ($sql = $conn->query($query)) {
                        
                        return true;
                    } else {

                        return false;
                    }
              $conn->close();       
    }

    public function updateStudentBlock($studentID, $blockID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "UPDATE catsu_student SET block = '$blockID' WHERE student_no = '$studentID';";
        if ($sql = $conn->query($query)) {
                        
                        return true;
                    } else {

                        return false;
                    }
              $conn->close();       
    }

    public function getFaculty($facultyID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        // $query = "SELECT  faculty_fname, faculty_mname, faculty_lname, faculty_level FROM catsu_faculty WHERE facultyID = '$facultyID'";
        $query = "SELECT * FROM catsu_faculty WHERE facultyID = '$facultyID';";
        $data = array();
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
            }
        }
        return $data;
        $conn->close();
    }

    public function updateFaculty($facultyID, $firstname, $middlename, $lastname, $facultyLevel, $collegeName) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "UPDATE catsu_faculty SET faculty_fname = '$firstname', 
            faculty_mname = '$middlename',
            faculty_lname = '$lastname', 
            faculty_level = '$facultyLevel',
            college_name = '$collegeName' WHERE 
            facultyID = '$facultyID' ;";
        if ($conn->query($query)) {
            return true;
        } else {
            return false;
        }

        $conn->close();
    }

    public function updateCourse($courseID, $courseCode, $csuCourseCode, $courseDesc, $courseUnit) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "UPDATE catsu_courses SET course_code = '$courseCode', 
            course_csccode = '$cscCourseCode',
            course_desc = '$courseDesc', 
            course_unit = '$courseUnit' WHERE 
            course_id = '$courseID' ;";
        if ($conn->query($query)) {
            return true;
        } else {
            return false;
        }

        $conn->close();
    }

    public function assignFaculty($facultyID, $course, $program, $year, $block) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
         $query = "INSERT INTO faculty_assigned (faculty_id, course_code, program, year, block) VALUES (?, ?, ?, ?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isiis", $facultyID, $course, $program, $year, $block);
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
        $conn->close();
    }

    public function getAssignedFac($facultyID) {
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM faculty_assigned WHERE faculty_id = '$facultyID';";
        $data = array();
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
            }
        }
        return $data;
        $conn->close();
    }

    public function addCourse($courseCode, $college, $csuCourseCode, $courseDesc, $courseLevel, $courseSem, $program, $courseUnit, $status ) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "INSERT INTO catsu_courses (course_code, course_college, course_csccode, course_desc, course_level, course_sem, course_program, course_unit, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssiiiii", $courseCode, $college, $csuCourseCode, $courseDesc, $courseLevel, $courseSem, $program, $courseUnit, $status );
        $result = $stmt->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
        $conn->close();
    }



} //class closing curly bracket
