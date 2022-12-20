<?php
require("backend_header.php");


$pageName = 'مدیریت پروژه ها';
$pageAddress = 'mproject';

// set status project
if (key_exists('trid2', $_POST)) {
    $Projectid = $_POST['trid2'];
    $status = $_POST['status'];
    $difficulties = $_POST['difficulties'];

    // get data project
    $sql = selectQuery_tc_project("id='$Projectid'");
    foreach ($sql as $row) {
        $PrStatus = $row['prstatus'];
        $cid = $row['creatoruid'];
        $pprice = $row['price'];
        $devid = $row["developeruid"];
        $nameproject = $row["subject"];
        $description = $row["description"];
    }
    // ./get data project


    $not_parameters = array();
    if ($status == "approve") {
        $not_parameters['nameproject'] = $nameproject;
        $not_parameters['priceproject'] = $pprice;
        $not_parameters['projectid'] = $Projectid;
        $not_parameters['description'] = $description;

        setNotifPer("developer_project", $not_parameters, "developer");
    }
//    else if ($status == "close_problem") {
//        $not_parameters['main'] = 'پروژه شما به دلایل زیر تایید نشد و مبلغ کسر شده به حساب شما بازگشت.';
//    }

    $temp_sms_main = selectQuery_temp_sms_main("name='result_status_project'");
    $not_parameters['main'] = $temp_sms_main[$status];
    $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);

    $not_parameters['nameproject'] = $nameproject;
    $not_parameters['priceproject'] = $pprice;
    $not_parameters['projectid'] = $Projectid;
    $not_parameters['difficulties'] = $difficulties;

    setNotifPer("result_status_project", $not_parameters, $cid);


    // update status project
    $tableName = 'tc_project';
    if ($status == "close_problem") {
        $sets = "prstatus='$status', difficulties='$difficulties'";
    } else {
        $sets = "prstatus='$status'";
    }
    $where = "id='$Projectid'";
    updateQuery($tableName, $sets, $where);
    // ./update status project


    // request close problem
    if ($status == "close_problem") {


        // get balance and hold user
        $sql = selectQuery_tc_clients("id='$cid'", "balance , hold");
        foreach ($sql as $row) {
            $balance = $row["balance"];
            $hold = $row["hold"];
        }
        // ./get balance and hold user
        $newhold = $hold - $pprice;
        $newbalance = $balance + $pprice;

        // update balance user
        $tableName = 'tc_clients';
        $sets = "balance='$newbalance', hold='$newhold' ";
        $where = "id='$cid'";
        updateQuery($tableName, $sets, $where);
        // ./update balance user


    }
    // ./request close problem


}
// ./set status project
// ./set status project

if (permissionPageInside($pageAddress) || $role == 'admin') {

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <?php
        // insert all css file and meta file and set meta tag

        $title = 'پروفایل | مدیریت | مدیریت مالی';
        $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
        $description = 'شما می توانید از این بخش منابع مالی و خروجی و ورودی های خود را بررسی کنید و درخواست های مالی خود را ثبت کنید';
        $icon = '../tradi-coders-logo-final.gif';
        defualtMetaAndStyleProfile($title, $keywords, $description, $icon);

        // ./insert all css file and meta file and set meta tag
        ?>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
              crossorigin="anonymous">

    </head>

    <body class="hold-transition sidebar-mini" style="overflow:hidden;">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
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
                                    <li class="breadcrumb-item active"><a
                                                href="<?php echo $pageAddress ?>.php" class="LinksPages"><?php echo $pageName ?></a>
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


                                <table class="table table-striped">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th scope="col">شماره پروژه</th>
                                        <th scope="col">نام کارفرما</th>
                                        <th scope="col">نام پروژه</th>
                                        <th scope="col">مبلغ پروژه</th>
                                        <th scope="col">توضحات بیشتر</th>
                                    </tr>
                                    <!--                                    <tr style="text-align: center">-->
                                    <!--                                        <th scope="col">نوع درخواست</th>-->
                                    <!--                                        <th scope="col">نام توسعه دهنده</th>-->
                                    <!--                                        <th scope="col">دلیل کارفرما</th>-->
                                    <!--                                        <th scope="col">دلیل توسعه دهنده</th>-->
                                    <!--                                    </tr>-->
                                    </thead>
                                    <tbody>
                                    <?php
                                    // get pending project
                                    $sql = selectQuery_tc_project("prstatus='pending' or difficulties!='' ORDER BY id DESC");
                                    foreach ($sql as $row) {
                                        $inuid = $row['creatoruid'];
                                        $trid = $row['id'];
                                        $difficulties = $row['difficulties'];
                                        // get name user
                                        $sql3 = selectQuery_tc_clients("id='$inuid'", "firstname, lastname");
                                        foreach ($sql3 as $row3) {
                                            $nameuser = $row3['firstname'] . ' ' . $row3['lastname'];
                                        }
                                        // ./get name user

                                        if ($difficulties == "") {
                                            ?>
                                            <tr style="text-align: center">
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $nameuser; ?></td>
                                                <td><?php echo $row['subject']; ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="trid"
                                                               value="<?php echo $trid ?>">
                                                            <button type="submit" class="btn btn-primary MainBgColor">
                                                                اطلاعات بیشتر و تغییرات
                                                            </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }else{
                                            $difficulties = json_decode($row['difficulties'], true);
                                        if (!isset($difficulties[0])) {
                                            ?>
                                            <tr style="text-align: center">
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $nameuser; ?></td>
                                                <td><?php echo $row['subject']; ?></td>
                                                <td><?php echo $row['price']; ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="trid"
                                                               value="<?php echo $trid ?>">
                                                        <button type="submit" class="btn btn-danger">
                                                            اطلاعات پروژه رد شده
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        }
                                    }
                                    // ./get pending project
                                    ?>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->


                <?php
                // show modal for answer status project
                if (key_exists('trid', $_POST)) {
                    $trid = $_POST['trid'];
                    ?>

                    <!-- modal -->
                    <button type="button" id="modal_id2" style="display: none" class="btn btn-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal2">
                        on
                    </button>


                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                         aria-hidden="true" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <form action="" method="post">
                                        <input type="hidden" name="trid2" value="<?php echo $trid ?>">
                                        <input type="hidden" name="status" id="status_id">

                                        <?php
                                        // get difficulties arbitration
                                        $sql = selectQuery_tc_project(" id='$trid' ");
                                        foreach ($sql as $row) {
                                            ?>

                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">عنوان
                                                    پروژه</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                          rows="1"><?php echo $row['subject']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">شرح
                                                    پروژه</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                          rows="4"><?php echo $row['description']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">دلیل رد
                                                    پروژه</label>
                                                <textarea class="form-control" name="difficulties"
                                                          id="exampleFormControlTextarea1"
                                                          rows="1"><?php echo $row['difficulties']; ?></textarea>
                                            </div>

                                            <?php
                                        }
                                        // ./get difficulties arbitration
                                        ?>
                                        <button id="submit_btn" style="display: none;" type="submit"
                                                class="btn btn-primary">ذخیره تغییرات
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن
                                    </button>
                                    <?php if ($row['difficulties'] == ""){ ?>
                                    <button type="submit" onclick="clickForm('approve')" class="btn btn-success">
                                        تایید پروژه
                                    </button>
                                    <button type="submit" onclick="clickForm('close_problem')" class="btn btn-danger">
                                        لغو
                                        پروژه پروژه
                                    </button>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->

                    <script>
                        function clickForm(status) {
                            document.getElementById('status_id').value = status;
                            document.getElementById('submit_btn').click();
                        }

                        document.getElementById('modal_id2').click();
                    </script>
                <?php }
                // ./show modal for answer status project
                ?>

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
    </body>
    </html>
    <?php
} else {
    openLink('https://www.tradicoders.ir/profile/index.php');
}
?>