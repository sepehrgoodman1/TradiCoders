<?php
function dateToMin($dateFrom, $dateTo){
    $to_time = strtotime($dateTo);
    $from_time = strtotime($dateFrom);
    return round(($to_time - $from_time) / 60);
}
function successOperation($message){
    require('checkanim.php');
    echo "<script>
function hideSuccess(){
    document.getElementById('anim_body').remove();
}
        setTimeout(hideSuccess,5000);
</script>";
}
function permissionPageInside($pageName)
{
    global $userid, $conn;
    $sql3 = selectQuery_tc_page_access("userid='$userid' and pagename='$pageName'");
    foreach ($sql3 as $row3) {
        if ($row3['access'] == 'true') {
            return true;
        } else {
            return false;
        }
    }
    return false;
}


function sendEmail($parameters, $email, $temp_id)
{
    $temp_id = "tc_".$temp_id;
    $domain = "tradicoders.ir";
    $subdomain = "info@tradicoders.ir";
    $merge_parameters = '';
    foreach (json_decode($parameters, true) as $key => $val) {
        $val = str_replace(' ', '%20', $val);
        $val = str_replace('{enter}{enter}', '', $val);
        $merge_parameters .= "&merge_" . $key . "=" . $val;
    }


    $from = "&from=" . $subdomain;

    $t_send = "https://api.elasticemail.com/v2/email/send?apikey=4C0218CE822E2995F968A6AB5185E60C5FE71E9A4B77DFE4C8221FD0F6481E3416E87E7FB083423A29D9E128050934E7" .
        $from . "&fromName=" . $domain . "&senderName=ReceiverName&msgFrom=&msgFromName=&to=" . $email . "&template=" . $temp_id . $merge_parameters . "&charset=UTF-8&charsetBodyHtml=UTF-8";
    $send = file_get_contents($t_send);
    echo $send;
}

function insertQuery($tableName, $input, $insert)
{
    global $conn;
    $sql = "INSERT INTO `$tableName` ($input)
            VALUES ($insert)";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function updateQuery($tableName, $sets, $where = '')
{
    global $conn;
    if ($where == '') {
        $sql = "UPDATE `$tableName` SET $sets ";
    } else {
        $sql = "UPDATE `$tableName` SET $sets WHERE " . $where;
    }

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


function deleteQuery($tableName, $where = '')
{
    global $conn;
    if ($where == '') {
        $sql = "DELETE FROM `$tableName` ";
    } else {
        $sql = "DELETE FROM `$tableName` WHERE " . $where;
    }

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

function closeProfile()
{
    openLink('https://www.tradicoders.ir/?destroy=-1');
}

function alert2($text, $mode = "danger")
{
    echo "
<div class=\"alert $mode \">
  <div class=\"closebtn\">×</div>  
  <i style=\"margin-right: 14px;\" class=\"fa fa-exclamation fa-1x\"></i>
   $text
</div>
";
}

function selectQuery($tableName, $where = '', $gets = '')
{
    global $conn;
    if ($where == '') {
        $sql = "SELECT * FROM $tableName ";
    } else {
        $sql = "SELECT * FROM `$tableName` WHERE " . $where;
    }
    if ($gets != '') {
        $sql = str_replace('*', $gets, $sql);
    }
    $resultArray = array();
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            array_push($resultArray, $row);
        }
    }

    return $resultArray;

}

function selectQuery_tc_project($where = '', $gets = '')
{
    return selectQuery('tc_project', $where, $gets);
}
function selectQuery_tc_codes($where = '', $gets = '')
{
    return selectQuery('tc_codes', $where, $gets);
}
function selectQuery_tc_project_activity($where = '', $gets = '')
{
    return selectQuery('tc_project_activity', $where, $gets);
}

function selectQuery_rating($where = '', $gets = '')
{
    return selectQuery('rating', $where, $gets);
}

function selectQuery_tc_forum($where = '', $gets = '')
{
    return selectQuery('tc_forum', $where, $gets);
}
function selectQuery_tc_attr($where = '', $gets = '')
{
    return selectQuery('tc_attr', $where, $gets);
}
function selectQuery_tc_forum_answer($where = '', $gets = '')
{
    return selectQuery('tc_forum_answer', $where, $gets);
}

function selectQuery_tc_messenger($where = '', $gets = '')
{
    return selectQuery('tc_messenger', $where, $gets);
}

function selectQuery_tc_faq($where = '', $gets = '')
{
    return selectQuery('tc_faq', $where, $gets);
}

function selectQuery_rating_range($where = '', $gets = '')
{
    return selectQuery('rating_range', $where, $gets);
}

function selectQuery_tc_custom_logic($where = '', $gets = '')
{
    return selectQuery('tc_custom_logic', $where, $gets);
}
function selectQuery_tc_functions($where = '', $gets = '')
{
    return selectQuery('tc_functions', $where, $gets);
}

function selectQuery_MQL4_Functions($where = '', $gets = '')
{
    return selectQuery('MQL4_Functions', $where, $gets);
}

function selectQuery_MQL5_Functions($where = '', $gets = '')
{
    return selectQuery('MQL5_Functions', $where, $gets);
}

function selectQuery_MQL4_Settings($where = '', $gets = '')
{
    return selectQuery('MQL4_Settings', $where, $gets);
}

function selectQuery_MQL5_Settings($where = '', $gets = '')
{
    return selectQuery('MQL4_Settings', $where, $gets);
}

function selectQuery_tc_MQL4_Logics($where = '', $gets = '')
{
    return selectQuery('tc_MQL4_Logics', $where, $gets);
}

function selectQuery_tc_Academy($where = '', $gets = '')
{
    return selectQuery('tc_Academy', $where, $gets);
}

function selectQuery_tc_MQL5_Logics($where = '', $gets = '')
{
        return selectQuery('tc_MQL5_Logics', $where, $gets);
}



function selectQuery_tc_notification($where = '', $gets = '')
{
        return selectQuery('tc_notification', $where, $gets);
}

function selectQuery_temp_sms($where = '', $gets = '')
{
        return selectQuery('temp_sms', $where, $gets);
}



function selectQuery_tc_payment($where = '', $gets = '')
{
    return selectQuery('tc_payment', $where, $gets);
}
function selectQuery_tc_meta($where = '', $gets = '')
{
    return selectQuery('tc_meta', $where, $gets);
}
function selectQuery_pagecontent($where = '', $gets = '')
{
    $sql = selectQuery('pagecontent', $where, $gets);
    $new_array = array();
    foreach ($sql as $row){
        array_push($new_array, $row['text'] );
    }
    return $new_array;
}


function selectQuery_tc_clients($where = '', $gets = '')
{
    return selectQuery('tc_clients', $where, $gets);
}

function selectQuery_tc_product($where = '', $gets = '')
{
    return selectQuery('tc_product', $where, $gets);
}

function selectQuery_tc_page_access($where = '', $gets = '')
{
        return selectQuery('tc_page_access', $where, $gets);
}
function selectQuery_online_date($where = '', $gets = '')
{
    return selectQuery('online_date', $where, $gets);
}
function selectQuery_tc_ticket($where = '', $gets = '')
{
    return selectQuery('tc_ticket', $where, $gets);
}
function selectQuery_tc_ticket_message($where = '', $gets = '')
{
    return selectQuery('tc_ticket_message', $where, $gets);
}

function selectQuery_tc_all_page($where = '', $gets = '')
{
        return selectQuery('tc_all_page', $where, $gets);
}

function send_mess($message, $projectid, $sender){
    insertQuery('tc_messenger',"message, projectid, sender","'$message', '$projectid', '$sender'");
}


function addViewForum($id){
    global $conn;
    $sql = "UPDATE `tc_forum` SET view=view+1 WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo 'true';
    } else {
        echo 'false';
    }
}

function findLike($array, $find){

    foreach ($array as $value){
        if ($value['id'] == $find){
            return false;
        }
    }

    return true;
}

function addLike($answer_id){
    global $userid;
    if ($userid > -1){
        $all_answer = selectQuery_tc_forum_answer("id='$answer_id'");
        $all_answer = $all_answer[0];
        if ($all_answer['like_answer'] != "") {
            $like_answer = json_decode($all_answer['like_answer'], true);
            $likes = $like_answer[0]['likes'];
            $dislikes = $like_answer[1]['dislikes'];
            if (sizeof($likes) == 0 or findLike($likes, $userid)){
                $newLike = array();
                foreach ($likes as $like){
                    array_push($newLike, $like);
                }
                array_push($newLike, array("id" => $userid));
                $like_answer = array(array("likes" => $newLike),array("dislikes" => $dislikes));
                $newlike_answer = json_encode($like_answer);

                updateQuery('tc_forum_answer',"like_answer='$newlike_answer'","id='$answer_id'");
                echo "true_like";
            }else{
                echo "false_like";
            }
        }else{
            $like_answer = array(array("likes" => array(array("id" => $userid))),array("dislikes" => array()));
            $newlike_answer = json_encode($like_answer);
            updateQuery('tc_forum_answer',"like_answer='$newlike_answer'","id='$answer_id'");
            echo "true_like";
        }
    }

}
function baseCode($tabname, $tabtype){
    $baseStart = '<!DOCTYPE html>
<html lang="fa-IR">
  <head>
    <link rel="icon" type="image/x-icon" href="assets/images/Logo.gif">
    <link rel="stylesheet" href="plugin/codemirror/doc/docs.css" />
    <link rel="stylesheet" href="plugin/codemirror/lib/codemirror.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/3024-day.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/3024-night.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/abbott.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/abcdef.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/ambiance.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/ayu-dark.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/ayu-mirage.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/base16-dark.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/bespin.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/base16-light.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/blackboard.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/cobalt.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/colorforth.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/dracula.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/duotone-dark.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/duotone-light.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/eclipse.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/elegant.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/erlang-dark.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/gruvbox-dark.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/hopscotch.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/icecoder.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/isotope.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/juejin.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/lesser-dark.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/liquibyte.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/lucario.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/material.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/material-darker.css" />
    <link
      rel="stylesheet"
      href="plugin/codemirror/theme/material-palenight.css"
    />
    <link rel="stylesheet" href="plugin/codemirror/theme/material-ocean.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/mbo.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/mdn-like.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/midnight.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/monokai.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/moxer.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/neat.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/neo.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/night.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/nord.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/oceanic-next.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/panda-syntax.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/paraiso-dark.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/paraiso-light.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/pastel-on-dark.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/railscasts.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/rubyblue.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/seti.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/shadowfox.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/solarized.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/the-matrix.css" />
    <link
      rel="stylesheet"
      href="plugin/codemirror/theme/tomorrow-night-bright.css"
    />
    <link
      rel="stylesheet"
      href="plugin/codemirror/theme/tomorrow-night-eighties.css"
    />
    <link rel="stylesheet" href="plugin/codemirror/theme/ttcn.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/twilight.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/vibrant-ink.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/xq-dark.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/xq-light.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/yeti.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/idea.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/darcula.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/yonce.css" />
    <link rel="stylesheet" href="plugin/codemirror/theme/zenburn.css" />

    <script src="plugin/codemirror/lib/codemirror.js"></script>
    <script src="plugin/codemirror/mode/javascript/javascript.js"></script>
    <script src="plugin/codemirror/addon/selection/active-line.js"></script>
    <script src="plugin/codemirror/addon/edit/matchbrackets.js"></script>



  </head>
  <body>
    
    <textarea  id="'.$tabname.'.'.$tabtype.'" name="code" class="CodeArea">
';
    $baseEnd = '</textarea>

  </body>
</html>';
    $baseCode = array();

    array_push($baseCode,$baseStart);
    array_push($baseCode,$baseEnd);

    return $baseCode;
}

function addDisike($answer_id){
    global $userid;
    if ($userid > -1) {
        $all_answer = selectQuery_tc_forum_answer("id='$answer_id'");
        $all_answer = $all_answer[0];
        if ($all_answer['like_answer'] != "") {
            $like_answer = json_decode($all_answer['like_answer'], true);
            $likes = $like_answer[0]['likes'];
            $dislikes = $like_answer[1]['dislikes'];
            if (sizeof($dislikes) == 0 or findLike($dislikes, $userid)) {
                $newDisike = array();
                foreach ($dislikes as $dislike) {
                    array_push($newDisike, $dislike);
                }
                array_push($newDisike, array("id" => $userid));
                $like_answer = array(array("likes" => $likes), array("dislikes" => $newDisike));
                $newlike_answer = json_encode($like_answer);

                updateQuery('tc_forum_answer', "like_answer='$newlike_answer'", "id='$answer_id'");
                echo 'true_dis';
            } else {
                echo 'false_dis';
            }
        } else {
            $like_answer = array(array("likes" => array()), array("dislikes" => array(array("id" => $userid))));
            $newlike_answer = json_encode($like_answer);
            updateQuery('tc_forum_answer', "like_answer='$newlike_answer'", "id='$answer_id'");
            echo 'true_dis';
        }
    }
}

$pagecontent = selectQuery_pagecontent();

function openLink($link)
{
    echo "<script>window.open('$link', '_self');</script>";
}

function alert($text)
{
    echo "<script>alert('$text');</script>";
}



function defualtScriptProfile()
{
    echo '<script src="plugins/jquery/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="plugins/morris/morris.min.js"></script>
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="plugins/knob/jquery.knob.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="plugins/fastclick/fastclick.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="../assetstwo/script_alert.js"></script>
<script src="../assetstwo/prefixfree.min.js"></script>
<script src="dist/js/demo.js"></script>';
}

function defualtMeta($title, $keywords, $description)
{
    echo '<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>' . $title . '</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="' . $keywords . '">
    <meta name="description" content="' . $description . '">
    <link href="tradi-coders-logo-final.gif" rel="shortcut icon" type="image/x-icon">
    <link href="tradi-coders-logo-final.gif" rel="apple-touch-icon">';
}

function defualtMetaAndStyleProfile($title, $keywords, $description, $icon)
{
    echo '<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>' . $title . '</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="' . $keywords . '">
    <meta name="description" content="' . $description . '">
    <link href="' . $icon . '" rel="shortcut icon" type="image/x-icon">
    <link href="' . $icon . '" rel="apple-touch-icon">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    <link rel="stylesheet" href="/profile/css/profile.css" />
    <link rel="stylesheet" href="/css/global.css" />
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
      integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    ';

    
}

function setNotif($tempid, $not_parameters)
{
    global  $Projectid;
    $not_parameters = json_encode($not_parameters, JSON_UNESCAPED_UNICODE);

    $sql = selectQuery_tc_project("id='$Projectid' ");
    foreach ($sql as $row) {
        $not_users = $row['developeruid'] . ',' . $row['creatoruid'];
        $tableName = 'tc_notification';
        $input = "not_ids, not_template, not_parameters";
        $insert = "'$not_users','$tempid', '$not_parameters'";
        insertQuery($tableName, $input, $insert);
    }

}
function selectQuery_temp_sms_main($where)
{
    $sql_temp = selectQuery_temp_sms($where);
    return json_decode($sql_temp[0]['main'], true);

}

function replace_parameter_notif($not_parameters, $text){
    foreach ($not_parameters as $key => $parameter) {
        $text = str_replace('{' . $key . '}', $parameter, $text);
    }
    return $text;
}

function setNotifPer($tempid, $not_parameters, $not_users)
{
    $not_parameters = json_encode($not_parameters, JSON_UNESCAPED_UNICODE);
    $tableName = 'tc_notification';
    $input = "not_ids, not_template, not_parameters";
    $insert = "'$not_users','$tempid', '$not_parameters'";
    return insertQuery($tableName, $input, $insert);

}

function setOnlineDate(){
    global $userid;
    if ($userid > 0) {
        $tclogintime = $_SESSION["tclogintime"];
        $date = date('Y-m-d');
        $now = time();
        $min = $now - $tclogintime;
        $sql_online_date = selectQuery_online_date("userid='$userid' and date_first='$date'");

        if (sizeof($sql_online_date) == 0) {
            insertQuery('online_date', 'userid,logintime,date_first', "'$userid','$tclogintime', '$date'");
        } else {
            $sql_online_date = $sql_online_date[0];
            $tableName = 'online_date';
            $sql_reg_date = $sql_online_date['logintime'];
            $sql_id = $sql_online_date['id'];

            if ($tclogintime == $sql_reg_date) {
                $sets = "online_time='$min'";
            } else {
                $min = $sql_online_date['online_time'] + $sql_online_date['old_online_time'];
                $sets = "old_online_time='$min', logintime='$tclogintime', online_time='0' ";
            }
            $where = "id='$sql_id'";
            updateQuery($tableName, $sets, $where);
        }
    }
}


function update_rating(){
    global $userid;
    $sql_tc_project = selectQuery_tc_project("developeruid='$userid' and (prstatus='close_half' or prstatus='close_cancel' or prstatus='close_complete')",
        "prdonetime, prstarttime, customer_rate, difficulties, id");
    $where = '';
    $job = sizeof($sql_tc_project);
    $customer_rate_count = 0;
    $customer_rate = 0;
    $arbitration = 0;
    $job_time_average = 0;
    $help = 0;
    foreach ($sql_tc_project as $tc_project){
        $help ++;
        $dateFrom = $tc_project['prstarttime'];
        $dateTo = $tc_project['prdonetime'];
        $job_time_average += dateToMin($dateFrom, $dateTo);
        $prid = $tc_project['id'];
        if ($help == $job){
            $where .= "prid='$prid'";
        }else{
            $where .= "prid='$prid' or ";
        }

        if ($tc_project['customer_rate'] > 0){
            $customer_rate_count += 1;
            $customer_rate += $tc_project['customer_rate'];
        }

        if ($tc_project['difficulties'] != ''){
            $arbitration += 1;
        }
    }
    $job_time_average = intval($job_time_average/60/24/$job);
    $customer_rate = floatval($customer_rate / $customer_rate_count);
    $sql_revision = selectQuery_tc_project_activity($where,'id');
    $revision_average = sizeof($sql_revision)/$job;

    $tableName = 'rating';
    $sets = "customer_rate='$customer_rate', revision_average='$revision_average',job_time_average='$job_time_average', job='$job', arbitration='$arbitration'";
    $where = "userid='$userid'";
    updateQuery($tableName, $sets, $where);



}

function check_rate(){
    global $userid;
    $rate_array = array();
    $sql_rating = selectQuery_rating("userid='$userid'");
    $sql_rating = $sql_rating[0];
    $sql_rating_range = selectQuery_rating_range("id='1'");
    $sql_rating_range = $sql_rating_range[0];

    $rate = 0;
    $product = $sql_rating['product'] * $sql_rating_range['product'];
    $rate += $product;
    $rate_array['product_count'] = $sql_rating['product'];
    $rate_array['product'] = $product;

    $article = $sql_rating['article'] * $sql_rating_range['article'];
    $rate += $article;
    $rate_array['article_count'] = $sql_rating['article'] ;
    $rate_array['article'] = $article ;

    $forum = $sql_rating['forum'] * $sql_rating_range['forum'];
    $rate += $forum;
    $rate_array['forum_count'] = $sql_rating['forum'];
    $rate_array['forum'] = $forum;

    $arbitration = $sql_rating['arbitration'] * $sql_rating_range['arbitration'];
    $rate -= $arbitration;
    $rate_array['arbitration_count'] = $sql_rating['arbitration'];
    $rate_array['arbitration'] = $arbitration;

    $job = $sql_rating['job'] * $sql_rating_range['job'];
    $rate += $job;
    $rate_array['job_count'] = $sql_rating['job'];
    $rate_array['job'] = $job;

    $job_time_average = $sql_rating_range['job_time_average'] - $sql_rating['job_time_average'];
    $job_time_average = $job_time_average * $sql_rating_range['job_rate_average'];
    $rate += $job_time_average;
    $rate_array['job_time_average_count'] = $sql_rating['job_time_average'];
    $rate_array['job_time_average'] = $job_time_average;

    $revision_average = $sql_rating_range['revision_average'] - $sql_rating['revision_average'];
    $revision_average = $revision_average * $sql_rating_range['revision_rate_average'];
    $rate += $revision_average;
    $rate_array['revision_average_count'] = $sql_rating['revision_average'];
    $rate_array['revision_average'] = $revision_average;

    $product_rate = floatval($sql_rating['product_rate'] - $sql_rating_range['product_rate_min']);
    $product_rate = intval($product_rate * $sql_rating_range['product_rate']);
    $rate += $product_rate;
    $rate_array['product_rate_count'] = $sql_rating['product_rate'];
    $rate_array['product_rate'] = $product_rate;

    $product_sell = $sql_rating['product_sell'] * $sql_rating_range['product_sell'];
    $rate += $product_sell;
    $rate_array['product_sell_count'] = $sql_rating['product_sell'];
    $rate_array['product_sell'] = $product_sell;

    $customer_rate = floatval($sql_rating['customer_rate'] - $sql_rating_range['customer_rate_min']);
    $customer_rate = intval($customer_rate * $sql_rating_range['customer_rate']);
    $rate += $customer_rate;
    $rate_array['customer_rate_count'] = $sql_rating['customer_rate'];
    $rate_array['customer_rate'] = $customer_rate;

    $online_time_month = $sql_rating['online_time_month'] * $sql_rating_range['online_time_month'];
    $rate += $online_time_month;
    $rate_array['online_time_month_count'] = $sql_rating['online_time_month'];
    $rate_array['online_time_month'] = $online_time_month;

    $online_day_month = $sql_rating['online_day_month'] * $sql_rating_range['online_day_month'];
    $rate += $online_day_month;
    $rate_array['online_day_month_count'] = $sql_rating['online_day_month'];
    $rate_array['online_day_month'] = $online_day_month;

    $rate_array['all_rate'] = $rate;

    return $rate_array;


}


?>