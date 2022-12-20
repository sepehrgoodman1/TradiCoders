 <?php
require('config.php');
require_once('central.php');
$action = 'login';

//پیش فرض
$access = false;

if ($text == "") {
//بررسی وضعیت دسترسی کاربر
    include_once('access.php');
}

if($access === true) {
    //انتقال به پنل مدیریت
    openLink("index.php");
    exit;
}

//اگر فرم ارسال نشده باشد
if(!isset($check)) {
    $text = null;
    $email = null;
    $checked = null;
}
if ($text != ""){
    alert($text);
}

 function signup_github()
 {
     $client_id = 'Iv1.f1307f96b4367a42';
     $redirect_url = 'https://tradicoders.ir/githublogin.php';

     //login request
     if($_SERVER['REQUEST_METHOD'] == 'GET')
     {
         $url = "https://github.com/login/oauth/authorize?client_id=$client_id&amp;redirect_uri=$redirect_url&amp;scope=user&quot";
         openLink($url);
     }
 }



?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Css Codes -->
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/fonts.css"/>

     <!-- Dynamic Meta Deskription -->
     <?php
        $sql_meta = selectQuery_tc_meta("action='$action'");
        $sql_meta = $sql_meta[0];
        $title = $sql_meta['title'];
        $keywords = $sql_meta['keywords'];
        $description = $sql_meta['description'];
        defualtMeta($title, $keywords, $description); ?>

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
    <div>
      <div class="Wrapper BgRegister">
      
        <div class="RightSide Z100">
          <!-- Sign In For Desktop -->
          <div class="NotAMember">
            عضو نیستید؟ <a href="register.php" class="SignInText">ثبت نام کنید </a>
          </div>
          <a href="/" class="MbDisNone">
            <img
              src="/assets/images/Logo.gif"
              alt="Logo TardiCoders"
              class="LogoTradi"
            />
          </a>
         
          <!-- Start Forms -->
          <div>
            <div class="WrapperForms">
              <div class="P_WrapperForms">
                  <div class="LoginToTardi TitleFont">ورود به تریدی کدرز</div>

                <form action="login_s.php<?php if (isset($_GET['url_redirect'])){echo '?url_redirect='.$_GET['url_redirect'];} ?>" method="post">
                  <!-- Inputs -->
                  <div class="P_Input">
                    <label class="LabelInput">شماره موبایل</label>
                    <input
                      type="number"
                      name="phonenumber"
                      class="FormInput"
                      placeholder="شماره موبایل خود را وارد کنید"
                    />
                  </div>
                  <!-- Inputs -->
                  <div class="P_Input">
                    <label class="LabelInput">رمز عبور</label>
                    <input
                      type="password"
                      class="FormInput"
                      name="password"
                      placeholder="رمز خود را وارد کنید"
                    />
                  </div>
                  <div>
                    <button class="EnterBtn">ورود</button>
                    <button type="button" onclick="OpenLink('googlelogin.php')" class="EnterWithGoogleBtn"><img src="assets/images/LogInGoogle.png" class="LogInWithGoogle"/> ورود با گوگل</button>
                    <button type="button" onclick="OpenLink('githublogin.php')" class="EnterWithGoogleBtn"><img src="assets/images/Github.png" class="LogInWithGoogle"/> ورود با گیت هاب</button>
                  </div>
                  <div class="ForgetPassText">رمز خودرا فراموش کرده اید؟ <a href="forgotpass.php" class="SignInTextBlue">بازنشانی رمز عبور</a></div>


                  <!-- Sign In For Mobile -->
                  <div class="NotAMemberMobile">
                    عضو نیستید؟ <a href="register.php" class="SignInText">ثبت نام کنید </a>
                  </div>
                    <input name="check" type="hidden" value="1">
                </form>

              </div>
            </div>
          </div>
        </div>
       
      </div>
    </div>
  </body>
 <script>
     function OpenLink(link){
         window.open(link, '_self');
     }

 </script>
</html>
