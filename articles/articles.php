<?php
require('../config.php');
require("../central.php");
require('../access.php');
require('../sessionchecker.php');
$action = 'articles';
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

</head>
<body>
<?php require('../navbar.php') ?>

<div>
    <div class="MainWrapper Mt100 M_Mt30">
        <h1 class="HeaderOfArticles DisNone">اشنایی با بازار سرمایه و زبان های برنامه نویسی بلاکچین</h1>
       
        <!-- Filters -->
        <div class="Filters Mt30 SecondaryColor FilterArticle">
            <div>
                <div class="ItemFilter ItemFilter_Atcive" onclick="ShowPannel(0)">
                    بازار سرمایه
                </div>
                <div class="ItemFilter" onclick="ShowPannel(1)">برنامه نویسی</div>
                <div class="ItemFilter" onclick="ShowPannel(2)">روش های معاملاتی</div>
                <div class="ItemFilter" onclick="ShowPannel(3)">تک نکته</div>
            </div>
            <div class="P_InputSearch">
                <form action="" method="get">
                    <input type="text" name="search_text" class="InputSearch" placeholder="جستجو..."/>
                    <input type="submit" id="submit_search" hidden>
                    <input name="tab" id="tab_search" type="hidden">
                    <i onclick="submit_search()" class="SearchIcon fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
        </div>
        <div class="LineFilter SecondaryBG"></div>


        <div class="MyTab">
            <!-- Start  Article liSt -->
            <div class="WrapperArticle Mt30">


                <!-- Article -->
                <?php
                $sql = "SELECT * FROM tc_article WHERE category='finance' ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        if (!isset($_GET['search_text']) || strpos($row['subject'], $_GET['search_text']) !== false || strpos($row['description'], $_GET['search_text']) !== false || $_GET['search_text'] == "") {
                            $tags = $row['tags'];
                            $authorid = $row["author"];
                            if ($row["publish"] == 1001) {
                                $sql1 = "SELECT imgurl,firstname,lastname FROM tc_clients WHERE id='$authorid'";
                                $result1 = $conn->query($sql1);

                                if ($result1->num_rows > 0) {
                                    // output data of each row
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $authorurl = $row1["imgurl"];
                                        $authorfullname = $row1["firstname"] . " " . $row1["lastname"];
                                    }
                                }
                                ?>
                                <div class="ArticleList">
                                    <div class="P_ImgArticle">
                                        <img src="<?php if ($row['banner'] != ""){echo $row['banner'];}else{echo "https://tradicoders.ir/assets/images/articleImg.jpg";} ?>" alt="<?php echo $row['subject'] ?>"/>
                                        <div class="Viwer"><?php echo $row['viewnum'] ?> بازدید</div>
                                        <div class="DateArticle">
                                            <?php echo $row['reg_date'] ?>
                                        </div>

                                    </div>


                                    <div class="WrapperBodyArticle">
                                        <h3 class="TitleArticle TitleFont" style="min-height:30px;">
                                            <?php echo $row['subject'] ?>
                                        </h3>
                                        <div class="AuthorName">
                                            <?php echo $authorfullname; ?>
                                        </div>
                                        <p class="DeskTitle">
                                            <?php echo mb_substr($row['description'], 0, 150) ?>...
                                        </p>
                                         <!-- <button onclick="openLink('https://www.tradicoders.ir/articles/content/articlecontent.php?id=<?php echo $row['id'] ?>')"
                                                class="ContinueArticle"> ادامه مطلب <i
                                                    class="fa-solid fa-arrow-left-long IconFit"></i>
                                        </button> -->
<!--                                        <a href="https://www.tradicoders.ir/articles/content/articlecontent.php?id=--><?php //echo $row['id'] ?><!--">-->
                                            <a href="<?php echo $row["subject"];?>">
                                            <button
                                                    class="ContinueArticle"> ادامه مطلب <i
                                                        class="fa-solid fa-arrow-left-long IconFit"></i>
                                            </button>
                                        </a>

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
                            }
                        }
                    }
                }
                ?>


            </div>
            <!-- End  Article liSt -->
        </div>

        <div class="MyTab">
            <!-- Start  Article liSt -->
            <div class="WrapperArticle Mt30">


                <!-- Article -->
                <?php
                $sql = "SELECT * FROM tc_article WHERE category='programming' ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        if (!isset($_GET['search_text']) || strpos($row['subject'], $_GET['search_text']) !== false || strpos($row['description'], $_GET['search_text']) !== false || $_GET['search_text'] == "") {
                            $tags = $row['tags'];
                            $authorid = $row["author"];
                            if ($row["publish"] == 1001) {
                                $sql1 = "SELECT imgurl,firstname,lastname FROM tc_clients WHERE id='$authorid'";
                                $result1 = $conn->query($sql1);

                                if ($result1->num_rows > 0) {
                                    // output data of each row
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $authorurl = $row1["imgurl"];
                                        $authorfullname = $row1["firstname"] . " " . $row1["lastname"];
                                    }
                                }
                                ?>
                                <div class="ArticleList">
                                    <div class="P_ImgArticle">
                                        <img src="https://tradicoders.ir/assets/images/articleImg.jpg" alt="<?php echo $row['subject'] ?>"/>
                                        <div class="Viwer"><?php echo $row['viewnum'] ?> بازدید</div>
                                        <div class="DateArticle">
                                            <?php echo $row['reg_date'] ?>
                                        </div>

                                    </div>


                                    <div class="WrapperBodyArticle">
                                        <div class="TitleArticle TitleFont" style="min-height:50px;">
                                            <?php echo $row['subject'] ?>
                                        </div>
                                        <div class="AuthorName">
                                            <?php echo $authorfullname; ?>
                                        </div>
                                        <div class="DeskTitle">
                                            <?php echo mb_substr($row['description'], 0, 150) ?>...
                                        </div>
                                        <a href="<?php echo $row["subject"];?>">
                                            <button 
                                                    class="ContinueArticle"> ادامه مطلب <i
                                                        class="fa-solid fa-arrow-left-long IconFit"></i>
                                            </button>
                                        </a>

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
                            }
                        }
                    }
                }
                ?>


            </div>
            <!-- End  Article liSt -->
        </div>

        <div class="MyTab">
            <!-- Start  Article liSt -->
            <div class="WrapperArticle Mt30">


                <!-- Article -->
                <?php
                $sql = "SELECT * FROM tc_article WHERE category='strategy' ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        if (!isset($_GET['search_text']) || strpos($row['subject'], $_GET['search_text']) !== false || strpos($row['description'], $_GET['search_text']) !== false || $_GET['search_text'] == "") {
                            $tags = $row['tags'];
                            $authorid = $row["author"];
                            if ($row["publish"] == 1001) {
                                $sql1 = "SELECT imgurl,firstname,lastname FROM tc_clients WHERE id='$authorid'";
                                $result1 = $conn->query($sql1);

                                if ($result1->num_rows > 0) {
                                    // output data of each row
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $authorurl = $row1["imgurl"];
                                        $authorfullname = $row1["firstname"] . " " . $row1["lastname"];
                                    }
                                }
                                ?>
                                <div class="ArticleList">
                                    <div class="P_ImgArticle">
                                        <img src="https://tradicoders.ir/assets/images/articleImg.jpg" alt="<?php echo $row['subject'] ?>"/>
                                        <div class="Viwer"><?php echo $row['viewnum'] ?> بازدید</div>
                                        <div class="DateArticle">
                                            <?php echo $row['reg_date'] ?>
                                        </div>

                                    </div>


                                    <div class="WrapperBodyArticle">
                                        <div class="TitleArticle TitleFont" style="min-height:50px;">
                                            <?php echo $row['subject'] ?>
                                        </div>
                                        <div class="AuthorName">
                                            <?php echo $authorfullname; ?>
                                        </div>
                                        <div class="DeskTitle">
                                            <?php echo mb_substr($row['description'], 0, 150) ?>...
                                        </div>
                                        <a href="<?php echo $row["subject"];?>">
                                            <button 
                                                    class="ContinueArticle"> ادامه مطلب <i
                                                        class="fa-solid fa-arrow-left-long IconFit"></i>
                                            </button>
                                        </a>

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
                            }
                        }
                    }
                }
                ?>


            </div>
            <!-- End  Article liSt -->
        </div>
        <div class="MyTab">
            <!-- Start  Article liSt -->
            <div class="WrapperArticle Mt30">


                <!-- Article -->
                <?php
                $sql = "SELECT * FROM tc_article WHERE category='hint' ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        if (!isset($_GET['search_text']) || strpos($row['subject'], $_GET['search_text']) !== false || strpos($row['description'], $_GET['search_text']) !== false || $_GET['search_text'] == "") {
                            $tags = $row['tags'];
                            $authorid = $row["author"];
                            if ($row["publish"] == 1001) {
                                $sql1 = "SELECT imgurl,firstname,lastname FROM tc_clients WHERE id='$authorid'";
                                $result1 = $conn->query($sql1);

                                if ($result1->num_rows > 0) {
                                    // output data of each row
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $authorurl = $row1["imgurl"];
                                        $authorfullname = $row1["firstname"] . " " . $row1["lastname"];
                                    }
                                }
                                ?>
                                <div class="ArticleList">
                                    <div class="P_ImgArticle">
                                        <img src="https://tradicoders.ir/assets/images/articleImg.jpg" alt="<?php echo $row['subject'] ?>"/>
                                        <div class="Viwer"><?php echo $row['viewnum'] ?> بازدید</div>
                                        <div class="DateArticle">
                                            <?php echo $row['reg_date'] ?>
                                        </div>

                                    </div>


                                    <div class="WrapperBodyArticle">
                                        <div class="TitleArticle TitleFont" style="min-height:50px;">
                                            <?php echo $row['subject'] ?>
                                        </div>
                                        <div class="AuthorName">
                                            <?php echo $authorfullname; ?>
                                        </div>
                                        <div class="DeskTitle">
                                            <?php echo mb_substr($row['description'], 0, 150) ?>...
                                        </div>
                                        <a href="<?php echo $row["subject"];?>">
                                            <button
                                                    class="ContinueArticle"> ادامه مطلب <i
                                                        class="fa-solid fa-arrow-left-long IconFit"></i>
                                            </button>
                                        </a>

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
                            }
                        }
                    }
                }
                ?>


            </div>
            <!-- End  Article liSt -->
        </div>
        <div class="Mt50">
        <h4 class="Fs24">لینک های مرتبط</h4>
        <div>
            <div>
                <a href="https://fa.wikipedia.org/wiki/%D8%B1%D9%85%D8%B2%D8%A7%D8%B1%D8%B2" class="Fs18">رمز ارز</a>
            </div>
            <div>
                <a href="https://fa.wikipedia.org/wiki/%D8%B1%D9%85%D8%B2_%D8%BA%DB%8C%D8%B1%D9%85%D8%AB%D9%84%DB%8C" class="Fs18">Nft</a>
            </div>
            
        </div>
        
    </div>
    </div>
    <!-- End Articles -->
    
    <?php require_once("../footer.php") ?>
</div>
<!-- Java scripts Codes -->
<script src="js/TabChanger.js"></script>
<script>
    function submit_search() {
        document.getElementById('submit_search').click();
    }
    <?php
        if (isset($_GET['tab'])){
            ?>
            ShowPannel(<?php echo $_GET['tab']; ?>);
    <?php
        }else{
    ?>
    ShowPannel(0);
    <?php
    }
    ?>
</script>

</body>

</html>
