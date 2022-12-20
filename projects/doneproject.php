<?php
require('required_page.php');
// require('projectbuilder.php');
$action = 'doneproject';
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
if (!empty($_POST["devrequest"])) {
    $newrole = $_POST["devrequest"];
    if ($userid > 0) {
        $sql = "UPDATE tc_clients SET role='$newrole' WHERE id=$userid";
        $conn->query($sql);
    } else {
        echo "<script> login(); </script>";
    }
}
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
    


</head>
<body>
<?php require('../navbar.php') ?>
<div class="MainWrapper M_Mt_50" >
    <!-- Filters -->
    <h1 class="Fs24">دریافت پروژه های برنامه نویسی</h1>
    <div class="Filters">
        <div>
            <div onclick="onClick('btnradio1')"
                 class="ItemFilter <?php if ($_POST['status_show'] == "prstatus='close_cancel' or prstatus='close_complete' or prstatus='close_half'") {
                     echo "ItemFilter_Atcive";
                 } ?>">تمام شده
            </div>
            <div onclick="onClick('btnradio2')"
                 class="ItemFilter <?php if ($_POST['status_show'] == "prstatus='close_pending_cancel' or prstatus='close_pending_complete' or prstatus='close_pending_half' or prstatus='open' or prstatus='waiting_user'"  || !isset($_POST['status_show'])) {
                     echo "ItemFilter_Atcive";
                 } ?> ">درحال انجام
            </div>
            <div onclick="onClick('btnradio3')"
                 class="ItemFilter <?php if ($_POST['status_show'] == "prstatus='approve'") {
                     echo "ItemFilter_Atcive";
                 } ?>">در انتظار توسعه دهنده
            </div>
            <div onclick="openLink('https://tradicoders.ir/addProject.php')" class="SabtOrder">
                <button>ثبت سفارش</button>
            </div>
        </div>
        <div class="P_InputSearch">
            <input type="text" name="search_text" id="search_text" onkeyup="changeAction()" class="InputSearch" placeholder="جستجو..."/>
            <form action="" id="form_search" method="post">
                <input type="hidden" name="status_show" value="<?php echo $_POST['status_show'];?>">
                <input type="submit" id="submit_search" hidden>
                <i onclick="submit_search()" class="SearchIcon fa-solid fa-magnifying-glass"></i>
            </form>
        </div>
    </div>
    <div class="LineFilter SecondaryBG"></div>

    <div class="row m-2">
        <form method="post" action="./">
            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                <input type="radio" class="btn-check" value="prstatus='approve'" name="status_show" id="btnradio3"
                       onclick="changeStatus()"
                       autocomplete="off" hidden>

                <input type="radio" class="btn-check"
                       value="prstatus='close_pending_cancel' or prstatus='close_pending_complete' or prstatus='close_pending_half' or prstatus='open' or prstatus='waiting_user'"
                       name="status_show" id="btnradio2"
                       onclick="changeStatus()" autocomplete="off" hidden>

                <input type="radio" class="btn-check"
                       value="prstatus='close_cancel' or prstatus='close_complete' or prstatus='close_half'"
                       name="status_show"
                       onclick="changeStatus()" id="btnradio1"
                       autocomplete="off" hidden>
            </div>
            <input type="submit" id="submit_status" hidden>
        </form>
    </div>
    <script>
        function changeStatus() {
            document.getElementById('submit_status').click();
        }

        function onClick(id) {
            document.getElementById(id).click();
        }
    </script>
    <div>
        <div class="WrapperAllProjects">
            <?php
            if (isset($_POST['status_show'])) {
                $sstatus = $_POST['status_show'];
                $sql = "SELECT * FROM tc_project WHERE developeruid=-1 and " . $sstatus . " ORDER BY id DESC";
            } else {
                $sql = "SELECT * FROM tc_project WHERE developeruid=-1 and prstatus='close_pending_cancel' or prstatus='close_pending_complete' or prstatus='close_pending_half' or prstatus='open' or prstatus='waiting_user' ORDER BY id DESC";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    if (!isset($_GET['search_text']) || strpos($row['subject'], $_GET['search_text']) !== false || strpos($row['description'], $_GET['search_text']) !== false || $_GET['search_text'] == "") {
                        $pid = $row['id'];
                        $subject = $row['subject'];
                        $userid_project = $row['creatoruid'];
                        $langimg = "https://tradicoders.ir/assets/images/" . $row['language'] . '.jpg';
                        $sql_info = selectQuery_tc_clients("id='$userid_project'","role,role2");
                        $role_t = $sql_info[0]['role'];
                        $role2_t = $sql_info[0]['role2'];
                        ?>
                        <!-- Start Project List -->
                        <div
                              class="ProjectBox">
                            <div class="C_ProjectBox">
                                <div class="P_ImageAndName">

                                    <div class="P_Image">
                                        <img class="ImgPerson" src="<?php if (($role_t="agent" || $role="admin") && ($role2_t=="marketing_manger")){echo "https://tradicoders.ir/assets/images/win.png";}else{echo $langimg;} ?>"/>
                                    </div>
                                    <div class="P_DetailWorks">
                                        <div class="DetailWorks"><?php if (mb_strlen(trim($row["subject"])) > 50) {
                                                echo mb_substr(trim($row["subject"]), 0, 50, 'UTF-8') . " ...";
                                            } else {
                                                echo $row["subject"];
                                            } ?></div>
                                        <!--                                    <div class="NameProducer">-->
                                        <?php //echo $devname;
                                        ?><!----><?php //echo $pid;
                                        ?><!--</div>-->
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

                                    <a href="<?php echo $subject."__".$pid;?>"><button
                                            class="OrderProject">مشاهده کامل پروژه
                                    </button></a>
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
                                            <div class="Tag">MQL4</div>
                                            <?php
                                        } else if ($row["language"] == 'mql5') {
                                            ?>
                                            <div class="Tag">MQL5</div>
                                            <?php
                                        } else if ($row["language"] == 'mql4&mql5') {
                                            ?>
                                            <div class="Tag">MQL4</div>
                                            <div class="Tag">MQL5</div>
                                            <?php
                                        } else if ($row["language"] == 'tradingview') {
                                            ?>
                                            <div class="Tag">TRADING VIEW</div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div>
                                    <div class="P_PriceText">
                                        <div class="PriceText">قیمت</div>
                                        <div class="Price"><?php echo number_format($row["price"], 0); ?> تومان</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                }
            } ?>

        </div>
    </div>
</div>
<!-- Java scripts Codes -->
<script>
    function openLink(link) {
        window.open(link, "_self");
    }

    function changeAction(){
        document.getElementById('form_search').action = "?search_text="+document.getElementById('search_text').value;
    }
    var input = document.getElementById("search_text");

    // Execute a function when the user presses a key on the keyboard
    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            submit_search()
        }
    });
    function submit_search(){
        document.getElementById('submit_search').click();
    }
</script>
<script src="js/Projects.js"></script>
</body>
</html>
