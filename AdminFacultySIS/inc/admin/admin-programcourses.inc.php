<?php
  if ($_SESSION['userRole'] != "admin") {
    header('location: logout.inc.php');
    exit();
  }

  include_once "inc/program.inc.php";
  include_once "inc/block.inc.php";
  include_once "inc/year.inc.php";

  $objprogram = new Program();
  $objBlock = new Block();
  $objyear = new YearLevel();
?>

<div class="main-contents d-flex justify-content-center align-middle col-auto col-md-3 col-xl-2 px-sm-2 px-0 ">
  <div class="header">
    <h6>PROGRAMS</h6>
  </div>
</div>


<!-- Table for the Programs -->

<div class="main-contents-table container">
  <div class="row">

      <?php
         $programs = $objprogram->getProgramlist();
         foreach ($programs as $program) {
           $program_con = $program['program_code']; 
      ?>

    <div class="col-sm table-custom">
      <!-- Table Accordion-->
      <div class="accordion-body m-3">
        <button class="accordion shadow"><?php echo $program_con; ?></button>
        <div class="panel shadow">
          <table class="table table-bordered table-hover mb-0" style="table-layout: fixed;">
            <thead>
              <th>Course Code</th>
              <th>Course Description</th>
              <th>Unit</th>
            </thead>
            <tbody>
              <tr>
                <td>ITRACKB4</td>
                <td>Web Systems and Technologies: Web Programming 2</td>
                <td>3</td>
              </tr>
              
            </tbody>
          </table>
        </div>
      </div>
<!-- 
      <table class="table res-table">
        <thead class="">
          <th scope="col" colspan="3" style="border-right: none !important;"><?php echo $program_con ?></th>
          <th scope="col" style="border-left: none !important; background-color: #FF487A"><a href="" style="color: #FFFFFF;"><i class="fas fa-trash"></i> <span class="ms-1 d-none d-sm-inline"></span></a></th>
        </thead>
        <tbody>

          <?php
            
            $years = $objyear->getAllYearLevel();
            foreach ($years as $year) {
            $year_level =  $year['year_id'];
            $x=0;
                
            $blocks = $objBlock->getBlockByCollege($program_con);
              if ($blocks != false) {
                
    
                    
          ?>

            <tr>
              <td colspan="2" style="border-right: none !important;"><?php echo $year['year_level'] . " - " . $block['blockname']; ?></td>
              <td style="width: 30px;  border-right: none !important; border-left: none !important;"><a href="index.php?content=student-list" class="btn btn-primary" >View</a></td>
              <td style="width: 30px;   border-left: none !important;"><a href="index.php?content=student-list" class="btn btn-danger">Delete</a></td>
              </tr>

            <?php
            
          }
               
          }
            ?>
         
            <tr>
              <td colspan="4" class="col" style="background-color: #4879FF; "><a style="text-decoration: none; color: #FFFFFF;" href="#">View All Year/Block<i class="fas fa-arrow-right"></i> <span class="ms-1 d-none d-sm-inline"></span></a></td>
            </tr>
        </tbody>
      </table>
      </div>
      
      <?php
            
          }
      ?>
      <!-- End of Table -->
      

    
    <!-- </div> -->
<!-- </div> --> 

<div class="main-contents d-flex justify-content-center align-middle col-auto col-md-3 col-xl-2 px-sm-2 px-0 ">
  <div class="floating-btn">
    <button type="button" name="button" class="btn-primary" data-toggle="modal" data-target="#modal"><i class="fas fa-plus" style="margin-right: 20px;"></i>Add Program</button>
    </div>
</div>

<!-- MODAL -->
<div class="modal fade text-center" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="ModalLabel">Add Program</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="close">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="imgmodal text-center">
            <div class="form">
              <div class="login-form">
                <form action="index.php?content=add-program">
                  <div class="form-group mt-3">
                    <label class="form-label">Program Code</label>
                    <input type="text" class="form-control" name="program_code" placeholder="ex. BSComSci" required>
                  </div>
                  <div class="form-group mt-3">
                    <label class="form-label">Program Name</label>
                    <input type="text" class="form-control" name="program_name" placeholder="ex. Bachelor of Science in Computer Science" required>
                  </div>
                  <div class="form-group mt-3">
                    <label class="form-label">College</label>
                    <select name="college" id="college" style="margin: 0 0 20px 30px;" autofocus>
                      <?php 
                    include_once 'inc/admin/class.admin.php';
                    $adminObj = new Admin();
                    $colleges = $adminObj->getColleges();

                    foreach ($colleges as $college) {
                      $collegeName = $college['college_name'];
                    
                    ?>

                            <option value="<?php echo $collegeName; ?>"><?php echo $collegeName; ?></option>
                    <?php 
                    }
                    ?>
                    </select>
                  </div>
                </form>
              </div>
            </div>
        </div>
        </div>
        <div class="modal-footer">
        
        </div>
      </div>
    </div>

  </div>


<script src="js/app.js" type="text/javascript"></script>
