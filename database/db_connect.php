<?php
// Example MySQLi connection
$con = mysqli_connect("localhost", "resblog_user", "StrongPassword123!", "blog_admin_db");

if (!$con) {
    die("MySQLi connection failed: " . mysqli_connect_error());
}
?>
