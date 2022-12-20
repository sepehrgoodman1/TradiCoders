<?php
if (isset($_GET['project_id'])) {
    require('required_page.php');
    $action = "doneproject";
    $projectsubject = explode("__",$_GET['project_id']);
    $projectid = $projectsubject[1];
    $projectsubject = $projectsubject[0];
    if (!empty($_POST["jobid"])) {
        $jobid = $_POST["jobid"];
        $sql = "UPDATE tc_project SET developeruid='$userid', prstatus='open'  WHERE id='$jobid'";
        if ($conn->query($sql) === TRUE) {


            $sql = "SELECT * FROM tc_project WHERE id='$jobid' ";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    // $not_description = $row['description'];
                    // $not_sub = $row['subject'];
                    $not_parameters = array();
                    $temp_sms_main = selectQuery_temp_sms_main("name='set_project'");

                    $not_parameters['main'] = $temp_sms_main['send_developer'];
                    $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);
                    $not_parameters['projectid'] = $jobid;
                    $not_parameters['nameproject'] = $row['subject'];
                    setNotifPer('set_project', $not_parameters, $userid);

                    $not_parameters['main'] = $temp_sms_main['send_user'];
                    $not_parameters['main'] = replace_parameter_notif($not_parameters, $not_parameters['main']);
                    setNotifPer('set_project', $not_parameters, $row['creatoruid']);
                }
            }


//        echo "Record updated successfully";
        }
    }
    $sql_project = selectQuery_tc_project("id='$projectid'");
    $sql_project = $sql_project[0];
    $userid_project = $sql_project['creatoruid'];
    $sql_info = selectQuery_tc_clients("id='$userid_project'","role,role2");
    $role_t = $sql_info[0]['role'];
    $role2_t = $sql_info[0]['role2'];
    ?>
    <!DOCTYPE html>
    <html lang="fa-IR">
    <head>
        <?php
        $sql_meta = selectQuery_tc_meta("action='$action'");
        $sql_meta = $sql_meta[0];
        $sql_keywords = selectQuery_tc_meta("action='find_meta'");
        $sql_keywords = $sql_keywords[0];
        $final_keywords = "";
        foreach (explode(",",$sql_keywords['keywords']) as $keywords){
            if (strpos($sql_project['subject'], $keywords) !== false){
                $final_keywords .= $keywords.", ";
            }else  if (strpos($sql_project['description'], $keywords) !== false){
                $final_keywords .= $keywords.", ";
            }
        }
        $title = $sql_project['subject'];
        $description = mb_substr(trim($sql_project['description']), 0, 120, 'UTF-8');
        defualtMeta($title, $final_keywords, $description); ?>
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
    <body class="BodyProjectDetail">
    <?php require('../navbar.php'); ?>
    <br>
    <div class="MainWrapperPro ">
        <!-- Right Side -->
        <div class="R_MainWrapperPro">
            <div class="WhiteAreaPro">
                <div class="BgProjects">
                    <img src="<?php if (($role_t="agent" || $role="admin") && ($role2_t=="marketing_manger")){echo "https://tradicoders.ir/assets/images/win.png";}else{echo "https://tradicoders.ir/assets/images/".$sql_project['language'].".jpg";} ?>" class="LogoProgram"
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
                        <a href="https://www.tradicoders.ir/addProject.php?project_id=<?php echo $projectid ?>" class="NormalLink"> <div>
                            <button
                                    class="OrderPro">سفارش کار مشابه
                            </button>
                        </div></a>
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
                <h3 class="TitleLeftProg TitleFont">قیمت</h3>
                <div class="PricePro"><?php echo $sql_project['price']; ?> تومان</div>
            </div>
            <!-- Files -->
            <div class="WhiteAreaLeft">
                <h3 class="TitleLeftProg TitleFont">فایل ها</h3>
                <?php if ($sql_project['requirement_url'] != "" && $sql_project['requirement_url'] != "null") { ?>
                    <a class="NormalLink" href="<?php echo $sql_project['requirement_url'];?>"><div class="PricePro Ptb5 CursorP EngFont">
                        <i class="fa-regular fa-file"></i>
                        فایل پیوستی
                    </div></a>
                <?php } ?>
            </div>
            <!-- Contact -->
            <div class="WhiteAreaLeft">
                <h3 class="TitleLeftProg TitleFont">پروژه های مشابه</h3>
                <?php
                $sql_tc_project = selectQuery_tc_project("prstatus !='pending' ORDER BY id DESC LIMIT 4");
                foreach ($sql_tc_project as $row) {
                    $pid = $row['id'];
                    $subject = $row['subject'];
                    $langimg = "https://tradicoders.ir/assets/images/".$row['language'].'.jpg';
                    $userid_project = $row['creatoruid'];
                    $sql_info = selectQuery_tc_clients("id='$userid_project'","role,role2");
                    $role_t = $sql_info[0]['role'];
                    $role2_t = $sql_info[0]['role2'];
                    ?>
                    <a href="<?php echo $subject."__".$pid;?>" class="NormalLink"><div  style="cursor: pointer;"  class="ItemInScrolProject">
                        <div>
                            <img src="<?php if (($role_t="agent" || $role="admin") && ($role2_t=="marketing_manger")){echo "https://tradicoders.ir/assets/images/win.png";}else{echo $langimg;} ?>" class="PersonInScroll" alt="Designer Image">
                        </div>
                        <div class="P_TitleInScrollPro">
                            <div class="TitleInScrollPro TitleFont"><?php echo $row["subject"] ?></div>
                            <div class="NameInScrollPro">قیمت
                                : <?php echo('<strong>' . $row["price"] . '</strong>'); ?></div>
                        </div>
                    </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
} else {
    require ("doneproject.php");
}
?>