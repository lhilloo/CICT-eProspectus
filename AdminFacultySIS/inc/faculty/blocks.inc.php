<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }
?>


<div class="main-contents d-flex justify-content-center align-middle col-auto col-md-3 col-xl-2 px-sm-2 px-0 ">
  <div class="header">
    <h6>Student List for COURSECODE1</h6>
  </div>
</div>


<!-- Table for the Courses -->

<div class="main-contents-table container d-flex justify-content-center">
  <div class="row">
    <div class="col-sm table-custom">
      <!-- First Table -->
      <table class="table" style="width: 500px; margin-top: 20px;">
        <thead class="">
          <th colspan="4" scope="col">Bachelor of Science in Information Technology</th>

        </thead>
        <tbody>
          <tr class="block-list">
            <td>1st Year</td>
            <td>2nd Year</td>
            <td>3rd Year</td>
            <td>4th Year</td>
          </tr>
          <tr>
            <td>Block A</td>
            <td>Block A</td>
            <td>Block A</td>
            <td>Block A</td>
          </tr>
          <tr>
            <td>Block B</td>
            <td>Block B</td>
            <td>Block B</td>
            <td>Block B</td>
          </tr>
          <tr>
            <td>Block C</td>
            <td>Block C</td>
            <td>Block C</td>
            <td>Block C</td>
          </tr>
        </tbody>
      </table>
      <table class="table" style="width: 500px; margin-top: 40px;">
        <thead class="">
          <th colspan="4" scope="col">Bachelor of Science in Information Systems</th>

        </thead>
        <tbody>
          <tr class="block-list">
            <td>1st Year</td>
            <td>2nd Year</td>
            <td>3rd Year</td>
            <td>4th Year</td>
          </tr>
          <tr>
            <td>Block A</td>
            <td>Block A</td>
            <td>Block A</td>
            <td>Block A</td>
          </tr>
          <tr>
            <td>Block B</td>
            <td>Block B</td>
            <td>Block B</td>
            <td>Block B</td>
          </tr>
          <tr>
            <td>Block C</td>
            <td>Block C</td>
            <td>Block C</td>
            <td>Block C</td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</div>
<!-- End of Table Div -->
