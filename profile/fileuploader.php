
<?php
$target_dir = "../projects/".$Projectid."/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$PrFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

    $decription = $_POST["stepdcrp"];
    $stepSt = $_POST["stepst"];
    if ($stepSt == "next")
    {
        $sql1 = "INSERT INTO tc_project_activity (prid,actorid, cid, did, pathurl1, pathurl2, description, sourcecode)
                VALUES ('$Projectid', '$userid', '$creatoruid', '$developeruid', '$target_file', '...', '$decription', '...')";
                
                $conn->query($sql1);            
            //....
    }
    // if ($stepSt == "previous")
    // {
    //         $sql = "UPDATE tc_project SET prstatus='1000' WHERE id=$Projectid";
    //         $projectProgress = 33;
    //         $conn->query($sql);                             
    //         //....
    //         $sql1 = "INSERT INTO tc_project_activity (prid, actorid, cid, did, type, pathurl1, pathurl2, description, sourcecode)
    //             VALUES ('$Projectid', '$userid', '$userid', '-1', '1000', '$target_file', '...', '$decription', '...')";
                
    //             $conn->query($sql1);            
    //         //....            
    // }

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an ex4 or ex5 - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        //echo "File is not an ex4 or ex5.";
        $uploadOk = 1;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    //echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    //echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($PrFileType != "jpg" && $PrFileType != "png" && $PrFileType != "jpeg"
    && $PrFileType != "pdf" && $PrFileType != "zip" && $PrFileType != "ex4" && $PrFileType != "ex5" && $PrFileType != "mq4" && $PrFileType != "mq5" ) {
    //echo "Sorry, only JPG, JPEG, PNG , pdf , mx4 , mx5 ,ex4 or ex5  files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    //echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      //  echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
        //echo "Sorry, there was an error uploading your file.";
    }
}
?>

