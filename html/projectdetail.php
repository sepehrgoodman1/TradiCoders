<?php
require('required_page.php');
$action = "doneproject";
if (isset($_GET['project_id'])) {
    $projectid = $_GET['project_id'];
    $sql_project = selectQuery_tc_project("id='$projectid'");
    $sql_project = $sql_project[0];
    ?>
    <!DOCTYPE html>
    <html lang="fa-IR">
    <head>
        <meta charset="UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <!-- Css Codes -->
        <link rel="stylesheet" href="css/global.css"/>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/projectPage.css"/>

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

        <!-- Fav Icon -->
        <link rel="icon" type="image/x-icon" href="assets/images/Logo.gif">

        <title>project page</title>
    </head>
    <body class="BodyProjectDetail">
    <?php require('navbar.php'); ?>
    <br>
    <div class="MainWrapperPro">
        <!-- Right Side -->
        <div class="R_MainWrapperPro">
            <div class="WhiteAreaPro">
                <div class="BgProjects">
                    <img src="assets/images/<?php echo $sql_project['language']; ?>.jpg" class="LogoProgram"
                         alt="<?php echo $sql_project['language']; ?>"/>
                </div>
                <div class="P_DeskProj">
                    <div class="Flex1">
                        <div class="TitleProjNew TitleFont"><?php echo $sql_project['subject']; ?></div>
                        <div class="P_TagsOfProj">
                            <div class="TagsOfProj EngFont Ltr">#<?php echo $sql_project['language']; ?></div>
                            <div class="TagsOfProj EngFont Ltr">#<?php echo $sql_project['type']; ?></div>
                        </div>
                    </div>
                    <?php
                    if ($role == "developer" && $sql_project['developeruid'] == "-1") {
                        ?>
                        <form action="" method="post">
                            <input type="hidden" value="<?php echo $projectid; ?>" name="jobid">
                            <div>
                                <button type="submit" class="OrderPro">دریافت و انجام کار</button>
                            </div>
                        </form>
                        <?php
                    } else { ?>
                        <div>
                            <button onclick="openLink('https://www.tradicoders.ir/addProject.php?project_id=<?php echo $projectid ?>')"
                                    class="OrderPro">سفارش کار مشابه
                            </button>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="WhiteAreaDesk">
                <div class="AboutPro TitleFont">درباره پروژه</div>
                <div class="AboutProDetail">
                    <?php echo $sql_project['description']; ?>
                </div>
            </div>
        </div>
        <!-- Left Side -->
        <div class="L_MainWrapperPro">
            <!-- Price -->
            <div class="WhiteAreaLeft">
                <div class="TitleLeftProg TitleFont">قیمت</div>
                <div class="PricePro"><?php echo $sql_project['price']; ?> تومان</div>
            </div>
            <!-- Files -->
            <div class="WhiteAreaLeft">
                <div class="TitleLeftProg TitleFont">فایل ها</div>
                <?php if ($sql_project['price'] != "" && $sql_project['price'] != "null") { ?>
                    <div onclick="openLink('<?php echo $sql_project['requirement_url'];?>')" class="PricePro Ptb5 CursorP">
                        <i class="fa-regular fa-file"></i>
                        فایل پیوستی
                    </div>
                <?php } ?>
            </div>
            <!-- Sample Projects -->
            <div class="WhiteAreaLeft">
              <div class="TitleLeftProg TitleFont">پروژه های مشابه</div>
              <div class="P_SampleProjects">
                <?php
                $sql_tc_project = selectQuery_tc_project("prstatus !='pending' ORDER BY id DESC LIMIT 4");
                foreach ($sql_tc_project as $row) {
                    $pid = $row['id'];
                    $langimg = "assets/images/".$row['language'].'.jpg';
                    ?>
                    <div onclick="openLink('projectdetail.php?project_id=<?php echo $pid;?>')" style="cursor: pointer;"  class="ItemInScrolProject">
                        <div>
                            <img src="<?php echo $langimg; ?>" class="PersonInScroll" alt="Designer Image">
                        </div>
                        <div class="P_TitleInScrollPro">
                            <div class="TitleInScrollPro TitleFont"><?php echo $row["subject"] ?></div>
                            <div class="NameInScrollPro">قیمت
                                : <?php echo('<strong>' . $row["price"] . '</strong>'); ?></div>
                        </div>
                    </div>
                <?php } ?>
                </div>

            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
} else {
    openLink('doneproject.php');
}
?>