<?php
$target_dir = "../asset/img/";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo(basename($_FILES["cimage"]["name"]),PATHINFO_EXTENSION));
$target_file = $target_dir . $userid."_icon.".$imageFileType;
//echo $target_file."<br>";
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["cimage"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }

// Check if file already exists
if (file_exists($target_file)) {
  //echo "Sorry, file already exists.";
  unlink($target_file);
  $uploadOk = 1;
}

// Check file size
if ($_FILES["cimage"]["size"] > 500000) {
  //echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  //echo "Sorry, only JPG, JPEG, PNG files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["cimage"]["tmp_name"], $target_file)) {
        $sql = "UPDATE tc_clients SET imgurl='$target_file' WHERE id=$userid";

        if ($conn->query($sql) === TRUE) {
          //echo "Record updated successfully";
        } else {
          //echo "Error updating record: " . $conn->error;
        }
    //echo "The file ". htmlspecialchars( basename( $_FILES["cimage"]["name"])). " has been uploaded.";
  } else {
    //echo "Sorry, there was an error uploading your file.";
  }
}
}
?>
