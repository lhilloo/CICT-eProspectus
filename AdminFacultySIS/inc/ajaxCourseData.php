<?php 
// Include the database config file 

 
if(!empty($_POST["programID"])) {
   
    // Fetch year data 
    $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys"); 
    $query = "SELECT * FROM student_yearlevel;"; 
    $result = $conn->query($query); 
     
    // Generate HTML of year options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select Year Level</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['year_id'].'">'.$row['year_level'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Year level not available</option>'; 
    }
    $conn->close();

} elseif(!empty($_POST["year_id"])){ 
    $yearID = $_POST["year_id"];
    // Fetch course data based on program id and year id
    $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys"); 
    $query = "SELECT * FROM catsu_courses WHERE course_level = '$yearID';"; 
    $result = $conn->query($query); 
     
    // Generate HTML of course options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select course</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['course_code'].'">'.$row['course_desc'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Course not available</option>'; 
    }
    $conn->close(); 
}  else{ 
        echo '<option value="">Not available</option>'; 
    } 
 
?>