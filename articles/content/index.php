<?php
require('../../config.php');
require("../../central.php");
require('../../access.php');
require('../../sessionchecker.php');
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

$edit_Viewnum = $articleViewnum+1;
$sql2 = "UPDATE tc_article SET viewnum='$edit_Viewnum' WHERE id='$arid'";
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
<html lang='en'>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title><?php echo $articleSubject;?></title>

    <link href='css/bootstrap.css' rel='stylesheet'>
    <link href='css/font-awesome.css' rel='stylesheet'>
    <link href='style.css' rel='stylesheet'>
    <link href='../../css/header.css' rel='stylesheet'>
    <link href='../../css/main.css' rel='stylesheet'>
    <link href='../../css/global.css' rel='stylesheet'>

    <!-- Font Awesome Icon-->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />

    <link rel="stylesheet" href="../../css/global.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src='https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js'></script>
      <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
</head>

<body>

<!-- <div class='main-menu'>
</div> -->
<?php require_once('../../navbar.php') ?>






<div class='container'>
    <div class='row'>
        <div class='page-content single_content'>
            <div class='col-md-9'>
                <div class='content_bx'>
                    <img src='../<?php echo $authorurl;?>' alt='' style='width: 100px;'>
                    <div class='meta'>
                        <span><i class='fa fa-eye'><?php echo $articleViewnum;?></i></span>
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
                        <?php echo $Latestcontent1.$Latestcontent2.$Latestcontent3.$Latestcontent4;?>
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

<script src='js/bootstrap.js'></script>
</body>

</html>