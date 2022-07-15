<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }
?>

<!-- Table for the Courses -->

<div class="main-contents-table container d-flex justify-content-center add-student">
  <div class="row">
    <div class="col-sm table-custom ">
      <!-- First Table -->
      <table class="table" style="width: 700px; margin-top: 20px; border: solid 1px #4879FF !important;">

        <tbody>
          <tr>
            <td colspan="2" style="border-right: none !important;">Search Student</td>
            <td colspan="4"  style="border-left: none !important;">
              <form class="" action="search" method="post">
                <input type="text" name="student-id" value="" placeholder="Enter student ID number">
                <input class="search-button" type="submit" name="searchBtn" value="Search" style="
    background-color: #4879FF;
    color: #FFFFFF;
    width: 100px;
    margin-left: 20px;
    border-radius: 20px;
    border: none;">
              </form>
            </td>
          </tr>
          <tr class="block-list" >
            <td>Student ID No.</td>
            <td>Student Name</td>
            <td>Program</td>
            <td>Block</td>
            <td>Year</td>
            <td style="background-color: #FFFFFF !important; border: solid 1px #707070 !important;"></td>
          </tr>
          <tr>
            <td>2077-201</td>
            <td>Sanchez, Mark C.</td>
            <td>BSIT</td>
            <td>C</td>
            <td>3</td>
            <td>
              <button class="add-studentBtn" type="button" name="addStudent">Add to list</button>
            </td>
          </tr>
        </tbody>
      </table>

    </div>

  </div>
</div>
<!-- End of Table Div -->
