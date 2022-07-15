<?php
    //include library
    include_once 'library/tcpdf.php';
    
    if (isset($_POST['export'])) {
        $college_desc   = $_POST['college_desc'];
        $program_id     = $_POST['program_id'];
        $program_name   = $_POST['program_name'];
        $course_info    = $_POST['course_info'];
        $block_name     = $_POST['block_name'];
        $block_id       = $_POST['block_id'];
        $course_csc     = $_POST['course_csc'];
        $enrolled       = $_POST['enrolled'];
        $faculty_info   = $_POST['faculty'];
        $class_sched    = $_POST['class_sched'];

    class Student 
    {
        public function getStudentByProgram($program_id)
        {
            $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
            $query = "SELECT student_id, student_no, firstname, lastname, gender, program, block, yearlevel FROM catsu_student WHERE program = '$program_id' ORDER BY lastname";
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

    // Extend the TCPDF class to create custom Header and Footer
    class MYPDF extends TCPDF {
        public function Header() {
            $headerData = $this->getHeaderData();
            $this->SetFont('helvetica', '', 10);
            $this->writeHTML($headerData['string'], true, 0, false, false, 'C');
        }

/**        //Page header
        public function Header() {
            // Logo
            $image_file = K_PATH_IMAGES.'catsu_logo.png';
            $this->Image($image_file, 10, 10, 15, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
            // Set font
            $this->SetFont('helvetica', '', 10);
            // Title
            $this->Cell(0, 15, 'Catanduanes State University', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        }*/
    }

    //make tcpdf object
    $studentsObj = new Student();
    $students    = $studentsObj->getStudentByProgram($program_id);

    $obj_pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    //document information
    $obj_pdf->SetCreator('CATSU STUDENT INFOSYS');
    $obj_pdf->SetAuthor($faculty_info);
    $obj_pdf->SetTitle('STUDENT MASTERLIST_'.$faculty_info );
    $obj_pdf->SetSubject('Student Masterlist');
    $obj_pdf->SetKeywords('list, students, masterlist');

    // set default header data
    $obj_pdf->setHeaderData($ln = "", $lw = 0, $ht='', $hs='<table>
                                                        <tr><td style="font-size:12;">Catanduanes State University</td></tr>
                                                        <tr><td>Virac, Catanduanes</td></tr>
                                                        <tr><td></td></tr>
                                                        <tr><td style="font-size:12;"><b>LIST OF OFFICIALLY ENROLLED STUDENTS</b></td></tr>
                                                        <tr><td>School Year 2021-2022 Semester 1</td></tr>
                                                        </table>', $tc=array(0,0,0), $lc=array(0,0,0));

    // set header and footer fonts
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

    // set margins
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '40', PDF_MARGIN_RIGHT, PDF_MARGIN_BOTTOM);
    $obj_pdf->SetHeaderMargin('10');

    // set auto page breaks
    $obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    //set font
    $obj_pdf->SetFont('helvetica', '', 10);

    //add page
    $obj_pdf->AddPage();

    $obj_pdf->setPageMark();
    //add content
    $table = "

            <style>
                .tablecls {
                    border: 1px solid black;
                    border-right: none;
                }
            </style>

            <table class=\"tablecls\"  cellspacing=\"0\" cellpadding=\"4\" border=\"0\">
                <thead>
                    <tr>
                        <th style=\"font-size: 10px;\">College: </th>
                        <td style=\"font-size: 10px;\" colspan=\"8\">$college_desc</td>
                    </tr>
                    <tr>
                        <th style=\"font-size: 10px;\">Program: </th>
                        <td style=\"font-size: 10px;\" colspan=\"8\">$program_name</td>
                    </tr>
                    <tr>
                        <th style=\"font-size: 10px;\">Course: </th>
                        <td style=\"font-size: 10px;\" colspan=\"8\">$course_info</td>
                    </tr>
                    <tr>
                        <th style=\"font-size: 10px;\">Block: </th>
                            <td style=\"font-size: 10px; width: 30px;\">$block_name</td>
                        <th style=\"font-size: 10px; width: 60px;\">CSC Code: </th>
                            <td style=\"font-size: 10px; width: 30px;\">$course_csc</td>
                        <th style=\"font-size: 10px;\">Schedule: </th>
                            <td style=\"font-size: 10px; width: 220px;\">$class_sched</td>
                        <th style=\"font-size: 10px;\">Room: </th>
                            <td></td>
                    </tr>
                    <tr>
                        <th style=\"font-size: 10px;\">Enrollees: </th>
                            <td style=\"font-size: 10px;\">$enrolled</td>
                        <th style=\"font-size: 10px;\">Instructor: </th>
                            <td style=\"font-size: 10px;\" colspan=\"5\">$faculty_info</td>
                    </tr>
                </thead>
            </table>
    ";

    $table .= "
            <table cellspacing=\"0\" cellpadding=\"3\" border=\"1\">
                <thead>
                    <tr>
                            <td style=\"width: 30px;\">No</td>
                            <td style=\"width: 80px;\">Student No</td>
                            <td style=\"width: 180px;\">Student Name</td>
                            <td style=\"width: 30px;\">Sex</td>
                            <td style=\"width: 80px;\">Program</td>
                            <td style=\"width: 40px;\">Year</td>
                            <td style=\"width: 70px;\">Remark</td> 
                        </tr>
                </thead>
                <tbody>
        ";

    if (empty($students)) {
        $table .= "<tr><td>No data.</td></tr>";
    } else {

        $count = 1;
        foreach ($students as $student) {
            
            $studentblock     = $student['block'];
            $studentno        = $student['student_no'];
            $studentname      = $student['lastname'] . ", " . $student['firstname'];
            $studentgender    = $student['gender'];
            $studentprogram   = $student['program'];
            $studentyear      = $student['yearlevel'];
            if ($studentblock == $block_id) {
                if ($studentgender == "Male") {
                    $studentgender = 'M';
                } else {
                    $studentgender = 'F';
                }

                switch ($studentprogram) {
                    case '1':
                        $studentprogram = "BSIT";
                        break;
                    case '2':
                        $studentprogram = "BSIS";
                        break;
                    case '3':
                        $studentprogram = "BSCOMSCI";
                        break;
                    
                    default:
                        $studentprogram = "No data.";
                        break;
                }

                $table .= '
                    <tr>
                        <td style="font-size: 10; width: 30px;">'.$count.'</td>
                        <td style="font-size: 10; width: 80px;">'.$studentno.'</td>
                        <td style="font-size: 10; width: 180px;">'.$studentname.'</td>
                        <td style="font-size: 10; width: 30px;">'.$studentgender.'</td>
                        <td style="font-size: 10; width: 80px;">'.$studentprogram.'</td>
                        <td style="font-size: 10; width: 40px;">'.$studentyear.'</td>
                        <td style="font-size: 10; width: 70px;"></td>
                    </tr>
                    ';

                $count++;
            }
        }
         $table .= '
                </tbody>
            </table>
        ';
    }


    $obj_pdf->lastPage();
    $obj_pdf->writeHTML($table);
    
    ob_end_clean();
    //output
    $filename = 'Student_Masterlist_'. $faculty_info .'.pdf';
    $obj_pdf->Output($filename, "I");
    
    }
?>