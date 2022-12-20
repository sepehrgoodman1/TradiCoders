<?php

$Projectid = $_GET['prid'];
require("backend_header.php");

$wappphone = "";

$sql = selectQuery_tc_project("id='$Projectid' and (developeruid='$userid' or creatoruid='$userid') ");
if (sizeof($sql) == 0) {
    openLink('index.php');
}
foreach ($sql as $row) {
    $cid = $row['creatoruid'];
    $devid = $row["developeruid"];
}
$sql_user_info = selectQuery_tc_clients("id='$cid' ", "firstname,lastname, imgurl");
$sql_dev_info = selectQuery_tc_clients("id='$devid' ", "firstname,lastname, imgurl");

//--------
if (!empty($_POST["close_complete_btn"]) || !empty($_POST["close_half_pending_btn"]) || !empty($_POST["arbitration_btn"]) || !empty($_POST["close_cancel_pending_btn"]) || !empty($_POST["close_half_btn"]) || !empty($_POST["close_cancel_btn"]) || !empty($_POST["waiting_user_btn"])) {
    $date = date('Y-m-d h:i:s');
    $sql = selectQuery_tc_project("id='$Projectid' ");
    foreach ($sql as $row) {
        $PrStatus = $row['prstatus'];
        $cid = $row['creatoruid'];
        $pprice = $row['price'];
        $devid = $row["developeruid"];
        $nameproject = $row["subject"];
        $alldifficulties = $row["difficulties"];
        if ($alldifficulties == "NULL" || $alldifficulties == "null" || $alldifficulties == "") {
            $alldifficulties = '';
        } else {
            $alldifficulties = json_decode($alldifficulties, true);
            $difficulte_mydata = json_decode($row['difficulties'], true);
        }

    }

    if (!empty($_POST["arbitration_btn"]) || !empty($_POST["close_half_pending_btn"]) || !empty($_POST["close_cancel_pending_btn"])) {

        if (array_key_exists('prdifficulties_dev', $_POST)) {
            $prdifficulties = array();
            $prdifficulties['devdifficulties'] = $_POST['prdifficulties_dev'];
        } else if (array_key_exists('prdifficulties_user', $_POST)) {
            $prdifficulties = array();
            $prdifficulties['userdifficulties'] = $_POST['prdifficulties_user'];
        }

        if ($alldifficulties == "NULL" || $alldifficulties == "null" || $alldifficulties == "") {
            $alldifficulties = array();
        }

    }


    if (!empty($_POST["waiting_user_btn"])) {

        $not_parameters = array();
        $not_parameters['nameproject'] = $nameproject;
        $not_parameters['projectid'] = $Projectid;
        setNotifPer("waiting_user", $not_parameters, $cid);


        $sql = "UPDATE tc_project SET prstatus='waiting_user' WHERE id='$Projectid'";
        $conn->query($sql);
    } else if (!empty($_POST["arbitration_btn"])) {


        $not_parameters = array();
        $temp_sms_main = selectQuery_temp_sms_main("name='arbitration'");

        $not_parameters['main'] = $temp_sms_main['send_developer'];
        $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);
        $not_parameters['nameproject'] = $nameproject;
        $not_parameters['projectid'] = $Projectid;
        $not_parameters['requestuser'] = $difficulte_mydata[0]['userdifficulties'];
        $not_parameters['requestdev'] = $difficulte_mydata[0]['devdifficulties'];
        if ($difficulte_mydata[0]['type'] == 'close_cancel_pending') {
            $not_parameters['type'] = 'کارفرما درخواست کنسل کردن پروژه را داده است';
        } else {
            $not_parameters['type'] = 'کارفرما درخواست پرداخت نصف مبلغ را داده است';
        }
        setNotifPer('arbitration', $not_parameters, $devid);

        $not_parameters['main'] = $temp_sms_main['send_user'];
        $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);
        setNotifPer('arbitration', $not_parameters, $cid);


        array_push($alldifficulties, $prdifficulties);
        $alldifficulties = json_encode($alldifficulties, JSON_UNESCAPED_UNICODE);
        $sql = "UPDATE tc_project SET prstatus='arbitration', difficulties = '$alldifficulties' WHERE id='$Projectid'";
        $conn->query($sql);
    } else if (!empty($_POST["close_complete_btn"])) {

        $not_parameters = array();
        $not_parameters['nameproject'] = $nameproject;
        $not_parameters['priceproject'] = $pprice;
        $not_parameters['projectid'] = $Projectid;
        setNotif("close_complete", $not_parameters);

        $sql = "UPDATE tc_project SET prstatus='close_complete', prdonetime='$date' WHERE id='$Projectid'";
        $conn->query($sql);
    } else if (!empty($_POST["close_half_pending_btn"])) {


        $not_parameters = array();
        $temp_sms_main = selectQuery_temp_sms_main("name='close_half_pending'");

        $not_parameters['main'] = $temp_sms_main['send_developer'];
        $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);
        $not_parameters['projectid'] = $Projectid;
        $not_parameters['nameproject'] = $nameproject;
        $not_parameters['priceproject'] = $pprice;
        setNotifPer('close_half_pending', $not_parameters, $devid);

        $not_parameters['main'] = $temp_sms_main['send_user'];
        $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);
        setNotifPer('close_half_pending', $not_parameters, $cid);


        $prdifficulties['type'] = 'close_half_pending';
        array_push($alldifficulties, $prdifficulties);
        $alldifficulties = json_encode($alldifficulties, JSON_UNESCAPED_UNICODE);
        $sql = "UPDATE tc_project SET prstatus='close_half_pending', difficulties = '$alldifficulties' WHERE id='$Projectid'";
        $conn->query($sql);
    } else if (!empty($_POST["close_cancel_pending_btn"])) {


        $not_parameters = array();
        $temp_sms_main = selectQuery_temp_sms_main("name='close_cancel_pending'");

        $not_parameters['main'] = $temp_sms_main['send_developer'];
        $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);
        $not_parameters['projectid'] = $Projectid;
        $not_parameters['nameproject'] = $nameproject;
        $not_parameters['priceproject'] = $pprice;
        setNotifPer('close_cancel_pending', $not_parameters, $devid);

        $not_parameters['main'] = $temp_sms_main['send_user'];
        $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);
        setNotifPer('close_cancel_pending', $not_parameters, $cid);


        $prdifficulties['type'] = 'close_cancel_pending';
        array_push($alldifficulties, $prdifficulties);
        $alldifficulties = json_encode($alldifficulties, JSON_UNESCAPED_UNICODE);
        $sql = "UPDATE tc_project SET prstatus='close_cancel_pending', difficulties = '$alldifficulties' WHERE id='$Projectid'";
        $conn->query($sql);
    } else {

        //...

        if (!empty($_POST["close_complete_btn"]) || !empty($_POST["close_half_btn"]) || !empty($_POST["close_cancel_btn"])) {


            if (!empty($_POST["close_half_btn"])) {

                $not_parameters = array();
                $not_parameters['nameproject'] = $nameproject;
                $not_parameters['priceproject'] = $pprice;
                $not_parameters['projectid'] = $Projectid;
                setNotif("close_half", $not_parameters);

                $sql = "UPDATE tc_project SET prstatus='close_half' , prdonetime='$date' WHERE id='$Projectid'";
                $conn->query($sql);
            }
            if (!empty($_POST["close_cancel_btn"])) {

                $not_parameters = array();
                $not_parameters['nameproject'] = $nameproject;
                $not_parameters['priceproject'] = $pprice;
                $not_parameters['projectid'] = $Projectid;
                setNotif("close_cancel", $not_parameters);

                $sql = "UPDATE tc_project SET prstatus='close_cancel', prdonetime='$date' WHERE id='$Projectid'";
                $conn->query($sql);
            }

            if (!empty($_POST["close_half_btn"])) {
                $pprice = $pprice / 2;


                $sql = "SELECT * FROM tc_clients WHERE id='$devid'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $balance = $row["balance"];
                    }
                }
                $newbalance = $balance + $pprice;
                $sql = "UPDATE tc_clients SET balance='$newbalance' WHERE id='$devid'";
                $conn->query($sql);
                //...
                $sql = selectQuery_tc_clients("id='$cid'");
                foreach ($sql as $row) {
                    $balance = $row["balance"];
                    $hold = $row["hold"];
                }
                $newhold = $hold - ($pprice * 2);
                $newbalance = $balance + $pprice;
                $sql = "UPDATE tc_clients SET balance='$newbalance', hold='$newhold' WHERE id='$cid'";
                $conn->query($sql);


            } else if (!empty($_POST["close_cancel_btn"])) {

                $sql = selectQuery_tc_clients("id='$cid'");
                foreach ($sql as $row) {
                    $balance = $row["balance"];
                    $hold = $row["hold"];
                }
                $newhold = $hold - $pprice;
                $newbalance = $balance + $pprice;

                $sql = "UPDATE tc_clients SET balance='$newbalance', hold='$newhold' WHERE id='$cid'";
                $conn->query($sql);


            } else {


                $sql = selectQuery_tc_clients("id='$devid'");
                foreach ($sql as $row) {
                    $balance = $row["balance"];
                }
                $newbalance = $balance + $pprice;
                $sql = "UPDATE tc_clients SET balance='$newbalance' WHERE id='$devid'";
                $conn->query($sql);
                //...
                $sql = selectQuery_tc_clients("id='$cid'");
                foreach ($sql as $row) {
                    $balance = $row["balance"];
                    $hold = $row["hold"];
                }
                $newhold = $hold - $pprice;
                $sql = "UPDATE tc_clients SET  hold='$newhold' WHERE id='$cid'";
                $conn->query($sql);


            }


        }
    }
    // }
}
$prnumber = 0;
$sql = selectQuery_tc_project("id='$Projectid'");
$projectProgress = 0;
foreach ($sql as $row) {
    $PrStatus = $row['prstatus'];
    $difficulte_user = json_decode($row['difficulties'], true);
    $difficulte_user = 'دلیل کارفرما: ' . $difficulte_user[0]['userdifficulties'];
    $baseurl = $row['requirement_url'];
    $PrPrice = $row['price'];
    $developeruid = $row["developeruid"];
    $creatoruid = $row["creatoruid"];
    if ($PrStatus == "pending") {
        $projectProgress = 0;
    }
    if ($PrStatus == "approve") {
        $projectProgress = 0;
    }
    if ($PrStatus == "open") {
        $projectProgress = 25;
    }
    if ($PrStatus == "close_complete") {
        $projectProgress = 100;
    }
    if ($PrStatus == "close_half_pending") {
        $projectProgress = 50;
    }
    if ($PrStatus == "close_half") {
        $projectProgress = 100;
    }
    if ($PrStatus == "close_cancel_pending") {
        $projectProgress = 100;
    }
    if ($PrStatus == "close_cancel") {
        $projectProgress = 100;
    }
    if ($PrStatus == "waiting_user") {
        $projectProgress = 50;
    }

}
//----------
if ($userid == $creatoruid) {
    $otheruid = $developeruid;
} else {
    $otheruid = $creatoruid;
}

$sql = selectQuery_tc_clients("id='$otheruid'");
foreach ($sql as $row) {
    $wappphone = $row["phonenumber"];
}
//----------
require('fileuploader.php');
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    $title = 'پروفایل | پروژه ها | مدیریت پروژه ها';
    $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
    $description = 'شما می توانید از این بخش پروژه های خود را مشاهده و کنترل کنید';
    $icon = '../tradi-coders-logo-final.gif';
    defualtMetaAndStyleProfile($title, $keywords, $description, $icon);
    ?>

    <!-- Tell the 7browser to be responsive to screen width -->
    <link href="css/progress-wizard.min.css" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">
    <!-- Navbar -->
    <?php require_once("navbar.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php require_once("sidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <!--NextStepPr--->
    <form action="" id="NextStepPr" name="NextStepPr" method="post"
          style="display: none;    box-shadow: 5px 6px 10px #00000024; position: absolute; width: 45%; z-index: 20; background: white; right: 35%;  text-align: center; top: 15%; border-radius: 12px; padding: 25px; color: black;border: 2px solid #0000001a;"
          enctype="multipart/form-data">
        <div class="imgcontainer">
            <!-- <span style="font-size: 40px;color: red;position: absolute;right: 15px;" 
                  class="close" >×</span> -->
            <i class="fa-solid fa-xmark CloseModalIcon" onclick="closeForm('NextStepPr')" title="Close Modal"></i>
        </div>

        <!-- if ($PrStatus == 1000 || ($PrStatus == 1001 && $userid==$developeruid))
        if ($PrStatus == 1001 && $userid==$creatoruid)
        <h3 style="padding: 10px;background: #343a40;color: #fff;border-radius: 10px;">در خواست باز تولید</h3> -->


        <?php
        if ($PrStatus == "pending") {
            echo "<h3 style='padding: 10px;color: black;border-radius: 10px;     font-size: 24px;'>در انتظار تایید تریدی کدرز</h3>";
        }
        if ($PrStatus == "approve") {
            echo "<h3 style='padding: 10px;color: black;border-radius: 10px;     font-size: 24px;'>در انتظار تایید توسعه دهنده</h3>";
        }
        if ($PrStatus == "open") {
            echo "<h3 style='padding: 10px;color: black;border-radius: 10px;     font-size: 24px;'>در حال تولید پروژه توسط توسعه دهنده</h3>";
        }
        if ($PrStatus == "close_complete") {
            echo "<h3 style='padding: 10px;color: black;border-radius: 10px;     font-size: 24px;'>پروژه با رضایت کامل به اتمام رسیده</h3>";
        }
        if ($PrStatus == "close_half_pending") {
            echo "<h3 style='padding: 10px;color: black;border-radius: 10px;     font-size: 24px;'>نیاز به باز تولید دارد</h3>";
        }
        if ($PrStatus == "close_half") {
            echo "<h3 style='padding: 10px;color: black;border-radius: 10px;     font-size: 24px;'>پروژه به اتمام رسیده و نیمی از پول آن پرداخت شده</h3>";
        }
        if ($PrStatus == "close_cancel_pending") {
            echo "<h3 style='padding: 10px;color: black;border-radius: 10px;     font-size: 24px;'>درخواست لغو پروژه داده شده</h3>";
        }
        if ($PrStatus == "close_cancel") {
            echo "<h3 style='padding: 10px;color: black;border-radius: 10px;     font-size: 24px;'>پروژه لغو شده</h3>";
        }
        if ($PrStatus == "waiting_user") {
            echo "<<h3 style='padding: 10px;color: black;border-radius: 10px;     font-size: 24px;'>در انتظار تایید کارفرما</h3>";
        }
        if ($PrStatus == "arbitration") {
            echo "<h3 style='padding: 10px;color: black;border-radius: 10px;     font-size: 24px;'>پروژه در وضعیت شکایت قرار دارد</h3>";
        }
        ?>

        <label for="stepdcrp" class="col-sm-3 control-label LabelTextArea">توضیحات :</label>
        <textarea name="stepdcrp" id="stepdcrp" rows="5"
                  style="width:100%;border-radius: 5px;margin-bottom: 20px;border: 1px solid;"></textarea>

        <input type="hidden" name="stepst" id="stepst" value="next">

        <label for="fileToUpload" class="col-sm-3 control-label TitleUpFile">آپلود
            فایل پروژه :</label>
        <input type="file" name="fileToUpload" id="fileToUpload" style="margin-right: 10px;width: 100%;">
        <button type="submit"
                name="submit" class="BtnUpFileModal">ثبت
        </button>
    </form>
    <!--NextStepPr--->

    <!--PreviousStepPr--->
    <form action="" id="PreviousStepPr" name="PreviousStepPr" method="post" enctype="multipart/form-data"
          style="display: none; position: absolute; width: 45%; z-index: 20; background: white; right: 35%;  text-align: center; top: 15%; border-radius: 5px; padding: 10px; color: black;border: 1px solid black;">
        <div class="imgcontainer">
            <span style="font-size: 30px;color: red;" onclick="closeForm('PreviousStepPr')" class="close"
                  title="Close Modal">×</span>
        </div>
        <h1>درخواست باز بینی</h1>
        <label for="stepdcrp" class="col-sm-3 control-label" style="float: right;width: 120px;">توضیحات :</label>
        <textarea name="stepdcrp" id="stepdcrp" rows="5"
                  style="width:93%;border-radius: 5px;border: none;margin-bottom: 20px;border: 1px solid;"></textarea>

        <input type="hidden" name="stepst" id="stepst" value="previous">

        <label for="fileToUpload" class="col-sm-3 control-label" style="width: 130px;float: right;margin-right: 20px;">آپلود
            فایل پروژه :</label>
        <input type="file" name="fileToUpload" id="fileToUpload" style="float: right;width: 100%;margin-right: 30px;">
        <button type="submit" name="submit"
                style="width: 40%;margin: 20px;border-radius: 5px;border: 1px solid red;padding: 5px;background: #ff0000a1;color: white;margin-bottom: 0;cursor: pointer;">
            ثبت
        </button>

    </form>
    <!--PreviousStepPr--->

    <!--deleteProject--->
    <form action="" id="deleteProject" name="deleteProject" method="post" enctype="multipart/form-data"
          style="display: none; position: absolute; width: 45%; z-index: 20; background: white; right: 35%;  text-align: center; top: 15%; border-radius: 5px; padding: 10px; color: black;border: 1px solid black;">
        <div class="imgcontainer">
            <span style="font-size: 30px;color: red;" onclick="closeForm('deleteProject')" class="close"
                  title="Close Modal">×</span>
        </div>
        <h1>درخواست حذف این پروژه</h1>
        <label for="stepdcrp" class="col-sm-3 control-label" style="float: right;width: 120px;">توضیحات :</label>
        <textarea name="stepdcrp" id="stepdcrp" rows="5"
                  style="width:93%;border-radius: 5px;border: none;margin-bottom: 20px;border: 1px solid;"></textarea>

        <input type="hidden" name="stepst" id="stepst" value="previous">

        <label for="fileToUpload" class="col-sm-3 control-label" style="width: 130px;float: right;margin-right: 20px;">آپلود
            فایل پروژه :</label>
        <input type="file" name="fileToUpload" id="fileToUpload" style="float: right;width: 100%;margin-right: 30px;">
        <button type="submit" name="submit"
                style="width: 40%;margin: 20px;border-radius: 5px;border: 1px solid red;padding: 5px;background: #ff0000a1;color: white;margin-bottom: 0;cursor: pointer;">
            ثبت
        </button>

    </form>
    <!--deleteProject--->


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="index.php" class="LinksPages">پروفایل</a></li>
                            <li class="breadcrumb-item"><a href="myprojects.php" class="LinksPages">پروژه ها</a></li>
                            <li class="breadcrumb-item active"><a href="" class="LinksPages">مدیریت پروژه</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content" style="background:#fff;">
        <div class="P_ContainerOfSec">
            <!-- Start Right -->

            <div class="R_ContainerOfSec">

            <div class="container-fluid Mt_20">
                <style>
                    .progress-indicator > li.completed .bubble, .progress-indicator > li.completed .bubble::after, .progress-indicator > li.completed .bubble::before {
                        background-color: #eee;
                    }
                </style>
                <div class="row" style="margin-bottom: 20px">
                    <ul class="progress-indicator"
                        style="width: 90%;direction: ltr;margin-bottom: 20px;margin-top: 10px;">
                        <li style="color:#047570;" class="<?php if ($PrStatus == "open") {
                            echo "active";
                        } else if ($PrStatus == "waiting_user") {
                            echo "warning";
                        } else if ($PrStatus == "close_complete") {
                            echo "success";
                        } else if ($PrStatus == "close_half_pending" || $PrStatus == "close_half") {
                            echo "warning";
                        } else if ($PrStatus == "close_cancel_pending" || $PrStatus == "close_cancel") {
                            echo "danger";
                        } else if ($PrStatus == "arbitration") {
                            echo "danger";
                        } else {
                            echo "completed";
                        } ?>">
                            <span class="bubble"></span>
                            ساخت پروژه<br><small>(در انتظار تولید توسط توسعه دهنده)</small>
                        </li>


                        <li style="color:#047570;" class="<?php if ($PrStatus == "waiting_user") {
                            echo "warning";
                        } else if ($PrStatus == "close_complete") {
                            echo "success";
                        } else if ($PrStatus == "close_half_pending" || $PrStatus == "close_half") {
                            echo "warning";
                        } else if ($PrStatus == "close_cancel_pending" || $PrStatus == "close_cancel") {
                            echo "danger";
                        } else if ($PrStatus == "arbitration") {
                            echo "danger";
                        } else {
                            echo "completed";
                        } ?>">
                            <span class="bubble"></span>
                            تحویل پروژه <br><small>(در انتظار تایید کارفرما)</small>
                        </li>


                        <li style="color:#047570;" class="<?php if ($PrStatus == "close_complete") {
                            echo "success";
                        } else if ($PrStatus == "close_half_pending" || $PrStatus == "close_half") {
                            echo "warning";
                        } else if ($PrStatus == "close_cancel_pending" || $PrStatus == "close_cancel") {
                            echo "danger";
                        } else if ($PrStatus == "arbitration") {
                            echo "danger";
                        } else {
                            echo "completed";
                        } ?>">
                            <span class="bubble"></span>
                            تایید مشتری <br><small>(تایید صحت عملکرد برنامه)</small>
                        </li>

                        <?php if ($PrStatus == "close_half_pending" || $PrStatus == "close_half") { ?>


                            <li style="color:#047570;"
                                class="<?php if ($PrStatus == "close_half_pending" || $PrStatus == "close_half") {
                                    echo "warning";
                                } else if ($PrStatus == "close_cancel_pending" || $PrStatus == "close_cancel") {
                                    echo "danger";
                                } else if ($PrStatus == "arbitration") {
                                    echo "warning";
                                } else {
                                    echo "completed";
                                } ?>">
                                <?php if ($PrStatus == "close_half_pending") { ?>
                                    <span class="bubble"></span>
                                    درخواست پرداخت نصف مبلغ<br><small>(در حال بررسی توسط تریدی کدرز)</small>
                                <?php } else { ?>
                                    <span class="bubble"></span>
                                    نصف مبلغ پرداخت شده<br><small>(تایید شده توسط تریدی کدرز)</small>
                                <?php } ?>
                            </li>

                        <?php }
                        if ($PrStatus == "close_cancel_pending" || $PrStatus == "close_cancel") { ?>


                            <li style="color:#047570;"
                                class="<?php if ($PrStatus == "close_cancel_pending" || $PrStatus == "close_cancel") {
                                    echo "danger";
                                } else if ($PrStatus == "arbitration") {
                                    echo "danger";
                                } else {
                                    echo "completed";
                                } ?>">
                                <?php if ($PrStatus == "close_cancel_pending") { ?>
                                    <span class="bubble"></span>
                                    لغو شده<br><small>(در حال بررسی توسط تریدی کدرز)</small>
                                <?php } else { ?>
                                    <span class="bubble"></span>
                                    لغو شده<br><small>(تایید شده توسط تریدی کدرز)</small>
                                <?php } ?>
                            </li>

                        <?php }
                        if ($PrStatus == "arbitration") { ?>


                            <li style="color:#047570;" class="<?php if ($PrStatus == "arbitration") {
                                echo "danger";
                            } else {
                                echo "completed";
                            } ?>">
                                <span class="bubble"></span>
                                شکایت<br><small>(در حال بررسی توسط تریدی کدرز)</small>
                            </li>
                        <?php } ?>

                    </ul>
                    <div class="container">
                       
                        <div class="row mt-2">
                            <!-- <button type="button" class="btn btn-info col-4" onclick="Previous_Step_Project()">درخواست
                                ورژن جدید
                            </button> -->
                           
                        </div>
                    </div>
                </div>
                <!-- /.row -->

                <style>
                    .direct-chat-text {
                        width: 35%;
                        float: left;
                    }

                    .direct-chat-primary .right > .direct-chat-text {
                        float: right;
                    }
                </style>
                <div style="margin: 10px;border-bottom: 1px solid #047570; padding-bottom:20px">
                    <!--                    <a href="https://api.whatsapp.com/send/?phone=-->
                    <?php //echo $wappphone; ?><!--&text&app_absent=0">-->
                    <button type="submit" onclick="ChatBox()" id="firsttitle"
                            class="col-sm-1 btn btn-block btn-outline-info btn-lg ButtonSInProfie ml-2"
                            style="margin-top:0.5rem"
                    >گفتگو
                    </button>
                    <!--                    </a>-->
                    <button id="secondtitle" class="col-sm-1 btn btn-block btn-outline-info btn-lg ButtonSInProfie ml-2"

                            onclick="HistoryBox()">تاریخچه
                    </button>
                    <button id="lasttitle" class="col-sm-2 btn btn-block btn-outline-info btn-lg ButtonSInProfie ml-2"
                            onclick="Next_Step_Project()">ارسال
                        فایل
                    </button>
                    <a class="col-sm-2 btn btn-block btn-outline-info btn-lg ButtonSInProfie"
                       href="<?php echo $baseurl ?>">اطلاعات
                        اولیه
                        <i class="fa-solid fa-file-arrow-down"></i>
                    </a>
                    <?php
                    if ($userid == $developeruid && $PrStatus == "open") {
                        ?>
                        <form action="" id="Confirm" name="Confirm" method="post">
                            <button type="submit" name="waiting_user_btn" value="1" class="btn btn-info col m-2">درخواست
                                اتمام کار
                            </button>
                        </form>
                        <?php
                    }
                    ?>

                </div>

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable" id="ChatBox" style="display:none;">
                        <!-- Custom tabs (Charts with tabs)-->
                        <!-- /.card -->
                        <!-- DIRECT CHAT -->
                        <div class="card direct-chat direct-chat-primary">
                            <div class="card-header">
                                <h3 class="card-title">گفتگو</h3>

                                <!--                                <div class="card-tools">-->
                                <!--                                    <span data-toggle="tooltip" title="3 پیام جدید" class="badge badge-primary">3</span>-->
                                <!--                                </div>-->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Conversations are loaded here -->
                                <div id="messages_body" class="direct-chat-messages">
                                    <!-- Message. Default to the left -->


                                    <!-- /.direct-chat-msg -->


                                </div>
                                <!--/.direct-chat-messages-->

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="input-group">
                                    <input type="text" name="message" id="message_text" placeholder="Type Message ..."
                                           class="form-control">
                                    <span class="input-group-append">
                      <button type="button" onclick="sendMess()" class="btn btn-primary">Send</button>
                    </span>
                                </div>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!--/.direct-chat -->

                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-12 connectedSortable" id="HistoryBox">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">تاریخچه فرایند پروژه</h3>

                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <tbody>
                                            <tr style="text-align: center">
                                                <th>شماره</th>
                                                <th>ارسال کننده</th>
                                                <th>تاریخ</th>
                                                <!-- <th>وضعیت</th> -->
                                                <th>دلیل</th>
                                                <th>دانلود</th>
                                            </tr>
                                            <?php
                                            $rowcounter = 0;
                                            $sql1 = "SELECT * FROM tc_project_activity WHERE prid='$Projectid'";
                                            $result1 = $conn->query($sql1);

                                            if ($result1->num_rows > 0) {
                                                // output data of each row
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    $rowcounter++;
                                                    $actorname = "";
                                                    $actorid = $row1['actorid'];
                                                    if ($actorid == -1) {
                                                        $actorname = "admin";
                                                    } else {
                                                        $sql2 = "SELECT * FROM tc_clients WHERE id='$actorid'";
                                                        $result2 = $conn->query($sql2);
                                                        if ($result2->num_rows > 0) {
                                                            // output data of each row
                                                            while ($row2 = $result2->fetch_assoc()) {
                                                                $actorname = $row2["firstname"] . " " . $row2["lastname"];
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <tr style="text-align: center">
                                                        <td><?php echo $rowcounter; ?></td>
                                                        <td><?php echo $actorname; ?></td>
                                                        <td><?php echo $row1['updatetime']; ?></td>
                                                        <!-- <td> -->
                                                        <?php
                                                        // if($actorid==$creatoruid){
                                                        ?>
                                                        <!-- <span class="badge badge-danger">درخواست بازتولید </span> -->
                                                        <?php
                                                        // }
                                                        // if($actorid==$developeruid){
                                                        ?>
                                                        <!-- <span class="badge badge-info">باز تولید</span> -->
                                                        <?php
                                                        // }
                                                        ?>
                                                        <!-- </td> -->
                                                        <td><?php echo $row1['description']; ?></td>
                                                        <td>
                                                            <a href="<?php echo $row1['pathurl1']; ?>"
                                                               class="btn btn-app"
                                                               style="font-size: 10px;padding: 3px;height: 40px;margin: 0;text-align: center;">
                                                                <i class="fa fa-save" style=""></i> ذخیره
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->

            </div><!-- /.container-fluid -->

            </div>
            <!-- End Right -->




            <!-- Start Left -->
            <div class="L_ContainerOfSec">

            <?php
                        if ($PrStatus == "waiting_user" && $userid == $creatoruid)
                        {
                        ?>

                        <!-- <form action="" id="Confirm" name="Confirm" method="post"> -->
                            <div class="P_Req">
                              
                                <div class="L_Req">
                                    <div class="TypeOfGuy">کارفرما</div>
                                    <div class="GuyAndDate">
                                        <div>
                                            <img src="../assets/images/person.webp" class="GuyPic" alt="">
                                        </div>
                                        <div>
                                            <div class="NameOfThatGuy">سپهر خادمی</div>
                                            <div class="DateOfThatGuy">1401/10/02</div>
                                        </div>
                                    </div>
                                    <div class="TypeOfGuy">توسعه دهنده</div>
                                    <div class="GuyAndDate">
                                        <div>
                                            <img src="../assets/images/person.webp" class="GuyPic" alt="">
                                        </div>
                                        <div>
                                            <div class="NameOfThatGuy">حامد دهقانی</div>
                                            <div class="DateOfThatGuy">1401/10/02</div>
                                        </div>
                                    </div>
                                    <div class="PriceOf Mt20">قیمت: 1200 تومان</div>
                                    <div class="PriceOf">زمان پروژه: 5 روز</div>
                                    <div class="TypeOfGuy">وضعیت</div>
                                    <div class="ProjectStatus">
                                    <?php
                            }
                             if ($PrStatus == "close_cancel_pending") {
                                ?>
                                <span class="col-5 text-warning">مشتری به دلیل عدم رضایت درخواست کنسل کردن پروژه را داده است</span>
                                <?php
                                if ($userid == $developeruid) {
                                    ?>
                                    <form action="" id="Confirm" name="Confirm" method="post">
                                        <button type="submit" name="close_cancel_btn" value="1"
                                                class="btn btn-info col-3">تایید لغو پروژه
                                        </button>
                                        <button type="submit" name="arbitration_btn" value="1"
                                                class="btn btn-danger col-3">عدم تایید لغو پروژه
                                        </button>
                                        <div class=" row mb-3">
                                            <label for="prdifficulties" class="form-label">در صورتی که تایید نمی کنید
                                                پاسخ نارضایتی کارفرما را ذکر کنید :</label>
                                            <label class="form-label text-danger"><?php echo $difficulte_user ?></label>
                                            <textarea class="form-control" name="prdifficulties_dev" id="prdifficulties"
                                                      rows="3"></textarea>
                                        </div>
                                    </form>
                                    <?php
                                }
                            } else if ($PrStatus == "close_cancel") {
                                ?>
                                <span class=" text-danger">این پروژه به دلیل عدم رضایت مشتری کنسل شده است</span>
                                <?php
                            } else if ($PrStatus == "close_half_pending") {
                                ?>
                                <span class="  text-warning">مشتری درخواست تایید 50 درصد و پرداخت نصف هزینه را داده است</span>
                                <?php
                                if ($userid == $developeruid) {
                                    ?>
                                    <form action="" id="Confirm" name="Confirm" method="post">
                                        <button type="submit" name="close_half_btn" value="1"
                                                class="btn btn-info col-3">تایید 50 درصد
                                        </button>
                                        <button type="submit" name="arbitration_btn" value="1"
                                                class="btn btn-danger col-3">عدم تایید 50 درصد
                                        </button>
                                        <div class=" row mb-3">
                                            <label for="prdifficulties" class="form-label">در صورتی که تایید نمی کنید
                                                پاسخ نارضایتی کارفرما را ذکر کنید :</label>
                                            <label class="form-label text-danger"><?php echo $difficulte_user ?></label>
                                            <textarea class="form-control" name="prdifficulties_dev" id="prdifficulties"
                                                      rows="3"></textarea>
                                        </div>
                                    </form>
                                    <?php
                                }

                            } else if ($PrStatus == "close_half") {
                                ?>
                                <span class=" text-danger">این پروژه با تایید 50% بسته شده است</span>
                                <?php
                            } else if ($PrStatus == "close_complete") {
                                ?>
                                <span class=" text-success">این پروژه با رضایت کامل بسسته شده است</span>
                                <?php
                            } else if ($PrStatus == "waiting_user") {
                                ?>
                                <span class=" text-primary">در انتظار تایید کارفرما</span>
                                <?php
                            } else if ($PrStatus == "open") {
                                ?>
                                <span class=" text-primary">در حال تولید پروژه توسط توسعه دهنده</span>
                                <?php
                            } else if ($PrStatus == "pending") {
                                ?>
                                <span class=" text-primary">در حال انتظار برای تایید توسعه دهنده</span>
                                <?php
                            } else if ($PrStatus == "arbitration") {
                                ?>
                                <span class=" text-danger">این پروژه در وضعیت شکایت قرار دارد</span>
                                <?php
                            }
                            ?>
                                    </div>
                                </div>

                                <div class="R_Req">
                                    <div>
                                        <button class="ButtonOfReq OrangeRed"  data-toggle="modal" data-target="#exampleModal">شکایت</button>
                                    </div>
                                    <div>
                                        <button class="ButtonOfReq Confirm100"  type="submit">تایید 100%</button>
                                    </div>
                                    <div>
                                        <button class="ButtonOfReq BtnNewVer"  type="submit">درخواست ورژن جدید</button>
                                    </div>
                                </div>


                             

                            <!-- Modal -->
                            <div class="modal fade NotShow" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content Modal_Projects">
                                
                                <div class="modal-body">
                                    <div>
                                        <label for="prdifficulties" class="Narezayati">در صورت نارضایتی دلایل خود را
                                            بیان کنید
                                            :</label>
                                        <textarea class="form-control" name="prdifficulties_user" id="prdifficulties"
                                                  rows="3"></textarea>
                                    </div>
                                    <div>
                                        <button class="BtnsOfReq Req_Pay">درخواست پرداخت</button>
                                        <button class="BtnsOfReq Req_Cancel">درخواست لغو پروژه</button>
                                    </div>
                                </div>
                                
                                </div>
                            </div>
                            </div>

                                
                               
                            </div>
                            <!-- <div class="row">
                                <div class="col-6 mt-4">
                                    <div class="row">
                                        <button type="submit" name="close_half_pending_btn" value="1"
                                                class="btn btn-warning col m-2">درخواست پرداخت 50%
                                        </button>
                                        <button type="submit" name="close_cancel_pending_btn" value="1"
                                                class="btn btn-danger col m-2"> درخواست لغو پروژه
                                        </button>
                                    </div>
                                    <div class="row">
                                        <button type="submit" name="close_complete_btn" value="1"
                                                class="btn btn-success col m-2">تایید 100%
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class=" row mb-3">
                                        <label for="prdifficulties" class="form-label">در صورت نارضایتی دلایل خود را
                                            بیان کنید
                                            :</label>
                                        <textarea class="form-control" name="prdifficulties_user" id="prdifficulties"
                                                  rows="3"></textarea>
                                    </div>
                                </div>
                            </div> -->
                        <!-- </form> -->

                
            </div>
            <!-- End Left -->


        </div>
            
        </section>
        <!-- /.content -->
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>

    function Next_Step_Project() {
        document.getElementById("NextStepPr").style.display = "block";
        document.getElementById("PreviousStepPr").style.display = "none";
        document.getElementById("deleteProject").style.display = "none";
    }

    function Previous_Step_Project() {
        document.getElementById("PreviousStepPr").style.display = "block";
        document.getElementById("NextStepPr").style.display = "none";
        document.getElementById("deleteProject").style.display = "none";
    }

    function delete_Project() {
        document.getElementById("deleteProject").style.display = "block";
        document.getElementById("PreviousStepPr").style.display = "none";
        document.getElementById("NextStepPr").style.display = "none";
    }

    function closeForm(v) {
        document.getElementById(v).style.display = "none";
    }

    function ChatBox() {
        document.getElementById("ChatBox").style.display = "block";
        document.getElementById("HistoryBox").style.display = "none";

        document.getElementById("firsttitle").classList.add("ButtonSInProfie_Active");
        document.getElementById("secondtitle").classList.remove("ButtonSInProfie_Active");
    }

    function HistoryBox() {
        document.getElementById("ChatBox").style.display = "none";
        document.getElementById("HistoryBox").style.display = "block";

        document.getElementById("secondtitle").classList.add("ButtonSInProfie_Active");
        document.getElementById("firsttitle").classList.remove("ButtonSInProfie_Active");
    }

    function sendMess() {
        message_text = document.getElementById('message_text').value;
        var data = "request=sendMess&message=" + message_text + "&projectid=<?php echo $Projectid ?>&sender=<?php echo $userid ?>";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // alert(this.responseText);
                document.getElementById('message_text').value = "";
                getMess();
            }
        };

        xmlhttp.open("GET", "../ajaxcenter.php?" + data, true);
        xmlhttp.send();

    }


    sql_dev_info_name = "<?php echo $sql_dev_info[0]['firstname'] ?>";
    sql_dev_info_last = "<?php echo $sql_dev_info[0]['lastname'] ?>";
    sql_dev_info_img = "<?php echo $sql_dev_info[0]['imgurl'] ?>";

    sql_user_info_name = "<?php echo $sql_user_info[0]['firstname'] ?>";
    sql_user_info_last = "<?php echo $sql_user_info[0]['lastname'] ?>";
    sql_user_info_img = "<?php echo $sql_user_info[0]['imgurl'] ?>";
    sql_user_info_id = "<?php echo $cid; ?>";


    function getMess() {
        var data = "request=getMess&projectid=<?php echo $Projectid ?>";
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                messages = JSON.parse(this.responseText);
                messages_body = "";
                for (const message of messages) {


                    if (message['sender'] === sql_user_info_id) {

                        messages_body += `<div  class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name float-right">` + sql_user_info_name + ` ` + sql_user_info_last + `</span>
                                            <span class="direct-chat-timestamp float-left">` + message['reg_date'] + `</span>
                                        </div>
                                        <img class="direct-chat-img" src="` + sql_user_info_img + `" alt="message user image">
                                        <div class="direct-chat-text">
                                            ` + message['message'] + `
                                        </div>
                                        </div>`;
                    } else {
                        messages_body += `<div  class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name float-left">` + sql_dev_info_name + ` ` + sql_dev_info_last + `</span>
                                            <span class="direct-chat-timestamp float-right">` + message['reg_date'] + `</span>
                                        </div>
                                        <img class="direct-chat-img" src="` + sql_dev_info_img + `" alt="message user image">
                                        <div class="direct-chat-text">
                                            ` + message['message'] + `
                                        </div>
                                        </div>`;
                    }

                }
                document.getElementById('messages_body').innerHTML = messages_body;
                document.getElementById('ChatBox').scrollIntoView(false);

            }
        };
        try {
            xmlhttp.open("GET", "../ajaxcenter.php?" + data, true);
            xmlhttp.send();
        } catch (e) {

        }
        setTimeout(getMess, 10000);
    }

    getMess();
</script>

<?php defualtScriptProfile(); ?>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

</body>
</html>