<?php
require("backend_header.php");

$pageName = 'مدیریت آکادمی';
$pageAddress = 'macademy';

// set new or update functions
if (key_exists('trid2', $_POST)) {
    $id = $_POST['trid2'];
    $trlang = $_POST['trlang2'];
    $name = $_POST['name'];
    $input = $_POST['input'];
    $output = $_POST['output'];
    $description = $_POST['description'];
    $code = $_POST['code'];
    $status = $_POST['status'];

    $exist = sizeof(selectQuery_tc_Academy(" id='$id' and language='$trlang'"));
    $tblname = 'tc_Academy';

    // update function
    if ($exist > 0) {
        if (updateQuery($tblname, "name='$name', input='$input', output='$output', description='$description', code='$code', status='$status'", "id='$id' and language='$trlang'")){
            alert("آپدیت با موفقیت انجام شد");
        }else{
            alert("خطا در اپدیت");
        }
    }
    // ./update function
    // set new function
    else {
        insertQuery($tblname, 'id, name, input, output, description, code, status', "'$id', '$name', '$input', '$output', '$description', '$code', '$status'");
        alert("آکادمی جدید اضافه شد");
    }
    // ./set new function

}
// ./set new or update functions

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
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <div class="">
                                <ol class="breadcrumb float-sm-left">
                                    <li class="breadcrumb-item"><a href="../index.php">خانه</a></li>
                                    <li class="breadcrumb-item active"><a
                                                href="<?php echo $pageAddress ?>.php"><?php echo $pageName ?></a>
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
                            <div class="card-header">
                                <h3 class="card-title"><?php echo $pageName ?></h3>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-4">
                                            <input type="text" class="form-control" name="trid" placeholder="کد آکادمی">
                                        </div>
                                        <div class="col-4">
                                            <select name="trlang" class="form-select FormSelect">
                                                <option value="mql4">mql4</option>
                                                <option value="mql5">mql5</option>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-success">
                                                افزودن آکادمی
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body row">
                                <!-- here main -->


                                <table class="table table-striped">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th scope="col">شماره آکادمی</th>
                                        <th scope="col">نام آکادمی</th>
                                        <th scope="col">زبان آکادمی</th>
                                        <th scope="col">توضیحات و تغییرات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // get functions
                                    $sql = selectQuery_tc_Academy("", "id, name, language");
                                    foreach ($sql as $row) {
                                        $trid = $row['id'];

                                        ?>
                                        <tr style="text-align: center">
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $row['language']; ?></td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="trid"
                                                           value="<?php echo $trid ?>">
                                                    <input type="hidden" name="trlang"
                                                           value="<?php echo $row['language']; ?>">
                                                    <button type="submit" class="btn btn-primary">
                                                        اطلاعات بیشتر و تغییرات
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                        <?php

                                    }
                                    // ./get functions
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
                    $trlang = $_POST['trlang'];
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
                                        <input type="hidden" name="trlang2" value="<?php echo $trlang ?>">
                                        <?php
                                        $sql = selectQuery_tc_Academy(" id='$trid' and language='$trlang'");
                                        $row = $sql[0];
                                        ?>
                                        <div class="mb-3">
                                            <label class="form-label">عنوان
                                                آکادمی</label>
                                            <input class="form-control" name="name"
                                                   value="<?php echo $row['name']; ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ورودی
                                                آکادمی</label>
                                            <textarea class="form-control" name="input"
                                                      rows="4"><?php echo $row['input']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">خروجی
                                                ستینگ</label>
                                            <textarea class="form-control" name="output"
                                                      rows="4"><?php echo $row['output']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">توضیحات
                                                آکادمی</label>
                                            <textarea class="form-control" name="description"
                                                      rows="4"><?php echo $row['description']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">کد
                                                آکادمی</label>
                                            <textarea class="form-control" name="code"
                                                      rows="4"><?php echo $row['code']; ?></textarea>
                                        </div>


                                        <input type="hidden" name="status" id="status">
                                        <button id="submit_btn" style="display: none;" type="submit"
                                                class="btn btn-primary">ذخیره تغییرات
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن
                                    </button>
                                    <button type="submit" onclick="clickForm('pending')"
                                            class="btn btn-warning">
                                        ذخیره تغییرات
                                    </button>

                                    <button type="submit" onclick="clickForm('open')"
                                            class="btn btn-success">
                                        ذخیره و انتشار
                                    </button>

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->

                    <script>
                        function clickForm(status) {
                            document.getElementById('status').value = status;
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