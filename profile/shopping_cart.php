<?php
require("backend_header.php");

if (isset($_POST['checkout'])){
$sql_order = selectQuery_tc_order("userid='$userid' and status='pending'","product_id, count, id, tracking_code");
$grand_total = 0;
foreach ($sql_order as $order) {
    $product_id = $order['product_id'];
    $sql_product = selectQuery_tc_product("id='$product_id'");
    $product = $sql_product[0];
    $price = ($product['price'] / 100) * (100 - $product['discount']);
    $total = $price * $order['count'];
    $grand_total += $total;
}
if ($grand_total == 0){
    foreach ($sql_order as $order) {
        $orderid = $order['id'];
        updateQuery("tc_order", "status='paid'", "userid='$userid' and id='$orderid'");
    }
    alert("پرداخت با موفقیت انجام شد");
}else{
    $orderid = "";
    for ($i=0; $i < sizeof($sql_order); $i++) {
        $product_id = $sql_order[$i]['product_id'];
        if ($i < sizeof($sql_order)-1) {
            $orderid .= $sql_order[$i]['id'] . ',';
        }else{
            $orderid .= $sql_order[$i]['id'];
        }
    }

    openLink('https://www.tradicoders.ir/getway/request.php?amount=' . $grand_total.'&mode=pay_product&order_id='.$orderid);
}
}

//----------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $title = 'تنظیمات | پروفایل';
    $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
    $description = 'شما می توانید از این بخش اطلاعات کاربری خود را تغییر یا اضافه کنید';
    $icon = '../tradi-coders-logo-final.gif';
    defualtMetaAndStyleProfile($title, $keywords, $description, $icon); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="./css/shooping_cart.css">

    <link rel="stylesheet" href="https://tradicoders.ir/css/global.css"/>
    
    <!-- Bootstrap 5 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
     <!-- Font Awesome Icon-->
     <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />

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
    <!-- Button trigger modal -->
  

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
                        <div class="card-header">
                            <div class="btn-group">
                                <a onclick="showTab('shopping')" class="btn btn-light text-dark active" aria-current="page">سبد خرید</a>

                                <a onclick="showTab('paid')" class="btn btn-light text-dark">خریداری شده</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div id="shopping" class="shopping-cart m-3">

                            <div class="column-labels">
                                <label class="product-image">Image</label>
                                <label class="product-details">Product</label>
                                <label class="product-price">قیمت (تومان)</label>
                                <label class="product-quantity">تعداد</label>
                                <label class="product-removal">Remove</label>
                                <label class="product-line-price">مجموع قیمت</label>
                            </div>

                            <?php
                            $sql_order = selectQuery_tc_order("userid='$userid' and status='pending'","product_id, count, id, tracking_code");
                            $grand_total = 0;
                            foreach ($sql_order as $order){
                                $product_id = $order['product_id'];
                                $sql_product = selectQuery_tc_product("id='$product_id'");
                                $product = $sql_product[0];
                                $price =  ($product['price']/100)*(100-$product['discount']);
                                $total = $price*$order['count'];
                                $grand_total += $total;
                            ?>
                            <div class="product">

                                <div class="product-image">
                                    <img src="<?php echo $product['url_banner']?>">
                                </div>
                                <div class="product-details">
                                    <div class="product-title"><?php echo $product['subject']?></div>
                                </div>
                                <div class="product-price" ><?php echo $price?></div>
                                <div class="product-quantity">
                                    <input id="<?php echo $order['id'];?>" type="number" value="<?php echo $order['count']?>" min="1">
                                </div>
                                <div class="product-removal">
                                    <button class="remove-product" id="<?php echo $order['id'];?>">
                                        حذف
                                    </button>
                                </div>
                                <div class="product-line-price"><?php echo $total?></div>
                            </div>

                            <?php
                            }
                            if (sizeof($sql_order) > 0){
                            ?>

                            <div class="totals">
                                <div class="totals-item totals-item-total">
                                    <label>مبلغ کل</label>
                                    <div class="totals-value" id="cart-total"><?php echo $grand_total;?></div>
                                </div>
                            </div>

                            <form action="" method="post" >
                                <button type="submit" name="checkout" class="checkout bg-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">تسویه</button>
                            </form>
                            <?php }else{echo  "سبد خالی میباشد";} ?>

                        </div>
                        <div id="paid" class="shopping-cart m-3" style="display: none">

                            <div class="column-labels">
                                <label class="product-image">Image</label>
                                <label class="product-details" style="width: 55%">Product</label>
                                <label class="product-price">قیمت (تومان)</label>
                                <label class="product-quantity" style="display: none; width: 0">تعداد</label>
                                <label class="product-removal">Remove</label>
                                <label class="product-line-price" style="display: none; width: 0">مجموع قیمت</label>
                            </div>

                            <?php
                            $sql_order = selectQuery_tc_order("userid='$userid' and status='paid'","product_id, count, id, tracking_code");
                            $grand_total = 0;
                            foreach ($sql_order as $order){
                            $product_id = $order['product_id'];
                            $sql_product = selectQuery_tc_product("id='$product_id'");
                            $product = $sql_product[0];
                            $price =  ($product['price']/100)*(100-$product['discount']);
                            $total = $price*$order['count'];
                            $grand_total += $total;
                            ?>
                            <div class="product">

                                <div class="product-image">
                                    <img src="<?php echo $product['url_banner']?>">
                                </div>
                                <div class="product-details m-2" style="width: 55%">
                                    <div class="product-title"><?php echo $product['subject']?></div>
                                </div>
                                <div class="product-price2" ><?php echo $price?></div>
                                <div class="product-quantity" style="display: none; width: 0">
                                    <input  type="number" value="<?php echo $order['count']?>" min="1">
                                </div>
                                <div class="product-removal2">
                                    <a href="https://shop.tradicoders.ir/TrC_<?php echo $order['tracking_code']?>" class="NormalLink"><button class="remove-product" id="<?php echo $order['id'];?>">
                                        دانلود فایل
                                    </button></a>
                                </div>
                                <div class="product-line-price" style="display: none; width: 0">0</div>
                            </div>

                            <?php
                            } ?>
                        </div>

                        </div>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content Br20">
     
      <div class="modal-body">
            <h4 class="TextCenter">انتخاب نوع پرداخت</h4>
            <div class="P_TypeOfPayement">
                <div class="TypeOfPayement Active_Pay">
                    <div>
                        <i class="fa-brands fa-internet-explorer IconPay"></i>
                    </div>
                    <div class="PayText">پرداخت انلاین</div>
                </div>
                <div class="TypeOfPayement">
                    <div>
                        <i class="fa-solid fa-wallet IconPay"></i>
                    </div>
                    <div class="PayText">پرداخت با کیف پول</div>
                </div>
            </div>
            <button class="PayBtns">پرداخت</button>
      </div>
      
    </div>
  </div>
</div>

<?php defualtScriptProfile(); ?>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="./js/shooping_cart.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

</body>
</html>
