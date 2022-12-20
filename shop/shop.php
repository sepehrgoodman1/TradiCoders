<?php

$action = 'shop';

?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
   

   <!-- Css Codes -->
   <link rel="stylesheet" href="https://tradicoders.ir/css/global.css"/>
     <link rel="stylesheet" href="https://tradicoders.ir/css/main.css"/>
     <link rel="stylesheet" href="../css/fonts.css"/>

   <!-- Dynamic Meta Deskription -->
   <?php
    $sql_meta = selectQuery_tc_meta("action='$action'");
    $sql_meta = $sql_meta[0];
    $title = $sql_meta['title'];
    $keywords = $sql_meta['keywords'];
    $description = $sql_meta['description'];
    defualtMeta($title, $keywords, $description); ?>

    <link rel="icon" type="image/x-icon" href="https://tradicoders.ir/assets/images/Logo.gif">

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
<body>
<?php require('../navbar.php') ?>
<br>
<div class="MainWrapper">
    <!-- Filters -->
    <div class="Filters SecondaryColor">
        <div>
            <div class="ItemFilter ItemFilter_Atcive" onclick="ShowPannel(0)">
                همه
            </div>
            <div class="ItemFilter" onclick="ShowPannel(1)">متا تریدر 4</div>
            <div class="ItemFilter" onclick="ShowPannel(2)">متا تریدر 5</div>
            <div class="ItemFilter" onclick="ShowPannel(3)">رایگان</div>
        </div>
    </div>
    <div class="LineFilter"></div>



    <!-- Start For Tab 1  -->
    <!-- Start Best Projects -->
    <div class="MyTab">
        <div class=" WrapperBestPriojects">
            <?php $sql_product = selectQuery_tc_product("status='publish'");
            foreach ($sql_product as $product) {
                $product_id = $product['id'];
                $sql_order = selectQuery_tc_order("userid='$userid' and product_id='$product_id' and status='pending'");
                ?>
                <!-- Item -->
                <div class="BestProject">
                    <div class="PosRel">
                        <img
                                src="<?php echo json_decode($product['url_banner'], true)[0] ?>"
                                class="BestProjImage"
                                alt=""
                        />
                        <?php
                        if ($product['discount'] != 0) {
                            ?>
                            <div class="DiscountBanner">
                                <img src="https://tradicoders.ir/assets/images/banner3.png" class="ImgDis" alt="">
                                <div class="TextOfTakh">
                                    <span class="Fs16">تخفیف</span> <br/>  <?= $product['discount'] ?>%
                                </div>

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="TiteBestProj TitleFont"><?php echo $product['subject'] ?></div>
                    <div class="DeskBestProj TitleFont">
                        <?php

                        if (mb_strlen(trim($product["description"])) > 120) {
                            echo mb_substr(trim($product["description"]), 0, 120, 'UTF-8') . " ...";
                        } else {
                            echo $product["description"];
                        } ?>
                    </div>
                    <div class="NumOfSell">تعداد فروش : <strong><?= sizeof(selectQuery_tc_order("product_id='$product_id'")) ?></strong></div>
                    <div class="PriceBest TitleFont"><?php if ($product['discount'] == 0) {
                            echo $product['price'];
                        } else {
                            echo  ($product['price'] / 100) * (100 - $product['discount']) . "<del class='DiscountText'>" . $product['price'] . "</del>"  . " تومان" ;
                        } ?> </div>
                    <div class="P_AddToShop">
                        <?php
                        if (sizeof($sql_order) == 0){
                            ?>
                            <div class="Flex1 Ml_10">
                                <button onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>')" id="add_btn" class="AddToShop">افزودن به سبد خرید <i class="fa-solid fa-bag-shopping"></i></button>
                            </div>
                        <?php }else{ ?>
                            <div class="Flex1 Ml_10">
                                <button onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>')" id="add_btn" class="BtnCardShop bg-success">حذف از سبد خرید</button>
                            </div>
                        <?php } ?>
                        <!--                            <div class="Flex1 Ml_10">-->
                        <!--                                <button class="AddToShop">افزودن به سبد خرید</button>-->
                        <!--                            </div>-->
                        <a class="Flex1" onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>','demo')" href="<?php if ($userid > 0){echo str_replace("https://tradicoders.ir/./shop/","",$product['url_demo']);}else{echo "https://tradicoders.ir/login.php?url_redirect="."https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];} ?>" class="NormalLink Mb_W100" download>
                            <div>
                                <button class="DownDemo">دانلود دمو</button>
                            </div>
                        </a>
                    </div>
                    <a href="<?php echo $product['subject'].'__'.$product['id'] ?>" class="NormalLink W100"><button class="BtnShowBest TitleFont">مشاهده کامل پروژه</button></a>
                </div>

                <!-- Item -->
            <?php } ?>
        </div>
    </div>
    <!-- End Best Projects -->
    <!-- End For Tab 1  -->



    <!-- Start For Tab 1  -->
    <!-- Start Best Projects -->
    <div class="MyTab">
        <div class=" WrapperBestPriojects">
            <?php $sql_product = selectQuery_tc_product("status='publish' and category='1'");
            foreach ($sql_product as $product) {
                $product_id = $product['id'];
                $sql_order = selectQuery_tc_order("userid='$userid' and product_id='$product_id' and status='pending'");
                ?>
                <!-- Item -->
                <div class="BestProject">
                    <div class="PosRel">
                        <img
                                src="<?php echo json_decode($product['url_banner'], true)[0] ?>"
                                class="BestProjImage"
                                alt=""
                        />
                        <?php
                        if ($product['discount'] != 0) {
                            ?>
                            <div class="DiscountBanner">
                                <img src="https://tradicoders.ir/assets/images/banner3.png" class="ImgDis" alt="">
                                <div class="TextOfTakh">
                                    <span class="Fs16">تخفیف</span> <br/>  <?= $product['discount'] ?>%
                                </div>

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="TiteBestProj TitleFont"><?php echo $product['subject'] ?></div>
                    <div class="DeskBestProj TitleFont">
                        <?php

                        if (mb_strlen(trim($product["description"])) > 120) {
                            echo mb_substr(trim($product["description"]), 0, 120, 'UTF-8') . " ...";
                        } else {
                            echo $product["description"];
                        } ?>
                    </div>
                    <div class="NumOfSell">تعداد فروش : <strong><?= sizeof(selectQuery_tc_order("product_id='$product_id'")) ?></strong></div>
                    <div class="PriceBest TitleFont"><?php if ($product['discount'] == 0) {
                            echo $product['price'];
                        } else {
                            echo  ($product['price'] / 100) * (100 - $product['discount']) . "<del class='DiscountText'>" . $product['price'] . "</del>"  . " تومان" ;
                        } ?> </div>
                    <div class="P_AddToShop">
                        <?php
                        if (sizeof($sql_order) == 0){
                            ?>
                            <div class="Flex1 Ml_10">
                                <button onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>')" id="add_btn" class="AddToShop">افزودن به سبد خرید <i class="fa-solid fa-bag-shopping"></i></button>
                            </div>
                        <?php }else{ ?>
                            <div class="Flex1 Ml_10">
                                <button onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>')" id="add_btn" class="BtnCardShop bg-success">حذف از سبد خرید</button>
                            </div>
                        <?php } ?>
                        <!--                            <div class="Flex1 Ml_10">-->
                        <!--                                <button class="AddToShop">افزودن به سبد خرید</button>-->
                        <!--                            </div>-->
                        <a class="Flex1" onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>','demo')" href="<?php if ($userid > 0){echo str_replace("https://tradicoders.ir/./shop/","",$product['url_demo']);}else{echo "https://tradicoders.ir/login.php?url_redirect="."https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];} ?>" class="NormalLink Mb_W100" download>
                            <div>
                                <button class="DownDemo">دانلود دمو</button>
                            </div>
                        </a>
                    </div>
                    <a href="<?php echo $product['subject'].'__'.$product['id'] ?>" class="NormalLink W100"><button class="BtnShowBest TitleFont">مشاهده کامل پروژه</button></a>
                </div>

                <!-- Item -->
            <?php } ?>
        </div>
    </div>
    <!-- End Best Projects -->
    <!-- End For Tab 1  -->




    <!-- Start For Tab 1  -->
    <!-- Start Best Projects -->
    <div class="MyTab">
        <div class=" WrapperBestPriojects">
            <?php $sql_product = selectQuery_tc_product("status='publish' and category='2'");
            foreach ($sql_product as $product) {
                $product_id = $product['id'];
                $sql_order = selectQuery_tc_order("userid='$userid' and product_id='$product_id' and status='pending'");
                ?>
                <!-- Item -->
                <div class="BestProject">
                    <div class="PosRel">
                        <img
                                src="<?php echo json_decode($product['url_banner'], true)[0] ?>"
                                class="BestProjImage"
                                alt=""
                        />
                        <?php
                        if ($product['discount'] != 0) {
                            ?>
                            <div class="DiscountBanner">
                                <img src="https://tradicoders.ir/assets/images/banner3.png" class="ImgDis" alt="">
                                <div class="TextOfTakh">
                                    <span class="Fs16">تخفیف</span> <br/>  <?= $product['discount'] ?>%
                                </div>

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="TiteBestProj TitleFont"><?php echo $product['subject'] ?></div>
                    <div class="DeskBestProj TitleFont">
                        <?php

                        if (mb_strlen(trim($product["description"])) > 120) {
                            echo mb_substr(trim($product["description"]), 0, 120, 'UTF-8') . " ...";
                        } else {
                            echo $product["description"];
                        } ?>
                    </div>
                    <div class="NumOfSell">تعداد فروش : <strong><?= sizeof(selectQuery_tc_order("product_id='$product_id'")) ?></strong></div>
                    <div class="PriceBest TitleFont"><?php if ($product['discount'] == 0) {
                            echo $product['price'];
                        } else {
                            echo  ($product['price'] / 100) * (100 - $product['discount']) . "<del class='DiscountText'>" . $product['price'] . "</del>"  . " تومان" ;
                        } ?> </div>
                    <div class="P_AddToShop">
                        <?php
                        if (sizeof($sql_order) == 0){
                            ?>
                            <div class="Flex1 Ml_10">
                                <button onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>')" id="add_btn" class="AddToShop">افزودن به سبد خرید <i class="fa-solid fa-bag-shopping"></i></button>
                            </div>
                        <?php }else{ ?>
                            <div class="Flex1 Ml_10">
                                <button onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>')" id="add_btn" class="BtnCardShop bg-success">حذف از سبد خرید</button>
                            </div>
                        <?php } ?>
                        <!--                            <div class="Flex1 Ml_10">-->
                        <!--                                <button class="AddToShop">افزودن به سبد خرید</button>-->
                        <!--                            </div>-->
                        <a class="Flex1" onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>','demo')" href="<?php if ($userid > 0){echo str_replace("https://tradicoders.ir/./shop/","",$product['url_demo']);}else{echo "https://tradicoders.ir/login.php?url_redirect="."https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];} ?>" class="NormalLink Mb_W100" download>
                            <div>
                                <button class="DownDemo">دانلود دمو</button>
                            </div>
                        </a>
                    </div>
                    <a href="<?php echo $product['subject'].'__'.$product['id'] ?>" class="NormalLink W100"><button class="BtnShowBest TitleFont">مشاهده کامل پروژه</button></a>
                </div>

                <!-- Item -->
            <?php } ?>
        </div>
    </div>
    <!-- End Best Projects -->
    <!-- End For Tab 1  -->



    <!-- Start For Tab 1  -->
    <!-- Start Best Projects -->
    <div class="MyTab">
        <div class=" WrapperBestPriojects">
            <?php $sql_product = selectQuery_tc_product("price='0' or discount='100'");
            foreach ($sql_product as $product) {
                $product_id = $product['id'];
                $sql_order = selectQuery_tc_order("userid='$userid' and product_id='$product_id' and status='pending'");
                ?>
                <!-- Item -->
                <div class="BestProject">
                    <div class="PosRel">
                        <img
                                src="<?php echo json_decode($product['url_banner'], true)[0] ?>"
                                class="BestProjImage"
                                alt=""
                        />
                        <?php
                        if ($product['discount'] != 0) {
                            ?>
                            <div class="DiscountBanner">
                                <img src="https://tradicoders.ir/assets/images/banner3.png" class="ImgDis" alt="">
                                <div class="TextOfTakh">
                                    <span class="Fs16">تخفیف</span> <br/>  <?= $product['discount'] ?>%
                                </div>

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="TiteBestProj TitleFont"><?php echo $product['subject'] ?></div>
                    <div class="DeskBestProj TitleFont">
                        <?php

                        if (mb_strlen(trim($product["description"])) > 120) {
                            echo mb_substr(trim($product["description"]), 0, 120, 'UTF-8') . " ...";
                        } else {
                            echo $product["description"];
                        } ?>
                    </div>
                    <div class="NumOfSell">تعداد فروش : <strong><?= sizeof(selectQuery_tc_order("product_id='$product_id'")) ?></strong></div>
                    <div class="PriceBest TitleFont"><?php if ($product['discount'] == 0) {
                            echo $product['price'];
                        } else {
                            echo  ($product['price'] / 100) * (100 - $product['discount']) . "<del class='DiscountText'>" . $product['price'] . "</del>"  . " تومان" ;
                        } ?> </div>
                    <div class="P_AddToShop">
                        <?php
                        if (sizeof($sql_order) == 0){
                            ?>
                            <div class="Flex1 Ml_10">
                                <button onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>')" id="add_btn" class="AddToShop">افزودن به سبد خرید <i class="fa-solid fa-bag-shopping"></i></button>
                            </div>
                        <?php }else{ ?>
                            <div class="Flex1 Ml_10">
                                <button onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>')" id="add_btn" class="BtnCardShop bg-success">حذف از سبد خرید</button>
                            </div>
                        <?php } ?>
                        <!--                            <div class="Flex1 Ml_10">-->
                        <!--                                <button class="AddToShop">افزودن به سبد خرید</button>-->
                        <!--                            </div>-->
                        <a class="Flex1" onclick="addOrder('<?php echo $product['id'] ?>',<?php echo sizeof($sql_order);?>,'<?php echo $sql_order[0]['id'];?>','demo')" href="<?php if ($userid > 0){echo str_replace("https://tradicoders.ir/./shop/","",$product['url_demo']);}else{echo "https://tradicoders.ir/login.php?url_redirect="."https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];} ?>" class="NormalLink Mb_W100" download>
                            <div>
                                <button class="DownDemo">دانلود دمو</button>
                            </div>
                        </a>
                    </div>
                    <a href="<?php echo $product['subject'].'__'.$product['id'] ?>" class="NormalLink W100"><button class="BtnShowBest TitleFont">مشاهده کامل پروژه</button></a>
                </div>

                <!-- Item -->
            <?php } ?>
        </div>
    </div>
    <!-- End Best Projects -->
    <!-- End For Tab 1  -->



</div>
<!-- Java scripts Codes -->
<script src="js/TabChanger.js"></script>
<script src="js/Projects.js"></script>
</body>
</html>
<script>
    <?php
    if (isset($_GET['tab'])){
    ?>
    ShowPannel(<?= $_GET['tab']; ?>);
    <?php
    }else{
    ?>
    ShowPannel(0);
    <?php
    }
    ?>
</script>
<script src="js/Projects.js"></script>


