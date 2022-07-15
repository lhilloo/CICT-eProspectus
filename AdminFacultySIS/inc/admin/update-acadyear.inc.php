<?php
if (isset($_POST['submit'])) 
{
    $semester = $_POST['catsu_sem'];
    $year_start = $_POST['year_start'];
    $year_end = $_POST['year_end'];
    $status = $_POST['status'];


    require_once 'class.admin.php';
    $adminObj = new Admin();
    $unset = $adminObj->unsetAcadYear();
    if ($unset) {
        echo    '<script language="javascript">alert("Successfully unset previous academic year and sem!"); 
                            window.location.href = "index.php";
                        </script>';
    } else {
        echo    '<script language="javascript">alert("Unsuccessfully updated academic year and sem!"); 
                            window.location.href = "index.php";
                        </script>';
    }


    $result = $adminObj->setAcadYear($year_start, $year_end, $semester, $status);

    if ($result) {
        echo    '<script language="javascript">alert("Successfully updated academic year and sem!"); 
                            window.location.href = "index.php";
                        </script>';
    } else {
        echo    '<script language="javascript">alert("Failed to update academic year and sem!"); 
                            window.location.href = "index.php";
                        </script>';
    }

} 


?>