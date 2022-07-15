<?php
 
 include_once 'inc/program.inc.php';
 include_once 'inc/courses.inc.php';
/**
 *
 */
class Faculty extends Program {

    public function getPostData()
    {
        if (isset($_POST['posted'])) {

                        $newdata = array('course_code' => $_POST['course_code'],
                                         'program' => $_POST['program'],
                                         'year_level' => $_POST['year_level']
                                            );

                        $_SESSION['postdata'] = $newdata;
        }
    }

    public function getStudentData()
    {
       if (isset($_POST['post'])) {

                        $studentdata = array( 'student_id' => $_POST['student_id'] );

                        $_SESSION['studentpost'] = $studentdata;
        }
    }

    public function addCourse()
    {
        if (isset($_POST['add'])) {
            if (isset($_SESSION['addedcourse'])) {
                $item_array_id = array_column($_SESSION['addedcourse'], "course_id");

                if(in_array($_POST['course_id'], $item_array_id)){
                    echo "<script>alert('Selected course is already added to your dashboard.')</script>";
                    echo "<script>window.location.href = 'index.php?content=course-list';</script>";
                }else{

                $count = count($_SESSION['addedcourse']);
                $newdata = array('course_id' => $_POST['course_id']);
                
                array_push($_SESSION['addedcourse'], $newdata);

                
            }
            } else {
                $newdata = array('course_id' => $_POST['course_id']);
                
                $_SESSION['addedcourse'][0] = $newdata;
            }
        }
    }
    
    public function getFaculty($facultyID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT  faculty_fname, faculty_mname, faculty_lname, faculty_level, college_name FROM catsu_faculty WHERE facultyID = '$facultyID'";
        $data = array();
        if ($sql = $conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
            }
        }
        return $data;
$conn->close();
    }

    // Get the courses assigned to the faculty
    public function getFacCourse($facultyID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_courses WHERE course_faculty = '$facultyID' ORDER BY course_code, course_level DESC;";
        $data = array();
            if ($sql = $conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        return $data;
$conn->close();
    }

    // Get the specific course assigned to the faculty
    public function getCourse($facultyID, $course_id) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_courses WHERE course_faculty = '$facultyID' AND course_id = '$course_id';";
        $data = array();
            if ($sql = $conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        return $data;
$conn->close();
    }

    // Get the profile pic of Faculty
    public function getFacultyPF($facultyID) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query_img = "SELECT * FROM faculty_profileimg WHERE faculty_id = '$facultyID';";
        $result_img = mysqli_query($conn, $query_img);
        $profile = "<img src='uploads/profiledefault.png' class='faculty-profileimg'>";
        while ($row_img = mysqli_fetch_assoc($result_img)) {
            /**
             * displays the correct photo on homepage
             * */
            if ($row_img['status'] == 0) {
                $allowed_exts = array("jpg", "jpeg", "png");
                $profile = "<img src='uploads/profile-faculty".$facultyID.".jpg?'".mt_rand()." class='faculty-profileimg'>";
            }
        }

        return $profile;
$conn->close();
    }

    // Get the total numbers of enrolled students in a course
    public function studentsNumInCourse($year_level, $program){
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        
        $query = "SELECT * FROM catsu_student WHERE yearlevel = '$year_level' AND program = '$program';";
        if ($sql = $conn->query($query)) {
            $rowcount = mysqli_num_rows($sql);
        }

        return $rowcount;
$conn->close();
    }

    // Get all graded students

    public function getAllGrades() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM student_grade";
        $data = null;
			if ($sql = $conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
$conn->close();
    }

    // Get the number of all grades
    public function getNumGrades($course_id) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM student_grade WHERE grade_courseid = '$course_id';";
        if ($sql = $conn->query($query)) {
            $row = mysqli_num_rows($sql);
        }
        return $row;
$conn->close();
    }

    // Get the number of students graded in a course
    public function studentsGraded($course_id, $remarks) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        
        $query = "SELECT * FROM student_grade WHERE grade_courseid = '$course_id' AND  grade_remarks = '$remarks';";
        if ($sql = $conn->query($query)) {
            $row = mysqli_num_rows($sql);
        }
        return $row;
$conn->close();
    }

    // Get all students attending course

    public function studentsInCourse($year, $program) {
        $data  = array();
        $conn = $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM catsu_student WHERE yearlevel = '$year' AND program = '$program';";
        if ($sql = $conn->query($query)) {
            while ($row = $sql->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
$conn->close();
    }

    // Get all block
    public function getAllBlocks() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT * FROM student_blocking";
        $data = null;
			if ($sql = $conn->query($query)) {
				while ($row = mysqli_fetch_assoc($sql)) {
					$data[] = $row;
				}
			}
			return $data;
$conn->close();
    }

    public function addSchedule($sched_firstday, $sched_secday, $sched_firststarttime, $sched_firstendtime, $sched_secstarttime, $sched_secendtime,  $course_id, $program_id, $faculty_id, $block_id, $year_id)
    {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "INSERT INTO course_sched (sched_firstday, sched_secday, sched_firststarttime, sched_firstendtime, sched_secstarttime, sched_secendtime, sched_courseid, sched_programid, sched_facultyid, sched_blockid, sched_yearid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssiiiii",$sched_firstday, $sched_secday, $sched_firststarttime, $sched_firstendtime, $sched_secstarttime, $sched_secendtime, $course_id, $program_id, $faculty_id, $block_id, $year_id);
        $result = $stmt->execute();

        if ($result) {
            echo '<script>alert("Successfully added class schedule!");windows.location.href = "index.php?content=student-list";</script>';
        } else {
            //die(mysqli_error($conn));
            echo '<script>alert("There was a problem storing your data.");windows.location.href = "index.php?content=student-list";</script>';
        }

        $conn->close();
    }

    public function getCourseSchedule( $course_id, $block_id)
    {
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "SELECT * FROM course_sched WHERE sched_courseid = '$course_id' AND sched_blockid = '$block_id';";
        if ($sql = $conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
            return $data;
            $conn->close();
    }

    public function getAssignedCourses($facultyID)
    {
        $data = null;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "SELECT * FROM faculty_assigned WHERE faculty_id = '$facultyID' ORDER BY year;";

        if ($sql = $conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
            return $data;
            $conn->close();
    }
    public function getCourseID($courseCode)
    {
        $data;
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "SELECT course_id FROM catsu_courses WHERE course_code = '$courseCode';";

        if ($sql = $conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data = $row;
                }
            }
            return $data;
$conn->close();

    }

}