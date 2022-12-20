<?php
// print_r($_FILES);
require('required_page.php');


function uploadfile($projectid)
{
    $response = array();
    $target_file = "null";
    if (isset($_FILES["eprfile"])) {
        $target_dir = "projects/" . $projectid . "/";
        $randomName = rand(100000, 999999);
        $target_file = $target_dir . $randomName . basename($_FILES["eprfile"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
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

        $sql = "INSERT INTO tc_project (requirement_url, creatoruid, developeruid, subject, description, prname, prstarttime, language, type, price)
        VALUES ('n', '$userid', '-1', '$subject', '$description', '$subject', '$dateTo', '$eprlang', '$eprtype', '$price')";
        // echo $sql;
        if ($conn->query($sql) === TRUE) {
            $projectid = $conn->insert_id;
            mkdir("./projects/" . $projectid, 0777);
            echo "Make Directory : " . $projectid;
            $clinicpath = "https://tradicoders.ir/" . uploadfile($projectid);


            $sql3 = "UPDATE tc_project SET requirement_url='$clinicpath' WHERE id='$projectid'";
            if ($conn->query($sql3) === TRUE) {
                $response = "true";
            } else {
                $response = "false";
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
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- Css Codes -->
    <link rel="stylesheet" href="css/global.css"/>
    <link rel="stylesheet" href="css/projectPage.css"/>
    <link rel="stylesheet" href="css/login.css"/>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/style_checkbox2.css">
    <link rel="stylesheet" href="css/fonts.css">

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
                راهنمای ثبت سفارش
            </div>
            <div class="ItemFilter" onclick="ShowPannel(1)">ثبت سفارش</div>
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
                <div class="TitleGuide">راهنمای ثبت سفارش</div>
                <div class="DeskGuide">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                    استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
                    در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                    نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                    کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان
                    جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای
                    طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان
                    فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری
                    موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد
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
                <div class="TitleGuide TextEnd MbTextCenter">راهنمای ثبت سفارش</div>
                <div class="DeskGuide TextEnd MbTextCenter">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                    استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
                    در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                    نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                    کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان
                    جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای
                    طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان
                    فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری
                    موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد
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
                <div class="TitleGuide">راهنمای ثبت سفارش</div>
                <div class="DeskGuide">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                    استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
                    در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                    نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                    کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان
                    جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای
                    طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان
                    فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری
                    موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد
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
                <div class="TitleGuide TextEnd MbTextCenter">راهنمای ثبت سفارش</div>
                <div class="DeskGuide TextEnd MbTextCenter">
                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با
                    استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله
                    در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد
                    نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                    کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان
                    جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای
                    طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان
                    فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری
                    موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد
                </div>
            </div>
        </div>
        <!-- End Guide -->

        <div class="VideoSection">
            <div class="VideoTitle">فیلم اموزشی راهنمای ثبت سفارش</div>
            <div class="LineFilter"></div>
            <div>ویدیو</div>
        </div>
    </div>
    <!-- End For Tab 0  -->

    <!-- Start For Tab 1  -->
    <div class="MyTab OrderForms">
        <form action="projectbuilder.php" method="post" enctype="multipart/form-data" id="formMain">
        <div class="P_Inputs">
            <div class="OurInput">
                <label for="ProjectName">
                    <i class="fa-solid fa-exclamation ExclamationMark"></i>نام
                    پروژه</label
                >
                <input name="eprname"type="text" id="ProjectName" class="FormInput"/>
            </div>

        </div>
        <div class="P_Inputs">
            <div class="OurInput">
                <label for="ProjectLang">
                    <i class="fa-solid fa-exclamation ExclamationMark"></i>انتخاب
                    زبان</label
                >
                <select onchange="showFunctions()"
                        class="form-select FormSelect"
                        aria-label="Default select example"
                        id="ProjectLang" name="eprlang"
                >
                    <option value="mql4">MQL4</option>
                    <option value="mql5" <?php if ($language == "mql5") {
                        echo "selected";
                    } ?> >MQL5
                    </option>
                </select>
            </div>
            <div class="OurInput">
                <label for="ProjectType">
                    <i class="fa-solid fa-exclamation ExclamationMark"></i>انتخاب نوع
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
        </div>
        <div class="P_Inputs">
            <div class="OurInput">
                <div class="File">
                    انتخاب فایل
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    <input type="file" name="eprfile" class="MainFileInput"/>
                </div>
            </div>
        </div>

            <div class="P_Inputs">
                <div class="OurInput">
                    <label for="functions">
                        <i class="fa-solid fa-exclamation ExclamationMark"></i>انتخاب فانکشن ها</label>
                    <input type='hidden' name='prfunctions'  id='prfunctions' >
                    <div class="container" id="functions">


                    </div>
                </div>
            </div>

            <div class="Center">
                <div id="function_more" class="SeeAllProjects">
                    مشاهده همه فانکشن ها <i class="fa-solid fa-arrow-left-long"></i>
                </div>
            </div>


            <div class="P_Inputs">
                <div class="OurInput">
                    <label for="functions">
                        <i class="fa-solid fa-exclamation ExclamationMark"></i>ساخت لاجیک</label>
                    <div class="container">

                        <?php require('itemlist.html'); ?>

                    </div>
                </div>
            </div>


            <div class="P_Inputs">
                <div class="OurInput">
                    <label for="functions">
                        <i class="fa-solid fa-exclamation ExclamationMark"></i>انتخاب لاجیک</label>
                    <div class="container" id="logics_show">



                    </div>
                </div>
            </div>

            <div class="Center">
                <div id="logic_more"  class="SeeAllProjects">
                    مشاهده همه لاجیک ها <i class="fa-solid fa-arrow-left-long"></i>
                </div>
            </div>


        <div>
            <?php if ($userid > 0) { ?>
            <button type="submit" name="eprsubmit2" value="1001" class="ConfirmBtn">
                ثبت سفارش
                <i class="fa-solid fa-check"></i>
            </button>

                <?php
            }
            ?>
               </div>
        </form>
            <?php if ($userid < 0) {
            ?>
                <button onclick="openLink('login.php')"  class="ConfirmBtn">
                    قبل از ثبت سفارش وارد شوید
                    <i class="fa-solid fa-check"></i>
                </button>
                <?php
            }
            ?>

    </div>
    <!-- End For Tab 1  -->
</div>

<script>
    functionsMql4 = <?php echo json_encode(selectQuery_tc_functions("FCode!='1' and FCode!='2' and FCode!='4' and language='mql4'",'FName, FHelp, FCode, FKey'))?>;
    functionsMql5 = <?php echo json_encode(selectQuery_tc_functions("FCode!='1' and FCode!='2' and FCode!='4' and language='mql5'",'FName, FHelp, FCode, FKey'))?>;

    codefunctionMql4 = "";
    codefunctionMql4_2 = "";
    helper = 0;
    for (functionMql4 of functionsMql4) {
        codefunctionMql4_n = '<div class="grid-wrapper grid-col-auto">'+
            '<label for="card-func-' + functionMql4['FKey'] + '" class="radio-card">'+
            '<input type="checkbox" value="' + functionMql4['FKey'] + '" onclick="addCheck(\''+functionMql4['FKey']+'\')" id="card-func-' + functionMql4['FKey'] + '" />'+
            '<div style="background: #ffecec;" class="card-content-wrapper">'+
            '<span class="check-icon"></span>'+
            '<div class="card-content">'+
            '<h4>' + functionMql4['FName'] + '</h4>'+
            '<h5>' + functionMql4['FHelp'] + '</h5>'+
            '</div>'+
            '</div>'+
            '</label></div>';

        codefunctionMql4 += codefunctionMql4_n;

        helper ++;
        if (helper < 7) {
            codefunctionMql4_2 += codefunctionMql4_n;
        }
    }

    codefunctionMql5 = "";
    codefunctionMql5_2 = "";
    helper = 0;
    for (functionMql5 of functionsMql5) {
        codefunctionMql5_n = '<div class="grid-wrapper grid-col-auto">'+
            '<label for="card-func-' + functionMql5['FKey'] + '" class="radio-card">'+
            '<input type="checkbox" value="' + functionMql5['FKey'] + '" id="card-func-' + functionMql5['FKey'] + '" />'+
            '<div style="background: #ffecec;" class="card-content-wrapper">'+
            '<span class="check-icon"></span>'+
            '<div class="card-content">'+
            '<h4>' + functionMql5['FName'] + '</h4>'+
            '<h5>' + functionMql5['FHelp'] + '</h5>'+
            '</div>'+
            '</div>'+
            '</label></div>';
        codefunctionMql5 += codefunctionMql5_n;
        helper ++;
        if (helper < 7) {
            codefunctionMql5_2 += codefunctionMql5_n;
        }
    }

    logicsMql4 = <?php echo json_encode(selectQuery_tc_MQL4_Logics('','LName, LHelp, LCode'))?>;
    logicsMql5 = <?php echo json_encode(selectQuery_tc_MQL5_Logics('','LName, LHelp, LCode'))?>;

    logicsCustom = <?php echo json_encode(selectQuery_tc_custom_logic("userid='$userid'"))?>;

    codelogicMql4 = "";
    codelogicMql5 = "";
    codelogicMql4_2 = "";
    codelogicMql5_2 = "";
    codeLogicSelectorMql4 = "<option selected>انتخاب ایتم</option>";
    codeLogicSelectorMql5 = "<option selected>انتخاب ایتم</option>";

    hepler = 0;
    hepler2 = 0;
    for (logic_mql4_mql5 of logicsCustom) {

        if (logic_mql4_mql5['language'] === "mql4") {
            codelogicMql4_n = '<div class="grid-wrapper grid-col-auto">' +
                '<label for="card-' + logic_mql4_mql5['id'] + '" class="radio-card">' +
                '<input type="radio" name="prlogics" value="' + logic_mql4_mql5['id'] + '" id="card-' + logic_mql4_mql5['id'] + '" />' +
                '<div class="card-content-wrapper">' +
                '<span class="check-icon"></span>' +
                '<div class="card-content">' +
                '<h4>' + logic_mql4_mql5['name'] + '</h4>' +
                '<h5>' + logic_mql4_mql5['description'] + '</h5>' +
                '</div>' +
                '</div>' +
                '</label></div>';
            codelogicMql4 += codelogicMql4_n;

            hepler ++;
            if (hepler < 7){
                codelogicMql4_2 += codelogicMql4_n;
            }

            codeLogicSelectorMql4 += '<option value=\'{"name":"'+logic_mql4_mql5['name']+'","id":"'+logic_mql4_mql5['id']+'"}\' class="OurItems">'+logic_mql4_mql5['name']+'</option>';
        }else {
            codelogicMql5_n = '<div class="grid-wrapper grid-col-auto">' +
                '<label for="card-' + logic_mql4_mql5['id'] + '" class="radio-card">' +
                '<input type="radio" name="prlogics" value="' + logic_mql4_mql5['id'] + '" id="card-' + logic_mql4_mql5['id'] + '" />' +
                '<div class="card-content-wrapper">' +
                '<span class="check-icon"></span>' +
                '<div class="card-content">' +
                '<h4>' + logic_mql4_mql5['name'] + '</h4>' +
                '<h5>' + logic_mql4_mql5['description'] + '</h5>' +
                '</div>' +
                '</div>' +
                '</label></div>';
            codelogicMql5 += codelogicMql5_n;

            hepler2 ++;
            if (hepler2 < 7){
                codelogicMql5_2 += codelogicMql5_n;
            }
            codeLogicSelectorMql5 += '<option value=\'{"name":"'+logic_mql4_mql5['name']+'","id":"'+logic_mql4_mql5['id']+'"}\' class="OurItems">'+logic_mql4_mql5['name']+'</option>';
        }
    }


    helper = 0;
    for (logicMql4 of logicsMql4) {
        codelogicMql4_n = '<div class="grid-wrapper grid-col-auto">'+
            '<label for="card-' + logicMql4['LCode'] + '" class="radio-card">'+
            '<input type="radio" name="prlogics" value="' + logicMql4['LCode'] + '" id="card-' + logicMql4['LCode'] + '" />'+
            '<div class="card-content-wrapper">'+
            '<span class="check-icon"></span>'+
            '<div class="card-content">'+
            '<h4>' + logicMql4['LName'] + '</h4>'+
            '<h5>' + logicMql4['LHelp'] + '</h5>'+
            '</div>'+
            '</div>'+
            '</label></div>';

        codelogicMql4 += codelogicMql4_n;
        hepler ++;
        if (hepler < 7){
            codelogicMql4_2 += codelogicMql4_n;
        }

        codeLogicSelectorMql4 += '<option value=\'{"name":"'+logicMql4['LName']+'","id":"'+logicMql4['LCode']+'"}\' class="OurItems">'+logicMql4['LName']+'</option>';
    }


    for (logicMql5 of logicsMql5) {
        codelogicMql5_n = '<div class="grid-wrapper grid-col-auto">'+
            '<label for="card-' + logicMql5['LCode'] + '" class="radio-card">'+
            '<input type="radio" name="prlogics" value="' + logicMql5['LCode'] + '" id="card-' + logicMql5['LCode'] + '" />'+
            '<div class="card-content-wrapper">'+
            '<span class="check-icon"></span>'+
            '<div class="card-content">'+
            '<h4>' + logicMql5['LName'] + '</h4>'+
            '<h5>' + logicMql5['LHelp'] + '</h5>'+
            '</div>'+
            '</div>'+
            '</label></div>';

        codelogicMql5 += codelogicMql5_n;
        hepler ++;
        if (hepler < 7){
            codelogicMql5_2 += codelogicMql5_n;
        }

        codeLogicSelectorMql5 += '<option value=\'{"name":"'+logicMql5['LName']+'","id":"'+logicMql5['LCode']+'"}\' class="OurItems">'+logicMql5['LName']+'</option>';
    }




    function showLogics(count = "0"){
        var lang = document.getElementById('ProjectLang').value;
        if (count === "1") {
            document.getElementById('logic_more').innerText = "مشاهده محدود";
            document.getElementById('logic_more').onclick = function () {
                showLogics('0')
            };
            if (lang === 'mql4') {
                document.getElementById('logics_show').innerHTML = codelogicMql4;
                document.getElementById('logics_selector').innerHTML = codeLogicSelectorMql4;
            } else if (lang === 'mql5') {
                document.getElementById('logics_show').innerHTML = codelogicMql5;
                document.getElementById('logics_selector').innerHTML = codeLogicSelectorMql5;
            }
        }else {
            document.getElementById('logic_more').innerText = "مشاهده همه لاجیک ها";
            document.getElementById('logic_more').onclick = function () {
                showLogics('1')
            };
            if (lang === 'mql4') {
                document.getElementById('logics_show').innerHTML = codelogicMql4_2;
                document.getElementById('logics_selector').innerHTML = codeLogicSelectorMql4;
            } else if (lang === 'mql5') {
                document.getElementById('logics_show').innerHTML = codelogicMql5_2;
                document.getElementById('logics_selector').innerHTML = codeLogicSelectorMql5;
            }
        }
    }


    function showFunctions(count = "0"){
        var lang = document.getElementById('ProjectLang').value;
        if (count === "1"){
            document.getElementById('function_more').innerText = "مشاهده محدود";
            document.getElementById('function_more').onclick = function () {
                showFunctions('0')
            };
            if (lang === 'mql4') {
                document.getElementById('functions').innerHTML = codefunctionMql4;
            } else if (lang === 'mql5') {
                document.getElementById('functions').innerHTML = codefunctionMql5;
            }
        }else {
            document.getElementById('function_more').innerText = "مشاهده همه فانکشن ها";
            document.getElementById('function_more').onclick = function () {
                showFunctions('1')
            };
            if (lang === 'mql4') {
                document.getElementById('functions').innerHTML = codefunctionMql4_2;
            } else if (lang === 'mql5') {
                document.getElementById('functions').innerHTML = codefunctionMql5_2;
            }
        }
        showLogics()
    }
    showFunctions()

    array_func = [];
    FKey2 = "";
    function searchArray(func){
        if (FKey2 === func){
            return true;
        }
        return false
    }
    function addCheck(FKey){
        FKey2 = FKey;
        findit = array_func.findIndex(searchArray);
        if (findit > -1){
            array_func.splice(findit,1);
        }else {
            array_func.push(FKey);
        }
        document.getElementById('prfunctions').value = array_func.toString();
    }

</script>
<!-- Java scripts Codes -->
<script src="js/TabChanger.js"></script>
<script src="js/Items.js"></script>
</body>
</html>

