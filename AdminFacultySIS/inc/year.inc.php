<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }

class YearLevel {


    static function getAllYearLevel() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT year_id, year_level, year_name FROM student_yearlevel";
        $data = null; 
            if ($sql = $conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }

            return $data; 
            $conn->close();
 
            
    }
    static function getYearLevel($yearlevel_id) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");
        $query = "SELECT year_id, year_level FROM student_yearlevel WHERE year_id = $yearlevel_id";
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
