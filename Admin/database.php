<!-- Database Connection  -->

<?php 
  $conn = new mysqli("localhost", "root", "", "obms");
  if ($conn->connect_error) {
      die("Connection Error");
  }
?>