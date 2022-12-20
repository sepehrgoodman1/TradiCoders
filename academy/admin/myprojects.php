<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>پنل مدیریت | پروژه من</title>
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
                          <a href="myprojects.php" class="nav-link active">
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
                          <a href="customer.php" class="nav-link">
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
            <h1 class="m-0 text-dark">پروژهای من</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="../index.php">خانه</a></li>
                <li class="breadcrumb-item"><a href="index.html">مدیریت پروژه</a></li>
                <li class="breadcrumb-item"><a href="myprojects.php">پروژه های من</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
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

          <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">جدول پروژه ها</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="جستجو">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                  <button type="button" class=" btn btn-block btn-primary" style="margin-bottom:10px;font-size: 16px;margin-top: 12px;width: 110px;margin-right: 20px;" onclick="NewprojectForm()">پروژه جدید</button>
                  <div id="NewprojectForm" class="card card-info" style="padding: 10px;display: none">
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
                                          <label for="ProjectNameInput" class="col-sm-3 control-label">نام پروژه</label>

                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" id="ProjectNameInput" placeholder="نام پروژه را وارد کنید..">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-6">
                                      <div class="form-group">
                                          <label for="ProjectNameInput" class="col-sm-3 control-label">نام مشتری</label>

                                          <div class="col-sm-10">

                                              <input type="text" id="myInput" onkeyup="searchcustomer()" placeholder="Search for names.." title="Type in a name">

                                              <ul id="myUL">
                                                  <li style="display: none"><a href="#">Adele</a></li>
                                                  <li style="display: none"><a href="#">Agnes</a></li>

                                                  <li style="display: none"><a href="#">Billy</a></li>
                                                  <li style="display: none"><a href="#">Bob</a></li>

                                                  <li style="display: none"><a href="#">Calvin</a></li>
                                                  <li style="display: none"><a href="#">Christina</a></li>
                                                  <li style="display: none"><a href="#">Cindy</a></li>
                                              </ul>

                                              <script>
                                                  function searchcustomer() {
                                                      var input, filter, ul, li, a, i, txtValue;
                                                      input = document.getElementById("myInput");
                                                      filter = input.value.toUpperCase();
                                                      ul = document.getElementById("myUL");
                                                      li = ul.getElementsByTagName("li");
                                                      for (i = 0; i < li.length; i++) {
                                                          a = li[i].getElementsByTagName("a")[0];
                                                          txtValue = a.textContent || a.innerText;
                                                          if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                                              li[i].style.display = "";
                                                          } else {
                                                              li[i].style.display = "none";
                                                          }
                                                      }
                                                  }
                                              </script>

                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-6">
                                      <div class="form-group">
                                          <label for="ProjectNameInput" class="col-sm-3 control-label">لینک mql</label>

                                          <div class="col-sm-10">
                                              <input type="url" class="form-control" id="ProjectNameInput" placeholder="لینک را وارد کنید..">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-6">
                                      <div class="form-group">
                                          <label for="ProjectNameInput" class="col-sm-3 control-label">قیمت پروژه</label>

                                          <div class="col-sm-10">
                                              <input type="text" class="form-control" id="ProjectNameInput" placeholder="قیمت پروژه را وارد کنید..">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-4">
                                      <div class="form-group">
                                          <label for="ProjectNameInput" class="col-sm-6 control-label">لینک mql</label>

                                          <div class="col-sm-10">
                                              <input type="url" class="form-control" id="ProjectNameInput" placeholder="لینک را وارد کنید..">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="form-group">
                                          <label for="ProjectNameInput" class="col-sm-6 control-label">مدت زمان پروژه</label>

                                          <div class="col-sm-10">
                                              <input type="date" class="form-control" id="ProjectNameInput" placeholder="مدت زمان پروژه را وارد کنید..">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="form-group">
                                          <label for="ProjectNameInput" class="col-sm-6 control-label">اولویت (بین 1 تا 10)</label>

                                          <div class="col-sm-10">
                                              <input type="number" class="form-control" id="ProjectNameInput"  min="1" max="10" placeholder="اولویت پروژه را وارد کنید..">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <button type="submit" class="btn btn-info">ورود</button>
                              <button type="button" onclick="closeprojectForm()" class="btn btn-default float-left">لغو</button>
                          </div>
                          <!-- /.card-footer -->
                      </form>
                  </div>
                <table class="table table-hover" id="projectTable">
                  <tbody>
                  <tr style="text-align: center">
                    <th>تایتل1</th>
                    <th>وضعیت فرایند</th>
                    <th>زمان اتمام پروژه</th>
                    <th>وضعیت</th>
                    <th>نام پروژه</th>
                    <th>نام توسعه دهنده</th>
                    <th>تایتل7</th>
                  </tr>
                  <tr style="text-align: center">
                    <td><a href="programs/index.html"><button type="button" class="btn btn-block btn-primary">مدیریت پروژه</button></a></td>
                    <td>
                      <div class="progress" style="margin-top: 10px;">
                        <div class="progress-bar" style="width: 70%">70%</div>
                      </div>
                    </td>
                    <td>۱۱-۷-۲۰۱۴</td>
                    <td><span class="badge badge-success">تایید شده</span></td>
                    <td>tradicoders</td>
                    <td style="padding-top: 5px;">Beny <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user image" style="width: 45px;"></td>
                    <td>#33</td>
                  </tr>
                  <tr style="text-align: center">
                      <td><a href="programs/index.html"><button type="button" class="btn btn-block btn-primary">مدیریت پروژه</button></a></td>
                      <td>
                          <div class="progress" style="margin-top: 10px;">
                              <div class="progress-bar" style="width: 70%">70%</div>
                          </div>
                      </td>
                      <td>۱۱-۷-۲۰۱۴</td>
                      <td><span class="badge badge-success">تایید شده</span></td>
                      <td>tradicoders</td>
                      <td style="padding-top: 5px;">Beny <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user image" style="width: 45px;"></td>
                      <td>#33</td>
                  </tr>
                  <tr style="text-align: center">
                      <td><a href="programs/index.html"><button type="button" class="btn btn-block btn-primary">مدیریت پروژه</button></a></td>
                      <td>
                          <div class="progress" style="margin-top: 10px;">
                              <div class="progress-bar" style="width: 70%">70%</div>
                          </div>
                      </td>
                      <td>۱۱-۷-۲۰۱۴</td>
                      <td><span class="badge badge-success">تایید شده</span></td>
                      <td>tradicoders</td>
                      <td style="padding-top: 5px;">Beny <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user image" style="width: 45px;"></td>
                      <td>#33</td>
                  </tr>
                  <tr style="text-align: center">
                      <td><a href="programs/index.html"><button type="button" class="btn btn-block btn-primary">مدیریت پروژه</button></a></td>
                      <td>
                          <div class="progress" style="margin-top: 10px;">
                              <div class="progress-bar" style="width: 70%">70%</div>
                          </div>
                      </td>
                      <td>۱۱-۷-۲۰۱۴</td>
                      <td><span class="badge badge-success">تایید شده</span></td>
                      <td>tradicoders</td>
                      <td style="padding-top: 5px;">Beny <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user image" style="width: 45px;"></td>
                      <td>#33</td>
                  </tr>
                  <tr style="text-align: center">
                      <td><a href="programs/index.html"><button type="button" class="btn btn-block btn-primary">مدیریت پروژه</button></a></td>
                      <td>
                          <div class="progress" style="margin-top: 10px;">
                              <div class="progress-bar" style="width: 70%">70%</div>
                          </div>
                      </td>
                      <td>۱۱-۷-۲۰۱۴</td>
                      <td><span class="badge badge-success">تایید شده</span></td>
                      <td>tradicoders</td>
                      <td style="padding-top: 5px;">Beny <img class="img-circle img-bordered-sm" src="dist/img/user1-128x128.jpg" alt="user image" style="width: 45px;"></td>
                      <td>#33</td>
                  </tr>

                  </tbody></table>
                  <script>
                      function NewprojectForm()
                      {
                          document.getElementById("NewprojectForm").style.display="block";
                          document.getElementById("projectTable").style.display="none";
                      }
                      function closeprojectForm()
                      {
                          document.getElementById("NewprojectForm").style.display="none";
                          document.getElementById("projectTable").style.display="block";
                      }
                  </script>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
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