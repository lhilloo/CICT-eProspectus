<?php

if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
      header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
      die();
  }

class Block{

    public function getBlock($block_id) {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "SELECT block_id, block_name FROM student_blocking WHERE block_id = '$block_id'";
        $data = null; 

                if ($sql = $conn->query($query)) {
                    while ($row = mysqli_fetch_assoc($sql)) {
                        $data[] = $row;
                    }
                }

                return $data; 
$conn->close();
    }

    public function getBlockByCollege() {
        $conn = new mysqli("sql200.epizy.com", "epiz_30552523", "B7lYpyFcFjwnp", "epiz_30552523_catsuinfosys");

        $query = "SELECT block_id, block_name FROM student_blocking";
        $data = null; 

				if ($sql = $conn->query($query)) {
					while ($row = mysqli_fetch_assoc($sql)) {
						$data[] = $row;
					}
				}

				return $data; 
$conn->close();
    }
}
