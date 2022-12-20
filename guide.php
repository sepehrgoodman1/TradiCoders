<?php
require('required_page.php');
$action = 'guide';
?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
   
    <!-- Css Codes -->
    <link rel="stylesheet" href="css/global.css"/>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/fonts.css"/>

    <!-- Font Awesome Icon-->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
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

<body class="BgGrayFade">
<?php require('navbar.php') ?>
<div>
<div class="MainWrapper Mt100 M_Mt_25">
    <!-- Filters -->
    <div class="Filters SecondaryColor">
        <div >
        <i class="fa-solid fa-circle-info"></i>
            <div class="ItemFilter ItemFilter_Atcive" onclick="ShowPannel(0)">
                عمومی
            </div>
            <div class="ItemFilter" onclick="ShowPannel(1)">کارفرما</div>
            <div class="ItemFilter" onclick="ShowPannel(2)">توسعه دهنده</div>
            <div class="ItemFilter" onclick="ShowPannel(3)">افزودن سوال جدید</div>
          
        </div>
        <div class="M_Mt20">
            <i class="fa-solid fa-scale-balanced"></i>
            <div class="ItemFilter ItemFilter_Atcive" onclick="ShowPannel(4)">
                عمومی
            </div>
            <div class="ItemFilter" onclick="ShowPannel(5)">کارفرما</div>
            <div class="ItemFilter" onclick="ShowPannel(6)">توسعه دهنده</div>
        </div>
    </div>
    <div class="LineFilter"></div>
    <!-- 0 -->
    <div class="MyTab">
        
            <div class="GuidePage">
                <h1 class="TitleQuestions TitleFont">سوالات متداول</h1>
                <div class="P_InputSearch Mt20">
                    <input type="text" class="InputSearch" placeholder="جستجو..."/>
                    <i class="SearchIcon fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="P_GuideList">
                <?php $sql = selectQuery_tc_faq("faqusage='public'");
                foreach ($sql as $row){?>
                    <!-- Grid Item -->
                    <div>
                        <div class="Guide">
                            <div class="BoxIconGuide">
                                <i class="fa fa-solid fa-question"></i>
                            </div>
                            <div class="P_TitleGuideList">
                                <h3 class="TitleGuideList TitleFont"><?php echo $row['question']?></h3>
                                <div class="DeskGuide">
                                    <?php echo $row['answer']?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    <!-- 1 -->
    
    <div class="MyTab">
            <div class="GuidePage">
                <div class="TitleQuestions TitleFont">سوالات متداول</div>
                <div class="P_InputSearch Mt20">
                    <input type="text" class="InputSearch" placeholder="جستجو..."/>
                    <i class="SearchIcon fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="P_GuideList">
                <?php $sql = selectQuery_tc_faq("faqusage='user'");
                foreach ($sql as $row){?>
                    <!-- Grid Item -->
                    <div>
                        <div class="Guide">
                            <div class="BoxIconGuide">
                                <i class="fa fa-solid fa-question"></i>
                            </div>
                            <div class="P_TitleGuideList">
                                <div class="TitleGuideList TitleFont"><?php echo $row['question']?></div>
                                <div class="DeskGuide">
                                    <?php echo $row['answer']?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </div>
    <!-- 2 -->

    <div class="MyTab">
            <div class="GuidePage">
                <div class="TitleQuestions TitleFont">سوالات متداول</div>
                <div class="P_InputSearch Mt20">
                    <input type="text" class="InputSearch" placeholder="جستجو..."/>
                    <i class="SearchIcon fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
            <div class="P_GuideList">
                <?php $sql = selectQuery_tc_faq("faqusage='developer'");
                foreach ($sql as $row){?>
                    <!-- Grid Item -->
                    <div>
                        <div class="Guide">
                            <div class="BoxIconGuide">
                                <i class="fa fa-solid fa-question"></i>
                            </div>
                            <div class="P_TitleGuideList">
                                <div class="TitleGuideList TitleFont"><?php echo $row['question']?></div>
                                <div class="DeskGuide">
                                    <?php echo $row['answer']?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </div>
    <!-- 3 -->
    <div class="MyTab Mt_30">
        <div class="OurInput ">
                    <label for="ProjectName " class="Fs18">متن سوال</label>
                    <input name="eprname " value="<?php echo $subject ?>" type="text" id="ProjectName"
                           class="FormInput Fs18"/>
                </div>
                <button class="ConfirmBtn">
                    ثبت سوال
                    <i class="fa-solid fa-check T3"></i>
                </button>
    </div>
    
    <!-- 4 -->

    <div class="MyTab">
        <div class="Fs20 LineH25 Mt20">
            <?php echo $pagecontent[17];?>
        </div>
    </div>
    <!-- 5 -->
    <div class="MyTab">
        <div class="Fs20 LineH25 Mt20">
            <?php echo $pagecontent[18];?>
        </div>
    </div>
    <!-- 6 -->
    <div class="MyTab">
        <div class="Fs20 LineH25 Mt20">
            <?php echo $pagecontent[19];?>
        </div>
    </div>




</div>
 <!-- Footer -->
 <?php 
        require_once("footer.php");
    ?>
    </div>
<!-- Java scripts Codes -->
<script src="js/TabChanger.js"></script>
</body>
</html>
