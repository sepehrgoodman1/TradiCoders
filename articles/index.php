<?php
if (isset($_GET['id'])){
require('../config.php');
require("../central.php");
require('../access.php');
require('../sessionchecker.php');
$action="articles";
$arid = $_GET['id'];
$sql = "SELECT subject, category, body, viewnum,tags,author FROM tc_article WHERE subject='$arid'";
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
        $final_keywords = "";
        if(strpos($tags,"programming")>0)
        {
            $tags1=" <a href='#programming'>برنامه نویسی</a> ";
            $tagholder1 = "programming";
            $final_keywords .= "برنامه نویسی".", programming, ";
        }
        if(strpos($tags,"algotrading")>0)
        {
            $tags2=" <a href='#algotrading'>معاملات الگوریتمی</a> ";
            $final_keywords .= "معاملات الگوریتمی".", algotrading, ";
        }
        if(strpos($tags,"analysis")>0)
        {
            $tags3=" <a href='#analysis'>روش تحلیل</a> ";
            $final_keywords .= "روش تحلیل".", analysis, ";
        }
        if(strpos($tags,"finance")>0)
        {
            $tags4=" <a href='#finance'>بازارهای مالی</a> ";
            $final_keywords .= "بازارهای مالی".", finance, ";
        }
        if(strpos($tags,"data")>0)
        {
            $tags5=" <a href='#data'>داده کاوری</a> ";
            $final_keywords .= "داده کاوری".", data, ";
        }
        if(strpos($tags,"education")>0)
        {
            $tags6=" <a href='#education'>آموزش</a> ";
            $final_keywords .= "آموزش".", education, ";
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

$edit_Viewnum = $articleViewnum+1;
$sql2 = "UPDATE tc_article SET viewnum='$edit_Viewnum' WHERE subject='$arid'";
if ($conn->query($sql2) === TRUE) {
   // echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
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
                    $Latestcontent1="<li class='Pointer'><div><a href='".$row5['subject'].".html' class='NormalLink'>".$row5['subject']."</a><div/>
                    <div class='LittleDeskArticle'>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است...<div/></li>";
                }
                if($counter==2)
                {
                    $Latestcontent2="<li class='Pointer'><div><a href='".$row5['subject'].".html' class='NormalLink'>".$row5['subject']."</a><div/>
                    <div class='LittleDeskArticle'>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است...<div/></li>";
                }
                if($counter==3)
                {
                    $Latestcontent3="<li class='Pointer'><div><a href='".$row5['subject'].".html' class='NormalLink'>".$row5['subject']."</a><div/>
                    <div class='LittleDeskArticle'>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است...<div/></li>";
                }
                if($counter==4)
                {
                    $Latestcontent4="<li class='Pointer'><div><a href='".$row5['subject'].".html' class='NormalLink'>".$row5['subject']."</a><div/>
                    <div class='LittleDeskArticle'>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است...<div/></li>";
                }
                if($counter==5)
                {
                    break;
                }

                if(strpos($row5["tags"],$tagholder1)>0) {
                    $counter ++;
                    if($counter==1)
                    {
                        $fvcontent1="<li><a href='".$row5['subject'].".html'>".$row5['subject']."</a></li>";
                    }
                    if($counter==2)
                    {
                        $fvcontent2="<li><a href='".$row5['subject'].".html'>".$row5['subject']."</a></li>";
                    }
                    if($counter==3)
                    {
                        $fvcontent3="<li><a href='".$row5['subject'].".html'>".$row5['subject']."</a></li>";
                    }
                    if($counter==4)
                    {
                        $fvcontent4="<li><a href='".$row5['subject'].".html'>".$row5['subject']."</a></li>";
                    }
                    if($counter==5)
                    {
                        break;
                    }
                }
            }
        } else {
            echo "0 results";
        }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!DOCTYPE html>
<html lang='fa-IR'>

<head>

    <?php
    $sql_meta = selectQuery_tc_meta("action='$action'");
    $sql_meta = $sql_meta[0];
    $sql_keywords = selectQuery_tc_meta("action='find_meta'");
    $sql_keywords = $sql_keywords[0];

    foreach (explode(",",$sql_keywords['keywords']) as $keywords){
        if (strpos($articleSubject, $keywords) !== false){
            $final_keywords .= $keywords.", ";
        }else  if (strpos($articlebody, $keywords) !== false){
            $final_keywords .= $keywords.", ";
        }
    }
    $title = $articleSubject;
    $description = mb_substr(trim($articleSubject), 0, 120, 'UTF-8');
    defualtMeta($title, $final_keywords, $description); ?>
    <link href='content/css/bootstrap.css' rel='stylesheet'>
    <link href='content/css/font-awesome.css' rel='stylesheet'>
    <link href='content/style.css' rel='stylesheet'>
    <link href='https://tradicoders.ir/css/header.css' rel='stylesheet'>

     <!-- Css Codes -->
     <link rel="stylesheet" href="https://tradicoders.ir/css/global.css"/>
     <link rel="stylesheet" href="https://tradicoders.ir/css/main.css"/>
     <link rel="stylesheet" href="../css/fonts.css"/>

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
     
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 el
    ements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
</head>

<body>
    <?php require_once('../navbar.php') ?>






<div class='Mt_20'>
    <div class='row'>
        <div class='page-content single_content P_0'>
        <div class='col-md-3 col-xs-12 BlackSideMenu'>
                <div class='side_bx'>
                    <span class='title WhiteColor'>آخرین مطالب</span>
                    <ul>
                        <?php echo $Latestcontent1.$Latestcontent2.$Latestcontent3.$Latestcontent4;?>
                    </ul>
                </div>
                
            </div>
            <div class='col-md-9 col-xs-12 P_0'>
                <div class="PosRel">
                    <img src="https://tradicoders.ir/assets/images/NewYork.jpg" class="BannerArticle" alt="">
                    <img src='https://tradicoders.ir/<?php echo str_replace("../","",$authorurl);?>' alt='<?php echo $articleSubject ?>'  class="ImgAuthor">
                </div>
               
                <div class='content_bx'>
                    
                    <h1 class="TitleOfArticle"><?php echo $articleSubject;?></h1>
                    <div class='meta'>
                        <span><i class='fa fa-eye'><span class="EyeContent"><?php echo $articleViewnum;?></span></i></span>
                        <span class='post_tags'><i class='fa fa-archive'></i><?php echo $tags1.$tags2.$tags3.$tags4.$tags5.$tags6;?></span>
                    </div>
                    <hr>
                    <div class='p_text'>
                        <?php echo $articlebody;?>
                    </div>
                    <div class='post_tags'>
                        #
                        <?php echo $tags1.$tags2.$tags3.$tags4.$tags5.$tags6;?>
                    </div>
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

<script src='content/js/bootstrap.js'></script>
</body>

</html>
<?php
}else{
require ("articles.php");
}
    ?>