<?php
require("backend_header.php");
/// زمان دو هفته به ثانیه
$twik = time()-1209600;
$sql_payment = selectQuery_tc_payment("userid='$userid' and trtime>'$twik' and trstatus='paid' and trdirection='deposit' and trid='1'", "tramount");

$hold_time = 0;
foreach ($sql_payment as $payment){
    $hold_time += $payment['tramount'];
}
$withdrawal_balance = (int)$balance-$hold_time;

if (!empty($_POST["getway"])) {
    $rprice = $_POST["rprice"];
    openLink('https://www.tradicoders.ir/getway/request.php?amount=' . $rprice);
}
if (!empty($_POST["rsubmit"])) {
    $rprice = $_POST["rprice"];
    $raccount = $_POST["raccount"];
    $rtypewithdraw = $_POST["rtypewithdraw"];
    $rdescription = $_POST["rdescription"];
    $rtype = $_POST["rsubmit2"];
    $ti = time();

    // خواندن موجودی
    $sql = selectQuery_tc_clients("id='$userid' ");
    foreach ($sql as $row) {
        $balance = $row["balance"];
        $hold = $row["hold"];
        $username = $row["firstname"].' '.$row["lastname"];
    }


    if ((int)$rprice <= (int)$balance || $rtype == 'deposit') {

        if ($rtype == 'withdraw' && (int)$rprice <= $withdrawal_balance) {
            // افزودن درخواست برداشت
            $tableName = 'tc_payment';
            $input = 'userid, uaccount, tramount,trdirection,trdescription,trtime,typewithdraw';
            $insert = "'$userid', '$raccount', '$rprice','$rtype','$rdescription','$ti','$rtypewithdraw'";
            insertQuery($tableName, $input, $insert);

            // set notif withdraw
            $not_parameters = array();
            $not_parameters['username'] = $username;
            $not_parameters['pricerequest'] = $rprice;
            setNotifPer("withdraw", $not_parameters, $userid);
            // ./set notif withdraw

            // کسر مبلغ درخواست شده از موجودی
            $newbalance = (int)$balance - (int)$rprice;
            $tableName = 'tc_clients';
            $sets = "balance='$newbalance'";
            $where = "id='$userid'";
            if (updateQuery($tableName, $sets, $where)) {
                openLink('https://www.tradicoders.ir/profile/accounting.php');
            }
        }else if ($rtype == 'withdraw'){
            alert("دریافت وجه هر قرار داد فقط پس از 14 روز امکان پذیر است. \n موجودی قابل برداشت شما: \n $withdrawal_balance تومان");
        }else if ($rtype == 'deposit'){
            // افزودن درخواست واریز
            $tableName = 'tc_payment';
            $input = 'userid, uaccount, tramount,trdirection,trdescription,trtime,typewithdraw';
            $insert = "'$userid', '$raccount', '$rprice','$rtype','$rdescription','$ti','$rtypewithdraw'";
            insertQuery($tableName, $input, $insert);
            // set notif deposit
            $not_parameters = array();
            $temp_sms_main = selectQuery_temp_sms_main("name='set_project'");
            $not_parameters['main'] = $temp_sms_main['cart'];
            $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);
            $not_parameters['username'] = $username;
            $not_parameters['pricerequest'] = $rprice;
            setNotifPer("deposit", $not_parameters, $userid);
            // ./set notif deposit
        }


    } else {
        alert('موجودی شما برای این درخواست کافی نمی باشد.');
    }


}
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    $title = 'پروفایل | مدیریت مالی';
    $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
    $description = 'شما می توانید از این بخش منابع مالی و خروجی و ورودی های خود را بررسی کنید و درخواست های مالی خود را ثبت کنید';
    $icon = '../tradi-coders-logo-final.gif';
    defualtMetaAndStyleProfile($title, $keywords, $description , $icon); ?>

    <link rel="stylesheet" href="accounting.css">

    <!-- My Css -->
    <link rel="stylesheet" href="css/profile.css">


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php require_once("navbar.php"); ?>
    <?php require_once("sidebar.php"); ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>جداول داده</h1>
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

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner BgRightSideSec" >
                                <h3><?php echo $prnumber; ?></h3>

                                <p>پروژها</p>
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
                                <h3><?php echo $balance; ?></h3>
                                <h4>موجودی کیف پول</h4>
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
                <!------------------------------------------------------------>

                <form action="" method="post" id="NewprojectForm" class="container"
                      style="border-radius: 10px;display: none;z-index: 9999;position: fixed;top: 80px;width: 500px;background: #343a406b;margin: auto;left: 400px;padding: 0;">
                    <div class="frame ModalAcounting H_Auto"
                         style="width: 100%">
                        <div class="imgcontainer">
                            <span  onclick="closeprojectForm()" class="close CloseIcon"
                                  title="Close Modal">×</span>
                        </div>

                        <div class="ChargeAccountText TitleFont">شارژ حساب</div>
                        <!-- <div class="nav">
                            <h2 style="text-align: center;width: 100%;font-weight: bold;color: #fff;padding:20px;"></h2>
                        </div> -->
                        <div ng-app="" ng-init="checked = false">
                            <!-- Harvest Money -->
                            <div class="P_Harvest " id="type_withdraw">
                                <div onclick="change_type_withdraw('tether')" class="TypeHarvest">
                                    <img src="../assets/images/Tetri.svg"  class="IconHarvest" alt="Tetri Icon">
                                    <div>برداشت تتری</div>
                                </div>
                                <div class="TypeHarvest ActiveHarvest" onclick="change_type_withdraw('toman')">
                                    <img src="../assets/images/Rial.png" class="IconHarvest" alt="Rial Icon">
                                    <div>برداشت تومانی</div>
                                </div>
                            </div>

                            <div class="form-signin" style="padding: 0;">
                                <label for="price"  class="LabelFormAcounting">مبلغ :</label>
                                <input onkeyup="to_alpha()" class="form-styling FormInputProfile" type="number" name="rprice" id="price" required=""
                                       placeholder="مبلغ مورد نظر را وارد کنید">
                                <span id="price_label"></span>
                                <input type="hidden" value="toman" name="rtypewithdraw" id="rtypewithdraw">
                                <label id="label_type" for="cart" class="LabelFormAcounting">شماره کارت :</label>
                                <input class="form-styling FormInputProfile" type="text" name="raccount" id="cart"
                                        placeholder="شماره کارت را وارد کنید">

                                <label for="name" id="label_des" class="LabelFormAcounting" style="margin: 0;">توضیحات :</label>
                                <textarea class="form-styling FormTextAreaProfile" id="des" name="rdescription" placeholder="توضیحات را وارد کنید"
                                          style="height: 70px;"></textarea>

                                <input type="hidden" name="rsubmit2" id="rsubmit2">
                                <button type="submit" id="getwaybtn" name="getway" value="1" class="BtnChargeModal"
                                        style="display:none; ">
                                    پرداخت آنلاین
                                </button>
                                <button type="submit" name="rsubmit" value="1" id="type_send" class="BtnConfirmOrderModal"
                                        >
                                    ثبت درخواست
                                </button>

                            </div>
                        </div>
                    </div>
                </form>


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title Accounting" style="display: inline-block;">حسابداری</h2>
                                <button type="button" class=" btn btn-block btn-primary col-3 harvestAccount"
                                        onclick="NewprojectForm('withdraw')">برداشت
                                    وجه
                                </button>
                                <button type="button" class=" btn btn-block btn-primary col-3 ChargeAccount"
                                       
                                        onclick="NewprojectForm('deposit')">شارژ حساب
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover">
                                    <tbody>
                                    <tr style="text-align: center">
                                        <th>ردیف</th>
                                        <th>زمان درخواست</th>
                                        <th>کد تراکنش</th>
                                        <th>توضیحات</th>
                                        <th>مبلغ تراکنش</th>
                                        <th>نوع تراکنش</th>
                                        <th>وضعیت</th>
                                    </tr>
                                    <?php
                                    // خواندن اطلاعات واریز و برداشت
                                    $sql = selectQuery_tc_payment("userid='$userid' ORDER BY id DESC");
                                    foreach ($sql as $row) {
                                        ?>
                                        <tr style="text-align: center">
                                            <td><?php echo $row['id']; ?></td>
                                            <td><?php echo date('Y/m/d H:i:s', $row['trtime']); ?></td>
                                            <td><?php echo $row['trid']; ?></td>
                                            <td><?php echo $row['trdescription']; ?></td>
                                            <td><?php echo $row['tramount']; ?></td>
                                            <td>
                                                <?php
                                                if ($row["trdirection"] == "deposit") {
                                                    echo "<span class='badge badge-success'>واریز</span>";
                                                }
                                                if ($row["trdirection"] == "withdraw") {
                                                    echo "<span class='badge badge-danger'>برداشت</span>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row["trstatus"] == "pending") {
                                                    echo "<span class='badge badge-warning'>در حال بررسی</span>";
                                                }
                                                if ($row["trstatus"] == "paid") {
                                                    echo "<span class='badge badge-success'>انجام شده</span>";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }

                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.col -->
                    </div>
                    <!-- /.row -->


        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<script>
    function NewprojectForm(type_send) {

        document.getElementById("NewprojectForm").style.display = "block";
        document.getElementById("rsubmit2").value = type_send;
        if (type_send === "deposit") {
            document.getElementById("type_withdraw").style.display = "none";
            document.getElementById("label_des").style.display = "none";
            document.getElementById("des").style.display = "none";
            document.getElementById("cart").style.display = "none";
            document.getElementById("label_type").style.display = "none";


            document.getElementById("getwaybtn").style.display = "block";
            document.querySelector(".ChargeAccountText").innerText = "شارژ حساب";
        } else {
            document.getElementById("type_withdraw").style.display = "flex";
            document.getElementById("label_des").style.display = "block";
            document.getElementById("des").style.display = "block";
            document.getElementById("cart").style.display = "block";
            document.getElementById("label_type").style.display = "block";

            document.getElementById("getwaybtn").style.display = "none";
            document.querySelector(".ChargeAccountText").innerText = "برداشت وجه";
        }

    }

    function closeprojectForm() {
        document.getElementById("NewprojectForm").style.display = "none";
    }

    function NewmoneyForm() {
        document.getElementById("NewmoneyForm").style.display = "block";
        document.getElementById("NewprojectForm").style.display = "none";
    }

    function closemoneyForm() {
        document.getElementById("NewmoneyForm").style.display = "none";
    }
    function change_type_withdraw(type){
        if (type === "toman"){
            document.getElementById('cart').placeholder = "شماره کارت را وارد کنید";
            document.getElementById('label_type').innerText = "شماره کارت :";
        }else {
            document.getElementById('cart').placeholder = "شماره کیف پول trc20 را وارد کنید";
            document.getElementById('label_type').innerText = "شماره کیف پول :";
        }
        document.getElementById('rtypewithdraw').value = type;
    }

    function numberToEnglish( n ) {

        var string = n.toString(), units, tens, scales, start, end, chunks, chunksLen, chunk, ints, i, word, words, and = 'و';

        /* Remove spaces and commas */
        string = string.replace(/[, ]/g,"");

        /* Is number zero? */
        if( parseInt( string ) === 0 ) {
            return 'صفر';
        }

        /* Array of units as words */
        units = [ '', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19' ];

        /* Array of tens as words */
        tens = [ '', '', '20', '30', '40', '50', '60', '70', '80', '90' ];

        /* Array of scales as words */
        scales = [ '', 'هزار', 'میلیون', 'بیلیون', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion', 'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quatttuor-decillion', 'quindecillion', 'sexdecillion', 'septen-decillion', 'octodecillion', 'novemdecillion', 'vigintillion', 'centillion' ];

        /* Split user argument into 3 digit chunks from right to left */
        start = string.length;
        chunks = [];
        while( start > 0 ) {
            end = start;
            chunks.push( string.slice( ( start = Math.max( 0, start - 3 ) ), end ) );
        }

        /* Check if function has enough scale words to be able to stringify the user argument */
        chunksLen = chunks.length;
        if( chunksLen > scales.length ) {
            return '';
        }

        /* Stringify each integer in each chunk */
        words = [];
        for( i = 0; i < chunksLen; i++ ) {

            chunk = parseInt( chunks[i] );

            if( chunk ) {

                /* Split chunk into array of individual integers */
                ints = chunks[i].split( '' ).reverse().map( parseFloat );

                /* If tens integer is 1, i.e. 10, then add 10 to units integer */
                if( ints[1] === 1 ) {
                    ints[0] += 10;
                }

                /* Add scale word if chunk is not zero and array item exists */
                if( ( word = scales[i] ) ) {
                    words.push( word );
                }

                /* Add unit word if array item exists */
                if( ( word = units[ ints[0] ] ) ) {
                    words.push( word );
                }

                /* Add tens word if array item exists */
                if( ( word = tens[ ints[1] ] ) ) {
                    words.push( word );
                }

                /* Add 'and' string after units or tens integer if: */
                if( ints[0] || ints[1] ) {

                    /* Chunk has a hundreds integer or chunk is the first of multiple chunks */
                    if( ints[2] || ! i && chunksLen ) {
                        words.push( and );
                    }

                }

                /* Add hundreds word if array item exists */
                if( ( word = units[ ints[2] ] ) ) {
                    words.push( word + '00' );
                }

            }

        }

        return words.reverse().join( ' ' );

    }



    function to_alpha(){
        var price_now = document.getElementById('price').value;

        document.getElementById('price_label').innerText = numberToEnglish(price_now)+" تومان";

    }
</script>
<!-- jQuery -->

<?php defualtScriptProfile(); ?>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!--Sep Js Code -->
<script src="js/index.js"></script>
</body>
</html>
