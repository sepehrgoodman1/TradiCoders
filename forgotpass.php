 <?php
require('config.php');
require_once('central.php');
$action = 'forgotpass';

//پیش فرض
$access = false;

if ($text == "") {
//بررسی وضعیت دسترسی کاربر
    include_once('access.php');
}

if($access === true) {
    //انتقال به پنل مدیریت
    header("Location: index.php");
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
?> 
<!DOCTYPE html>
<html lang="fa-IR">
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
            <a href="login.php" class="SignInText">ورود به حساب </a>
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
                  <div class="LoginToTardi TitleFont">بازنشانی رمز عبور</div>
                  
                
                <form method="post" action="forgot_s.php">
                  <!-- Input -->
                    <div id="body1">
                        <div class="P_TwoInput">
                            <!-- Input -->
                            <div class="P_Input_Two">
                                <label class="LabelInput">شماره موبایل</label>
                                <input
                                        id="phonenumber"
                                        onkeyup="changephone()"
                                        type="number"
                                        class="FormInput"
                                        placeholder="شماره موبایل خود را وارد کنید"
                                        required
                                />
                                <input
                                        type="hidden"
                                        name="phonenumber"
                                        id="phonenumber2"
                                />
                            </div>
                            <!-- Input -->
                            <div class="P_Input_Two">
                                <div>
                                    <label class="LabelInput">کد تایید</label>
                                    <div class="PSendCode">
                                        <div class="Flex1">
                                            <input
                                                    id="code_verify"
                                                    name="code_verify"
                                                    type="text"
                                                    onkeyup="checkCode()"
                                                    class="FormInput"
                                                    placeholder="کد ارسال شده را وارد کنید"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Button Send Confirm Code -->

                        <div class="P_SendB">
                            <div
                                    id="send_code_btn"
                                    onclick="sendCode('send')"
                                    class="SendBtn disabled"
                            >
                                ارسال کد تایید
                            </div>
                            <div
                                    id="loading"
                                    style="display: none"
                                    class="loader"
                            ></div>
                        </div>
                    </div>
                    <div style="display: none" id="body2">
                        <div class="P_TwoInput">
                            <!-- Input -->
                            <div class="P_Input_Two">
                                <label class="LabelInput">رمز عبور</label>
                                <input
                                        name="password"
                                        type="password"
                                        class="FormInput"
                                        placeholder="رمز خود را وارد کنید"
                                        required
                                />
                            </div>

                            <!-- Input -->
                            <div class="P_Input_Two">
                                <label class="LabelInput">تکرار رمز عبور </label>
                                <input
                                        name="r_password"
                                        type="password"
                                        class="FormInput"
                                        placeholder="رمز خود را دوباره وارد کنید"
                                        required
                                />
                            </div>
                        </div>
                  <input name="check" type="hidden" value="1" />
                  <div>
                    <button id="register_btn" class="EnterBtn" disabled>
                      بازنشانی رمز عبور
                    </button>
                  </div>
                </form>

                <!-- Sign In For Mobile -->
                <div class="NotAMemberMobile">
                  قبلا ثبت نام کرده اید؟<a href="login.php" class="SignInText">
                    ورود به حساب
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <script>

        function changephone() {
            phone = document.getElementById("phonenumber").value;
            if (phone.length === 11) {
                document.getElementById('send_code_btn').classList.remove('disabled');
            } else {
                document.getElementById('send_code_btn').classList.add('disabled');
            }
        }

        function checkCode() {
            phone = document.getElementById("phonenumber").value;
            code_verify = document.getElementById("code_verify").value;
            if (code_verify.length === 6) {
                document.getElementById('loading').style.display = "block";
                document.getElementById('send_code_btn').style.display = "none";
                var data = "mode=check_authentication&tmobile=" + phone + "&code_by_user=" + code_verify;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        // alert(this.responseText);
                        if (this.responseText === "true") {
                            document.getElementById('loading').style.display = "none";
                            document.getElementById('send_code_btn').style.display = "block";
                            document.getElementById('send_code_btn').innerText = "تایید شد";
                            document.getElementById('send_code_btn').classList.add('disabled');
                            document.getElementById('send_code_btn').onclick = function () {

                            }
                            document.getElementById("phonenumber2").value = phone;
                            document.getElementById('register_btn').disabled = false;
                            document.getElementById('body1').style.display = "none";
                            document.getElementById('body2').style.display = "block";
                        } else {
                            document.getElementById('loading').style.display = "none";
                            document.getElementById('send_code_btn').style.display = "block";
                            document.getElementById('send_code_btn').innerText = "کد وارد شده صحیح نیست";
                            document.getElementById("code_verify").value = "";
                        }
                    }
                };
                xmlhttp.open("GET", "sms.php?" + data, true);
                xmlhttp.send();
            }
        }

        function chckPhoneExist(phone){
            var data = "mode=check_phone&tmobile=" + phone;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // alert(this.responseText);
                    if (this.responseText > 0) {
                        document.getElementById('loading').style.display = "block";
                        document.getElementById('send_code_btn').style.display = "none";
                        var data2 = "mode=send_authentication&tmobile=" + phone+"&special=<?php echo $pagecontent[28]; ?>";
                        var xmlhttp2 = new XMLHttpRequest();
                        xmlhttp2.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {
                                // alert(this.responseText);
                                if (this.responseText > 2000) {
                                    document.getElementById('loading').style.display = "none";
                                    document.getElementById('send_code_btn').style.display = "block";
                                    document.getElementById('send_code_btn').innerText = "کد ارسال شده را وارد کنید";
                                    document.getElementById('send_code_btn').onclick = function () {
                                        sendCode('check');
                                    }
                                }
                            }
                        };
                        xmlhttp2.open("GET", "sms.php?" + data2, true);
                        xmlhttp2.send();
                    }else {
                        document.getElementById('send_code_btn').innerText = "شماره تلفن یافت نشد";
                    }
                }
            };
            xmlhttp.open("GET", "sms.php?" + data, true);
            xmlhttp.send();
        }

        function sendCode(mode) {

            phone = document.getElementById("phonenumber").value;
            code_verify = document.getElementById("code_verify").value;

            if (phone.length === 11 && mode === "send") {
                chckPhoneExist(phone);
            }
        }
        function autooff(){
            document.getElementById('code_verify').value ="";
        }
        setTimeout(autooff, 100);
    </script>
  </body>
</html>
