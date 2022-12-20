<?php
require('../../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Articles</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://cdn.ckeditor.com/4.16.2/full-all/ckeditor.js"></script>
    <style>
        @font-face {
            font-family: zarei;
            font-style: normal;
            font-weight: bold;
            src: url("../../font/IRANSansWeb(FaNum)_Bold.woff") format("woff"); }
        @font-face {
            font-family: zarei;
            font-style: normal;
            font-weight: 500;
            src: url("../../font/IRANSansWeb(FaNum)_Medium.woff") format("woff"); }
        @font-face {
            font-family: zarei;
            font-style: normal;
            font-weight: 300;
            src: url("../../font/IRANSansWeb(FaNum)_Light.woff") format("woff"); }
        @font-face {
            font-family: zarei;
            font-style: normal;
            font-weight: 200;
            src: url("../../font/IRANSansWeb(FaNum)_UltraLight.woff") format("woff"); }
        @font-face {
            font-family: zarei;
            font-style: normal;
            font-weight: normal;
            src: url("../../font/IRANSansWeb(FaNum).woff") format("woff");
        }

        *
        {
            box-sizing: border-box;
            font-family: zarei;
        }
        body
        {
            direction: rtl;
            overflow-x: hidden;
        }
        a
        {
            text-decoration: none !important;
        }
        .listarticles
        {
            border: 1px solid #003b98;
            padding: 5px;
            margin: 10px;
            border-radius: 5px;
            display: inline-block;
            width: 30%;
            background: #344451;
            color: #fff;
            height: 150px;
        }
        .listarticles:hover
        {
            transition: all 0.5s;
            box-shadow: 0 0 15px #051862;
        }
        .jumbotron {
            margin-top: 1%;
            background-color: #fff;
            color: #303030;
        }

        #myInput {
            width: 40%;
            font-size: 16px;
            padding: 7px 25px 5px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
            border-radius: 5px;
        }

        #myUL {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL li a {
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;
            margin: 1px;
        }

        #myInput2 {
            width: 40%;
            font-size: 16px;
            padding: 7px 25px 5px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
            border-radius: 5px;
        }
        #myUL2 {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        #myUL2 li a {
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;
            margin: 1px;
        }

        #myInput3 {
            width: 40%;
            font-size: 16px;
            padding: 7px 25px 5px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
            border-radius: 5px;
        }
        #myUL3 {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        #myUL3 li a {
            border: 1px solid #ddd;
            background-color: #fff;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block;
            margin: 1px;
        }

        .note-editor.note-frame
        {
            width: 100%;
        }

        .ck.ck-editor__main > .ck-editor__editable:not(.ck-focused)
        {
            height: 300px;
            text-align: right;
        }
        .ck-rounded-corners .ck.ck-editor__main > .ck-editor__editable, .ck.ck-editor__main > .ck-editor__editable.ck-rounded-corners
        {
            height: 300px;
            text-align: right;
        }
    </style>
</head>
<body>
<?php
$step="1001";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["selectforedit"]))
    {
        $step="1002";
        $postid = $_POST["articleid"];

        $sql = "SELECT * FROM tc_article WHERE id=$postid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $articleid      = $row['id'];
                $articleSubject = $row['subject'];
                $articleDescription = $row['description'];
                $articlecategory = $row['category'];
                $articlebody = $row['body'];
                $articleViewnum = $row['viewnum'];
                $articleauthorid = $row['author'];
                $articlepublish  = $row['publish'];
                $tags = $row['tags'];
            }
        } else {
            echo "0 results";
        }
    }
    if (isset($_POST["sabt"])) {
        $subject = $_POST["subject"];
        $articleDescription = $_POST["description"];
        $subject_select = $_POST["subjectSelect"];
        $cbody = $_POST["content"];
        $viewnum = 0;
        $authorid = $_POST["authorid"];
        $postid = $_POST["postid"];
        $isnewarticle = true;
        $sql10 = "SELECT * FROM tc_article WHERE subject='$subject'";
        $result10 = $conn->query($sql10);
        if ($result10->num_rows > 0) {
            // output data of each row
            while($row10 = $result10->fetch_assoc()) {
                $isnewarticle = false;
                break;
            }
        }
        if($isnewarticle==true) {
            $sql = "INSERT INTO tc_article (subject,description,category,body,author) 
        VALUES ('$subject','$articleDescription','$subject_select','$cbody','$authorid')";

            if ($conn->query($sql) === TRUE) {
                //echo "New record created successfully";
                $last_id = $conn->insert_id;
                require('htmlbuilder.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }else{
            echo "THIS ARTICLE ALREADY EXIST";
        }
    }
    if (isset($_POST["edit"]))
    {
        echo "EDit SELECT";
        $edit_id = $_POST['editid'];
        $edit_subject = $_POST['subject'];
        $edit_description = $_POST['description'];
        $edit_select = $_POST['subjectSelect'];
        $edit_articlebody = $_POST['content'];
        $edit_Viewnum = $_POST['viewnum'];
        $edit_authorid = $_POST['authorid'];
        $edit_publish = $_POST['editpublish'];
        $tag = ",";
        if(isset($_POST["programming"])){
            $tag .= "programming,";
        }
        if(isset($_POST["algotrading"])){
            $tag .= "algotrading,";
        }
        if(isset($_POST["analysis"])){
            $tag .= "analysis,";
        }
        if(isset($_POST["finance"])){
            $tag .= "finance,";
        }
        if(isset($_POST["data"])){
            $tag .= "data,";
        }
        if(isset($_POST["education"])){
            $tag .= "education,";
        }
        $sql = "UPDATE tc_article SET subject='$edit_subject',description='$edit_description', category='$edit_select', body='$edit_articlebody', viewnum='$edit_Viewnum', author='$edit_authorid', tags='$tag', publish='$edit_publish' WHERE id='$edit_id'";

        if ($conn->query($sql) === TRUE) {
            echo "Edit successfully ** : ".$edit_id;
            $last_id = $edit_id;
            require('htmlbuilder.php');
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }else{
        if (isset($_POST["delete"]))
        {
            $delete_id = $_POST['articleid'];
            // sql to delete a record

            $sql = "DELETE FROM tc_article WHERE id='$delete_id'";

            if ($conn->query($sql) === TRUE) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }
        if (isset($_POST["publish1"]))
        {
            $publish_id = $_POST['articleid'];
            $publish = $_POST['publish'];
            $publishcode = 1002;

            $sql = "UPDATE tc_article SET publish='$publishcode' WHERE id='$publish_id'";

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully ".$publishcode;
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
        if (isset($_POST["publish2"]))
        {
            $publish_id = $_POST['articleid'];
            $publish = $_POST['publish'];
            $publishcode = 1001;

            $sql = "UPDATE tc_article SET publish='$publishcode' WHERE id='$publish_id'";

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully ".$publishcode;
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }
    }
}

?>
<!--again form-->
<form action="" method="post" id="againform" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid rgb(26, 22, 21); height: 350px; display: none; z-index: 5; position: fixed; top: 100px; width: 500px; margin: auto; left: 490px;">
    <div style="width: 500px;position: relative;border-radius: 15px 15px 0 0;padding: 10px;text-align: center;color: white;padding-bottom: 1px;bottom: 10px;border-bottom: 0.1px solid #000;background: #047570;">
        <div class="imgcontainer">
            <span style="font-size: 30px;color: white;" onclick="closeForm('againform')" class="close" title="Close Modal">×</span>
        </div>
        <h1 style="text-align: center;color: #fff;">سفارش</h1>
    </div>
    <div style="margin-left: 20px;text-align: right;">
        <div style="font-size: 20px;padding: 5px 15px 10px 0;">
            توضیحات :
        </div>
        <textarea name="" id="" style="width: 100%;margin-right: 10px;" rows="5"></textarea>
    </div>
    <div style="position: relative;top: 20px;right: 25px;" class="row">
        <div style="padding: 0 !important;width: 40%;text-align: center;background: #047570;border-radius: 5px;margin: 10px;border: 1px solid #005552;display: inline-block;" class="col-4 button--active">
            <button type="submit" class="btn" style="color: white;background: none;">ثبت سفارش</button>
        </div>
        <div style="color: #707476;border: 1.3px solid;padding: 0 !important;width: 40%;text-align: center;margin: 10px;border-radius: 5px;display: inline-block;" class="col-4">
            <button type="button" class="btn cancel" onclick="closeForm('againform')" style="color: #707476;background: none;">بستن</button>
        </div>
    </div>
</form>
<!--again form-->

<!--filemanager-->
<div id="filemanager" style="background: #f9f9f9; border: 1px solid #1500a5; height: 85%; display: none; z-index: 5; position: fixed; top: 80px; width: 95%; left: 2.5%; border-radius: 10px;padding: 5px;overflow: hidden;">
    <div class="imgcontainer">
        <span style="font-size: 30px;color: red;" onclick="closeForm('filemanager')" class="close" title="Close Modal">×</span>
    </div>
    <iframe src="filemanager/tinyfilemanager.php" style="width: 100%;height: 95%;border: 1px solid #e3e3e3;border-radius: 10px;" frameborder="0"></iframe>
</div>
<!--filemanager-->

<!--login form-->
<form action="index.php" method="post" id="loginform" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 1px solid #014946; height: 350px; display: none; z-index: 5; position: fixed; top: 100px; width: 500px; margin: auto; left: 490px;">
    <div style="background: #047570;width: 500px;position: relative;border-radius: 15px 15px 0 0;padding: 10px;text-align: center;color: white;padding-bottom: 1px;bottom: 21px;border-bottom: 0.1px solid #000;">
        <div class="imgcontainer">
            <span style="font-size: 30px;color: white;" onclick="closeForm('loginform')" class="close" title="Close Modal">×</span>
        </div>
        <h1 style="text-align: center;">ورود</h1>
    </div>
    <div style="margin-left: 20px;text-align: right;">
        <label for="email" style="font-size: 20px;margin: 7px;margin-right: 40px;"><b style="">: ایمیل</b><div></div></label><br>

        <input type="text" id="emaillogin" required="" style="background:white;padding: 10px;border: 1px solid #a1a1a1;border-radius: 5px;width: 85%;text-align: right;margin-right: 40px;" name="emaillogin" placeholder="ایمیل خود را وارد کنید"><br>


        <label for="psw" style="font-size: 20px;margin: 7px;margin-right: 42px;"><b>: رمز ورود</b></label><br>

        <input type="password" name="pswlogin" id="pswlogin" required="" style="background:white;padding: 10px;border: 1px solid #a1a1a1;border-radius: 5px;width: 85%;text-align: right;margin-right: 40px;" placeholder="رمز خود را وارد کنید">

    </div>
    <div style="position: relative;top: 20px;right: 25px;" class="row">
        <div style="padding: 0 !important;width: 40%;text-align: center;background: #047570;border-radius: 5px;margin: 10px;border: 1px solid #014946;display: inline-block;" class="col-4 button--active">
            <button type="submit" class="btn" style="color: white;background: none;">ورود</button>
        </div>
        <div style="color: #707476;border: 1.3px solid;padding: 0 !important;width: 40%;text-align: center;margin: 10px;border-radius: 5px;display: inline-block;" class="col-4">
            <button type="button" class="btn cancel" onclick="closeForm('loginform')" style="color: #707476;background: none;">بستن</button>
        </div>
    </div>
</form>
<!--login form-->

<!--signup form-->
<form action="" method="post" id="signupform" style="display: none; background: rgb(255, 255, 255) none repeat scroll 0% 0%; height: 500px; z-index: 5; position: fixed; top: 100px; width: 500px; margin: auto; left: 490px; border-radius: 15px; border: 1px solid #047570">
    <div class="container" style="width: 100%;background: #fff;border-radius:15px;">
        <div style="height:70px;background: #047570;width: 106.3%;position: relative;border-radius: 15px 15px 0 0;padding: 10px;padding-bottom: 10px;text-align: center;color: white;padding-bottom: 1px;margin-bottom: 10px;left: 15px;">
            <div class="imgcontainer">
                <span style="font-size: 30px;color: #5c6163;" onclick="closeForm('signupform')" class="close" title="Close Modal">×</span>
            </div>
            <h1 style="margin: 0;color: white">ثبت نام</h1>

        </div>
        <div style="margin-left: 10px">
            <div class="w3-row">
                <div>
                    <input type="text" id="fname" name="namesignup" style="padding: 10px;border: 1px solid #a1a1a1;border-radius: 5px;width: 95%;margin: 5px;text-align: right;" placeholder=" نام خود را وارد کنید">
                </div>

                <div style="margin-bottom: 10px;">
                    <input type="text" id="lname" name="lastnamesignup" style="padding: 10px;border: 1px solid #a1a1a1;border-radius: 5px;width: 95%;margin: 5px;text-align: right;" placeholder="نام خانوادگی خود را وارد کنید">
                </div>
            </div>

            <input type="hidden" name="lastuserid" id="lastuserid" value="">

            <div style="margin-bottom: 10px;">
                <input type="text" name="emailsignup" style="padding: 10px;border: 1px solid #a1a1a1;border-radius: 5px;width: 95%;margin: 5px;text-align: right;" required="" placeholder="ایمیل خود را وارد کنید">
            </div>

            <div class="w3-row" style="position: relative;bottom: 10px">
                <div class="w3-col m5 l5" style="margin-right: 10px">
                    <input type="password" style="padding: 10px;border: 1px solid #a1a1a1;border-radius: 5px;width: 97%;margin: 5px;text-align: right;" name="pswsignup" required="" placeholder="رمز خود را وارد کنید">
                </div>

                <div class="w3-col m5 l5">
                    <input type="password" style="padding: 10px;border: 1px solid #a1a1a1;border-radius: 5px;width: 95%;margin: 5px;text-align: right;" name="pswsecondsignup" required="" placeholder="تکرار رمز ورود">
                </div>

                <div class="w3-col m5 l5">
                    <input type="phone" style="padding: 10px;border: 1px solid #a1a1a1;border-radius: 5px;width: 95%;margin: 5px;text-align: right;" name="phonenumbersignup" required="" placeholder="شماره موبایل">
                </div>
            </div>
            <div style="margin-left: 10px;text-align: right;">
                <label style="margin-right: 20px;">
                    <input type="checkbox" checked="checked" name="remember" style="float: right;margin: 5px;">من را به یاد داشته باش</label>
                <label style="margin-right: 20px;">
                    <input type="checkbox" checked="" name="newdev" style="float: right;margin: 5px;">
                    همکاری با تیم تریدیکدرز به عنوان توسعه دهندگان
                </label>
            </div>
        </div>

        <div class="clearfix w3-row" style="text-align: center;padding: 5px;position: relative;">

            <button type="submit" class="w3-col m5 l5 button--" style="color: white;border: 1px solid #047570;margin-left: 10px;padding: 5px;width: 35%;border-radius: 5px;background: #047570;">ثبت نام</button>
            <button type="button" class="w3-col m5 l5 button--active cancel" style="margin-right: 10px;padding: 5px;width: 30%;border-radius: 5px;border: 1px solid #047570;color: #707476;background: none;" onclick="closeForm('signupform')">بستن</button></div>
    </div>
</form>
<!--signup form-->

<!--menu-->
<div class="topnav" id="myTopnav" style="box-shadow: 0 3px 10px rgba(71,44,173,.2);padding: 10px;height: 60px;position: fixed;width: 100%;background: #fff;z-index: 10;top: 0;">
    <div class="row">
        <div style="text-align:center;font-size: 30px;font-weight: bold;" class="col-12">
            مدیریت مقالات
        </div>
    </div>
</div>
<!--menu-->

<!--Project List-->
<div class="content" style="margin: 5%;">

    <form action="" method="" style="width:300px;height:300px;margin:auto;position:absolute;"></form>

    <form action="" method="post">
        <div id="top-title" style="border: 1px solid #d2d2d2;padding: 10px;border-radius: 10px;">
            <input id="subject" name="subject" placeholder="عنوان" style="margin: 10px;font-size: 26px;font-weight: bold;display: inline-block;border-radius: 5px;border: 1px solid #b2b1b1;padding: 5px;" value="<?php echo $articleSubject?>">
            <input type="hidden" id="editid" name="editid" value="<?php echo $articleid?>">
            <input type="hidden" id="editpublish" name="editpublish" value="<?php echo $articlepublish?>">
            <select name="subjectSelect" id="subjectSelect" value="<?php echo $articleViewnum?>" style="font-size: 20px;background: #fff;border: 1px solid #b6b4b4;border-radius: 5px;font-weight: bold;padding: 8px;">
                <option value="1001">بازار سرمایه</option>
                <option value="1002">روش های معاملاتی</option>
                <option value="1003">ابزار ها</option>
                <option value="1004">تک نکته</option>
            </select>

            <label for="authorid" style="position: absolute;top: 95px;margin-right: 10px;">انتخاب نویسنده :</label>

            <select name="authorid" id="authorid" style="width: 310px;position: absolute;top: 120px;margin-right: 10px;">
                <?php

                $sql = "SELECT id ,firstname, lastname, role FROM tc_clients WHERE role=1002 OR role=1003";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc())
                    {
                        if($articleauthorid==$row['id'])
                        {
                            ?>
                            <option value="<?php echo $row['id']; ?>" selected><?php echo $row['firstname']." ".$row['lastname']; ?></option>
                            <?php
                        }
                        else
                        {
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['firstname']." ".$row['lastname']; ?></option>
                            <?php
                        }
                    }
                }
                else {
                    echo "0 results";
                }
                ?>
            </select>

            <div style="position: absolute;left: 65px;top: 90px;width: 400px;font-size: 13px;">
                <style>
                    /* The container */
                    .container {
                        display: block;
                        margin-bottom: 12px;
                        cursor: pointer;
                        position: relative;
                    }

                    /* Hide the browser's default checkbox */
                    .container input {
                        position: absolute;
                        opacity: 0;
                        cursor: pointer;
                        height: 0;
                        width: 0;
                    }

                    /* Create a custom checkbox */
                    .checkmark {
                        position: absolute;
                        top: 0;
                        left: 0;
                        height: 25px;
                        width: 25px;
                        background-color: #eee;
                    }

                    /* On mouse-over, add a grey background color */
                    .container:hover input ~ .checkmark {
                        background-color: #ccc;
                    }

                    /* When the checkbox is checked, add a blue background */
                    .container input:checked ~ .checkmark {
                        background-color: #2196F3;
                    }

                    /* Create the checkmark/indicator (hidden when not checked) */
                    .checkmark:after {
                        content: "";
                        position: absolute;
                        display: none;
                    }

                    /* Show the checkmark when checked */
                    .container input:checked ~ .checkmark:after {
                        display: block;
                    }

                    /* Style the checkmark/indicator */
                    .container .checkmark:after {
                        left: 9px;
                        top: 5px;
                        width: 5px;
                        height: 10px;
                        border: solid white;
                        border-width: 0 3px 3px 0;
                        -webkit-transform: rotate(45deg);
                        -ms-transform: rotate(45deg);
                        transform: rotate(45deg);
                    }
                </style>
                <h4 style="margin: 5px;font-weight: bold;">برچسب ها :</h4>
                <div style="width:150px;margin-top: 10px;display: inline-block;">
                    <label class="container">برنامه نویسی
                        <?php
                        if(strpos($tags,"programming")>0){
                            ?>
                            <input type="checkbox" value="programming" name="programming" checked="checked">
                            <?php
                        }else{
                            ?>
                            <input type="checkbox" value="programming" name="programming">
                            <?php
                        }
                        ?>
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">معاملات الگوریتمی
                        <?php
                        if(strpos($tags,"algotrading")>0){
                            ?>
                            <input type="checkbox" value="algotrading" name="algotrading" checked="checked">
                            <?php
                        }else{
                            ?>
                            <input type="checkbox" value="algotrading" name="algotrading">
                            <?php
                        }
                        ?>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div style="width:120px;margin-top: 10px;display: inline-block;">
                    <label class="container">روش تحلیل
                        <?php
                        if(strpos($tags,"analysis")>0){
                            ?>
                            <input type="checkbox" value="analysis" name="analysis" checked="checked">
                            <?php
                        }else{
                            ?>
                            <input type="checkbox" value="analysis" name="analysis">
                            <?php
                        }
                        ?>
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">بازارهای مالی
                        <?php
                        if(strpos($tags,"finance")>0){
                            ?>
                            <input type="checkbox" value="finance" name="finance" checked="checked">
                            <?php
                        }else{
                            ?>
                            <input type="checkbox" value="finance" name="finance">
                            <?php
                        }
                        ?>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div style="width:110px;margin-top: 10px;display: inline-block;">
                    <label class="container">داده کاوری
                        <?php
                        if(strpos($tags,"data")>0){
                            ?>
                            <input type="checkbox" value="data" name="data" checked="checked">
                            <?php
                        }else{
                            ?>
                            <input type="checkbox" value="data" name="data">
                            <?php
                        }
                        ?>
                        <span class="checkmark"></span>
                    </label>
                    <label class="container">آموزش
                        <?php
                        if(strpos($tags,"education")>0){
                            ?>
                            <input type="checkbox" value="education" name="education" checked="checked">
                            <?php
                        }else{
                            ?>
                            <input type="checkbox" value="education" name="education">
                            <?php
                        }
                        ?>
                        <span class="checkmark"></span>
                    </label>
                </div>
            </div>

            <br>
            <textarea id="description" name="description" placeholder="چکیده" style="margin: 10px;font-size: 20px;font-weight: bold;display: inline-block;border-radius: 5px;border: 1px solid #b2b1b1;padding: 5px;width: 570px;"><?php echo $articleDescription?></textarea>

            <span onclick="filemanager()" style="background: #00cfff;padding: 7px;position: relative;top: 60px;border-radius: 10px;cursor: pointer;border: 2px solid #045895;width: 150px;text-align: center;float: left;"> FileManager <i class="fa fa-files-o"></i></span>
        </div>

        <script>
            function filemanager()
            {
                document.getElementById("filemanager").style.display="block";
            }
        </script>

        <input type="hidden" name="postid" value="<?php echo $postid?>">

        <textarea name="content" id="editor">
            <?php echo $articlebody?>
        </textarea>

        <script>
            CKEDITOR.replace( 'editor' );
        </script>

        <input id="viewnum" name="viewnum" type="hidden" value="<?php echo $articleViewnum?>">

        <?php
        if($step==1001)
        {
            ?>
            <button id="sabt" name="sabt" type="submit" style="width: 200px;padding: 10px;font-size: 20px;float: left;margin: 10px 0;background: #045f7a;border-radius: 5px;border: none;color: white;">ثبت</button>
            <?php
        }elseif($step==1002)
        {
            ?>
            <button id="edit" name="edit" type="submit" style="width: 200px;padding: 10px;font-size: 20px;float: left;margin: 10px 0;background: #045f7a;border-radius: 5px;border: none;color: white;">ادیت</button>
            <?php
        }
        ?>
    </form>
    <div style="margin-top: 65px;border: 1px solid;padding: 15px;border-radius: 5px;">
        <!--listArticles-->
        <?php

        $sql = "SELECT id, subject, description,category, body, viewnum,author,publish, reg_date FROM tc_article ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                ?>
                <form action="" method="post" style="width: 50px;position: relative;right: 25%;display: inline-block;bottom: 100px;">
                    <input type="checkbox" id="" name="delete" requeird="" style="margin-right: 7px;">
                    <input type="hidden" name="articleid" value="<?php echo $row['id']?>">
                    <button type="submit" onclick="popupdelete();" name="delete" id="delete" style="float: right;background: none;border: none;padding: 0;position: relative;bottom: 5px;">
                        <i class="fa fa-trash" style="font-size: 28px;color: red;"></i>
                    </button>
                </form>
                <form class="listarticles" id="listarticles<?php echo $row['id']?>" action="" method="post" style="margin: 5px;width: 27%;">
                    <input type="hidden" name="articleid" value="<?php echo $row['id']?>">
                    <input type="hidden" name="authorid" value="<?php echo $row['author']?>">
                    <button type="submit" name="selectforedit" style="float: left;background: none;border: none;">
                        <i class="fa fa-edit" style="font-size: 28px;color: gold;"></i>
                    </button>
                    <div style="font-size: 20px;font-weight: bold;margin-bottom: 10px;text-align: center;white-space: nowrap;width: 250px;overflow: hidden;text-overflow: ellipsis;">
                        <?php echo $row['subject'];?>
                    </div>
                    <p style=" overflow:auto;height: 60px;border-radius: 5px;border: 1px solid;padding: 5px;font-size: 12px;">
                        <?php echo $row['description'];?>
                    </p>
                    <a href="http://tradicoders.ir/articles/content/<?php echo $row["subject"];?>.html" style="border: 1px solid #06365d;border-radius: 10px;padding: 5px;float: left;background: #00579e;color: white;">خواندن مقاله</a>

                    <style>
                        .switch {
                            position: relative;
                            display: inline-block;
                            width: 50px;
                            height: 25px;
                        }

                        .switch input {
                            opacity: 0;
                            width: 0;
                            height: 0;
                        }

                        .slider {
                            position: absolute;
                            cursor: pointer;
                            top: 0;
                            left: 0;
                            right: 0;
                            bottom: 0;
                            background-color: #ccc;
                            -webkit-transition: .4s;
                            transition: .4s;
                        }

                        .slider:before {
                            position: absolute;
                            content: "";
                            height: 26px;/
                        width: 26px;
                            left: 4px;
                            bottom: 4px;
                            background-color: white;
                            -webkit-transition: .4s;
                            transition: .4s;
                        }

                        input:checked + .slider {
                            background-color: #2196F3;
                        }

                        input:focus + .slider {
                            box-shadow: 0 0 1px #2196F3;
                        }

                        input:checked + .slider:before {
                            -webkit-transform: translateX(26px);
                            -ms-transform: translateX(26px);
                            transform: translateX(23px);
                        }

                        /* Rounded sliders */
                        .slider.round {
                            border-radius: 34px;
                        }

                        .slider.round:before {
                            border-radius: 50%;
                            width: 40%;
                            height: 80%;
                        }
                    </style>
                    <?php
                    if($row["publish"]==1001)
                    {
                        ?>
                        <label class="switch">
                            <input type="hidden" value="off" name="publish1">
                            <input type="checkbox" onchange="givesignal(this.form.id)" checked="" >
                            <span class="slider round"></span>
                        </label>
                        <?php
                    }else
                    {
                        ?>
                        <label class="switch">
                            <input type="checkbox" onchange="givesignal(this.form.id)" name="publish2">
                            <span class="slider round"></span>
                        </label>
                        <?php
                    }
                    ?>
                </form>
                <?php
            }
        }
        else {
            echo "0 results";
        }
        ?>
    </div>

</div>
<!--Project List-->

<script>
    function givesignal(v)
    {
        document.getElementById(v).submit();
    }
    function tl_top1()
    {
        document.getElementById("tl_top1").style.background="#00404b";
        document.getElementById("tl_top2").style.background="#00849a";
        document.getElementById("tl_top3").style.background="#00849a";
        document.getElementById("tl_top4").style.background="#00849a";
        ////////////////////////////////////////
        document.getElementById("tl_1").style.display="block";
        document.getElementById("tl_2").style.display="none";
        document.getElementById("tl_3").style.display="none";
        document.getElementById("tl_4").style.display="none";
    }
    function tl_top2()
    {
        document.getElementById("tl_top2").style.background="#00404b";
        document.getElementById("tl_top1").style.background="#00849a";
        document.getElementById("tl_top3").style.background="#00849a";
        document.getElementById("tl_top4").style.background="#00849a";
        ////////////////////////////////////////
        document.getElementById("tl_2").style.display="block";
        document.getElementById("tl_1").style.display="none";
        document.getElementById("tl_3").style.display="none";
        document.getElementById("tl_4").style.display="none";
    }
    function tl_top3()
    {
        document.getElementById("tl_top3").style.background="#00404b";
        document.getElementById("tl_top1").style.background="#00849a";
        document.getElementById("tl_top2").style.background="#00849a";
        document.getElementById("tl_top4").style.background="#00849a";
        ////////////////////////////////////////
        document.getElementById("tl_3").style.display="block";
        document.getElementById("tl_1").style.display="none";
        document.getElementById("tl_2").style.display="none";
        document.getElementById("tl_4").style.display="none";
    }
    function tl_top4()
    {
        document.getElementById("tl_top4").style.background="#00404b";
        document.getElementById("tl_top1").style.background="#00849a";
        document.getElementById("tl_top2").style.background="#00849a";
        document.getElementById("tl_top3").style.background="#00849a";
        ////////////////////////////////////////
        document.getElementById("tl_4").style.display="block";
        document.getElementById("tl_1").style.display="none";
        document.getElementById("tl_2").style.display="none";
        document.getElementById("tl_3").style.display="none";
    }
    function Searchbox() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    function Searchbox2() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput2");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL2");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    function Searchbox3() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput3");
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL3");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    function MProjectinfo()
    {
        document.getElementById("MProjectinfo").style.display="block";
    }
    function downloadinfo()
    {
        document.getElementById("downloadinfo").style.display="block";
    }
    function login()
    {
        document.getElementById("loginform").style.display="block";
        document.getElementById("signupform").style.display="none";
        document.getElementById("videoform").style.display="none";
    }
    function signup()
    {
        document.getElementById("signupform").style.display="block";
        document.getElementById("loginform").style.display="none";
        document.getElementById("videoform").style.display="none";
    }
    function video()
    {
        document.getElementById("videoform").style.display="block";
        document.getElementById("loginform").style.display="none";
        document.getElementById("signupform").style.display="none";
    }
    function OpenForm(v) {
        document.getElementById(v).style.display = "block";
    }
    function closeForm(v) {
        document.getElementById(v).style.display = "none";
    }
</script>

<?php
$conn->close();
?>
</body>
</html>