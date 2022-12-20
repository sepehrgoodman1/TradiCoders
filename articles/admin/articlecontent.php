<?php
require('../../config.php');
$arid = $_GET['id'];
$sql = "SELECT subject, category, body, viewnum,tags,author FROM tc_article WHERE id='$arid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $articleSubject = $row['subject'];
        $articlecategory = $row['category'];
        $articlebody = $row['body'];
        $articleViewnum = $row['viewnum'];
        $tags = $row['tags'];
        $authorid = $row["author"];
        if(strpos($tags,"programming")>0)
        {
            $tags1=" <a href='#programming'>برنامه نویسی</a> ";
            $tagholder1 = "programming";
        }
        if(strpos($tags,"algotrading")>0)
        {
            $tags2=" <a href='#algotrading'>معاملات الگوریتمی</a> ";
        }
        if(strpos($tags,"analysis")>0)
        {
            $tags3=" <a href='#analysis'>روش تحلیل</a> ";
        }
        if(strpos($tags,"finance")>0)
        {
            $tags4=" <a href='#finance'>بازارهای مالی</a> ";
        }
        if(strpos($tags,"data")>0)
        {
            $tags5=" <a href='#data'>داده کاوری</a> ";
        }
        if(strpos($tags,"education")>0)
        {
            $tags6=" <a href='#education'>آموزش</a> ";
        }



        $sql1 = "SELECT imgurl FROM tc_clients WHERE id='$authorid'";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            // output data of each row
            while($row1 = $result1->fetch_assoc()) {
                $authorurl= $row1["imgurl"];
            }
        } else {
            echo "0 results";
        }
    }
} else {
    echo "0 results";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         $sql5 = "SELECT * FROM tc_article";
        $result5 = $conn->query($sql5);
        if ($result5->num_rows > 0) {
             //output data of each row
            $counter=0;
            while($row5 = $result5->fetch_assoc())
            {
                $counter ++;
                if($counter==1)
                {
                    $Latestcontent1="<li><a href='".$row5['subject'].".html'>".$row5['subject']."</a></li>";
                }
                if($counter==2)
                {
                    $Latestcontent2="<li><a href='".$row5['subject'].".html'>".$row5['subject']."</a></li>";
                }
                if($counter==3)
                {
                    $Latestcontent3="<li><a href='".$row5['subject'].".html'>".$row5['subject']."</a></li>";
                }
                if($counter==4)
                {
                    $Latestcontent4="<li><a href='".$row5['subject'].".html'>".$row5['subject']."</a></li>";
                }
                if($counter==5)
                {
                    break;
                }
            }
        } else {
            echo "0 results";
        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>blog</title>

    <link href='css/bootstrap.css' rel='stylesheet'>
    <link href='css/font-awesome.css' rel='stylesheet'>
    <link href='style.css' rel='stylesheet'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
</head>

<body>
<div class='main-menu'>
    <!--menu-->
    <div class='topnav' id='myTopnav' style='box-shadow: 0 3px 10px rgba(71,44,173,.2);padding: 10px;height: 60px;position: fixed;width: 100%;background: #fff;z-index: 10;'>
        <div class='row'>
            <div class='col-4'>
                <a href='http://tradicoders.ir/'><button style='width: 110px;margin: 5px;margin-right: 20px;border: 1px solid;border-radius: 5px;padding: 5px;background: none;color: #344451;' onclick='login()'>ورود</button></a>
                <a href='http://tradicoders.ir/'><button style='width: 110px;margin: 5px;margin-right: 0px;border: 1px solid #344451;border-radius: 5px;padding: 5px;background: #344451;color: #fff;' onclick='signup()'>ثبت نام</button></a>

                <a href='index.php' style='margin: 5px;margin-right: 10px;border-radius: 5px;color: #444;background: none;border: none;' >خانه</a>
                <a href='guide.php' style='margin: 5px;margin-right: 10px;border-radius: 5px;color: #444;background: none;border: none;' >راهنما</a>
                <a href='doneproject.php'>
                    <button style='margin: 5px;margin-right: 0px;border-radius: 5px;color: #444;background: none;border: none;' >برترین پروژه ها</button>
                </a>
                <a href='academy/index.php'>
                    <button style='margin: 5px;margin-right: 0px;border-radius: 5px;color: #444;background: none;border: none;' >کد آکادمی</button>
                </a>
                <a href='articles.php' style='margin: 5px;margin-right: 10px;color: #444;background: none;border: none;border-bottom:1px solid #344451;padding-bottom: 5px'>کتابخانه</a>
                <a href='developer.php'>
                    <button style='margin: 5px;margin-right: 0px;border-radius: 5px;color: #444;background: none;border: none;' >توسعه دهندگان</button>
                </a>
            </div>
        </div>
    </div>
    <!--menu-->
</div>


<div class='page-baner'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <span><?php echo $articleSubject;?></span>
            </div>
        </div>
    </div>
</div>



<div class='container'>
    <div class='row'>
        <div class='page-content single_content'>
            <div class='col-md-9'>
                <div class='content_bx'>
                    <img src='../"<?php echo $authorurl;?>' alt='' style='width: 100px;'>
                    <div class='meta'>
                        <span><i class='fa fa-eye'>".$articleViewnum."</i></span>
                        <span class='post_tags'><i class='fa fa-archive'></i><?php echo $tags1.$tags2.$tags3.$tags4.$tags5.$tags6;?></span>
                    </div>
                    <h1><?php echo $articleSubject;?></h1><hr>
                    <div class='p_text'>
                        <?php echo $articlebody;?>
                    </div>
                    <div class='post_tags'>
                        #
                        <?php echo $tags1.$tags2.$tags3.$tags4.$tags5.$tags6;?>
                    </div>
                </div>
            </div>
            <div class='col-md-3'>
                <div class='side_bx'>
                    <span class='title'>آخرین مطالب</span>
                    <ul>
                        <?php echo $Latestcontent1.$Latestcontent2.$Latestcontent3.$Latestcontent4;?>
                    </ul>
                </div>
                <div class='side_bx'>
                    <span class='title'>به چه مطالبی علاقمندید</span>
                    <ul>
                        <li><a href='#'>وردپرس</a></li>
                        <li><a href='#'>اندروید</a></li>
                        <li><a href='#'>سیستم عامل</a></li>
                        <li><a href='#'>دانلود</a></li>
                        <li><a href='#'>موبایل</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>


<div class='footer_box' style='display:none;'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-7'>
                <div class='col-md-4'>
                    <div class='footer-menu'>
                        <span class='title'>دسترسی سریع</span>
                        <ul>
                            <li><a href='#'>خانه</a></li>
                            <li><a href='#'>تماس با ما</a></li>
                            <li><a href='#'>حریم خصوصی</a></li>
                            <li><a href='#'>مجلات</a></li>
                            <li><a href='#'>بلاگ</a></li>
                        </ul>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='footer-menu'>
                        <span class='title'>دسنه بندی موضوعی</span>
                        <ul>
                            <li><a href='#'>وردپرس</a></li>
                            <li><a href='#'>اندروید</a></li>
                            <li><a href='#'>سیستم عامل</a></li>
                            <li><a href='#'>دانلود</a></li>
                            <li><a href='#'>موبایل</a></li>
                        </ul>
                    </div>
                </div>
                <div class='col-md-4'>
                    <div class='footer-menu'>
                        <span class='title'>دسترسی سریع</span>
                        <ul>
                            <li><a href='#'>خانه</a></li>
                            <li><a href='#'>تماس با ما</a></li>
                            <li><a href='#'>حریم خصوصی</a></li>
                            <li><a href='#'>مجلات</a></li>
                            <li><a href='#'>بلاگ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class='col-md-5'>
                <div class='desc_footer footer-menu'>
                    <span class='title'>دسترسی سریع</span>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                        چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                        تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای
                        زیادیلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک
                        است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                        تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی
                    </p>
                </div>
            </div>
            <div class='col-md-12 text-center'>
                <div class='copy-r'>
                        <span>
                            &copy; حقوق انتشار برای سئو 90 محفوط است
                        </span>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function acounter() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('txtHint').innerHTML = this.responseText;
            }
        }
        xmlhttp.open('GET', 'articlecounter.php?id=".$last_id."', true);
        xmlhttp.send();
    }
</script>
<script src='js/bootstrap.js'></script>
</body>

</html>