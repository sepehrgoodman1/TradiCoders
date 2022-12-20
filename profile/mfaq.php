<?php
require("backend_header.php");

$pageName = 'مدیریت سوالات متداول';
$pageAddress = 'mfaq';

if(isset($_POST["addfaq"])){
$sql = "INSERT INTO tc_faq ()
VALUES ()";
	if ($conn->query($sql) === TRUE) {
	  echo "Record added successfully";
	  $_POST["addfaq"] = "";
	} else {
	  echo "Error adding record: " . $conn->error;
	}
}

if(isset($_POST["savefaq"])){
    $question = $_POST["question"];
    $answer = $_POST["answer"];
    $faqusage = $_POST["faqusage"];
    $qid = $_POST["qid"];
    // update balance developer
    $tableName = 'tc_faq';
    $sets = "question='$question' , answer='$answer' , faqusage='$faqusage'";
    $where = "id='$qid'";
    updateQuery($tableName, $sets, $where);
    // ./update balance developer
}

if (permissionPageInside($pageAddress) || $role == 'admin') {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    // insert all css file and meta file and set meta tag

    $title = 'پروفایل | مدیریت | مدیریت سوالات متداول';
    $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
    $description = 'شما می توانید از این بخش منابع مالی و خروجی و ورودی های خود را بررسی کنید و درخواست های مالی خود را ثبت کنید';
    $icon = '../tradi-coders-logo-final.gif';
    defualtMetaAndStyleProfile($title, $keywords, $description, $icon);
    // ./insert all css file and meta file and set meta tag
    ?>

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/bootstrap.min.css" rel="stylesheet">
  <link href="assets/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/boxicons.min.css" rel="stylesheet">
  <link href="assets/quill.snow.css" rel="stylesheet">
  <link href="assets/quill.bubble.css" rel="stylesheet">
  <link href="assets/remixicon.css" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">



  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="hold-transition sidebar-mini" style="overflow:hidden;">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<div class="wrapper">

    <!-- Navbar -->
    <?php require_once("navbar.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <!-- Sidebar -->
    <?php require_once("sidebar.php"); ?>
    <!-- /.sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper SpaceContent">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <div class="">
                            <ol class="breadcrumb float-sm-left">
                                <li class="breadcrumb-item"><a href="../index.php" class="LinksPages">خانه</a></li>
                                <li class="breadcrumb-item active"><a href="<?php echo $pageAddress ?>.php" class="LinksPages"><?php echo $pageName ?></a>
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary">
                        <div class="card-header MainBgColor">
                            <h3 class="card-title"><?php echo $pageName ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body row">
                            <!-- here main -->

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">My Orders</h5>
                                    <form class="" id="addform" action="" method="post" style="text-align:right;">
                                        <button type="submit" name="addfaq" style="background: white;width: 100px;border-radius: 5px;color: #000;border: 1px solid;box-shadow: 0 0 3px 3px #dadada;margin: 0 10px;">ADD</button>
                                    </form>
                                    <!-- Table with stripped rows -->
                                    <table class="table datatable">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>QUESTION</th>
                                            <th>ANSWER</th>
                                            <th>USAGE</th>
                                            <th>active</th>
                                        </tr>
                                        </thead>
                                        <tbody>



                                        <?php
                                        $sql = "SELECT * FROM tc_faq";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            // output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                ?>
                                        <form action="" method="post">
                                                <input type="hidden" name="qid" value="<?php echo $row['id'];?>" >
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <textarea class="form-control" placeholder="Question" name="question" style="height: 40px;"><?php echo $row['question'];?></textarea>
                                                    </td>
                                                    <td>
                                                        <textarea class="form-control" placeholder="Answer" name="answer"  style="height: 40px;"><?php echo $row['answer'];?></textarea>
                                                    </td>
                                                    <td>
                                                        <select id="u_<?php echo $row['id'];?>" name="faqusage" class="form-select">

                                                            <option value='public' <?php if($row["faqusage"]=="public"){echo "selected";} ?> >عمومی</option>
                                                            <option value='user' <?php if($row["faqusage"]=="user"){echo "selected";} ?> >کارفرما</option>
                                                            <option value='developer' <?php if($row["faqusage"]=="developer"){echo "selected";} ?> >توسعه دهنده</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="submit" style="padding: 5px;border-radius: 5px;border: 2px solid #0c1987;background: #4254f1;color: #fff;" name="savefaq" >SAVE CHANGE<i class="fa fa-edit"></i></button>
                                                    </td>
                                                </tr>
                                        </form>
                                                <?php
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <!-- End Table with stripped rows -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
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

    <?php
    // insert script file
    defualtScriptProfile();
    // ./insert script file
    ?>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>





  <!-- ======= Footer ======= -->
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/apexcharts.min.js"></script>
  <script src="assets/bootstrap.bundle.min.js"></script>
  <script src="assets/chart.min.js"></script>
  <script src="assets/echarts.min.js"></script>
  <script src="assets/quill.min.js"></script>
  <script src="assets/simple-datatables.js"></script>
  <script src="assets/tinymce.min.js"></script>
  <script src="assets/validate.js"></script>



</body>

</html>
    <?php
} else {
    openLink('https://www.tradicoders.ir/profile/index.php');
}
?>