<?php
require('required_page.php');
// require('projectbuilder.php');


$action = 'projectpage';
$search = $_GET["se"];
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
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Css Codes -->
    <link rel="stylesheet" href="css/global.css"/>
    <link rel="stylesheet" href="css/projectPage.css"/>
    <title>لیست پروژه ها</title>
    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="assets/images/Logo.gif">


</head>
<body>
<?php require('navbar.php')?>
<div class="MainWrapper" style="margin-top: 8%;">
    <!-- Filters -->
    <div class="Filters">
        <div>
            <div onclick="onClick('btnradio1')"
                 class="ItemFilter <?php if ($_POST['status_show'] == "prstatus='close_cancel' or prstatus='close_complete' or prstatus='close_half'") {
                     echo "ItemFilter_Atcive";
                 } ?>">تمام شده
            </div>
            <div onclick="onClick('btnradio2')"
                 class="ItemFilter <?php if ($_POST['status_show'] == "prstatus='close_pending_cancel' or prstatus='close_pending_complete' or prstatus='close_pending_half' or prstatus='open' or prstatus='waiting_user'") {
                     echo "ItemFilter_Atcive";
                 } ?> ">درحال انجام
            </div>
            <div onclick="onClick('btnradio3')"
                 class="ItemFilter <?php if ($_POST['status_show'] == "prstatus='approve'" || !isset($_POST['status_show'])) {
                     echo "ItemFilter_Atcive";
                 } ?>">در انتظار توسعه دهنده
            </div>
            <div class="SabtOrder">
                <button >ثبت پروژه</button>
            </div>
        </div>
        <div class="P_InputSearch">
            <input type="text" class="InputSearch" placeholder="جستجو...">
            <i class="SearchIcon fa-solid fa-magnifying-glass"></i>
        </div>
    </div>
    <div class="LineFilter SecondaryBG"></div>

    <div class="row m-2">
        <form method="post" action="">
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
                $sql = "SELECT * FROM tc_project WHERE developeruid=-1 and prstatus ='approve' ORDER BY id DESC";
            }
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $pid = $row['id'];
                    $uid = $row['creatoruid'];
                    $sql1 = "SELECT * FROM tc_clients WHERE id='$uid'";
                    $result1 = $conn->query($sql1);
                    if ($result1->num_rows > 0) {
                        // output data of each row
                        while ($row1 = $result1->fetch_assoc()) {
                            $devname = $row1["firstname"] . " " . $row1["lastname"];
                            $devimg = $row1["imgurl"];
                        }
                    }
                    ?>
                    <!-- Start Project List -->
                    <div class="ProjectBox">
                        <div class="C_ProjectBox">
                            <div class="P_ImageAndName">

                                <div class="P_Image">
                                    <img class="ImgPerson" src="<?php echo $devimg; ?>"/>
                                </div>
                                <div class="P_DetailWorks">
                                    <div class="DetailWorks TitleFont"><?php if (mb_strlen(trim($row["subject"])) > 50) {
                                            echo mb_substr(trim($row["subject"]), 0, 50, 'UTF-8') . " ...";
                                        } else {
                                            echo $row["subject"];
                                        } ?></div>
                                    <div class="NameProducer"><?php echo $devname; ?><?php echo $pid; ?></div>
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
                                            <button type="submit" class="OrderProject">دریافت و انجام کار</button>
                                        </form>
                                    <?php }
                                } else { ?>

                                    <button onclick="openLink('https://www.tradicoders.ir/addProject.php?project_id=<?php echo $pid ?>')"
                                            class="OrderProject">سفارش کار مشابه
                                    </button>
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
            } ?>

        </div>
    </div>
</div>
 <!-- Footer -->
 <?php 
        require_once("footer.php");
    ?>
<!-- Java scripts Codes -->
<script>
    function openLink(link) {
        window.open(link, "_self");
    }
</script>
<script src="js/Projects.js"></script>
</body>
</html>
