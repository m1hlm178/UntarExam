<?php  
// E-Exam Database Connection
$host = "localhost";
$username = "root";
$password = "";
$database = "ne-exam";
$dbcon=mysqli_connect($host,$username,$password,$database) or die(mysqli_error($dbcon));

?>  