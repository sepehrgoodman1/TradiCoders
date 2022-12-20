<?php
require("backend_header.php");

$pageName = 'مدیریت انجمن';
$pageAddress = 'managequestion';


if (isset($_POST['answer_id'])){
    $answer_id = $_POST['answer_id'];
    $status = $_POST['status'];
    $answer = $_POST['answer'];
    updateQuery("tc_forum_answer","status='$status', answer='$answer'","id='$answer_id'");
}

if (isset($_POST['question_id'])){
    $question_id = $_POST['question_id'];
    $status = $_POST['status'];
    $question = $_POST['question'];
    $description = $_POST['description'];
    updateQuery("tc_forum","status='$status', question='$question', description='$description'","id='$question_id'");
}

if (permissionPageInside($pageAddress) || $role == 'admin') {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php
        // insert all css file and meta file and set meta tag

        $title = 'پروفایل | مدیریت | مدیریت سوالات متداول';
        $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
        $description = 'شما می توانید از این بخش منابع مالی و خروجی و ورودی های خود را بررسی کنید و درخواست های مالی خود را ثبت کنید';
        $icon = '../tradi-coders-logo-final.gif';
        defualtMetaAndStyleProfile($title, $keywords, $description, $icon);
        // ./insert all css file and meta file and set meta tag
        ?>

        <!-- Css Codes -->
        <link rel="stylesheet" href="../css/global.css"/>
        <link rel="stylesheet" href="../css/main.css"/>
        <link rel="stylesheet" href="../css/projectPage.css"/>
        <link rel="stylesheet" href="../css/login.css"/>

        <!-- Font Awesome Icon-->
        <link
                rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
                integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
                crossorigin="anonymous"
                referrerpolicy="no-referrer"
        />
    </head>
    <body class="hold-transition sidebar-mini" style="overflow:hidden;">
    <?php require_once("navbar.php"); ?>
    <?php require_once("sidebar.php"); ?>
    <div class="content-wrapper">
        <div class="WrapperForums">
            <div class="TitleFont ForumText">مدیریت انجمن</div>
            <!-- Filters -->
            <div class="Filters">
                <div>
                    <div onclick="onClick(0)" class="ItemFilter">سوالات</div>
                    <div onclick="onClick(1)" class="ItemFilter">جواب ها</div>
                </div>
            </div>
            <div class="LineFilter SecondaryBG"></div>
            <div class="row m-2">
                <form method="post" action="">
                    <div
                            class="btn-group"
                            role="group"
                            aria-label="Basic radio toggle button group"
                    >
                        <input
                                type="radio"
                                class="btn-check"
                                name="status_show"
                                id="btnradio3"
                                onclick="changeStatus()"
                                autocomplete="off"
                                hidden
                        />

                        <input
                                type="radio"
                                class="btn-check"
                                name="status_show"
                                id="btnradio2"
                                onclick="changeStatus()"
                                autocomplete="off"
                                hidden
                        />

                        <input
                                type="radio"
                                class="btn-check"
                                name="status_show"
                                onclick="changeStatus()"
                                id="btnradio1"
                                autocomplete="off"
                                hidden
                        />
                    </div>
                    <input type="submit" id="submit_status" hidden/>
                </form>
            </div>
            <!-- Start Forum Tab 0-->
            <div class="ForumArea MyTab">
                <div class="WrapperForumList Flex1">
                    <?php
                    $sql_questions = selectQuery_tc_forum("status='pending'");
                    foreach ($sql_questions as $row) {
                        ?>
                        <!-- ForumItem -->
                        <div
                                class="ForumItem"
                        >
                            <div>
                                <div class="P_ImageAndQues">
                                    <div>
                                        <img
                                                src="../assets/images/person.webp"
                                                class="LogoPrograming"
                                                alt="Programing Language"
                                        />
                                    </div>

                                    <div class="P_TitleForum" style="width: 100%">
                                        <form method="post" action="">
                                            <div class="TitleForum TitleFont">
                                                <textarea name="question" ><?php echo $row['question'] ?></textarea>
                                            </div>
                                                <textarea name="description" ><?php echo $row['description'] ?></textarea>

                                        <input type="hidden" name="question_id" value="<?php echo $row['id'];?>">
                                        <button name="status" value="open" class="Taeed">تایید</button>
                                        <button name="status" value="cancel" class="Laghv">لغو انتشار</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <!-- End Forum -->

            <!-- Start Forum Tab 1-->
            <div class="ForumArea MyTab">
                <div class="WrapperForumList Flex1">
                    <?php $sql_questions = selectQuery_tc_forum();
                    foreach ($sql_questions as $row_q) {
                        $id_q = $row_q['id'];
                        $sql_answer = selectQuery_tc_forum_answer("status='pending' and forum_id='$id_q'");
                        if (sizeof($sql_answer) > 0) {
                            ?>
                            <!-- ForumItem -->
                            <div
                                    class="ForumItem"
                            >
                                <div>
                                    <div class="P_ImageAndQues">
                                        <div>
                                            <img
                                                    src="../assets/images/person.webp"
                                                    class="LogoPrograming"
                                                    alt="Programing Language"
                                            />
                                        </div>
                                        <div class="P_TitleForum">
                                            <div class="TitleForum TitleFont"><?php echo $row_q['question']; ?></div>
                                            <div class="TimePostForm"><?php echo $row_q['description']; ?></div>
                                            <?php
                                            foreach ($sql_answer as $row_a) {
                                                ?>
                                                <form action="" method="post">
                                                    <textarea name="answer" class="TopMessageForm"><?php echo $row_a['answer']; ?></textarea>
                                                    <input type="hidden" name="answer_id" value="<?php echo $row_a['id'];?>">
                                                    <button name="status" value="open" class="Taeed">تایید</button>
                                                    <button name="status" value="cancel" class="Laghv">لغو انتشار</button>
                                                </form>
                                            <?php } ?>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
            <!-- End Forum -->
        </div>
    </div>
    <script src="../js/TabChanger.js"></script>
    <?php
    // insert script file
    defualtScriptProfile();
    // ./insert script file
    ?>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    </body>
    </html>
    <?php
} else {
    openLink('https://www.tradicoders.ir/profile/index.php');
}
?>