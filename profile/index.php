<?php
require("backend_header.php");

?>
<html>
<head>
    <?php
    $title = 'پروفایل | پروژه ها';
    $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
    $description = 'شما می توانید از این بخش پروژه های خود را مشاهده و کنترل کنید';
    $icon = '../tradi-coders-logo-final.gif';
    defualtMetaAndStyleProfile($title, $keywords, $description, $icon); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
          crossorigin="anonymous">
    <!-- Sepehr Css Codes -->
    <link rel="stylesheet" href="./css/profile.css" />
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="css/fonts.css" />
    
    <!-- Font Awesome Icon-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

</head>
<body class="hold-transition sidebar-mini">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
<?php
//--------

// تعداد پروژه ها بر مبنای فیلتر
if (array_key_exists('status', $_GET) && $_GET['status'] != 'all') {
    $getstatus = $_GET['status'];
    if ($getstatus == 'close') {
        $prnumber = sizeof(selectQuery_tc_project("(creatoruid='$userid' OR developeruid='$userid') and (prstatus='close_cancel_pending' or prstatus='close_cancel' or prstatus='close_half_pending' or prstatus='close_half' or prstatus='close_complete' )"));
    }else if ($getstatus == 'open') {
        $prnumber = sizeof(selectQuery_tc_project("(creatoruid='$userid' OR developeruid='$userid') and (prstatus='open' OR prstatus='waiting_user' OR prstatus='pending' OR prstatus='approve' )"));
    } else {
        $prnumber = sizeof(selectQuery_tc_project("(creatoruid='$userid' OR developeruid='$userid') and prstatus='$getstatus' "));
    }

} else {
    $prnumber = sizeof(selectQuery_tc_project("creatoruid='$userid' "));
}

?>
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
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="../index.php" class="LinksPages">خانه</a></li>
                            <li class="breadcrumb-item"><a href="index.php" class="LinksPages">پروفایل</a></li>
                            <li class="breadcrumb-item"><a href="accounting.php" class="LinksPages">مدیریت مالی</a></li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner BgRightSideSec" >
                                <h3 class="Fs30"><?php echo $prnumber; ?></h3>

                                <h4 class="Fs24">پروژها</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="myprojects.php" class="small-box-footer BottomSide"
                               >اطلاعات بیشتر <i
                                        class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner BgLeftSideSec" >
                                <h3 class="Fs30"><?php echo $balance; ?></h3>
                                <h4 class="Fs24">موجودی کیف پول</h4>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="accounting.php" class="small-box-footer BottomSide"
                               >اطلاعات بیشتر <i
                                        class="fa fa-arrow-circle-left"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title OpensProjectText">پروژه های باز</h3>

                                <div class="card-tools col-8">

                                    <div class="input-group input-group-sm">
                                        <div class="col"
                                             style="padding: 3px; margin-left:8px;border-radius: 5px;width: 100%;">
                                            <form action="" method="get">
                                                <select onchange="filter()" class="form-select" name="status">
                                                    <option value="all">همه</option>
                                                    <option value="pending" <?php if ($getstatus == "pending") {
                                                        echo "selected";
                                                    } ?>> در حالت انتظار تایید تریدی کدرز
                                                    </option>
                                                    <option value="approve" <?php if ($getstatus == "approve") {
                                                        echo "selected";
                                                    } ?> >در انتظار توسعه دهنده
                                                    </option>
                                                    <option value="open" <?php if ($getstatus == "open") {
                                                        echo "selected";
                                                    } ?> >پروژه های باز
                                                    </option>
                                                    <option value="waiting_user" <?php if ($getstatus == "waiting_user") {
                                                        echo "selected";
                                                    } ?> >در انتظار تایید کارفرما
                                                    </option>
                                                    <option value="arbitration" <?php if ($getstatus == "arbitration") {
                                                        echo "selected";
                                                    } ?> >شکایات
                                                    </option>
                                                    <option value="close" <?php if ($getstatus == "close") {
                                                        echo "selected";
                                                    } ?> >پروژه های بسته
                                                    </option>
                                                </select>

                                                <button id="submit_status" type="submit" style="display:none;"></button>

                                            </form>
                                        </div>
                                        <div class="col">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="table_search" class="form-control float-right InputProfile"
                                                       placeholder="جستجو">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i
                                                                class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr style="text-align: center">
                                    <th class="Fs14 Ptb15">کد پروژه</th>
                                    <?php
                                        if ($role == 'user') {
                                            ?>
                                            <th class="Fs14 Ptb15">نام مشتری</th>
                                            <?php
                                        } else {
                                            ?>
                                            <th class="Fs14 Ptb15">نام توسعه دهنده</th>
                                            <?php
                                        }
                                        ?>
                                        <th class="Fs14 Ptb15">نام پروژه</th>
                                        <th class="Fs14 Ptb15">وضعیت</th>
                                        <th class="Fs14 Ptb15">زمان آغاز پروژه</th>

                                        <th class="Fs14 Ptb15">وضعیت فرایند</th>
                                        <th class="Fs14 Ptb15">عملیات</th>
                                       
                                        
                                        
                                       

                                       
                                    </tr>
                                    <?php
                                    // اعمال فیلتر روی پروژه ها و دریافت اطلاعات آن
                                    if (array_key_exists('status', $_GET) && $_GET['status'] != 'all') {
                                        $getstatus = $_GET['status'];
                                        if ($getstatus == 'close') {
                                            $q_tc_project = selectQuery_tc_project("(prstatus='close_cancel_pending' or prstatus='close_cancel' or prstatus='close_half_pending' or prstatus='close_half' or prstatus='close_complete' ) and (creatoruid='$userid' OR developeruid='$userid') ORDER BY id DESC");
                                        }else if ($getstatus == 'open') {
                                            $q_tc_project = selectQuery_tc_project("(creatoruid='$userid' OR developeruid='$userid') and (prstatus='open' OR prstatus='waiting_user' OR prstatus='pending' OR prstatus='approve' ) ORDER BY id DESC");
                                        } else {
                                            $q_tc_project = selectQuery_tc_project("prstatus='$getstatus' and (creatoruid='$userid' OR developeruid='$userid') ORDER BY id DESC");
                                        }

                                    } else {
                                        $q_tc_project = selectQuery_tc_project("creatoruid='$userid' OR developeruid='$userid' ORDER BY id DESC");
                                    }

                                    foreach ($q_tc_project as $row) {
                                        $PrStatus = $row['prstatus'];
                                        if ($PrStatus == "pending") {
                                            $projectProgress = 0;
                                        } else if ($PrStatus == "approve") {
                                            $projectProgress = 0;
                                        } else if ($PrStatus == "open") {
                                            $projectProgress = 25;
                                        } else if ($PrStatus == "close_complete") {
                                            $projectProgress = 100;
                                        } else if ($PrStatus == "close_half_pending") {
                                            $projectProgress = 50;
                                        } else if ($PrStatus == "close_half") {
                                            $projectProgress = 100;
                                        } else if ($PrStatus == "close_cancel_pending") {
                                            $projectProgress = 100;
                                        } else if ($PrStatus == "close_cancel") {
                                            $projectProgress = 100;
                                        } else if ($PrStatus == "close_problem") {
                                            $projectProgress = 100;
                                        } else if ($PrStatus == "arbitration") {
                                            $projectProgress = 100;
                                        } else if ($PrStatus == "waiting_user") {
                                            $projectProgress = 50;
                                        }
                                        $projectid = $row["id"];

                                        $devname = "";
                                        $customername = "";
                                        $devid = $row["developeruid"];
                                        $customerid = $row["creatoruid"];
                                        // گرفتن اطلاعات توسعه دهنده و کارفرما
                                        $sql3 = selectQuery_tc_clients("id='$devid' OR id='$customerid'");
                                        foreach ($sql3 as $row3) {
                                            if ($row3['id'] == $devid) {
                                                $devname = $row3['firstname'] . " " . $row3['lastname'];
                                                $pricePlan = $row3['priceplan'];
                                                $dev_url_img = $row3['imgurl'];
                                            }
                                            if ($row3['id'] == $customerid) {
                                                $customername = $row3['firstname'] . " " . $row3['lastname'];
                                                $cus_url_img = $row3['imgurl'];
                                            }
                                        }

                                        ?>
                                        <!-- Start Body -->
                                        <tr style="text-align: center">
                                            <!-- Code Project -->
                                            <td class="Fs14">
                                                <?php echo $row['id']; ?>
                                            </td>

                                            <!-- UserName -->
                                            <?php
                                            if ($role == 'user') {
                                                ?>
                                                <td style="padding-top: 5px;" class="Fs14 Fw600">
                                                    
                                                    <img class="img-circle img-bordered-sm ObjectFitCover"
                                                         src="<?php echo $cus_url_img; ?>" alt=""
                                                         style="width: 45px;height: 45px;">
                                                         <?php echo $customername; ?>
                                                </td>
                                                <?php
                                            } else {
                                                if ($devid > 0) {
                                                    ?>
                                                    <td style="padding-top: 5px;" class="Fs14 Fw600">
                                                        <img class="img-circle img-bordered-sm ObjectFitCover"
                                                             src="<?php echo $dev_url_img; ?>" alt="user image"
                                                             style="width: 45px;height: 45px;">
                                                        <?php echo $devname; ?>

                                                    </td>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <td style="padding-top: 5px;" class="Fs14 Fw600 Op7">
                                                        در انتظار توسعه دهنده
                                                    </td>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            <!-- Project name -->
                                            <td class="Fs14 Fw600"><?php echo $row['subject']; ?></td>

                                            <!-- Status -->                                            
                                            <td>
                                                <?php
                                                if ($PrStatus == "pending") {
                                                    echo "<span class='badge badge-info P10 Fw500 MainBgColor'>در انتظار تایید تریدی کدرز</span>";
                                                } else if ($PrStatus == "approve") {
                                                    echo "<span class='badge badge-info P10 Fw500'>در انتظار تایید توسعه دهنده</span>";
                                                } else if ($PrStatus == "open") {
                                                    echo "<span class='badge badge-info P10 Fw500'>در حال تولید پروژه توسط توسعه دهنده</span>";
                                                } else if ($PrStatus == "close_complete") {
                                                    echo "<span class='badge badge-success P10 Fw500'>پروژه با رضایت کامل به اتمام رسیده</span>";
                                                } else if ($PrStatus == "close_problem") {
                                                    $difficulties = $row["difficulties"];
                                                    $difficulties = str_replace(array("\n", "\r"), '', $difficulties);
                                                    echo "<span class='badge badge-danger P10 Fw500'>پروژه شما رد شده</span> <br>
                                                          <button type='button'  onclick='show_difficulties(\"$difficulties\")' class='btn btn-success mt-2'>توضیحات</button>";
                                                } else if ($PrStatus == "waiting_user") {
                                                    echo "<span class='badge badge-warning P10 Fw500 BgOrange'>در انتظار تایید کارفرما</span>";
                                                } else if ($PrStatus == "close_half_pending") {
                                                    echo "<span class='badge badge-warning P10 Fw500 BgOrange'>نیاز به باز تولید دارد</span>";
                                                } else if ($PrStatus == "close_half") {
                                                    echo "<span class='badge badge-warning P10 Fw500 BgSpecialColor'>پروژه به اتمام رسیده و نیمی از پول آن پرداخت شده</span>";
                                                } else if ($PrStatus == "close_cancel_pending") {
                                                    echo "<span class='badge badge-warning P10 Fw500 BgOrange'>درخواست لغو پروژه داده شده</span>";
                                                } else if ($PrStatus == "close_cancel") {
                                                    echo "<span class='badge badge-danger P10 Fw500'>پروژه لغو شده</span>";
                                                } else if ($PrStatus == "arbitration") {
                                                    echo "<span class='badge badge-danger P10 Fw500'>پروژه در وضعیت شکایت قرار دارد</span>";
                                                }
                                                ?>

                                            </td>

                                            <!-- Date -->
                                            <td class="Fs12 Fw600"><?php echo($row['prstarttime']); ?></td>

                                            <!-- Progress -->
                                            <td style="padding-left: 0;padding-right: 20px;">
                                                <div class="progress" style="margin-top: 10px;">
                                                    <div class="progress-bar MainBgColor"
                                                         style="width: <?php echo $projectProgress; ?>%"><?php echo $projectProgress; ?>
                                                        %
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Manage Project -->
                                            <td>
                                                <a href="projectpage.php?prid=<?php echo $projectid; ?>">
                                                    <button type="button" class=" btn btn-block btn-primary MainBgColor Fs14">مدیریت
                                                        پروژه
                                                    </button>
                                                </a>
                                            </td>
                                            
                                            
                                            
                                        </tr>
                                        <!-- End Body -->
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->

                <!-- Modal -->
                <button type="button" id="modal_id2" style="display: none" class="btn btn-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#exampleModal2">
                    on
                </button>

                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2"
                     aria-hidden="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="difficulties_id" class="form-label">دلیل رد
                                        پروژه</label>
                                    <textarea class="form-control" name="difficulties"
                                              id="difficulties_id"
                                              rows="1"></textarea>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.modal -->

                <script>
                    function show_difficulties(difficulties) {
                        document.getElementById('modal_id2').click();
                        document.getElementById('difficulties_id').innerText = difficulties;
                    }
                </script>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
</div>
<!-- ./wrapper -->

<script>
    function filter() {
        document.getElementById("submit_status").click();
    }
</script>

<?php defualtScriptProfile(); ?>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
</body>
</html>
