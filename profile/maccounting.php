<?php
require("backend_header.php");




$pageName = 'مدیریت مالی';
$pageAddress = 'maccounting';

// request change status payment
if (key_exists('statusRadio', $_POST)) {
    $trid2 = $_POST['trid2'];
    $instatus = $_POST['statusRadio'];

    // get queries payment
    $sql = selectQuery_tc_payment("id='$trid2' and trstatus='pending'");
    foreach ($sql as $row) {

        $trdescription = 'تایید شده توسط کاربر شماره ' . $userid;

        // update status payment

        $tableName = 'tc_payment';
        $sets = "trstatus='$instatus', trdescription='$trdescription'";
        $where = "id='$trid2'";
        if (updateQuery($tableName, $sets, $where)) {
            // if request for deposit
            if ($row['trdirection'] == 'deposit' && $instatus == 'paid') {
                $tramount = (int)$row['tramount'];
                $inuserid = $row['userid'];


                // get value balance

                $sql3 = "SELECT balance FROM tc_clients  WHERE id='$inuserid' ";
                $result3 = $conn->query($sql3);
                if ($result3->num_rows > 0) {
                    while ($row3 = $result3->fetch_assoc()) {
                        $inbalance = $row3['balance'];
                    }
                }

                // ./get value balance

                // update balance user

                $newbalance = $inbalance + $tramount;
                $tableName = 'tc_clients';
                $sets = "balance='$newbalance'";
                $where = "id='$inuserid'";
                if (updateQuery($tableName, $sets, $where)) {
                    // refresh page
                    openLink('https://www.tradicoders.ir/profile/maccounting.php');
                    // ./refresh page
                }

                // ./update balance user

            }
            // ./if request for deposit

        }
        // ./update status payment

    }
    // ./get queries payment

}
// ./request change status payment


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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
                crossorigin="anonymous"></script>
    </head>

    <body class="hold-transition sidebar-mini" style="overflow:hidden;">

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
                                    <tr>
                                        <th scope="col">ردیف</th>
                                        <th scope="col">نام کاربر</th>
                                        <th scope="col">زمان درخواست</th>
                                        <th scope="col">کد تراکنش</th>
                                        <th scope="col">شماره حساب / پیگیری</th>
                                        <th scope="col">مبلغ تراکنش</th>
                                        <th scope="col">نوع تراکنش</th>
                                        <th scope="col">وضعیت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // get queries payment
                                    $sql = selectQuery("tc_payment  ORDER BY id DESC");
                                    foreach ($sql as $row) {
                                        $inid = $row['userid'];
                                        $trid = $row['id'];

                                        // get name applicant
                                        $sql3 = selectQuery_tc_clients("id='$inid'", "firstname, lastname");
                                        foreach ($sql3 as $row3) {
                                            $nameuser = $row3['firstname'] . ' ' . $row3['lastname'];
                                        }
                                        // ./get name applicant

                                        ?>
                                        <tr style="text-align: center">
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo $nameuser; ?></td>
                                            <td><?php echo date('Y/m/d H:i:s', $row['trtime']); ?></td>
                                            <td><?php echo $row['trid']; ?></td>
                                            <td><?php echo $row['uaccount']; ?></td>
                                            <td><?php echo $row['tramount']; ?></td>
                                            <td>
                                                <?php
                                                if ($row["trdirection"] == "deposit") {
                                                    echo "<span class='badge badge-info MainBgColor'>واریز</span>";
                                                }
                                                if ($row["trdirection"] == "withdraw") {
                                                    echo "<span class='badge badge-info MainBgColor'>برداشت</span>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row["trstatus"] == "pending") {
                                                    echo "<form action='' method='post'>
                                                        <input type='hidden' name='trid'
                                                               value='$trid'>
                                                        <button type='submit' class='btn btn-warning'>
                                                            تغییر وضعیت
                                                        </button>
                                                    </form>";
                                                }
                                                if ($row["trstatus"] == "paid") {
                                                    echo "<span class='badge badge-success'>انجام شده</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    // ./get queries payment
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
                // show modal change status payment
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
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="" method="post">
                                    <input type="hidden" name="trid2" value="<?php echo $trid ?>">
                                    <div class="modal-body">


                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="statusRadio"
                                                   id="exampleRadios1" value="false">
                                            <label class="form-check-label" for="exampleRadios1">
                                                درخواست صحیح نمی باشد
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="statusRadio"
                                                   id="exampleRadios2" value="paid">
                                            <label class="form-check-label" for="exampleRadios2">
                                                درخواست انجام شده
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
                // ./show modal change status payment
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