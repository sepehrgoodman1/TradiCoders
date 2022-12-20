<?php
require("backend_header.php");
function uploadfile()
{
    $response = array();
    $target_file = "null";
    if (isset($_FILES["eprfile"])) {
        $target_dir = "ticketsfile/";
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
if (isset($_POST['message'])){
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $category = $_POST['category'];

    insertQuery('tc_ticket','userid, category, subject',"'$userid', '$category', '$subject'");
    $ticket_id = $conn->insert_id;
    $filepath = "https://tradicoders.ir/profile/" . uploadfile();
    insertQuery('tc_ticket_message','ticket_id, message, pathurl',"'$ticket_id', '$message', '$filepath'");
    successOperation('تیکت شما ثبت شد');

}
if (isset($_GET['developer_request'])){
    $sql_user_info = selectQuery_tc_clients("id='$userid'","firstname, lastname");
    $nameuser = $sql_user_info[0]['firstname']." ".$sql_user_info[0]['lastname'];
    $bodymess = "با سلام اینجانب $nameuser قصد فعالیت در تریدی کدرز به عنوان توسعه دهنده را دارم";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    $title = 'پروفایل | پروژه ها';
    $keywords = 'tradicoders, trading, programing, mql4, mql5,tradingView,تریدی کدرز,برنامه نویسی,ام کیو ال4 ,تریدینگ ویو';
    $description = 'شما می توانید از این بخش پروژه های خود را مشاهده و کنترل کنید';
    $icon = '../tradi-coders-logo-final.gif';
    defualtMetaAndStyleProfile($title, $keywords, $description, $icon); ?>
    <!-- Css Codes -->
    <link rel="stylesheet" href="../css/global.css"/>
    <link rel="stylesheet" href="../css/login.css"/>
    <link rel="stylesheet" href="css/profile.css"/>

    <!-- Font Awesome Icon-->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />

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

    <!-- Fav Icon -->
    <link rel="icon" type="image/x-icon" href="assets/images/Logo.gif"/>
</head>
<body class="hold-transition sidebar-mini">
<!-- Navbar -->
<?php require_once("navbar.php"); ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<!-- Sidebar -->
<?php require_once("sidebar.php"); ?>
<!-- /.sidebar -->
<div class="WraperSup content-wrapper">
    <div class="PAllBoxs">
        <div class="P_Boxs">
            <div onclick="changecategory('public')" class="Boxs">
                <div>
                    <i id="public_category_icon" class="fa-solid fa-user-group IconSup"></i>
                </div>
                <div id="public_category_text" class="TextSup">عمومی</div>
            </div>
            <div onclick="changecategory('accounting')" class="Boxs">
                <div>
                    <i id="accounting_category_icon" class="fa-solid fa-briefcase IconSup"></i>
                </div>
                <div id="accounting_category_text" class="TextSup">اداری و مالی</div>
            </div>
            <div onclick="changecategory('developer')" class="Boxs">
                <div>
                    <i id="developer_category_icon" class="fa-solid fa-code IconSup ActiveTab"></i>
                </div>
                <div id="developer_category_text" class="TextSup ActiveTab">توسعه دهندگان</div>
            </div>
        </div>
    </div>
    <form enctype="multipart/form-data" action="" method="post">
        <input type="hidden" name="category" id="input_category">
        <div>

            <div class="P_TwoInput">
                <div class="P_Input_Two">
                    <label class="LabelInput">عنوان</label>
                    <input name="subject"
                            type="class"
                            class="FormInput"
                            placeholder="عنوان را وارد کنید"
                           value="<?php if (isset($_GET['developer_request'])){echo 'درخواست فعالیت به عنوان توسعه دهنده';} ?>"
                    />
                </div>
                <div class="P_Input_Two">
                    <label  for="formFile" class="form-label">فایل</label>
                    <input name="eprfile" class="form-control" type="file" id="formFile"/>
                </div>

            </div>
            <div class="P_Input_Two">
                <label class="LabelInput">توضیحات</label>
                <textarea name="message" class="TextArea" placeholder="توضیحات"><?php if (isset($_GET['developer_request'])){echo $bodymess;} ?></textarea>
            </div>


        </div>
        <button type="submit" class="SendInfo me-2">ارسال</button>
    </form>
</div>
<?php defualtScriptProfile(); ?>
<script>
    function changecategory(category) {
        icons = document.getElementsByClassName('IconSup');
        for (const icon of icons) {
            icon.classList.remove('ActiveTab');
        }

        texts = document.getElementsByClassName('TextSup');
        for (const text of texts) {
            text.classList.remove('ActiveTab');
        }

        document.getElementById(category + '_category_icon').classList.add('ActiveTab');
        document.getElementById(category + '_category_text').classList.add('ActiveTab');
        document.getElementById('input_category').value = category;
    }

    $.widget.bridge('uibutton', $.ui.button)
</script>
</body>
</html>
