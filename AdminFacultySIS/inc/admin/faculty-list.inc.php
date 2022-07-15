<?php
if (isset($_SESSION['userRole'])) {
    if ($_SESSION['userRole'] == 'admin') {
        require_once 'inc/admin/class.admin.php';

        $adminObj = new Admin();
        $faculties = $adminObj->allFaculty();
         if (!empty($faculties)) {
?>
<!-- header -->
<div class="container-fluid d-flex justify-content-center mt-3">
    <h5 style="color: #4879ff; margin-right: 0.5em;">Faculty</h5>
   
    <a href="index.php?content=add-faculty"><i class="fas fa-user-plus"></i><span class="tooltiptext">Add Faculty</span></a>
</div>

<hr>
<!-- start of table -->

<div class="main-contents-table container justify-content-center">
    <div class="mt-4 justify-content-center">
        <div>
            <table class="table table-bordered table-hover" id="facultyTable" width="100%">
                <thead class="table-head">
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>College</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
<?php 
foreach ($faculties as $faculty) {
    $facultyID = $faculty['facultyID'];
    $facultyName = $faculty['faculty_lname'] . ", " . $faculty['faculty_fname'] . " " . $faculty['faculty_mname'];
    $position = $faculty['faculty_level'];
    $college = $faculty['college_name'];
    $status = $faculty['status'];
if ($status == 1) {
        // code...
    

?>
            <tr>
                <td><?php echo $facultyName; ?></td>
                <td style="text-align:center;"><?php echo $position; ?></td>
                <td style="text-align:center;"><?php echo $college; ?></td>
                <td style="text-align: center;">

                    <a href="index.php?content=faculty-assign&id=<?php echo $facultyID;?>"><button class="btn-primary" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px;"><i class="fas fa-plus-square" style="margin-right:5px;"></i>Assign</button></a>

                    <a href="index.php?content=faculty-update&id=<?php echo $facultyID;?>"><button class="btn-success" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px;"><i class="fas fa-edit" style="margin-right:5px;"></i>Update</button></a>

                    <a href="index.php?content=faculty-remove&id=<?php echo $facultyID;?>"><button class="btn-danger" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px;"><i class="fas fa-minus-circle" style="margin-right:5px;"></i>Remove</button></a>
                </td>

            </tr>
<?php 
} // if status
} //foreach faculty end
?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
              $('#facultyTable').DataTable({
      'columnDefs': [{
        'targets': [3], // column index (start from 0)
        'orderable': false, // set orderable false for selected columns
     }]
   });
        });
    </script>


<!-- end of table -->
</div>
<?php 
        } // end !empty faculties
        else {
            echo
            '<script language="javascript">
              alert("No data loaded");
              window.location.href = "index.php?content=home-admin";
            </script>';
        }
    } // end userrole = admin
    else {
        echo
        '<script language="javascript">
          alert("Unauthorized Access");
          window.location.href = "inc/logout.inc.php";
        </script>';

    } 
} //end isset session userrole
else {
    echo
    '<script language="javascript">
      alert("User Role Unknown");
      window.location.href = "inc/logout.inc.php";
    </script>';
}
?>