<?php

if (isset($_GET['forum_id'])) {
    require('required_page.php');
    $action = 'forum';
    $fid = explode("__",$_GET['forum_id']);
    $fid = $fid[1];
    addViewForum($fid);


if ($userid > 0 && isset($_POST['answer'])) {
    $answer = $_POST['answer'];
    $forum_id = $_POST['forum_id'];
    $main = $_POST['main'];
    $sub = $_POST['sub'];
    insertQuery('tc_forum_answer', "answer, forum_id, userid, main, sub", "'$answer', '$forum_id', '$userid', '$main', '$sub'");
}
$dateTo = date("Y/m/d H:i:s");
$question = selectQuery_tc_forum("id='$fid'");
if (sizeof($question) == 1) {
    $question = $question[0];
} else {
    openLink('forum.php');
}
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
        if (strpos($question['question'], $keywords) !== false){
            $final_keywords .= $keywords.", ";
        }else  if (strpos($question['description'], $keywords) !== false){
            $final_keywords .= $keywords.", ";
        }
    }
    $title = $question['question'];
    $description = mb_substr(trim($question['question']), 0, 120, 'UTF-8');
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

    <title>Forum</title>
</head>
<body class="BodyForum">
<?php require('../navbar.php'); ?>
<br>
<div class="WrapperForums Mb_P0">
    <div class="BgForum">
        <!-- Question Forum -->
        <?php

        $timeMess = dateToMin($question['reg_date'], $dateTo);
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
        ?>
        <div class="QuestionForum">
            <h1 class="TitleQues TitleFont">
                <?php echo $question['question']; ?>
                <div class="BannerQues">سوال</div>
            </h1>
            <div class="P_ImageQusrtion">
                <div class="PosRel">
                    <?php
                    $uid_q = $question['userid'];
                    $sql_info_user = selectQuery_tc_clients("id='$uid_q'");
                    $sql_info_user = $sql_info_user[0];
                    ?>
                    <img
                            src="https://tradicoders.ir/<?php echo $sql_info_user['imgurl']; ?>"
                            class="LogoQusestionForum"
                            alt="Person Image"
                    />

                </div>
                <div class="P_NameOfUser">
                    <div class="NameOfUser"><?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?></div>
                    <div class="TimeOfPost"><?php echo intval($timeMess); ?> <?php echo $typeTimeMess; ?> پیش</div>
                </div>


            </div>
            <div class="TextAboutQuestion">
                <?php echo $question['description']; ?>
            </div>
            <?php if ($userid > 0) { ?>
                <div class="ReplyText"
                     onclick="add_answer('<?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?>','0','0')"
                     data-bs-toggle="modal" data-bs-target="#exampleModal">پاسخ دادن
                </div>
            <?php } ?>
        </div>


        <!-- First Answer -->
        <?php
        $all_answer = selectQuery_tc_forum_answer("forum_id='$fid' and status='open'");
        if (sizeof($all_answer) > 0) {

            $all_like_answer_count = array();
            foreach ($all_answer as $ans) {
                if ($ans['like_answer'] != "") {
                    $like_answer = json_decode($ans['like_answer'], true);
                    $dislike_answer = $like_answer[1]['dislikes'];
                    $like_answer = $like_answer[0]['likes'];
                    $count_like_answer = sizeof($like_answer);
                    $count_dislike_answer = sizeof($dislike_answer);
                } else {
                    $count_like_answer = 0;
                    $count_dislike_answer = 0;
                }
                $all_like_answer_count[$ans['id']] = $count_like_answer;
            }
            asort($all_like_answer_count);
            foreach ($all_like_answer_count as $key => $value) {
                $first_id = $key;
            }

            if ($first_id == 0) {
                $first_answer = selectQuery_tc_forum_answer("forum_id='$fid' and status='open' LIMIT 1");
            } else {
                $first_answer = selectQuery_tc_forum_answer("forum_id='$fid' and id='$first_id' and status='open' LIMIT 1");
            }
            $first_answer = $first_answer[0];
            if ($first_answer['like_answer'] != "") {
                $like_answer = json_decode($first_answer['like_answer'], true);
                $dislike_answer = $like_answer[1]['dislikes'];
                $like_answer = $like_answer[0]['likes'];
                $count_like_answer = sizeof($like_answer);
                $count_dislike_answer = sizeof($dislike_answer);
            } else {
                $count_like_answer = 0;
                $count_dislike_answer = 0;
            }
            ?>
            <div class="AnswerArea">
                <div class="BannerAnswer">راه حل</div>
                <div class="Answer">
                    <div class="C_Answer">
                        <div class="P_ImgAnswer">
                            <div class="P_ArrowQuestion">
                                <div>
                                    <i onclick="add_like(<?php echo $first_answer['id']?>)" class="fa-solid fa-arrow-up-long IconArrows SpecialColor"
                                    ></i>
                                </div>
                                <div class="NumLikes SpecialColor"><?php echo $count_like_answer; ?></div>
                                <div class="NumLikes RedColor"><?php echo $count_dislike_answer; ?></div>

                                <div>
                                    <i onclick="add_dislike(<?php echo $first_answer['id']?>)" class="fa-solid fa-arrow-down-long IconArrows RedColor"></i>
                                </div>
                            </div>
                            <?php
                            $uid_a = $first_answer['userid'];
                            $sql_info_user = selectQuery_tc_clients("id='$uid_a'");
                            $sql_info_user = $sql_info_user[0];
                            ?>
                            <img
                                    src="https://tradicoders.ir/<?php echo $sql_info_user['imgurl']; ?>"
                                    class="LogoQusestionForum"
                                    alt="Person Image"
                            />
                            <div class="NameOfUser"><?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?></div>
                            <span class="BestAnswer">بهترین جواب</span>
                        </div>
                        <?php
                        $timeMess = dateToMin($first_answer['reg_date'], $dateTo);
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
                        ?>
                        <div class="AnswerTime"><?php echo intval($timeMess); ?> <?php echo $typeTimeMess; ?> پیش</div>
                    </div>
                    <div class="TextAnswer">
                        <?php echo $first_answer['answer']; ?>
                        <?php if ($userid > 0) { ?>
                            <div class="ReplyText"
                                 onclick="add_answer('<?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?>','<?php if ($first_answer['main'] == '0') {
                                     echo $first_answer['id'];
                                 } else {
                                     echo $first_answer['main'];
                                 } ?>','<?php if ($first_answer['main'] == '0') {
                                     echo '0';
                                 } else {
                                     echo $first_answer['id'];
                                 } ?>')"
                                 data-bs-toggle="modal" data-bs-target="#exampleModal">پاسخ دادن
                            </div>
                        <?php } else { ?>
                            <div style="height: 30px;"></div>
                        <?php } ?>
                    </div>

                    <!-- Second Answer => Answer Is Inside of First Answer -->
                    <?php
                    $first_answer_id = $first_answer['id'];
                    $answers = selectQuery_tc_forum_answer("forum_id='$fid' and status='open' and (main='$first_answer_id' or sub='$first_answer_id')");
                    foreach ($answers as $answer) {
                        if ($answer['like_answer'] != "") {
                            $like_answer = json_decode($answer['like_answer'], true);
                            $dislike_answer = $like_answer[1]['dislikes'];
                            $like_answer = $like_answer[0]['likes'];
                            $count_like_answer = sizeof($like_answer);
                            $count_dislike_answer = sizeof($dislike_answer);
                        } else {
                            $count_like_answer = 0;
                            $count_dislike_answer = 0;
                        }
                        ?>
                        <div class="Answer">
                            <div class="C_Answer">
                                <div class="P_ImgAnswer">
                                    <div class="P_ArrowQuestion">
                                        <div>
                                            <i onclick="add_like(<?php echo $answer['id']?>)" class="fa-solid fa-arrow-up-long IconArrows SpecialColor"
                                            ></i>
                                        </div>
                                        <div class="NumLikes SpecialColor"><?php echo $count_like_answer; ?></div>
                                        <div class="NumLikes RedColor"><?php echo $count_dislike_answer; ?></div>
                                        <div>
                                            <i onclick="add_dislike(<?php echo $answer['id']?>)" class="fa-solid fa-arrow-down-long IconArrows RedColor"></i>
                                        </div>
                                    </div>
                                    <?php
                                    $uid_a = $answer['userid'];
                                    $sql_info_user = selectQuery_tc_clients("id='$uid_a'");
                                    $sql_info_user = $sql_info_user[0];
                                    ?>
                                    <img
                                            src="https://tradicoders.ir/<?php echo $sql_info_user['imgurl']; ?>"
                                            class="LogoQusestionForum"
                                            alt="Person Image"
                                    />
                                    <div class="NameOfUser"><?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?></div>
                                </div>

                                <?php
                                $timeMess = dateToMin($answer['reg_date'], $dateTo);
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
                                ?>
                                <div class="AnswerTime"><?php echo intval($timeMess); ?> <?php echo $typeTimeMess; ?>
                                    پیش
                                </div>
                            </div>
                            <div class="TextAnswer">
                                <?php echo $answer['answer']; ?>
                                <?php if ($userid > 0) { ?>
                                    <div class="ReplyText"
                                         onclick="add_answer('<?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?>','<?php if ($answer['main'] == '0') {
                                             echo $answer['id'];
                                         } else {
                                             echo $answer['main'];
                                         } ?>','<?php if ($answer['main'] == '0') {
                                             echo '0';
                                         } else {
                                             echo $answer['id'];
                                         } ?>')"
                                         data-bs-toggle="modal" data-bs-target="#exampleModal">پاسخ دادن
                                    </div>
                                <?php } else { ?>
                                    <div style="height: 30px;"></div>
                                <?php } ?>
                            </div>
                        </div>
                        <!-- End Second Answer => Answer Is Inside of First Answer -->
                    <?php }
                    ?>
                </div>
                <!-- End First Answer -->
            </div>
            <?php
        } ?>

        <!-- Answers -->
        <?php if (sizeof($all_answer) > 0) {
            $first_answers = selectQuery_tc_forum_answer("forum_id='$fid' and status='open' and main='0' and sub='0'");
            foreach ($first_answers as $first_answer) {
                if ($first_answer['like_answer'] != "") {
                    $like_answer = json_decode($first_answer['like_answer'], true);
                    $dislike_answer = $like_answer[1]['dislikes'];
                    $like_answer = $like_answer[0]['likes'];
                    $count_like_answer = sizeof($like_answer);
                    $count_dislike_answer = sizeof($dislike_answer);
                } else {
                    $count_like_answer = 0;
                    $count_dislike_answer = 0;
                }
                ?>
                <div class="AnswerArea">
                    <div class="Answer">
                        <div class="C_Answer">
                            <div class="P_ImgAnswer">
                                <div class="P_ArrowQuestion">
                                    <div>
                                        <i onclick="add_like(<?php echo $first_answer['id']?>)" class="fa-solid fa-arrow-up-long IconArrows SpecialColor"
                                        ></i>
                                    </div>
                                    <div class="NumLikes SpecialColor"><?php echo $count_like_answer; ?></div>
                                    <div class="NumLikes RedColor"><?php echo $count_dislike_answer; ?></div>
                                    <div>
                                        <i class="fa-solid fa-arrow-down-long IconArrows RedColor"></i>
                                    </div>
                                </div>

                                <?php
                                $uid_a = $first_answer['userid'];
                                $sql_info_user = selectQuery_tc_clients("id='$uid_a'");
                                $sql_info_user = $sql_info_user[0];
                                ?>
                                <img
                                        src="https://tradicoders.ir/<?php echo $sql_info_user['imgurl']; ?>"
                                        class="LogoQusestionForum"
                                        alt="Person Image"
                                />
                                <div class="NameOfUser"><?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?></div>
                            </div>
                            <?php
                            $timeMess = dateToMin($first_answer['reg_date'], $dateTo);
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
                            ?>
                            <div class="AnswerTime"><?php echo intval($timeMess); ?> <?php echo $typeTimeMess; ?>پیش
                            </div>
                        </div>
                        <div class="TextAnswer">
                            <?php echo $first_answer['answer']; ?>
                            <?php if ($userid > 0) { ?>
                                <div class="ReplyText"
                                     onclick="add_answer('<?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?>','<?php if ($first_answer['main'] == '0') {
                                         echo $first_answer['id'];
                                     } else {
                                         echo $first_answer['main'];
                                     } ?>','<?php if ($first_answer['main'] == '0') {
                                         echo '0';
                                     } else {
                                         echo $first_answer['id'];
                                     } ?>')"
                                     data-bs-toggle="modal" data-bs-target="#exampleModal">پاسخ دادن
                                </div>
                            <?php } else { ?>
                                <div style="height: 30px;"></div>
                            <?php } ?>
                        </div>

                        <!-- Second Answer => Answer Is Inside of First Answer -->
                        <?php
                        $first_answer_id = $first_answer['id'];
                        $answers = selectQuery_tc_forum_answer("forum_id='$fid' and status='open' and (main='$first_answer_id' or sub='$first_answer_id')");
                        foreach ($answers as $answer) {
                            if ($answer['like_answer'] != "") {
                                $like_answer = json_decode($answer['like_answer'], true);
                                $dislike_answer = $like_answer[1]['dislikes'];
                                $like_answer = $like_answer[0]['likes'];
                                $count_like_answer = sizeof($like_answer);
                                $count_dislike_answer = sizeof($dislike_answer);
                            } else {
                                $count_like_answer = 0;
                                $count_dislike_answer = 0;
                            }
                            ?>
                            <div class="Answer">
                                <div class="C_Answer">
                                    <div class="P_ImgAnswer">
                                        <div class="P_ArrowQuestion">
                                            <div>
                                                <i onclick="add_like(<?php echo $answer['id']?>)" class="fa-solid fa-arrow-up-long IconArrows SpecialColor"
                                                ></i>
                                            </div>
                                            <div class="NumLikes SpecialColor"><?php echo $count_like_answer; ?></div>
                                            <div class="NumLikes RedColor"><?php echo $count_dislike_answer; ?></div>
                                            <div>
                                                <i onclick="add_dislike(<?php echo $answer['id']?>)" class="fa-solid fa-arrow-down-long IconArrows RedColor"></i>
                                            </div>
                                        </div>
                                        <?php
                                        $uid_a = $answer['userid'];
                                        $sql_info_user = selectQuery_tc_clients("id='$uid_a'");
                                        $sql_info_user = $sql_info_user[0];
                                        ?>
                                        <img
                                                src="https://tradicoders.ir/<?php echo $sql_info_user['imgurl']; ?>"
                                                class="LogoQusestionForum"
                                                alt="Person Image"
                                        />
                                        <div class="NameOfUser"><?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?></div>
                                    </div>

                                    <?php
                                    $timeMess = dateToMin($answer['reg_date'], $dateTo);
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
                                    ?>
                                    <div class="AnswerTime"><?php echo intval($timeMess); ?> <?php echo $typeTimeMess; ?>
                                        پیش
                                    </div>
                                </div>
                                <div class="TextAnswer">
                                    <?php echo $answer['answer']; ?>
                                    <?php if ($userid > 0) { ?>
                                        <div class="ReplyText"
                                             onclick="add_answer('<?php echo $sql_info_user['firstname'] . " " . $sql_info_user['lastname']; ?>','<?php if ($answer['main'] == '0') {
                                                 echo $answer['id'];
                                             } else {
                                                 echo $answer['main'];
                                             } ?>','<?php if ($answer['main'] == '0') {
                                                 echo '0';
                                             } else {
                                                 echo $answer['id'];
                                             } ?>')"
                                             data-bs-toggle="modal" data-bs-target="#exampleModal">پاسخ دادن
                                        </div>
                                    <?php } else { ?>
                                        <div style="height: 30px;"></div>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- End Second Answer => Answer Is Inside of First Answer -->
                            <!-- End Answers -->
                        <?php }
                        ?>
                    </div>
                </div>
                <?php
            }
        } ?>


    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="answer_name" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content MainModal">
            <div class="modal-header">
                <h5 class="modal-title TitleModal TitleFont" id="answer_name">پاسخ به امیر</h5>
                <button type="button" class="btn-close CloseModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $fid ?>" name="forum_id">
                    <input type="hidden" name="main" id="main_id">
                    <input type="hidden" name="sub" id="sub_id">
                    <!-- Answer Type Area -->
                    <div>
                        <label class="Fs14 Fw600">متن پاسخ</label>
                        <textarea name="answer" cols="30" rows="10"
                                  class="TextArea"></textarea>
                    </div>
                </div>


                <div class="modal-footer Ltr">
                    <button type="submit" class="btn btn-primary Fs14 MainBgColor">افزودن پاسخ</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function add_answer(answer_name, main, sub) {
            document.getElementById('answer_name').innerText = answer_name;
            document.getElementById('main_id').value = main;
            document.getElementById('sub_id').value = sub;
        }

        function add_like(answer_id) {
                var data = "request=like&answer_id=" + answer_id;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        // alert(this.responseText);
                        if (this.responseText.includes("true_like")) {
                            location.reload();
                        }else if (this.responseText.includes("false_like")){
                            alert('این جواب را قبلا تایید کرده اید');
                        }else {
                            openLink('login.php');
                        }
                    }
                };

                xmlhttp.open("GET", "../ajaxcenter.php?" + data, true);
                xmlhttp.send();
        }
        function add_dislike(answer_id) {
                var data = "request=dislike&answer_id=" + answer_id;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        // alert(this.responseText);
                        if (this.responseText.includes("true_dis")) {
                            location.reload();
                        }else if (this.responseText.includes("false_dis")){
                            alert(this.responseText);
                        }else {
                            openLink('login.php');
                        }
                    }
                };

                xmlhttp.open("GET", "../ajaxcenter.php?" + data, true);
                xmlhttp.send();

        }
    </script>

</div>
</body>
</html>
<?php
} else {
    require ("forum.php");
}
    ?>