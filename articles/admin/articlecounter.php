<?php
require('../../config.php');
$id = $_GET["id"];
$view = -1;
$sql = "SELECT * FROM tc_article WHERE id=$id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $view = $row["viewnum"];
    $view = $view + 1;
    $sql2 = "UPDATE tc_article SET viewnum = '$view' WHERE id = $id";
    $conn->query($sql2);
    break;
  }
}
echo "view has been updated to : ".$view;
?>