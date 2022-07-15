<?php 
require_once 'inc/courses.inc.php';

$adminObj = new Courses;
$courses = $adminObj->getCourselist();

?>


<div class="container-fluid d-flex justify-content-center mt-3">

		<h5 style="color: #4879ff; margin-right: 0.5em;">Courses</h5>
		<a href="index.php?content=add-course"><i class="fas fa-plus-circle"></i><span class="tooltiptext">Add Course</span></a>
</div>

	<hr>

	<div class="main-contents-table container justify-content-center">
		<div class="mt-4 justify-content-center">
			<table class="table table-bordered table-hover" id="courseTable" cellspacing="0">
				<thead class="table-head">
				    <tr>	
				      <th scope="col" style="width: 20%;">Course Code</th>
				      <th scope="col" style="width: 50%;">Description</th>
				      <th scope="col" style="width: 5%;">Level</th>
				      <th scope="col" style="width: 5%;">College</th>
				      <th scope="col" style="width: 20%;">Action</th>
				    </tr>
			  	</thead>
			  	<tbody class="table-body">
<?php 
foreach ($courses as $course) {
	$courseCode = $course['course_code'];
	$courseDesc = $course['course_desc'];
	$courseLvl = $course['course_level'];
	$courseCollege = $course['course_college'];
	$status = $course['status'];

	if ($status == 1) {
	

?>
				    <tr>
				      <td><?php echo $courseCode; ?></td>
				      <td><?php echo $courseDesc; ?></td>
				      <td><?php echo $courseLvl; ?></td>
				      <td><?php echo $courseCollege; ?></td>
				      <td>
				      	<a href="index.php?content=course-update&id=<?php echo $courseCode;?>"><button class="btn-success" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px;"><i class="fas fa-edit" style="margin-right:5px;"></i>Update</button></a>
				      	<a href="index.php?content=course-remove&id=<?php echo $courseCode;?>"><button class="btn-danger" style="border: none!important; padding: 10px!important; border-radius: 10px; font-size: 12px;"><i class="fas fa-minus-circle" style="margin-right:5px;"></i>Remove</button></a>
				      </td>
				    </tr>

<?php 
	} //if status condition end
} // foreach courses end loop
?>			    
			  	</tbody>
			
			</table>
		</div>	
	</div>

<script>
     $(document).ready(function() {
          $('#courseTable').DataTable({
          "order": [[ 2, "asc" ]],
	     'columnDefs': [{
	     	'targets': [4], // column index (start from 0)
	     	'orderable': false, // set orderable false for selected columns
	     }]
   });
          
    });
</script>