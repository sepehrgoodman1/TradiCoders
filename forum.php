<?php
require('required_page.php');
$action = 'forum';
if (!isset($_POST['status_show'])) {
    $status = "status='open' ORDER BY id DESC";
} else {
    $status = $_POST['status_show'];
}
if (isset($_POST['question'])){
    if ($userid > -1){
        $question = $_POST['question'];
        $description = $_POST['description'];
        $category = $_POST['category'];

        if (insertQuery('tc_forum','question, description, category, userid', "'$question', '$description', '$category', '$userid'")){
            alert("سوال شما ثبت و در حال بررسی توسط مدیر تریدی کدرز می باشد لطفا تا تایید آن و نمایش در سایت شکیبا باشید.");
        }
    }else{
        openLink('login.php');
    }
}

?>
<!DOCTYPE html>
<html lang="fa-IR">
<head>
    <?php
    $sql_meta = selectQuery_tc_meta("action='$action'");
    $sql_meta = $sql_meta[0];
    $title = $sql_meta['title'];
    $keywords = $sql_meta['keywords'];
    $description = $sql_meta['description'];
    defualtMeta($title, $keywords, $description); ?>

    <!-- Css Codes -->
    <link rel="stylesheet" href="css/global.css"/>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/projectPage.css"/>
    <link rel="stylesheet" href="css/login.css"/>

    <!-- Font Awesome Icon-->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
            integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />
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
    
</head>
<body class="BodyForum">
<?php require('navbar.php');?>
<br>
<div>
    <div class="WrapperForums">
        <h2 class="TitleFont ForumText">انجمن</h2>
        <!-- Filters -->
        <div class="Filters">
            <div>
                <div onclick="onClick('btnradio1')" class="ItemFilter <?php if ($status == "status='open' ORDER BY id DESC") {
                    echo "ItemFilter_Atcive";
                } ?>">تازه ها
                </div>
                <div onclick="onClick('btnradio2') <?php if ($status == "status='open' ORDER BY view DESC") {
                    echo "ItemFilter_Atcive";
                } ?>" class="ItemFilter">
                    پر بازدیدترین ها
                </div>
                <?php if ($userid > -1){ ?>
                <div class="SabtOrder">
                    <button data-bs-toggle="modal" data-bs-target="#exampleModal">افزودن سوال</button>
                </div>
                <?php }else{ ?>
                    <a href="login.php"><div class="SabtOrder">
                        <button >ورود</button>
                    </div></a>
                <?php } ?>
            </div>
            <div class="P_InputSearch">
                <form action="" method="get">
                    <input type="text" name="search_text" class="InputSearch" placeholder="جستجو..."/>
                    <input type="submit" id="submit_search" hidden>
                    <i onclick="submit_search()" class="SearchIcon fa-solid fa-magnifying-glass"></i>
                </form>
            </div>
        </div>
        <div class="LineFilter SecondaryBG"></div>
        <div class="row m-2">
            <form method="post" action="">
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">

                    <input type="radio" class="btn-check"
                           value="status='open' ORDER BY view DESC"
                           name="status_show" id="btnradio2"
                           onclick="changeStatus()" autocomplete="off" hidden>

                    <input type="radio" class="btn-check"
                           value="status='open' ORDER BY id DESC"
                           name="status_show"
                           onclick="changeStatus()" id="btnradio1"
                           autocomplete="off" hidden>
                </div>
                <input type="submit" id="submit_status" hidden>
            </form>
        </div>
        <!-- Start Forum -->
        <div class="ForumArea">
            <div class="WrapperForumList Flex1">
                <?php
                alert($status);
                $dateTo = date("Y/m/d H:i:s");
                $sql_forum = selectQuery_tc_forum("$status");
                foreach ($sql_forum as $row) {
                    if (!isset($_GET['search_text']) || strpos($row['question'], $_GET['search_text']) !== false || strpos($row['description'], $_GET['search_text']) !== false || $_GET['search_text'] == ""){
                    $fid = $row['id'];
                    $question = $row['question'];
                    $count_answer = sizeof(selectQuery_tc_forum_answer("forum_id='$fid'", "id"));

                    $timeMess = dateToMin($row['reg_date'], $dateTo);
                    $typeTimeMess = 'دقیقه';
                    if ($timeMess > 525600) {
                        $typeTimeMess = 'سال';
                        $timeMess /= 525600;
                    } else if ($timeMess > 43200) {
                        $typeTimeMess = 'ماه';
                        $timeMess /= 43200;
                    } else if ($timeMess > 10080) {
                        $typeTimeMess = 'هفته';
                        $timeMess /= 10080;
                    } else if ($timeMess > 1440) {
                        $typeTimeMess = 'روز';
                        $timeMess /= 1440;
                    } else if ($timeMess > 60) {
                        $typeTimeMess = 'ساعت';
                        $timeMess /= 60;
                    }
                    $uid_a = $row['userid'];
                    $sql_info_user = selectQuery_tc_clients("id='$uid_a'");
                    $sql_info_user = $sql_info_user[0];
                    ?>
                    <!-- ForumItem -->
                    <a href="https://forum.tradicoders.ir/<?php echo $question."__".$fid;?>" class="NormalLink"><div  class="ForumItem ">
                        <div>
                            <div class="P_ImageAndQues">
                                <div>
                                    <img
                                            src="<?php echo $sql_info_user['imgurl']; ?>"
                                            class="LogoPrograming"
                                            alt="Programing Language"
                                    />
                                </div>
                                <div class="P_TitleForum">
                                    <h3 class="TitleForum TitleFont">
                                        <?php echo $row['question']; ?>
                                    </h3>
                                    <div class="TimePostForm">پست شده
                                        در <?php echo intval($timeMess); ?> <?php echo $typeTimeMess; ?> پیش
                                    </div>
                                    <h4 class="TopMessageForm">
                                        <i class="fa-solid fa-reply"></i>
                                        <?php echo $row['description']; ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="NumComments">
                            <?php echo $count_answer; ?>
                            <i class="fa-solid fa-comments"></i>
                        </div>
                    </div></a>

                <?php }
                }?>

            </div>
            <div class="LeftForum">

                <div class="TitleFont TitleDiscution">پربحث ترین ها</div>
                <?php
                $sql = "SELECT forum_id
                        FROM tc_forum_answer
                        GROUP BY forum_id
                        ORDER BY COUNT(forum_id) DESC
                        LIMIT 7";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $id_top = $row['forum_id'];
                        $sql_forum_top = selectQuery_tc_forum("id='$id_top'", "view, userid");
                        $sql_forum_top = $sql_forum_top[0];
                        $uid_a = $sql_forum_top['userid'];
                        $sql_info_user = selectQuery_tc_clients("id='$uid_a'");
                        $sql_info_user = $sql_info_user[0];
                        $count_comment = sizeof(selectQuery_tc_forum_answer("forum_id='$id_top'"));
                ?>
                <!-- Item Discution -->
                <div class="ItemDiscution">
                    <div>
                        <img
                                src="<?php echo $sql_info_user['imgurl']; ?>"
                                class="LogoProgramingNew"
                                alt="Programing Language"
                        />
                    </div>
                    <div class="NameOfDiscusser"><?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?></div>
                    <div class="NumDiscus">
                        <i class="fa-regular fa-comment-dots"></i>
                        <?php echo $count_comment;?>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
<!--                <div class="TitleFont TitleDiscution2 ">پربازدید ترین ها</div>-->

<!--                <div class="ItemDiscution">-->
<!--                    <div>-->
<!--                        <img-->
<!--                                src="assets/images/person.webp"-->
<!--                                class="LogoProgramingNew"-->
<!--                                alt="Programing Language"-->
<!--                        />-->
<!--                    </div>-->
<!--                    <div class="NameOfDiscusser">سپهر خادمی</div>-->
<!--                    <div class="NumDiscus">-->
<!--                        <i class="fa-solid fa-eye"></i>-->
<!---->
<!--                        137-->
<!--                    </div>-->
<!--                </div>-->


            </div>
        </div>
        <!-- End Forum -->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content MainModal">
      <div class="modal-header">
        <h5 class="modal-title TitleModal TitleFont" id="exampleModalLabel">افزودن سوال جدید به انجمن</h5>
        <button type="button" class="btn-close CloseModal" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <form method="post" action="">
      <div class="modal-body">
        <!-- Select Category -->
        <div>
            <label class="Fs14 Fw600">دسته بندی </label>
            <select name="category" class="form-select FormSelect" aria-label="Default select example">
                <option value="finance" selected>بازار سرمایه</option>
                <option value="mql4">mql4</option>
                <option value="mql5">mql5</option>
                <option value="tradingview">tradingview</option>
                <option value="other">غیره</option>
            </select>
        </div>
        <div class="Mt20">
            <label  class="Fs14 Fw600">عنوان سوال</label>
            <input type="text" name="question" class="FormInput"/>
        </div>

        <!-- Question Type Area -->
        <div class="Mt20">
            <label class="Fs14 Fw600">متن سوال</label>
                <textarea name="description" cols="30" rows="10"
                            class="TextArea"></textarea>
            </div>
      </div>
        

      <div class="modal-footer Ltr">
        <button type="submit" class="btn btn-primary Fs14 MainBgColor">افزودن سوال</button>
      </div>
        </form>
    </div>
  </div>
</div>


<script>
    function changeStatus() {
        document.getElementById('submit_status').click();
    }

    function onClick(id) {
        document.getElementById(id).click();
    }
    function submit_search(){
        document.getElementById('submit_search').click();
    }
</script>
</body>
</html>
