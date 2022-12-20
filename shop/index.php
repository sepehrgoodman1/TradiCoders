<?php
require('required_page.php');
$action = 'shop';

if (isset($_GET['id']) && strpos($_GET['id'], 'TrC_') === false) {
    $action = 'shop';
    $product_id = explode("__", $_GET['id']);
    $product_sub = $product_id[0];
    $product_id = $product_id[1];
    $sql_product = selectQuery_tc_product("id='$product_id' and subject='$product_sub'");
    if (sizeof($sql_product) == 0){
        openLink("https://shop.tradicoders.ir");
    }
    $product = $sql_product[0];
    ?>
    <!DOCTYPE html>
    <html lang="fa-IR">
    <head>
        <?php
        $keywords = $product['tags'];
        $title = $product['meta_title'];
        $description = mb_substr(trim($product['meta_description']), 0, 120, 'UTF-8');
        defualtMeta($title, $keywords, $description); ?>
        <!-- Css Codes -->
     <link rel="stylesheet" href="https://tradicoders.ir/css/global.css"/>
     <link rel="stylesheet" href="https://tradicoders.ir/css/main.css"/>
     <link rel="stylesheet" href="../css/fonts.css"/>
        <link rel="stylesheet" href="css/shop.css"/>


        <!-- Dynamic Meta Deskription -->

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

         <!-- Hotjar Tracking Code for https://tradicoders.ir/ -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:3267684,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>

    </head>
    <body>
    <?php require('../navbar.php') ?>
    <br>
    <div class="OriginWrapper">
        <div class="TitleCrd">
            <?php echo $product['subject'] ?>
            <span class="VersionCard">نسخه <?php echo $product['version'] ?> </span>
        </div>
        <div class="P_ImageAndSide Ltr">
            <div class="P_ImgCard">
                <div class="PosRel">
                    <img src="<?php echo json_decode($product['url_banner'], true)[0] ?>" class="CardImg" alt=""/>
                    <?php
                    $sql_order = selectQuery_tc_order("userid='$userid' and product_id='$product_id' and status='pending'");
                    ?>
                    
                </div>
            </div>
            <div class="DetailCard">
                <div class="P_Sell PosRel">
                    <span class="Devider"></span>
                    <div class="Sell">
                        <div class="Fs24 M_Fs24 Fw600 SellColor"><?php echo sizeof(selectQuery_tc_order("product_id='$product_id' and status='paid'")) ?></div>
                        <div class="Fs24 Op5">فروش</div>
                    </div>

                    <div class="Sell">
                        <div id="count_demo"  class="Fs24 M_Fs24 Fw600 SellColor"><?php echo sizeof(selectQuery_tc_order("product_id='$product_id' and status='demo'")) ?></div>
                        <div class="Fs24 Op5">دانلود دمو</div>
                    </div>
<!--                    <div class="Sell">-->
<!--                        <div class="Fs24 M_Fs24 Fw600 PrimaryColor">--><?php //echo $product['rate'] . '% <br>' . ' رای: ' . $product['rate_number'] . ' نفر' ?><!--</div>-->
<!--                        <div class="Fs24 Op5">رضایت</div>-->
<!--                    </div>-->
                </div>
                <div>
                    <?php
                    foreach (explode(",", $product['attributes_id']) as $attr_id) {
                        $sql_attr = selectQuery_tc_attribute_product("id='$attr_id'");
                        foreach ($sql_attr as $attr) { ?>
                            <div class="TextDetalCard">
                                <i class="fa-solid fa-check IconDetailCard"></i>
                                <?php echo $attr['subject']?>
                            </div>
                        <?php }
                    }
                    ?>
                </div>
                <div class="P_PriceCard">
                    <div class="Op5">قیمت محصول</div>
                    <?php if ($product['discount'] != 0) {
                        $discount = ($product['price'] / 100) * (100 - $product['discount']);
                        ?>
                        <div class="Del DiscountText"><del><?php echo $product['price'] ?> <span class="JustMobile">تومان</span></del></div>
                        <div class="Fs24"><?php echo $discount ?> تومان</div>
                        <?php
                    } else {
                        ?>
                        <div class="Fs24"><?php echo $product['price'] ?> تومان</div>
                        <?php
                    } ?>
                </div>
                <div class="P_Share Ltr">

                    <?php
                    if (sizeof($sql_order) == 0){
                    ?>
                    <button onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>')" id="add_btn" class="BtnCardShop">افزودن به سبد خرید <i class="fa-solid fa-bag-shopping"></i></button>
                    <?php }else{ ?>
                    <button onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>')" id="add_btn" class="BtnCardShop bg-success">حذف از سبد خرید</button>
                    <?php } ?>
                    <!-- <div class="ShareBtn">
                        <i class="fa-solid fa-share-nodes"></i>
                    </div> -->
                    <a onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>','demo')" href="<?php if ($userid > 0){echo str_replace("https://tradicoders.ir/./shop/","",$product['url_demo']);}else{echo "https://tradicoders.ir/login.php?url_redirect="."https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];} ?>" class="NormalLink Mb_W100" download>
                        <button  class="DemoVersion">
                            دانلود نسخه دمو <i class="fa-solid fa-arrow-down IconDown"></i>
                        </button>
                    </a>
                </div>
                
            </div>
        </div>
        <div class="StartDesk">
            <div class="TitleOfTabs">
                <div class="ItemFilter C_TitleOfTabs">توضیحات</div>
                <div class="ItemFilter C_TitleOfTabs">محصولات مشابه</div>
               <div class="ItemFilter C_TitleOfTabs">ویدیو</div>
               <div class="ItemFilter C_TitleOfTabs">گالری</div>
            </div>
            <!-- Start Tabs -->

            <!-- Tab 0 -->
            <div class="MyTab">
                <div class="TitleTozihat">معرفی <?php echo $product['subject'] ?></div>
                <div class="DeskTozihat">
                    <?php echo $product['description'] ?>
                </div>
            </div>
            <!-- End Tab 0 -->

            <!-- End Tabs -->
            <div class="MyTab">
                <div class=" WrapperBestPriojects">
                    <?php $category = $product['category'];
                    $sql_product = selectQuery_tc_product("status='publish' and category='$category'");
                    foreach ($sql_product as $product) {
                        ?>
                        <!-- Item -->
                        <div class="BestProject">
                            <div>
                                <img
                                        src="<?php echo json_decode($product['url_banner'], true)[0] ?>"
                                        class="BestProjImage"
                                        alt=""
                                />
                            </div>
                            <div class="TiteBestProj TitleFont"><?php echo $product['subject'] ?></div>
                            <div class="DeskBestProj TitleFont">
                                <?php if (mb_strlen(trim($product["description"])) > 120) {
                                    echo mb_substr(trim($product["description"]), 0, 120, 'UTF-8') . " ...";
                                } else {
                                    echo $product["description"];
                                } ?>
                            </div>
                            <div class="PriceBest TitleFont"><?php if ($product['discount'] == 0) {
                                    echo $product['price'];
                                } else {
                                    echo "<del>" . $product['price'] . "</del>" . "<br>" . ($product['price'] / 100) * (100 - $product['discount']) . " تومان";
                                } ?> </div>
                            <a href="<?php echo $product['subject'].'__'.$product['id'] ?>" class="NormalLink W100"><button class="BtnShowBest TitleFont">مشاهده کامل پروژه</button></a>
                        </div>
                        <!-- Item -->
                    <?php } ?>
                </div>
            </div>
            <div class="MyTab">
                <div>ویدیو</div>
            </div>
            <div class="MyTab">
                <div class="WrapperGallery">
                    <div>
                        <img src="https://tradicoders.ir/assets/images/FooterImage.jpg" class="ImgGallery" alt="">
                    </div>
                    <div>
                        <img src="https://tradicoders.ir/assets/images/FooterImage.jpg" class="ImgGallery" alt="">
                    </div> 
                    <div>
                        <img src="https://tradicoders.ir/assets/images/FooterImage.jpg" class="ImgGallery" alt="">
                    </div> 
                    <div>
                        <img src="https://tradicoders.ir/assets/images/FooterImage.jpg" class="ImgGallery" alt="">
                    </div>
                    <div>
                        <img src="https://tradicoders.ir/assets/images/BgMain.jpg" class="ImgGallery" alt="">
                    </div>
                    <div>
                        <img src="https://tradicoders.ir/assets/images/articleImg.jpg" class="ImgGallery" alt="">
                    </div>
                    
                </div>
            </div>
        </div>

    </div>
    <!-- Java scripts Codes -->
    <script src="js/TabChanger.js"></script>
    </body>
    </html>

    <?php
} else if (!isset($_GET['id'])) {
    require("shop.php");
}else if (isset($_GET['id']) && strpos($_GET['id'], 'TrC_') !== false){
    if ($userid > 0){
    $tracking_code = str_replace("TrC_","",$_GET['id']);
    $sql_order = selectQuery_tc_order("userid='$userid' and tracking_code='$tracking_code' ");
    if (sizeof($sql_order) == 1){
        $order = $sql_order[0];
        $product_id = $order['product_id'];
        $sql_product = selectQuery_tc_product("id='$product_id'");
        $product = $sql_product[0];
        $status = $order['status'];
        if ($status == "paid"){
            $url = str_replace("https://tradicoders.ir/../shop/assets/file/", "",$product['url_base']);
            $name = explode(".", $url);
            $file = $name[0];
            $type = $name[1];
        }else{
            openLink("index.php");
        }

    }else{
        openLink("index.php");
    }

    ?>

    <script>
        function downloadFile(name, type, track){
            var file = "assets/file/"+name+"."+type;
            const a = document.createElement("a");
            a.href = file;
            a.download = track+"."+type;
            a.click();


        }
        downloadFile('<?php echo $file;?>', '<?php echo $type;?>', '<?php echo $tracking_code;?>');
    </script>
<?php
    }
}
?>
