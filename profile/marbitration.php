<?php
require("backend_header.php");


$pageName = 'مدیریت شکایات';
$pageAddress = 'marbitration';

// set answer arbitration
if (key_exists('trid2', $_POST)) {
    $Projectid = $_POST['trid2'];
    $status = $_POST['status'];

    // get data project
    $sql = selectQuery_tc_project("id='$Projectid'");
    foreach ($sql as $row) {
        $PrStatus = $row['prstatus'];
        $cid = $row['creatoruid'];
        $pprice = $row['price'];
        $devid = $row["developeruid"];
        $nameproject = $row["subject"];
    }
    // ./get data project

    // set notification
    $temp_sms_main = selectQuery_temp_sms_main("name='result_arbitration'");

    $not_parameters = array();
    if ($status == "close_complete") {
        $not_parameters['main'] = $temp_sms_main['close_complete'];
    } else if ($status == "close_half") {
        $not_parameters['main'] = $temp_sms_main['close_half'];
    } else if ($status == "close_cancel") {
        $not_parameters['main'] = $temp_sms_main['close_cancel'];
    }

    $not_parameters['nameproject'] = $nameproject;
    $not_parameters['priceproject'] = $pprice;
    $not_parameters['projectid'] = $Projectid;

    $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);

    setNotifPer("result_arbitration", $not_parameters, $cid);
    setNotifPer("result_arbitration", $not_parameters, $devid);
    // ./set notification

    // update status project
    $date = date('Y-m-d h:i:s');
    $tableName = 'tc_project';
    $sets = "prstatus='$status', prdonetime='$date'";
    $where = "id='$Projectid'";
    updateQuery($tableName, $sets, $where);
    // ./update status project

    // request close half
    if ($status == "close_half") {
        $pprice = $pprice / 2;

        // get balance developer
        $sql = selectQuery_tc_clients("id='$devid'", "balance");
        foreach ($sql as $row) {
            $balance = $row["balance"];
        }
        // ./get balance developer

        $newbalance = $balance + $pprice;
        // update balance developer
        $tableName = 'tc_clients';
        $sets = "balance='$newbalance'";
        $where = "id='$devid'";
        updateQuery($tableName, $sets, $where);
        // ./update balance developer

        // get balance and hold user
        $sql = selectQuery_tc_clients("id='$cid'", "balance , hold");
        foreach ($sql as $row) {
            $balance = $row["balance"];
            $hold = $row["hold"];
        }
        // ./get balance and hold user

        $newhold = $hold - ($pprice * 2);
        $newbalance = $balance + $pprice;
        // update balance user
        $tableName = 'tc_clients';
        $sets = "balance='$newbalance', hold='$newhold'";
        $where = "id='$cid'";
        updateQuery($tableName, $sets, $where);
        // ./update balance user


    }
    // ./request close half
    // request close cancel
    else if ($status == "close_cancel") {


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
        $sets = "balance='$newbalance', hold='$newhold'";
        $where = "id='$cid'";
        updateQuery($tableName, $sets, $where);
        // ./update balance user


    }
    // ./request close cancel
    // request close complete
    else {


        // get balance developer
        $sql = selectQuery_tc_clients("id='$devid'", "balance");
        foreach ($sql as $row) {
            $balance = $row["balance"];
        }
        // ./get balance developer

        $newbalance = $balance + $pprice;
        // update balance developer
        $tableName = 'tc_clients';
        $sets = "balance='$newbalance'";
        $where = "id='$devid'";
        updateQuery($tableName, $sets, $where);
        // ./update balance developer
        // get balance and hold user
        $sql = selectQuery_tc_clients("id='$cid'", "balance , hold");
        foreach ($sql as $row) {
            $balance = $row["balance"];
            $hold = $row["hold"];
        }
        // ./get balance and hold user
        $newhold = $hold - $pprice;
        // update balance user
        $tableName = 'tc_clients';
        $sets = "hold='$newhold'";
        $where = "id='$cid'";
        updateQuery($tableName, $sets, $where);
        // ./update balance user


    }
    // ./request close complete


}
// ./set answer arbitration

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
            <div class="content-header ">
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
                                        <th scope="col">زمان شروع پروژه</th>
                                        <th scope="col">نام توسعه دهنده</th>
                                        <th scope="col">اطلاعات بیشتر</th>
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
                                    // get arbitration
                                    $sql = selectQuery_tc_project("prstatus='arbitration' or difficulties!='' ");
                                    foreach ($sql as $row) {
                                        $inuid = $row['creatoruid'];
                                        $indevid = $row['developeruid'];
                                        $trid = $row['id'];

                                        // get name user
                                        $sql3 = selectQuery_tc_clients("id='$inuid'", "firstname, lastname");
                                        foreach ($sql3 as $row3) {
                                            $nameuser = $row3['firstname'] . ' ' . $row3['lastname'];
                                        }
                                        // ./get name user

                                        // get name developer
                                        $sql3 = selectQuery_tc_clients("id='$indevid'", "firstname, lastname");
                                        foreach ($sql3 as $row3) {
                                            $namedev = $row3['firstname'] . ' ' . $row3['lastname'];
                                        }
                                        // ./get name developer
                                        $difficulties = json_decode($row['difficulties'], true);
                                        if (isset($difficulties[1])) {
                                            ?>
                                            <tr style="text-align: center">
                                                <td><?php echo $row['id']; ?></td>
                                                <td><?php echo $nameuser; ?></td>
                                                <td><?php echo $row['prstarttime']; ?></td>
                                                <td><?php echo $namedev; ?></td>
                                                <?php if ($prstatus == "arbitration") { ?>
                                                    <td>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="trid"
                                                                   value="<?php echo $trid ?>">
                                                            <button type="submit" class="btn btn-primary">
                                                                اطلاعات بیشتر و تغییرات
                                                            </button>
                                                        </form>
                                                    </td>
                                                <?php } else { ?>
                                                    <td>
                                                        <form action="" method="post">
                                                            <input type="hidden" name="trid"
                                                                   value="<?php echo $trid ?>">
                                                            <button type="submit" class="btn btn-danger">
                                                                نتیجه شکایت
                                                            </button>
                                                        </form>
                                                    </td>
                                                    <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    // ./get arbitration
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
                // show modal for answer arbitration
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
                                        $prstatus = '';
                                        foreach ($sql as $row) {
                                            $difficulties = json_decode($row['difficulties'], true);
                                            $prstatus = $row['prstatus'];

                                            ?>
                                            <div class="mb-3">
                                                    <span class='badge badge-success'>کارفرما درخواست <?php if ($difficulties[0]['type'] == "close_cancel_pending") {
                                                            echo "لغو پروژه";
                                                        } else {
                                                            echo "پرداخت نیمی از هزینه";
                                                        } ?>را داده است.</span>
                                            </div>
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
                                                <label for="exampleFormControlTextarea1" class="form-label">توضیحات
                                                    کارفرما</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                          rows="4"><?php echo $difficulties[0]['userdifficulties']; ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">توضیحات
                                                    توسعه دهنده</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                          rows="4"><?php echo $difficulties[1]['devdifficulties']; ?></textarea>
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
                                    <?php if ($prstatus == "arbitration") { ?>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن
                                        </button>
                                        <button type="submit" onclick="clickForm('close_complete')"
                                                class="btn btn-success">
                                            پرداخت کل وجه
                                        </button>
                                        <button type="submit" onclick="clickForm('close_half')" class="btn btn-warning">
                                            پرداخت نیمی از وجه
                                        </button>
                                        <button type="submit" onclick="clickForm('close_cancel')"
                                                class="btn btn-danger">لغو
                                            پروژه
                                        </button>
                                    <?php } else if ($prstatus == "close_complete") {
                                        ?>
                                        <button type="submit" class="btn btn-danger">پروژه به نفع توسعه دهنده بسته شد
                                        </button>
                                    <?php } else if ($prstatus == "close_half") {
                                        ?>
                                        <button type="submit" class="btn btn-danger">پروژه به صورت نیم بها بسته شد
                                        </button>
                                    <?php } else if ($prstatus == "close_cancel") {
                                        ?>
                                        <button type="submit" class="btn btn-danger">پروژه به نفع کارفرما بسته شد
                                        </button>
                                        <?php
                                    } ?>
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
                // ./show modal for answer arbitration
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