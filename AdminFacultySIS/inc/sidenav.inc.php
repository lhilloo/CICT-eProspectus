<?php
// display when the user is faculty
if (isset($_SESSION['userRole'])) {
    if ($_SESSION['userRole'] == 'admin') {

        require_once 'inc/admin/class.admin.php';

        $adminID = $_SESSION['loggedin'];
        $admin = new Admin();
        $rows = $admin->getAdmin($adminID);
        if (!empty($rows)) {
            foreach ($rows as $row) {
                # code...
            
?>

<div class="fixed-left col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidenav">

  <div class="sidebar-header pb-3 mb-md-0 me-md-auto text-white text-decoration-none text-align-center" >
      <img src="uploads/catsu_logo.png" alt="Profile" width=150>
      <br>
      <p><?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
  </div>
<div class="d-flex flex-column align-items-center px-3 pt-2 text-white min-vh-100">
      <ul class=" nav nav-pills flex-column mb-sm-auto mb-0 align-items-start " id="menu">
            <li class="nav-item">
            <a href="index.php?content=home-admin" class="sidenav-links nav-link align-middle px-0 ">
                    <i class="fas fa-tachometer-alt"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?content=student-view-college" class="nav-link align-middle px-0">
                <i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Students</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="index.php?content=faculty-list" class="nav-link align-middle px-0">
                  <i class="fas fa-chalkboard-teacher"></i> <span class="ms-1 d-none d-sm-inline">Faculties</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?content=course-list" class="nav-link align-middle px-0">
                  <i class="fas fa-sticky-note"></i> <span class="ms-1 d-none d-sm-inline">Courses</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?content=archive" class="nav-link align-middle px-0">
                  <i class="fas fa-archive"></i> <span class="ms-1 d-none d-sm-inline">Archive</span>
                </a>
            </li>
            <li class="nav-item" style="margin-top: 100px;">
                <a href="inc/logout.inc.php" class="nav-link align-middle px-0">
                <i class="fas fa-sign-out-alt"></i> <span class="ms-1 d-none d-sm-inline">Logout</span>
                </a>
            </li>
        </ul>
        <hr>

    </div>
</div>
<?php
            }
        }
    }
elseif ($_SESSION['userRole'] == 'faculty')  {

    require_once 'inc/faculty/faculty.inc.php';
    $facultyID = $_SESSION['loggedin'];
    $facultyobj = new Faculty();
    $profile = $facultyobj->getFacultyPF($facultyID);
    
    ?>
    <div class="fixed-left col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidenav ">

<div class="sidebar-header pb-3 mb-md-0 me-md-auto text-white text-decoration-none text-align-center" >
        <?php
            /**
             * displays profile photo on modal container
             * */
            echo $profile;
        ?>
    <br>
    <p><?php echo $_SESSION['faculty_username'];?></p>
</div>
<div class="d-flex flex-column align-items-center px-3 pt-2 text-white min-vh-100">
      <ul class=" nav nav-pills flex-column mb-sm-auto mb-0 align-items-center " id="menu">
          <li class="nav-item">
          <a href="index.php?content=home-faculty" class="sidenav-links nav-link align-middle px-0 ">
                  <i class="fas fa-tachometer-alt"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
              </a>
          </li>
            <li class="nav-item">
                <a href="index.php?content=student-list" class="nav-link align-middle px-0">
                <i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Students</span>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="index.php?content=course-list" class="nav-link align-middle px-0">
                    <i class="fas fa-chalkboard-teacher"></i> <span class="ms-1 d-none d-sm-inline">Courses</span>
                </a>
            </li>
          <li class="nav-item" style="margin-top: 200px;">
                <button class="nav-link align-middle px-0" data-toggle="modal" data-target="#modal">
                    <i class="fas fa-edit"></i> <span class="ms-1 d-none d-sm-inline">Edit Photo</span>
                </button>
          </li>
          <li class="nav-item">
              <a href="inc/logout.inc.php" class="nav-link align-middle px-0">
              <i class="fas fa-sign-out-alt"></i> <span class="ms-1 d-none d-sm-inline">Logout</span>
              </a>
          </li>
      </ul>
      <hr>
  </div>
</div>

<?php
} 
} else {
    header("location: index.php");
}?>

<!-- MODAL -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h2 class="modal-title" id="ModalLabel">Change profile photo</h2>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true" class="close">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div class="imgmodal text-center">
		        <?php
		        	/**
		        	 * displays profile photo on modal container
		        	 * */
		        	echo $profile;
		        ?>
		    </div>
	      </div>
	      <div class="modal-footer">
	    	<?php
	    	/**
	    	 * upload button script, logs out user if session is not started
	    	 * */
	    		if (isset($_SESSION['loggedin'])) {
	    			echo "<form action=\"inc/upload.inc.php\" method=\"post\" enctype=\"multipart/form-data\">
		    		<input class=\"modalbtn1\" type=\"file\" name=\"profile_img\" required>
		    		<input class=\"modalbtn\" type=\"submit\" name=\"submit\" value=\"UPLOAD\">
	    			</form>";
	    		} else {
	    			header('location: includes/logout.inc.php');
	    		}
	    	?>
	      </div>
	    </div>
	  </div>

	</div>
