<?php
$conn = mysqli_connect("localhost", "resblog_user", "StrongPassword123!", "blog_admin_db");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
 ?>
