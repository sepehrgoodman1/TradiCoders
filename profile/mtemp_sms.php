<?php
require("backend_header.php");


$pageName = 'مدیریت متن پیامک ها';
$pageAddress = 'mtemp_sms';

// set new body
if (key_exists('trid2', $_POST)) {
    $temp_id = $_POST['trid2'];
    $body = $_POST['body'];
    $array_main = array();
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'main_') !== false) {
            $keynew = str_replace('main_', '', $key);
            $value = str_replace(array("\n", "\r"), '{enter}', $value);
            $array_main[$keynew] = $value;
        }
    }

    $array_main = json_encode($array_main, JSON_UNESCAPED_UNICODE);


    // update new body and main
    $tableName = 'temp_sms';
    $sets = "body='$body', main='$array_main' ";
    $where = "id='$temp_id'";
    updateQuery($tableName, $sets, $where);
    // ./update new body and main

}
// ./set new body

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
                                        <th scope="col">نام تمپلیت</th>
                                        <th scope="col">شرح تمپلیت</th>
                                        <th scope="col">تغییرات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // get temp sms
                                    $sql = selectQuery_temp_sms();
                                    foreach ($sql as $row) {
                                        $inname = $row['name'];
                                        $trid = $row['id'];

                                        $indescription = '';
                                        if ($row['description'] != '') {
                                            $descriptions_array = json_decode($row['description'], true);
                                            $indescription = $descriptions_array['description'];
                                        }

                                        ?>
                                        <tr style="text-align: center">
                                            <td><?php echo $inname; ?></td>
                                            <td><?php echo $indescription; ?></td>
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
                                    }
                                    // ./get temp sms
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
                // show modal for temp sms
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

                                <div class="modal-body NewModal">
                                    <form action="" method="post">
                                        <input type="hidden" name="trid2" value="<?php echo $trid ?>">
                                        <input type="hidden" name="status" id="status_id">

                                        <?php
                                        // get key parameters and body
                                        $sql = selectQuery_temp_sms(" id='$trid' ");
                                        foreach ($sql as $row) {
                                            ?>

                                            <table class="table table-striped">
                                                <thead>
                                                <tr style="text-align: center">
                                                    <th scope="col">کلید پارامتر</th>
                                                    <th scope="col">شرح پارامتر</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                // get key parameter
                                                $key_parameters = json_decode($row['key_parameters'], true);
                                                foreach ($key_parameters as $key => $val) {
                                                    ?>
                                                    <tr style="text-align: center">
                                                        <td><?php echo $key; ?></td>
                                                        <td><?php echo $val; ?></td>
                                                    </tr>
                                                    <?php

                                                }
                                                // ./get key parameter
                                                ?>

                                                </tbody>
                                            </table>

                                            <?php
                                            // get main
                                            if ($row['main'] != '') {
                                                $mains = json_decode($row['main'], true);
                                                foreach ($mains as $key => $val) {

                                                    $descriptions_array = json_decode($row['description'], true);
                                                    $indescription = $descriptions_array[$key];

                                                    ?>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                               class="form-label"><?php echo $indescription; ?></label>
                                                        <textarea class="form-control" name="main_<?php echo $key ?>"
                                                                  id="exampleFormControlTextarea1"
                                                                  rows="1"><?php echo $val; ?></textarea>
                                                    </div>
                                                    <?php

                                                    // {"close_complete":"","close_half":"","close_cancel":""}

                                                }
                                            }
                                            // ./get main
                                            ?>

                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">متن
                                                    پیامک</label>
                                                <textarea class="form-control" name="body"
                                                          id="exampleFormControlTextarea1"
                                                          rows="5"><?php echo $row['body']; ?></textarea>
                                            </div>

                                            <?php
                                        }
                                        // ./get key parameters and body
                                        ?>
                                        <button id="submit_btn" style="display: none;" type="submit"
                                                class="btn btn-primary">ذخیره تغییرات
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن
                                    </button>
                                    <button type="submit" onclick="clickForm()" class="btn btn-success">
                                        ذخیره تغییرات
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->

                    <script>
                        function clickForm() {
                            document.getElementById('submit_btn').click();
                        }

                        document.getElementById('modal_id2').click();
                    </script>
                <?php }
                // ./show modal for temp sms
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