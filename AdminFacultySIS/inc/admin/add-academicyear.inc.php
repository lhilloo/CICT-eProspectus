<?php
if (isset($_POST['submit'])) 
{
    $semester = $_POST['catsu_sem'];
    $year_start = $_POST['year_start'];
    $year_end = $_POST['year_end'];
    $status = 1;


    require_once 'inc/admin/class.admin.php';
    $adminObj = new Admin();

   // $adminObj->unsetAcadYear();
    $resultYear = $adminObj->setAcadYear($year_start, $year_end, $semester, $status);

    if ($resultYear) 
    {
        echo    '<script language="javascript">
                            window.location.href = "index.php?content=add-academicyear&yearerror=none";
                        </script>';
    } 
    else 
    {
        echo    '<script language="javascript">
                            window.location.href = "index.php?content=add-academicyear&yearerror=failed";
                        </script>';
    }

} else
    {



?>




<section class="acad-year-form mt-5 justify-content-center align-content-center">
    <div class="form ">
            <div class="login-form">
                <form action="index.php?content=add-academicyear" method="post">
                    <h2 class="title-head text-align-center">Add Academic Year</h2>
                    <div class="form-group mt-3">
                        <label class="form-label">Semester</label>
                        <select name="catsu_sem" id="sem" style="margin: 0 0 20px 30px;" autofocus>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                        </select>
                    </div>       
                    <div class="form-group">
                        <label class="form-label">Year Start</label>
                        <input type="text" name="year_start" class="form-control" placeholder="Year Start" required="required" >
                    </div>
                    <div class="form-group">
                        <label class="form-label">Year End</label>
                        <input type="text" name="year_end" class="form-control" placeholder="Year End" required="required" >
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="admin-viewBtn" value="Submit">
                    </div>   
                    <?php
                    if (isset($_GET['yearerror'])) {
                        if ($_GET['yearerror'] == 'none') {
                            echo '<div class="form-group">
                                    <p class="text-success">Successfully added academic year and semester. <br><a href="index.php">Click here to go back to homepage.</a></p>
                                  </div>';
                        } elseif ($_GET['yearerror'] == 'failed') {
                            echo '<div class="form-group">
                                    <p class="text-danger">Failed to add academic year and semester. <br><a href="index.php">Click here to go back to homepage.</a></p>
                                  </div>';
                        }
                    }
                    ?>     
                </form>
                
        </div>
    </div>

</section>
<?php
    }
?>