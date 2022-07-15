<?php
if (isset($_SESSION['userRole'])) 
{
  if ($_SESSION['userRole'] == 'admin') 
  {
    require_once 'inc/admin/class.admin.php';
    $adminObj = new Admin();

    


?>

  <div class="margin-top ml-4">
    <h6 class="mt-4 mx-auto text-center lead">Select a college to view students</h6>
  </div>


<div class="container">
  <div class="row justify-content-center">

<?php 
  $colleges = $adminObj->getColleges();
  foreach ($colleges as $college) 
  {
    $collegeName = $college['college_name'];
    $collegeDesc = $college['college_desc'];
  

?>
  <div class="card col-6 col-md-4">
    <img class="mx-auto" src="./uploads/logos/<?php echo $collegeName;?>.png" alt="<?php echo $collegeName; ?>" width="150">
    <a href="index.php?content=student-view-program&college_name=<?php echo $collegeName;?>"><button class="admin-viewBtn"><?php echo $collegeName;?></button></a>
  </div>

<?php 
  } //foreach closing curly bracket

  } else {
      echo 
      '<script language="javascript">
      alert("Unauthorized Access! Redirecting to login page");
      window.location.href = "index.php";
      </script>';
    }
} else {
  echo 
      '<script language="javascript">
      alert("Please login first! Redirecting to login page");
      window.location.href = "login.php";
      </script>';
}
?>
  </div>
</div>