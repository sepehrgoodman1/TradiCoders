<?php
require('required_page.php');
$action = 'index';
?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
     <!-- Dynamic Meta Deskription -->
     <?php
        $sql_meta = selectQuery_tc_meta("action='$action'");
        $sql_meta = $sql_meta[0];
        $title = $sql_meta['title'];
        $keywords = $sql_meta['keywords'];
        $description = $sql_meta['description'];
        defualtMeta($title, $keywords, $description); ?>
        
    <!-- Css Codes -->
    <link rel="stylesheet" href="css/global.css"/>
    <link rel="stylesheet" href="css/fonts.css"/>
    <link rel="stylesheet" href="css/main.css"/>

    <!-- Font Awesome Icon-->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
    <!-- Aos Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-YTGXME61R2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YTGXME61R2');
</script>
<body>
<!-- <div class="BgLoading">
      <div class="P_LodImg">
        <img src="assets/images/Loading.svg" class="LoadingImg" alt="" />
        <div class="LoadingText">لطفا منتظر بمانید...</div>
      </div>
    </div>

<div> -->
<?php require('navbar.php');

?>



    <!-- Start Body -->
    <div class="WrapperBody">
        <div class="PosRel BgSlider">
            <div class="LeftContentMain" data-aos="fade-up">
                <img src="assets/images/SliderImage.png" alt="عکس برنامه نویسی" class="SliderImage">
            </div>
            <div class="RightContentMain" data-aos="fade-up">
                <div class="TitleSlide TitleFont"> <?php echo $pagecontent[4];?></div>
                <h2 class="DeskSli">
                    <?php echo $pagecontent[0];?>
                </h2>
                <div class="P_Sabt">
                    <a href="addProject.php" class="NormalLink Flex1_Mobile"><button class="Sabt_Project">
                    <i class="fa-solid fa-user-tie "></i>
                    ثبت پروژه
                </button>
                    <a href="https://projects.tradicoders.ir/" class="NormalLink Flex1_Mobile"><button class="Jobs">
                    <i class="fa-solid fa-code "></i>
                    فرصت های شغلی باز</button></a>
                </div>
            </div>


        </div>

        <div class="P_DeskDeatils">
                <div class="C_Desk" data-aos="fade-left">
                    <i class="fa-solid fa-user-tie IconDev"></i>
                    <h3 class="TitleFont TitleWorker">کارفرما</h3>
                    <div class="DeskWorker">
                        <?php echo $pagecontent[3];?>
                    </div>
                    <a class="NormalLink" href="addProject.php"> <button  class="SabtsProjects" >
                       ثبت پروژه جدید <i class="fa-solid fa-arrow-left-long IconTop2"></i>
                    </button></a>
                </div>
                <div class="C_Desk" data-aos="fade-right">
                    <i class="fa-solid fa-code IconDev"></i>
                    <h2 class="TitleFont TitleWorker">توسعه دهنده</h2>
                    <div class="DeskWorker">
                        <?php echo $pagecontent[2];?>
                    </div>
                    <a class="NormalLink" href="<?php if ($userid > -1){echo 'profile/support.php?developer_request';}else{echo 'login.php';} ?>"><button  class="SabtsProjectsLashi" >
                      پیوستن به تریدی کدرز 
                        </button></a>
                        <a class="NormalLink" href="https://projects.tradicoders.ir/"><button  class="SabtsProjects" >
                       مشاهده پروژه ها <i class="fa-solid fa-arrow-left-long IconTop2"></i>
                            </button></a>
                   
                </div>
        </div>
        <div class="P_Num_Devs">
            <div class="Devs ">
                <div><?= sizeof(selectQuery_tc_clients("role='developer'"))+10;  ?>+</div>
                <div class="TextDevs ">توسعه دهندگان</div>
            </div>
            <div class="Devs">
                <div><?= sizeof(selectQuery_tc_project("prstatus LIKE 'close%'"));  ?>+
</div>
                <div class="TextDevs">پروژه موفق
</div>
            </div>
            <div class="Devs ">
                <div><?= sizeof(selectQuery_tc_product("price!='0' and discount!='100'"));  ?>+
</div>
                <div class="TextDevs ">محصولات حرفه ای</div>
            </div>
          <a class="NormalLink" href="https://shop.tradicoders.ir/?tab=3">  <div class="Devs">
                <div><?= sizeof(selectQuery_tc_product("price='0' or discount='100'"));  ?>+</div>
                <div class="TextDevs">محصولات رایگان
</div>
            </div></a>
        </div>

        <div>
            <h3 class="TextCenter TextLang">در تریدی کدرز چه کارهایی را می تواند انجام دهید؟</h3>
            <div class="P_IteLangs">
                <div class="ItemLang">
                     <img src="assets/images/robot.png"  alt="">
                    <h3 class="Text_Prog">
                    طراحی ربات های معاملاتی
                    </h3>
             </div>
             <div class="ItemLang">
                     <img src="assets/images/forex1.jpg" alt="">
                    <h3 class="Text_Prog">
                    طراحی اندیکاتورها
                    </h3>
             </div>
             <div class="ItemLang">
                     <img src="assets/images/moshavereh.png" alt="">
                    <h3 class="Text_Prog">
                    مشاوره 
                    </h3>
             </div>
             <div class="ItemLang BrNone">
                     <img src="assets/images/women.png" alt="">
                    <h3 class="Text_Prog">
                    کسب درآمد
                    </h3>
             </div>
            </div>
        </div>


        <!-- Start All Projects -->

        <div class="WrapperIndex">
            <div class="WrapperProjects">
                <h1 class="NewProjects TitleFont">
                    <span class="DashRight"></span> جدید ترین پروژه ها
                    <span class="DashLeft"></span>
                </h1>
                <div class="AboutProject Center">
                    <p>
                        <?php echo $pagecontent[1] ?>
                    </p>
                </div>
                <div class="WrapperTwoArea">

                    <div class="Flex1" id="ProjList">
                        <div class="WrapperAllProjects">
                            <?php
                            $sql_tc_project = selectQuery_tc_project("prstatus !='pending' ORDER BY id DESC");
                            $limit_pr = 0;
                            foreach ($sql_tc_project as $row) {
                                $limit_pr++;
                                if ($limit_pr > 4) {
                                    break;
                                }
                                $pid = $row['id'];
                                $psub = $row['subject'];
                                $langimg = "assets/images/".$row['language'].'.jpg';
                                ?>
                                <!-- Start Project List -->
                                <div class="ProjectBox"  style="cursor: pointer;"  data-aos="zoom-out">
                                    <div class="C_ProjectBox">
                                        <div class="P_ImageAndName">

                                            <div class="P_Image">
                                                <img class="ImgPerson" alt="<?php echo $langimg;?> زبان برنامه نویسی" src="<?php echo $langimg;?>"/>
                                            </div>
                                            <div class="P_DetailWorks">
                                                <h3 class="DetailWorks TitleFont"><?php if (mb_strlen(trim($row["subject"])) > 50) {
                                                        echo mb_substr(trim($row["subject"]), 0, 50, 'UTF-8') . " ...";
                                                    } else {
                                                        echo $row["subject"];
                                                    } ?></h3>
<!--                                                <div class="NameProducer">--><?php //echo $devname; ?><!----><?php //echo $pid; ?><!--</div>-->
                                            </div>
                                        </div>
                                        <div class="DeskProject">
                                            <?php
                                            if (mb_strlen(trim($row["description"])) < 150) {
                                                echo $row["description"];
                                            } else {
                                                $limit = mb_substr(trim($row["description"]), 0, 150, 'UTF-8');
                                                echo $limit;
                                                ?>

                                                <span class="ReadMoreText">
                            <?php echo str_replace($limit, '', $row["description"]) ?>
                        </span>
                                                <span class="ReadMoreBtn">بیشتر...</span>
                                                <?php
                                            }
                                            ?>

                                        </div>

                                        <div>
                                            <?php if ($role == "developer") {
                                                if ($_POST['status_show'] == "prstatus='approve'" || !isset($_POST['status_show'])) {
                                                    ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" value="<?php echo $pid; ?>" name="jobid">
                                                        <button type="submit" class="OrderProject">دریافت و انجام کار
                                                        </button>
                                                    </form>
                                                <?php }
                                            } else { ?>

                                            <a class="NormalLink" href="https://projects.tradicoders.ir/<?php echo $psub."__".$pid;?>"><button
                                                    class="OrderProject">مشاهده کامل پروژه
                                                </button></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <!-- Footer Projects -->
                                    <div class="FooterProjects">
                                        <!-- Start Tags -->
                                        <div>
                                            <div class="P_Tags">
                                                <div class="Tag"> <?php
                                                    if ($row["type"] == 'expert') {
                                                        echo '#Expert';
                                                    } else if ($row["type"] == 'indicator') {
                                                        echo '#Indicator';
                                                    } else if ($row["type"] == 'script') {
                                                        echo '#Script';
                                                    }
                                                    ?></div>

                                                <?php
                                                if ($row["language"] == 'mql4') {
                                                    ?>
                                                    <h4 class="Tag">MQL4</h4>
                                                    <?php
                                                } else if ($row["language"] == 'mql5') {
                                                    ?>
                                                    <h4 class="Tag">MQL5</h4>
                                                    <?php
                                                } else if ($row["language"] == 'mql4&mql5') {
                                                    ?>
                                                    <h4 class="Tag">MQL4</h4>
                                                    <h4 class="Tag">MQL5</h4>
                                                    <?php
                                                } else if ($row["language"] == 'tradingview') {
                                                    ?>
                                                    <h5 class="Tag">TRADING VIEW</h5>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div>
                                            <div class="P_PriceText">
                                                <div class="PriceText">قیمت</div>
                                                <div class="Price"><?php echo number_format($row["price"], 0); ?>تومان
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php } ?>
                        </div>


                    </div>
                    <!-- Start Scroller Area -->
                    <div class="ScrollerProjects" id="ScrollerProjects" data-aos="flip-left">
                        <!-- Items In Scroll -->
                        <?php
                        foreach ($sql_tc_project as $row) {
                            $pid = $row['id'];
                            $psub = $row['subject'];
                            $langimg = "assets/images/".$row['language'].'.jpg';
                            ?>
                        <a class="NormalLink" href="https://projects.tradicoders.ir/<?php echo $psub."__".$pid;?>"><div style="cursor: pointer;"  class="ItemInScrolProject">
                                <div>
                                    <img src="<?php echo $langimg; ?>" class="PersonInScroll" alt="<?php echo $langimg; ?>">
                                </div>
                                <div class="P_TitleInScrollPro">
                                    <h3 class="TitleInScrollPro TitleFont"><?php echo $row["subject"] ?></h3>
                                    <div class="NameInScrollPro">قیمت 
                                        : <?php echo('<strong>' . $row["price"] . '</strong>'); ?></div>
                                </div>
                            </div></a>
                        <?php } ?>

                    </div>


                </div>
                <div class="Center">
                    <a class="NormalLink" href="https://projects.tradicoders.ir/"><button class="SeeAllProjects">
                        مشاهده همه پروژه ها <i class="fa-solid fa-arrow-left-long"></i>
                        </button></a>
                </div>

            </div>
            <!-- End All Projects -->

            <!-- Start Articles -->
            <div class="Articles">
                <h2 class="TextArticles TitleFont">
                    <span class="DashRightSec"></span> جدیدترین مقاله ها
                    <span class="DashLeftSec"></span>
                </h2>

                <!-- Start  Article liSt -->
                <div class="WrapperArticle">


                    <!-- Article -->
                    <?php
                    $sql = "SELECT * FROM tc_article where publish='1001' ORDER BY id DESC LIMIT 3";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) {
                            $tags = $row['tags'];
                            $authorid = $row["author"];
//                            if ($row["publish"] == 1001) {
                                    $sql1 = "SELECT imgurl,firstname,lastname FROM tc_clients WHERE id='$authorid'";
                                    $result1 = $conn->query($sql1);

                                    if ($result1->num_rows > 0) {
                                        // output data of each row
                                        while ($row1 = $result1->fetch_assoc()) {
$authorurl = $row1["imgurl"];
$authorfullname = $row1["firstname"]." ".$row1["lastname"];
                                        }
                                    }
                                    ?>
                                    <div class="ArticleList" data-aos="zoom-in">
                                        <div class="P_ImgArticle">
                                            <!-- <img src="<?php echo $authorurl ?>" alt="Article Image"/> -->
                                            <img src="<?php if ($row['banner'] != ""){echo $row['banner'];}else{echo "assets/images/articleImg.jpg";} ?>" alt="<?php echo $row['subject'] ?> عکس مقاله"/>
                                            
                                            <div class="Viwer"><?php echo $row['viewnum'] ?> بازدید</div>
                                            <div class="DateArticle">
                                                <?php echo $row['reg_date'] ?>
                                            </div>
                                        </div>
                                        <!-- <div class="P_TypeArticle">
                                            <?php
                                        // $tags = explode(',',$tags);
                                        //echo "<div class='TimeArticle'>#$tags[1]</div>";
                                        ?>
                                            <div class="TimeArticle" ><?php // echo $row['reg_date']?></div>
                                        </div> -->
                                        <div class="WrapperBodyArticle">
                                            <h3 class="TitleArticle TitleFont" >
                                                <?php echo $row['subject'] ?>
                                            </h3>
                                            <div class="AuthorName">
                                                <?php echo $authorfullname; ?>
                                            </div>
                                            <div class="DeskTitle">
                                                <?php echo mb_substr($row['description'], 0, 150) ?>...
                                            </div>
                                            <a class="NormalLink" href="https://articles.tradicoders.ir/<?php echo $row['subject'] ?>"><button
                                                    class="ContinueArticle"> ادامه مطلب <i
                                                        class="fa-solid fa-arrow-left-long IconFit"></i>
                                                </button></a>
                                            <!-- Start Tags -->
                                            <div class="Mb30 Ltr">
                                                <div class="TagsArticle Ltr">
                                                    <?php
                                                    $tags = explode(',', $tags);
                                                    foreach ($tags as $tag) {
                                                        ?>
                                                        <a href="#" class="LinkTags">
                                                            <?php
                                                            if ($tag != "") {
                                                                echo "#$tag";
                                                            }
                                                            ?>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>

                                            </div>
                                            <!-- End Tags -->
                                        </div>
                                    </div>

                                    <?php
//                            }
                        }
                    }
                    ?>


                </div>
                <!-- End  Article liSt -->
            </div>
            <!-- End Articles -->
        </div>
     

        <!-- Footer -->
        <?php
        require_once("footer.php");
        ?>
    </div>
    <!-- End Body -->
</div>
<script src="js/Projects.js"></script>

 <!-- script animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</body>
</html>

