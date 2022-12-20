<?php
require("backend_header.php");


$inuser = $_POST['inuser'];

// request change access page user or agent ...
if (key_exists('inuser2', $_POST)) {
    $inuser2 = $_POST['inuser2'];

    // delete all access page user
    deleteQuery("tc_page_access", " userid='$inuser2' ");
    // ./delete all access page user

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'pages_') !== false) {
            $inpageName = str_replace('pages_', '', $key);

            // add access for user
            $tableName = 'tc_page_access';
            $input = 'pagename, userid';
            $insert = "'$inpageName', '$inuser2'";
            insertQuery($tableName, $input, $insert);
            // ./add access for user

        }
    }
}
// ./request change access page user or agent ...


// request change role user or agent ...
if (key_exists('accessRadio', $_POST)) {
    $inuser4 = $_POST['inuser4'];
    $inrole = $_POST['accessRadio'];

    // update role
    $tableName = 'tc_clients';
    $sets = "role='$inrole', rolerequest='0'";
    $where = "id='$inuser4'";
    if (updateQuery($tableName, $sets, $where)) {

        // refresh page
        openLink('https://www.tradicoders.ir/profile/musers.php');
        // ./refresh page

    }
    // ./update role

}
// ./request change role user or agent ...


$pageName = 'مدیریت کاربران';
$pageAddress = 'musers';

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
                                    <li class="breadcrumb-item "><a href="../index.php" class="LinksPages">خانه</a></li>
                                    <li class="breadcrumb-item active "><a
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
                                    <tr>
                                        <th scope="col">ایدی کاربر</th>
                                        <th scope="col">نام و نام خانوادگی</th>
                                        <th scope="col">سطح دسترسی</th>
                                        <th scope="col">توضیحات</th>
                                        <th scope="col">تغییر دسترسی صفحات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    // get queries all users
                                    $sql2 = selectQuery("tc_clients ORDER BY role,rolerequest DESC");
                                    foreach ($sql2 as $row2) {
                                        $nameuser = $row2['firstname'] . ' ' . $row2['lastname'];
                                        $iduser = $row2['id'];
                                        $introduction = $row2['introduction'];
                                        $newchecked = $row2['rolerequest'];
                                        $roleuser = $row2['role'];
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $iduser ?></th>
                                            <td><?php echo $nameuser ?></td>
                                            <td><?php echo $roleuser ?>
                                                <!-- Button trigger modal -->
                                                <form action="" method="post">
                                                    <input type="hidden" name="inuser3"
                                                           value="<?php echo $iduser ?>">
                                                    <input type="hidden" name="inaccess"
                                                           value="<?php echo $roleuser ?>">
                                                    <button type="submit" class="btn <?php if ($newchecked == '1') {
                                                        echo 'btn-success';
                                                    } else {
                                                        echo 'btn-warning';
                                                    } ?>">
                                                        تغییر سطح دسترسی
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <?php if ($newchecked == "1") {
                                                    echo '(این کاربر درخواست ارتقا به توسعه دهنده را دارد)' . '<br>' . $introduction;
                                                } else {
                                                    echo $introduction;
                                                } ?>
                                            </td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <form action="" method="post">
                                                    <input type="hidden" name="inuser"
                                                           value="<?php echo $iduser ?>">
                                                    <button type="submit" class="btn btn-primary MainBgColor">
                                                        تغییر صفحات مجاز
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    // ./get queries all users
                                    ?>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>


            <?php
            // show modal change access page
            if (key_exists('inuser', $_POST)) {
                ?>

                <!-- modal -->
                <button type="button" id="modal_id" style="display: none" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                    on
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="inuser2" value="<?php echo $inuser ?>">
                                <div class="modal-body">


                                    <?php
                                    // get all page with type base
                                    $sql2 = selectQuery_tc_all_page("type='base'");
                                    foreach ($sql2 as $row2) {
                                        $basename = $row2['basename'];
                                        $namepage = $row2['namepage'];
                                        $addresspage = $row2['addresspage'];
                                        ?>

                                        <h4><?php echo $namepage ?></h4>

                                        <?php
                                        // get all page with type subset
                                        $sql = selectQuery_tc_all_page(" type='subset' and basename='$basename'");
                                        foreach ($sql as $row) {
                                            $namepage = $row['namepage'];
                                            $addresspage = $row['addresspage'];

                                            ?>

                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       name="pages_<?php echo $addresspage ?>" type="checkbox"
                                                       value=""
                                                       id="flexCheckChecked" <?php if (permissionPageInside($addresspage, $inuser)) {
                                                    echo 'checked';
                                                } ?>>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    <?php echo $namepage ?>
                                                </label>
                                            </div>

                                            <?php

                                        }
                                        // ./get all page with type subset
                                    }
                                    // ./get all page with type base
                                    ?>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن
                                    </button>
                                    <button type="submit" class="btn btn-primary MainBgColor">ذخیره تغییرات</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal -->

                <script>
                    document.getElementById('modal_id').click();
                </script>
            <?php }
            // ./show modal change access page
            ?>




            <?php
            // show modal change role
            if (key_exists('inuser3', $_POST)) {
                $inaccess = $_POST['inaccess'];
                $inuser3 = $_POST['inuser3'];
                ?>

                <!-- modal -->
                <button type="button" id="modal_id2" style="display: none" class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal2">
                    on
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form action="" method="post">
                                <input type="hidden" name="inuser4" value="<?php echo $inuser3 ?>">
                                <div class="modal-body">


                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accessRadio"
                                               id="exampleRadios1" value="user" <?php if ($inaccess == "user") {
                                            echo 'checked';
                                        } ?> >
                                        <label class="form-check-label" for="exampleRadios1">
                                            کارفرما
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accessRadio"
                                               id="exampleRadios2"
                                               value="developer" <?php if ($inaccess == "developer") {
                                            echo 'checked';
                                        } ?> >
                                        <label class="form-check-label" for="exampleRadios2">
                                            توسعه دهنده
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="accessRadio"
                                               id="exampleRadios2" value="agent" <?php if ($inaccess == "agent") {
                                            echo 'checked';
                                        } ?> >
                                        <label class="form-check-label" for="exampleRadios2">
                                            مدیر
                                        </label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن
                                    </button>
                                    <button type="submit" class="btn btn-primary MainBgColor">ذخیره تغییرات</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal -->

                <script>
                    document.getElementById('modal_id2').click();
                </script>
            <?php }
            // ./show modal change role?>


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