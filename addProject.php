<?php
// print_r($_FILES);
require('required_page.php');
$action = 'addproject';

function uploadfile($projectid)
{
    $response = array();
    $target_file = "null";
    if (isset($_FILES["eprfile"])) {
        $target_dir = "projects/files/" . $projectid . "/";
        $randomName = rand(100000, 999999);
        $target_file = $target_dir . $randomName . basename($_FILES["eprfile"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType == "") {
            return "null";
        }
        $target_file = $target_dir . $randomName . "." . $imageFileType;

        try {
            move_uploaded_file($_FILES['eprfile']['tmp_name'], $target_file);
            // echo "success";

        } catch (Exception $e) {

            $response['error'] = true;
            $response['message'] = $e->getMessage();

        }
    }
    // print_r($_FILES);
    return $target_file;
}

// set request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $subject = $_POST['eprname'];
    $description = $_POST['eprdes'];
    $eprlang = $_POST['eprlang'];
    $eprtype = $_POST['eprtype'];
    $price = $_POST['eprprice'];
    $dateTo = date("Y/m/d h:i:s");


    $sql = "SELECT * FROM tc_clients WHERE id='$userid' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $balance = $row["balance"];
            $hold = $row["hold"];
        }
    }

    if ((int)$price <= (int)$balance) {

        $help = '0';

        if (isset($_POST['help']) && $_POST['help'] != ""){
            $help = '1';
        }

        $sql = "INSERT INTO tc_project (creatoruid, developeruid, subject, description, prname, prstarttime, language, type, price, help)
        VALUES ('$userid', '-1', '$subject', '$description', '$subject', '$dateTo', '$eprlang', '$eprtype', '$price', '$help')";
        // echo $sql;
//        echo "ss".$sql;
        if ($conn->query($sql) === TRUE) {
            $projectid = $conn->insert_id;

            mkdir("./projects/files/" . $projectid, 0777);
//            echo "Make Directory : " . $projectid;
            $pathurl = uploadfile($projectid);
            if ($pathurl != "null") {
                $clinicpath = "https://tradicoders.ir/" . $pathurl;


                $sql3 = "UPDATE tc_project SET requirement_url='$clinicpath' WHERE id='$projectid'";
                if ($conn->query($sql3) === TRUE) {
                    $response = "true";
                } else {
                    $response = "false";
                }
            }

            $newbalance = (int)$balance - (int)$price;
            $newhold = (int)$hold + (int)$price;
            $sql3 = "UPDATE tc_clients SET balance='$newbalance', hold='$newhold'  WHERE id='$userid' ";
            if ($conn->query($sql3) === TRUE) {
                $response = "true";
            } else {
                $response = "false";
                // refresh
            }

            $not_parameters = array();

            $not_parameters['nameproject'] = $subject;
            $not_parameters['description'] = $description;
            $not_parameters['projectid'] = $projectid;
            $not_parameters['priceproject'] = $price;

            setNotifPer("new_project", $not_parameters, $userid);
            openLink('profile/index.php');
        }

    } else {
        echo "<script>alert('موجودی حساب شما کافی نمی باشد')</script>";
    }


}
// ./set request
// get data another project
else if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $Projectid2 = $_GET['project_id'];

    $sql = "SELECT * FROM tc_project WHERE id='$Projectid2' ";
    // echo $projectid;
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {

            $subject = $row['subject'];
            $description2 = $row['description'];
            $language = $row['language'];
            $type = $row['type'];
            $price = $row['price'];

        }
    }
}
// ./get data another project

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
    <link rel="stylesheet" href="css/fonts.css"/>

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


    <!-- Bootstrap 5 -->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
    />
    <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"
    ></script>

    <!-- Font Awesome Icon-->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />

    <title>لیست پروژه ها</title>
</head>
<body>
<?php require('navbar.php') ?>
<br>
<div class="MainWrapper">
    <!-- Filters -->
    <div class="Filters SecondaryColor">
        <div>
            <div class="ItemFilter ItemFilter_Atcive" onclick="ShowPannel(0)">
                راهنمای ثبت پروژه
            </div>
            <div class="ItemFilter" onclick="ShowPannel(1)">ثبت سفارش پروژه</div>
            <div class="ItemFilter" onclick="ShowPannel(2)">سفارش پروژه های برتر</div>
        </div>
    </div>
    <div class="LineFilter"></div>

    <!-- For Tab 0  -->
    <div class="MyTab">
        <!-- Start Guide -->
        <div class="P_Guide">
            <div class="ShapeX">
                <i class="fa-solid fa-address-card IconGuide"></i>
            </div>
            <div class="P_TitleGuide">
                <div class="TitleGuide"><?php echo $pagecontent[20]; ?></div>
                <div class="DeskGuide">
                    <?php echo $pagecontent[21]; ?>
                </div>
            </div>
        </div>
        <!-- End Guide -->

        <!-- Start Guide -->
        <div class="P_Guide Ltr">
            <div class="ShapeX">
                <i class="fa-solid fa-address-card IconGuide"></i>
            </div>
            <div class="P_TitleGuide">
                <div class="TitleGuide TextEnd MbTextCenter"><?php echo $pagecontent[22]; ?></div>
                <div class="DeskGuide TextEnd MbTextCenter">
                    <?php echo $pagecontent[23]; ?>
                </div>
            </div>
        </div>
        <!-- End Guide -->

        <!-- Start Guide -->
        <div class="P_Guide">
            <div class="ShapeX">
                <i class="fa-solid fa-address-card IconGuide"></i>
            </div>
            <div class="P_TitleGuide">
                <div class="TitleGuide"><?php echo $pagecontent[24]; ?></div>
                <div class="DeskGuide">
                    <?php echo $pagecontent[25]; ?>
                </div>
            </div>
        </div>
        <!-- End Guide -->

        <!-- Start Guide -->
        <div class="P_Guide Ltr">
            <div class="ShapeX">
                <i class="fa-solid fa-address-card IconGuide"></i>
            </div>
            <div class="P_TitleGuide">
                <div class="TitleGuide TextEnd MbTextCenter"><?php echo $pagecontent[26]; ?></div>
                <div class="DeskGuide TextEnd MbTextCenter">
                    <?php echo $pagecontent[27]; ?>
                </div>
            </div>
        </div>
        <!-- End Guide -->

        <div class="VideoSection">
            <div class="VideoTitle">فیلم اموزشی راهنمای ثبت پروژه</div>
            <div class="LineFilter"></div>
            <div>ویدیو</div>
        </div>
    </div>
    <!-- End For Tab 0  -->

    <!-- Start For Tab 1  -->


   


    <div class="MyTab OrderForms">
   
    <!-- Start Multi Step -->
    <div class="P_FormOfStep">

    <?php if ($userid > 0) { ?>

        <div class="Flex1">
    <form action="" method="post" enctype="multipart/form-data" id="formMain" class="W_100">

            
            <!-- <h1 class="text-center Fs24">ثبت سفارش پروژه</h1> -->
            <!-- Progress bar -->
            <div class="progressbar">
                <div class="progress" id="progress"></div>
                
                <div
                class="progress-step progress-step-active"
                data-title="مشخصات اولیه"
                ></div>
                <div class="progress-step" data-title="توضیحات"></div>
                <div class="progress-step" data-title="پیوست فایل"></div>
                <div class="progress-step" data-title="پشتیبانی"></div>
            </div>

            <!-- Steps -->
            <div class="form-step form-step-active">
                    <div class="">
                        <label for="ProjectName">
                            <i class="fa-solid fa-exclamation ExclamationMark">
                                <div class="DeatilsForms">
                                    <?php echo $pagecontent[11]; ?>
                                </div>
                            </i>نام
                            پروژه</label>
                        <input name="eprname" value="<?php echo $subject ?>" type="text" id="ProjectName"
                            class="FormInput"/>
                    </div>
                    <div class=" Mt_20">
                        <label for="ProjectPrice">
                            <i class="fa-solid fa-exclamation ExclamationMark">
                                <div class="DeatilsForms">
                                    <?php echo $pagecontent[12]; ?>
                                </div>
                            </i>مبلغ
                            پیشنهادی (واحد تومان)</label
                        >
                        <input type="text" onkeyup="to_alpha()" value="<?php echo $price ?>" name="eprprice" id="ProjectPrice"
                            class="FormInput"/>
                        <div id="price_label" class="Mt_10"></div>
                    </div>
                    <div class="Mt_20">
                    <label for="ProjectLang">
                        <i class="fa-solid fa-exclamation ExclamationMark">
                            <div class="DeatilsForms">
                                <?php echo $pagecontent[13]; ?>
                            </div>
                        </i>انتخاب
                        زبان</label
                    >
                    <select
                            class="form-select FormSelect"
                            aria-label="Default select example"
                            id="ProjectLang" name="eprlang"
                    >
                        <option value="mql4">MQL4</option>
                        <option value="mql5" <?php if ($language == "mql5") {
                            echo "selected";
                        } ?> >MQL5
                        </option>
                        <option value="mql4&mql5" <?php if ($language == "mql4&mql5") {
                            echo "selected";
                        } ?> >MQL4 & MQL5
                        </option>
                        <option value="tradingview" <?php if ($language == "tradingview") {
                            echo "selected";
                        } ?> >trading view
                        </option>
                    </select>
                </div>
                <div class="Mt_20">
                    <label for="ProjectType">
                        <i class="fa-solid fa-exclamation ExclamationMark">
                            <div class="DeatilsForms">
                                <?php echo $pagecontent[14]; ?>
                            </div>
                        </i>انتخاب نوع
                        برنامه</label
                    >
                    <select
                            class="form-select FormSelect"
                            aria-label="Default select example"
                            id="ProjectType" name="eprtype"
                    >
                        <option value="expert">اکسپرت</option>
                        <option value="indicator" <?php if ($type == "indicator") {
                            echo "selected";
                        } ?> >اندیکیتور
                        </option>
                        <option value="script" <?php if ($type == "script") {
                            echo "selected";
                        } ?> >اسکریپت
                        </option>
                    </select>
                </div>
                <div class="Mt_30 btns_group1">
                    <a href="#" class="btn_Step btn-next ">مرحله بعد</a>
                </div>
            
            </div>
            <div class="form-step">
                <div class="Mt_20">
                    <label for="ProjectLang">
                        <i class="fa-solid fa-exclamation ExclamationMark">
                            <div class="DeatilsForms">
                                <?php echo $pagecontent[16]; ?>
                            </div>
                        </i>توضیحات
                        پروژه</label>
                    <textarea name="eprdes" id="" cols="30" rows="10"
                              class="TextArea"><?php echo $description2 ?></textarea>
                </div>
                <div class="btns_group Mt_30">
                    <a href="#" class="btn_Step btn-prev PrevBtn">بازگشت</a>
                    <a href="#" class="btn_Step btn-next ">مرحله بعد</a>
                </div>
            </div>
            <div class="form-step">
                <div class="P_OfFile">
                    <div class="Flex1">
                        <h3 class="Fs24 Text_center">فایل پیوستی خود را وراد کنید</h3>
                        <div class="Mt_20">
                            <div class="File">
                                انتخاب فایل
                                <i class="fa-solid fa-arrow-up-from-bracket">
                                    <div class="DeatilsForms">
                                        <?php echo $pagecontent[15]; ?>
                                    </div>
                                </i>
                                <input type="file" name="eprfile" class="MainFileInput"/>
                            </div>
                        </div>
                    </div>
                    <div class="Flex1">
                        <img src="assets/images/FileTransfer.png" class="W_100" alt="">
                    </div>
                    
                    
                </div>
                <div class="btns_group Mt_30">
                    <a href="#" class="btn_Step btn-prev PrevBtn">بازگشت</a>
                    <a href="#" class="btn_Step btn-next">مرحله بعد</a>
                </div>
            </div>
            <div class="form-step">
               
                <div class="P_OfFile">
                        <div class="Flex1">
                            <h3 class="Fs24 Text_center">مشاوره حرفه ای توسط تریدی کدرز</h3>
                            <div class="Mt_20">
                            <label class="container_Check">
                                به مشاوره نیاز دارم
                                <input type="checkbox" name="help" />
                                <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="Flex1 D_ltr">
                            <img src="assets/images/Support.png" class="ImgSup" alt="">
                        </div>
                    
                    
                </div>
                <div class="btns_group Mt_30">
                    <a href="#" class="btn_Step btn-prev PrevBtn">بازگشت</a>
               
                                    <button type="submit" name="eprsubmit2" value="1001" class="btn_Step_Confirm">
                                        ثبت پروژه
                                        <i class="fa-solid fa-check"></i>
                                    </button>

                                  
                            </div>
                       

                <!-- </div>
                    <a href="#" class="btn_Step btn-next">مرحله بعد</a>
                </div> -->
            </div>

            </form>

        </div>
        <div class="P_ImgStep">
            <img src="assets/images/BgMain.jpg" alt="">
        </div>
        <?php }?>

        <?php if ($userid < 0) {
                            ?>
                            <div class="Flex1">
                                <div class="P_OfFile">
                                    <div class="Flex1">
                                        <h3 class="Fs30 Text_center"> قبل از ثبت سفارش پروژه وارد شوید</h3>
                                        <div class="Mt_20">
                                                <button  class="BtnLoginBlue" onclick="openLink('login.php?url_redirect=addProject.php')"   >
                                                    ورود

                                                </button>
                                        
                                        </div>
                                    </div>
                                    <div class="Flex1 D_ltr">
                                        <img src="assets/images/userlogin.png" class="ImgSup" alt="">
                                    </div>
                                
                                
                                </div>
                               
                            </div>
                            <?php
                        }
                        ?>
       
    </div>
   
    <!-- End Multi Step  -->
       
            
           

                
          
    <!-- End For Tab 1  -->


    <div class="MyTab">
        <div class="WrapperAllProjects">
            <?php
            $sql = "SELECT * FROM tc_project WHERE priority !='0' ORDER BY priority";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    if (!isset($_GET['search_text']) || strpos($row['subject'], $_GET['search_text']) !== false || strpos($row['description'], $_GET['search_text']) !== false || $_GET['search_text'] == "") {
                        $pid = $row['id'];
                        $subject = $row['subject'];
                        $userid_project = $row['creatoruid'];
                        $langimg = "assets/images/" . $row['language'] . '.jpg';
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

                                    <a href="https://projects.tradicoders.ir/<?php echo $subject."__".$pid;?>"><button
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
<script src="js/TabChanger.js"></script>
<script src="js/Projects.js"></script>
<script src="js/addProject.js"></script>
</body>
</html>

<?php
if (isset($_GET['project_id'])) {
    echo "<script>ShowPannel(1);</script>";
}
?>
