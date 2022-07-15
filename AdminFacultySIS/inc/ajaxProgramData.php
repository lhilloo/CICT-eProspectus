<?php 
// Include the database config file 

 
if(!empty($_POST["college"])) {
    $college = $_POST["college"];
    // Fetch year data 
    $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys"); 
    $query = "SELECT * FROM catsu_programs WHERE program_college = '$college';"; 
    $result = $conn->query($query); 
     
    // Generate HTML of year options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select Program</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['program_id'].'">'.$row['program_name'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Program not available</option>'; 
    }

} else{ 
        echo '<option value="">Not available</option>'; 
    } 
 
?>