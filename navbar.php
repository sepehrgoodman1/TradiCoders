<?php $actual_link = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>
<!-- Css Codes -->
<!-- <link rel="stylesheet" href="https://tradicoders.ir/css/global.css"/>
<link rel="stylesheet" href="https://tradicoders.ir/css/main.css"/> -->
<!-- Font Awesome Icon-->
<!-- <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
/> -->

<div class="Headers">
    <!-- Top Navigation Bar -->
    <div class="TopNavigation">
        <!-- Start Just For Mobile -->
        <div class="ToggleMenuButton">
            <i class="fa-solid fa-bars IconToggle"></i>
        </div>
        <!-- End Just For Mobile -->

        <div class="CursorP P_ItemNavbar">
            <?php if ($userid > 0) { ?>
                <div class="P_ImgNav">
                    <img src="https://tradicoders.ir/<?php echo $imgurl;?>" class="ImgNav"/>
                </div>

                <!-- Mobile -->
                <div class="UserName SecondaryColor"><?php echo $fullname;?></div>
                <div class="UserType SecondaryColor">ناحیه کاربری</div>
                <a href="https://tradicoders.ir/profile/accounting.php" class="NormalLink"><div class="PriceInMobile  ">
                    <i class="fa-solid fa-coins"></i>
                    <?php echo $balance;?> تومان
                </div></a>
                <a href="https://tradicoders.ir/profile/accounting.php" class="NormalLink"><div class="PriceInMobile  ">
                    <i class="fa fa-lock"></i>
                    <?php echo $hold;?> تومان
                </div></a>

                <a href="https://tradicoders.ir/profile/index.php?status=open" class="NormalLink"> <div class="PriceInMobile">
                    <i class="fa fa-duotone fa-wallet "></i> <?php echo $prnumber;?> پروژه های باز
                </div></a>
                <a href="https://tradicoders.ir/profile/shopping_cart.php" class="NormalLink"><div class="PriceInMobile  ">
                <i class="fa-solid fa-cart-shopping"></i> <a class="NormalLink" id="shopping_cart_m" ><?php echo (sizeof(selectQuery_tc_order("userid='$userid' and status='pending'")))?></a>
                    سبد خرید
                </div></a>

                
            <?php } ?>
            <!-- Mobile -->
            <a href="https://tradicoders.ir" class="NormalLink   Mb_DisNone"> <div>
                <img
                        src="https://tradicoders.ir/assets/images/Logo.gif"
                        alt="TradicodersLogo"
                        class="MainLogo CursorP"
                />
            </div></a>
            <!-- Start Example of Ative Navbar Item -->
            <a href="https://tradicoders.ir" class="NormalLink"> <div class="ItemNavbar TitleFont <?php if ($action=='index'){echo 'ItemNavbar_Atcive';} ?>">خانه</div></a>
            <!-- End Example of Ative Navbar Item -->

            <a href="https://tradicoders.ir/guide.php" class="NormalLink"><div class="ItemNavbar TitleFont <?php if ($action=='guide'){echo 'ItemNavbar_Atcive';} ?>">راهنما</div></a>
            <a href="https://projects.tradicoders.ir/" class="NormalLink"><div class="ItemNavbar TitleFont <?php if ($action=='doneproject'){echo 'ItemNavbar_Atcive';} ?>">پروژه ها</div></a>
            <a href="https://app.tradicoders.ir/" class="NormalLink"><div class="ItemNavbar TitleFont <?php if ($action=='academy'){echo 'ItemNavbar_Atcive';} ?>">کد آکادمی</div></a>
            <a href="https://shop.tradicoders.ir/" class="NormalLink"><div class="ItemNavbar TitleFont <?php if ($action=='shop'){echo 'ItemNavbar_Atcive';} ?>">فروشگاه</div></a>
            <a href="https://forum.tradicoders.ir/" class="NormalLink"><div class="ItemNavbar TitleFont <?php if ($action=='forum'){echo 'ItemNavbar_Atcive';} ?>">انجمن</div></a>
            <a href="https://articles.tradicoders.ir/" class="NormalLink"><div class="ItemNavbar TitleFont <?php if ($action=='articles'){echo 'ItemNavbar_Atcive';} ?>">مقالات</div></a>
            <a href="https://tradicoders.ir/logout.php" class="NormalLink DeskNone"><div class="ItemNavbar TitleFont ">خروج</div></a>

         

            <!-- for Mobile -->
            <?php if ($userid < 0) { ?>
                <div class="P_Login TitleFont">
                    <a href="https://tradicoders.ir/login.php?url_redirect=<?php echo $actual_link?>" class="NormalLink"> <div class="ItemNavbar">
                        <i class="fa fa-right-to-bracket IconNav"></i> ورود
                    </div></a>
                    <a href="https://tradicoders.ir/register.php" class="NormalLink"> <div class="ItemNavbar">
                        <i class="fa fa-solid fa-user-plus"></i> ثبت نام ها
                    </div></a>
                    <i class="fa-solid fa-xmark CloseIcon"></i>
                </div>
            <?php } ?>
        </div>
        <!-- for Desktop Login -->
        <?php if ($userid < 0) { ?>
            <div class="LognInNav CursorP">
               <a href="https://tradicoders.ir/login.php?url_redirect=<?php echo $actual_link?>" class="NormalLink"> <div class="ItemNavbar TitleFont ">
                    <i class="fa fa-right-to-bracket IconNav"></i> ورود
                </div></a>
               <a href="https://tradicoders.ir/register.php" class="NormalLink"> <div  class="ItemNavbar TitleFont">
                    <i class="fa fa-solid fa-user-plus"></i> ثبت نام
                </div></a>
            </div>
        <?php } else { ?>
            <div class="LognInNav CursorP TitleFont">
               
               
                <a href="https://tradicoders.ir/profile/accounting.php" class="NormalLink"> 
                    <div class="ItemNavbarNew1">
                        <div  class="">
                            <i class="fa-solid fa-coins"></i>
                             <span><?php echo $balance;?> تومان</span> 
                        </div>
                    <!-- <div>
                    <i class="fa fa-lock"></i>
                        <?php echo $hold;?> <span>تومان</span> 
                    </div> -->
                    </div>
                </a>
               

                <!-- <div class="ItemNavbarNew PrimaryColor">
                   
                </div> -->
                <div class="D_Flex_C">
                    <a href="https://tradicoders.ir/profile/index.php?status=open" class="NormalLink"> 
                    <div class="ItemNavbarNew1 PrimaryColor">
                        <i class="fa fa-duotone fa-wallet Ml_5"></i>  <span class="SpanHover"> <?php echo $prnumber;?> پروژه ی باز </span> 
                    </div>
                    </a>
                    <a href="https://tradicoders.ir/profile/shopping_cart.php" class="NormalLink">
                        <div class="ItemNavbarNew1 PrimaryColor">
                            <i class="fa-solid fa-cart-shopping">
                            </i>
                            <span> <?php echo (sizeof(selectQuery_tc_order("userid='$userid' and status='pending'")))?> سبد خرید</span>  
                        </div>
                    </a>
                </div>
                <div class="P_ItemMenuDown ItemNavbarNew BgUserName">
                    <a href="https://tradicoders.ir/profile/" class="NormalLink  "> <div class=" PosRel PrimaryColor">
                        <div class="User WhiteColor"><?php echo $fullname;?>  </div>
                        <!-- <div class="UserTypeDesk">ناحیه کاربری </div> -->
                    </div>
                    <a href="https://tradicoders.ir/logout.php" class="NormalLink ItemMenuDown"> <div class="Fs18 BlackColor">
                    خروج<i class="fa-solid fa-right-from-bracket IconExit"></i>
                    </div></a>
                </span>
            </a>

            </div>
        <?php } ?>
        <!-- for Desktop -->
        <a href="https://tradicoders.ir" class="NormalLink DeskNone"> <div>
                <img
                        src="https://tradicoders.ir/assets/images/Logo.gif"
                        alt="TradicodersLogo"
                        class="MainLogo CursorP"
                />
            </div></a>
       
    </div>

    <!-- End Navigation Bar -->
</div>
<!-- Js Scripts -->
<script src="https://tradicoders.ir/js/HeaderNavBar.js"></script>

