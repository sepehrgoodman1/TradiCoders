<?php
require("backend_header.php");

$pageName = 'مدیریت فروشگاه';
$pageAddress = 'mshop';


if (permissionPageInside($pageAddress) || $role == 'admin') {

    if (isset($_POST['status'])){
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $status = $_POST['status'];
        $product_id = $_POST['product_id'];

        updateQuery("tc_product", "author='$userid' ,price='$price', discount='$discount', status='$status'", "id='$product_id'");
    }elseif ($_POST['trash']){
        $product_id = $_POST['trash'];
        updateQuery("tc_product", "author='$userid' , status='trash'", "id='$product_id'");
    }

    ?>
<!DOCTYPE html>
<html lang="fa-IR">
  <head>
      <?php
      // insert all css file and meta file and set meta tag

      $title = 'پروفایل | مدیریت | مدیریت سوالات متداول';
      $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
      $description = 'شما می توانید از این بخش منابع مالی و خروجی و ورودی های خود را بررسی کنید و درخواست های مالی خود را ثبت کنید';
      $icon = '../tradi-coders-logo-final.gif';
      defualtMetaAndStyleProfile($title, $keywords, $description, $icon);
      // ./insert all css file and meta file and set meta tag
      ?>
    <!-- My Css -->
    <link rel="stylesheet" href="../css/global.css" />
    <link rel="stylesheet" href="css/profile.css" />
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css" />


      <!-- Vendor CSS Files -->
      <link href="assets/bootstrap.min.css" rel="stylesheet">
      <link href="assets/bootstrap-icons.css" rel="stylesheet">
      <link href="assets/boxicons.min.css" rel="stylesheet">
      <link href="assets/quill.snow.css" rel="stylesheet">
      <link href="assets/quill.bubble.css" rel="stylesheet">
      <link href="assets/remixicon.css" rel="stylesheet">
      <link href="assets/style.css" rel="stylesheet">


  </head>
  <body class="Rtl P30">
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

          <div class="P_Tab_Prod">
              <a href="mshop.php" class="NormalLink"><div class="Prod_Filter <?php if (!isset($_GET['view'])){ echo "Active_Prod";}?>">همه</div></a>
              <a href="mshop.php?view=publish" class="NormalLink"> <div class="Prod_Filter <?php if (isset($_GET['view']) && $_GET['view'] == "publish") echo "Active_Prod" ?>"  >محصولات فعال</div></a>
              <a href="mshop.php?view=trash" class="NormalLink"> <div class="Prod_Filter <?php if (isset($_GET['view']) && $_GET['view'] == "trash") echo "Active_Prod" ?>" >حذف شده ها</div></a>
              <a href="mshop.php?view=pending" class="NormalLink"><div class="Prod_Filter <?php if (isset($_GET['view']) && $_GET['view'] == "pending") echo "Active_Prod" ?>" >پیش نویس</div></a>
              <button class="AddProd">افزودن محصول</button>
          </div>

          <div class="P_Table">
              <table class="table table-striped">
                  <thead>
                  <tr class="TextStart">
                      <th scope="col">محصول</th>
                      <th  class="Status">وضعیت</th>
                      <th scope="col">تخفیف %</th>
                      <th scope="col">قیمت (تومان)</th>
                      <th scope="col">تعغیرات</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $where = "";
                  if (isset($_GET['view']) && ($_GET['view'] == "trash" || $_GET['view'] == "pending" || $_GET['view'] == "publish")){
                      $view = $_GET['view'];
                      $where = "status='$view'";
                  }
                  $sql_product = selectQuery_tc_product($where);
            foreach ($sql_product as $product){
            ?>
            <tr class="TextStart">
              <td>
                <div>
                  <img
                    src="<?php echo $product['url_banner'];?>"
                    alt="image product"
                    class="ImgProd"
                  />
                  <span class="TextProd"><?php echo $product['subject'];?></span>
                </div>
              </td>
                <form action="" method="post">
                <td scope="row" class="W40">
                    <select class="form-select" name="status">
                        <option value="pending" <?php if ($product['status'] == "pending") echo "selected";?>> pending
                        </option>
                        <option value="trash"<?php if ($product['status'] == "trash") echo "selected";?>> trash
                        </option>
                        <option value="publish"<?php if ($product['status'] == "publish") echo "selected";?>> publish
                        </option>

                    </select>
                </td>
              <td>
                <input type="number" max="100" min="0" name="discount" value="<?php echo $product['discount'];?>" class="InputOfPrice W64" />
              </td>
              <td>
                <input type="text" name="price" value="<?php echo $product['price'];?>" class="InputOfPrice" />
              </td>
                    <input type="hidden" name="product_id" value="<?php echo $product['id'];?>">
                    <input id="<?php echo $product['id'];?>_change" type="submit" hidden>
                </form>
              <td>
                <button onclick="document.getElementById('<?php echo $product['id'];?>_change').click()" class="FastChange">اصلاح سریع</button>
                <a href="manage_product.php?edit=<?php echo $product['id'];?>" class="NormalLink"><button class="NormalChange">اصلاح</button></a>
                  <form method="post" action="">
                      <input type="hidden" name="trash" value="<?php echo $product['id'];?>">
                      <button type="submit" class="DeleteProd">حذف</button>
                  </form>
              </td>
            </tr>

          <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </body>

  <?php
  // insert script file
  defualtScriptProfile();
  // ./insert script file
  ?>

  <script>
      $.widget.bridge('uibutton', $.ui.button)
  </script>
</html>
<?php
}
?>