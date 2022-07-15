<?php
  
  if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }
?>


<div class="main-contents d-flex justify-content-center align-middle col-auto col-md-3 col-xl-2 px-sm-2 px-0 ">
  <div class="header" style="border-bottom-style: none;">
    <h6>Do you want to remove CourseCode from your dashboard?</h6>
  </div>
</div>


<!-- Table for the Courses -->

<div class="main-contents-table container d-flex justify-content-center">
  <div class="row">
    <div class="col-sm table-custom">
      <!-- First Table -->
      <table class="table" style="width: 220px; margin-top: 10px;">
        <thead class="">
          <th colspan="2" scope="col">COURSE CODE</th>

        </thead>
        <tbody>
          <tr>
            <td>No. of Students Enrolled:</td>
            <td style="color: #000000">120</td>
          </tr>
          <tr>
            <td>No. of Students Graded:</td>
            <td style="color: #000000">100</td>
          </tr>
          <tr>
            <td>No. of Students Ungraded:</td>
            <td style="color: #000000">20</td>
          </tr>
          <tr>
            <td class="col" style="background-color: #FF487A;"><a style="text-decoration: none; color: #FFFFFF;" href="#">Cancel<span class="ms-1 d-none d-sm-inline"></span></a></td>

            <td class="col" style="background-color: #FFFFFF;"><a style="text-decoration: none; color: #4879FF;" href="#">Remove <span class="ms-1 d-none d-sm-inline"></span></a></td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</div>
<!-- End of Table Div -->
