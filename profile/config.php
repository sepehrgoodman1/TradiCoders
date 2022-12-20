<?php
session_start();
$servername = "localhost";
$username = "tcadmin_main";
$password = "DAbC1WWv3";
$dbname = "tcadmin_main";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_query($conn, "SET NAMES utf8");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
  //echo "all are ok";
}
?>