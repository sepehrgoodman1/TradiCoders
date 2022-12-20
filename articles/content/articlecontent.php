<?php
require('../../config.php');
require("../../central.php");
require('../../access.php');
require('../../sessionchecker.php');
$action="articles";
$arid = $_GET['id'];
$sql = "SELECT subject, category, body, viewnum,tags,author FROM tc_article WHERE id='$arid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $articleSubject = $row['subject'];
        openLink("https://articles.tradicoders.ir/".$articleSubject);
    }
} else {
    openLink("https://articles.tradicoders.ir/");
}

?>