<?php
require("backend_header.php");
require('imageuploader.php');

if (isset($_POST["submit"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $mobile = $_POST["mobilephone"];
    $introduction = $_POST["introduction"];

    $tableName = 'tc_clients';
    if ($pass != '' && isset($_POST["newdev"])) {
        // بروزرسانی اطلاعات همراه با پسورد و درخواست تغییر به توسعه دهنده
        $pass = md5($pass);
        $sets = "email='$email', phonenumber='$mobile',rolerequest='1', pass='$pass', city='$city', country='$country', introduction='$introduction'";
        $where = "id='$userid'";
    } else if ($pass != '') {
        // بروزرسانی اطلاعات همراه با پسورد
        $pass = md5($pass);
        $sets = "email='$email', phonenumber='$mobile', pass='$pass', city='$city', country='$country', introduction='$introduction'";
        $where = "id='$userid'";
    } else if (isset($_POST["newdev"])) {
        // بروزرسانی اطلاعات همراه درخواست تغییر به توسعه دهنده
        $sets = "email='$email', phonenumber='$mobile', city='$city',rolerequest='1', country='$country', introduction='$introduction'";
        $where = "id='$userid'";
    } else {
        // بروزرسانی اطلاعات
        $sets = "email='$email', phonenumber='$mobile', city='$city', country='$country', introduction='$introduction'";
        $where = "id='$userid'";
    }
    updateQuery($tableName, $sets, $where);
}

// خواندن اطلاعات کاربری

$sql = selectQuery_tc_clients("id='$userid' ");
foreach ($sql as $row3) {
    $newchecked = $row3['rolerequest'];
    $currentemail = $row3['email'];
    $currentpass = '';
    $currentcity = $row3['city'];
    $currentcountry = $row3['country'];
    $currentphone = $row3['phonenumber'];
    $currentintroduction = $row3['introduction'];
}

//----------
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    $title = 'تنظیمات | پروفایل';
    $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
    $description = 'شما می توانید از این بخش اطلاعات کاربری خود را تغییر یا اضافه کنید';
    $icon = '../tradi-coders-logo-final.gif';
    defualtMetaAndStyleProfile($title, $keywords, $description, $icon); ?>

</head>
<body class="hold-transition sidebar-mini" style="overflow:hidden;">
<div class="wrapper">

    <!-- Navbar -->
    <?php require_once("navbar.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php require_once("sidebar.php"); ?>

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
                                <li class="breadcrumb-item active"><a href="index.html">پروفایل</a></li>
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
                            <h3 class="card-title">پروفایل</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="card-body row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">آدرس ایمیل</label>
                                        <input type="email" name="email" value="<?php echo $currentemail; ?>"
                                               class="form-control" id="exampleInputEmail1"
                                               placeholder="ایمیل را وارد کنید">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">رمز عبور</label>
                                        <input type="password" name="pass" value="<?php echo $currentpass; ?>"
                                               class="form-control" id="exampleInputPassword1"
                                               placeholder="پسورد را وارد کنید">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نام شهر</label>
                                        <input type="text" name="city" value="<?php echo $currentcity; ?>"
                                               class="form-control" id="exampleInputEmail1"
                                               placeholder="نام شهر را وارد کنید">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">نام کشور</label>
                                        <input type="text" name="country" value="<?php echo $currentcountry; ?>"
                                               class="form-control" id="exampleInputEmail1"
                                               placeholder="نام کشور را وارد کنید">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="telephone">شماره تماس</label>
                                        <input type="tel" name="mobilephone" value="<?php echo $currentphone; ?>"
                                               class="form-control" id="telephone"
                                               placeholder="شماره تماس خود را وارد کنید">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputFile">عکس پروفایل</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <!--
                                                <input type="file" name="cimage" class="custom-file-input" id="cimage">
                                                -->
                                                <label class="custom-file-label" for="cimage"
                                                       style="width: 180px;cursor: pointer;position: relative;z-index: 2;">انتخاب
                                                    فایل</label>
                                            </div>
                                        </div>
                                        <input style="display:none;" type="file" name="cimage" id="cimage"
                                               style="position: relative;right: 103px;z-index: 1;bottom: 40px;">

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="telephone">
                                                معرفی توانایی های شما
                                            </label>
                                            <textarea name="introduction" rows="4" cols="50"
                                                      placeholder="در مورد توانایی های خود بنویسید">
       <?php echo $currentintroduction; ?>
                        </textarea>

                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>
                                            <input type="checkbox" name="newdev"
                                                   style="float: right;margin: 5px;" <?php if ($newchecked == '1') {
                                                echo 'checked';
                                            } ?> >
                                            همکاری با تیم تریدی کدرز به عنوان توسعه دهندگان
                                        </label>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-primary MainBgColor">ثبت ویرایش</button>
                    </div>
                    </form>
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

<?php defualtScriptProfile(); ?>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

</body>
</html>
