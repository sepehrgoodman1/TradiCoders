<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>پنل crm</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="dist/css/bootstrap-rtl.min.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="dist/css/custom-style.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../index.php" class="nav-link">خانه</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">تماس</a>
            </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-comments-o"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 ml-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    حسام موسوی
                                    <span class="float-left text-sm text-danger"><i class="fa fa-star"></i></span>
                                </h3>
                                <p class="text-sm">با من تماس بگیر لطفا...</p>
                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle ml-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    پیمان احمدی
                                    <span class="float-left text-sm text-muted"><i class="fa fa-star"></i></span>
                                </h3>
                                <p class="text-sm">من پیامتو دریافت کردم</p>
                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 ساعت قبل</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle ml-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    سارا وکیلی
                                    <span class="float-left text-sm text-warning"><i class="fa fa-star"></i></span>
                                </h3>
                                <p class="text-sm">پروژه اتون عالی بود مرسی واقعا</p>
                                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i>4 ساعت قبل</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">مشاهده همه پیام‌ها</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
                        <span class="float-left text-muted text-sm">3 دقیقه</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users ml-2"></i> 8 درخواست دوستی
                        <span class="float-left text-muted text-sm">12 ساعت</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-file ml-2"></i> 3 گزارش جدید
                        <span class="float-left text-muted text-sm">2 روز</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fa fa-th-large"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">پنل مدیریت</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar" style="direction: ltr">
            <div style="direction: rtl">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">حسام موسوی</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    مدیریت پروژه
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="myprojects.php" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>پروژه های من</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.html" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>پروژهای باز</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="mangemoney.php" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>حساب مالی</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="support.php" class="nav-link">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>پشتیبانی</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="customer.php" class="nav-link active">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>مشتریان</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">داشبورد</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="../index.php">خانه</a></li>
                            <li class="breadcrumb-item"><a href="index.html">مدیریت پروژه</a></li>
                            <li class="breadcrumb-item active"><a href="customer.php">مشتریان</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>21</h3>

                            <p>پروژها</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="myprojects.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>870000 <span>تومان</span></h3>

                            <p>حساب مالی</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="mangemoney.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>پشتیبانی</h3>

                            <p></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="support.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>10</h3>

                            <p>مشتریان</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="customer.php" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">جدول داده 1</h3>
                        </div>
                        <!-- /.card-header -->

                        <button type="button" class=" btn btn-block btn-primary" style="margin-bottom:10px;font-size: 16px;margin-top: 12px;width: 110px;margin-right: 20px;" onclick="NewCustomerForm()">مشتری جدید</button>

                        <div id="NewCustomerForm" class="card card-info" style="padding: 10px;display: none">
                            <div class="card-header">
                                <h3 class="card-title">فرم مشتری جدید</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="customerNameInput" class="col-sm-3 control-label">نام مشتری</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="customerNameInput" placeholder="نام مشتری را وارد کنید..">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cusomerNumberInput" class="col-sm-3 control-label">شماره موبایل</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="cusomerNumberInput" placeholder="شماره موبایل مشتری را وارد کنید">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="customerEmailInput" class="col-sm-3 control-label">ایمیل</label>

                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="customerEmailInput" placeholder="ایمیل مشتری را وارد کنید..">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cusomerWebInput" class="col-sm-3 control-label">سایت مشتری</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="cusomerWebInput" placeholder="لینک سایت مشتری را وارد کنید">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>توضیحات مشتری</label>
                                                <textarea class="form-control" id="CustomerDescription" rows="3" placeholder="وارد کردن اطلاعات ..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-6"></div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">ورود</button>
                                    <button type="button" onclick="closeCustomerForm()" class="btn btn-default float-left">لغو</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <div id="EditCustomerForm" class="card card-info" style="padding: 10px;display: none">
                            <div class="card-header">
                                <h3 class="card-title">فرم ادیت مشتری</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form class="form-horizontal">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="EditCustomerNameInput" class="col-sm-3 control-label">نام مشتری</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="EditCustomerNameInput" placeholder="نام مشتری را وارد کنید..">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="cusomerNumberInput" class="col-sm-3 control-label">شماره موبایل</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="cusomerNumberInput" placeholder="شماره موبایل مشتری را وارد کنید">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="EditCustomerEmailInput" class="col-sm-3 control-label">ایمیل</label>

                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="EditCustomerEmailInput" placeholder="ایمیل مشتری را وارد کنید..">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="EditCustomerWebInput" class="col-sm-3 control-label">سایت مشتری</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="EditCustomerWebInput" placeholder="لینک سایت مشتری را وارد کنید">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>توضیحات مشتری</label>
                                                <textarea class="form-control" id="EditCustomerDescription" rows="3" placeholder="وارد کردن اطلاعات ..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-6"></div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">ورود</button>
                                    <button type="button" onclick="closeEditCustomerForm()" class="btn btn-default float-left">لغو</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                        </div>
                        <div id="historyForm" class="card card-info" style="padding: 10px;display: none">
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>شماره تراکنش</th>
                                        <th>وضعیت پرداخت</th>
                                        <th>مبلغ پرداخت</th>
                                        <th>توضیحات پرداخت</th>
                                        <th>تاریخ پرداخت</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>۴۳۱۱۶۶۷۸۱۷۷۱</td>
                                        <td>
                                            <span class="badge badge-success">تایید شده</span>
                                        </td>
                                        <td>۱۷۸۰۰۰۰ تومان</td>
                                        <td>tradinotifir</td>
                                        <td>۱۱,۲,۲۰۲۱</td>
                                    </tr>
                                    <tr>
                                        <td>۴۳۱۱۶۶۷۸۱۷۷۱</td>
                                        <td>
                                            <span class="badge badge-success">تایید شده</span>
                                        </td>
                                        <td>۱۷۸۰۰۰۰ تومان</td>
                                        <td>tradinotifir</td>
                                        <td>۱۱,۲,۲۰۲۱</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>شماره تراکنش</th>
                                        <th>وضعیت پرداخت</th>
                                        <th>مبلغ پرداخت</th>
                                        <th>توضیحات پرداخت</th>
                                        <th>تاریخ پرداخت</th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <div class="card-footer">
                                    <button type="button" onclick="closehistoryForm()" class="btn btn-default float-left">لغو</button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body" id="card-body">
                            <table id="example2" class="table table-bordered table-hover" style="text-align: center">
                                <thead>
                                <tr>
                                    <th>نام مشتری</th>
                                    <th>شماره موبایل</th>
                                    <th>شبکه اجتماعی</th>
                                    <th>تعداد پروژه</th>
                                    <th>رتبه</th>
                                    <th>ویرایش</th>
                                    <th>تاریخچه</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>hamed</td>
                                    <td>
                                        090012122222
                                    </td>
                                    <td>instagram</td>
                                    <td>23</td>
                                    <td>30%</td>
                                    <td><button type="button" class=" btn btn-block btn-primary" onclick="EditCustomerForm()" style="width: 48%;display: inline-block;padding: 0;font-size: 12px;margin-top: 7px;">ویرایش</button></td>
                                    <td><button type="button" class=" btn btn-block btn-primary" onclick="historyForm()" style="width: 48%;display: inline-block;padding: 0;font-size: 12px;margin-top: 7px;">تاریخچه</button></td>
                                </tr>
                                <tr>
                                    <td>hamed</td>
                                    <td>
                                        090012122222
                                    </td>
                                    <td>instagram</td>
                                    <td>23</td>
                                    <td>30%</td>
                                    <td><button type="button" class=" btn btn-block btn-primary" onclick="EditCustomerForm()" style="width: 48%;display: inline-block;padding: 0;font-size: 12px;margin-top: 7px;">ویرایش</button></td>
                                    <td><button type="button" class=" btn btn-block btn-primary" onclick="historyForm()" style="width: 48%;display: inline-block;padding: 0;font-size: 12px;margin-top: 7px;">تاریخچه</button></td>
                                </tr>
                                <tr>
                                    <td>hamed</td>
                                    <td>
                                        090012122222
                                    </td>
                                    <td>instagram</td>
                                    <td>23</td>
                                    <td>30%</td>
                                    <td><button type="button" class=" btn btn-block btn-primary" onclick="EditCustomerForm()" style="width: 48%;display: inline-block;padding: 0;font-size: 12px;margin-top: 7px;">ویرایش</button></td>
                                    <td><button type="button" class=" btn btn-block btn-primary" onclick="historyForm()" style="width: 48%;display: inline-block;padding: 0;font-size: 12px;margin-top: 7px;">تاریخچه</button></td>
                                </tr>
                                <tr>
                                    <td>hamed</td>
                                    <td>
                                        090012122222
                                    </td>
                                    <td>instagram</td>
                                    <td>23</td>
                                    <td>30%</td>
                                    <td><button type="button" class=" btn btn-block btn-primary" onclick="EditCustomerForm()" style="width: 48%;display: inline-block;padding: 0;font-size: 12px;margin-top: 7px;">ویرایش</button></td>
                                    <td><button type="button" class=" btn btn-block btn-primary" onclick="historyForm()" style="width: 48%;display: inline-block;padding: 0;font-size: 12px;margin-top: 7px;">تاریخچه</button></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>نام مشتری</th>
                                    <th>شماره موبایل</th>
                                    <th>شبکه اجتماعی</th>
                                    <th>تعداد پروژه</th>
                                    <th>رتبه</th>
                                    <th>ویرایش</th>
                                    <th>تاریخچه</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.col -->

                </div>
                <!-- /.row -->
                <script>
                    function historyForm()
                    {
                        document.getElementById("historyForm").style.display="block";
                        document.getElementById("NewCustomerForm").style.display="none";
                        document.getElementById("EditCustomerForm").style.display="none";
                        document.getElementById("card-body").style.display="none";
                    }
                    function closehistoryForm()
                    {
                        document.getElementById("historyForm").style.display="none";
                        document.getElementById("card-body").style.display="block";
                    }
                    ////////////////////
                    function EditCustomerForm()
                    {
                        document.getElementById("EditCustomerForm").style.display="block";
                        document.getElementById("NewCustomerForm").style.display="none";
                        document.getElementById("historyForm").style.display="none";
                        document.getElementById("card-body").style.display="none";
                    }
                    function closeEditCustomerForm()
                    {
                        document.getElementById("EditCustomerForm").style.display="none";
                        document.getElementById("card-body").style.display="block";
                    }
                    /////////////
                    function NewCustomerForm()
                    {
                        document.getElementById("NewCustomerForm").style.display="block";
                        document.getElementById("EditCustomerForm").style.display="none";
                        document.getElementById("historyForm").style.display="none";
                        document.getElementById("card-body").style.display="none";
                    }
                    function closeCustomerForm()
                    {
                        document.getElementById("NewCustomerForm").style.display="none";
                        document.getElementById("card-body").style.display="block";
                    }
                </script>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>CopyLeft &copy; 2018 <a href="http://github.com/hesammousavi/">حسام موسوی</a>.</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>