<?php
require_once('sms.php');

$sql = selectQuery_tc_notification("not_status='pending'");


foreach ($sql as $row) {
    $id = $row['id'];
    $not_ids = $row['not_ids'];
    $not_ids = explode(',', $not_ids);
    $not_template = $row['not_template'];
    $not_parameters = $row['not_parameters'];
    $sql_temp = selectQuery_temp_sms("name='$not_template'");
    $body_sms = $sql_temp[0]['body'];

    $body_sms = replace_parameter_notif(json_decode($not_parameters, true), $body_sms);
    $body_sms = str_replace('{enter}{enter}', "\n", $body_sms);

    if ($not_ids != "developer" && $not_ids != "agent" && $not_ids != "user" && $not_ids != "all") {

        foreach ($not_ids as $not_id) {
            $sql2 = selectQuery_tc_clients("id='$not_id' ");
            foreach ($sql2 as $row2) {
                $email = $row2['email'];
                $phonenumber = $row2['phonenumber'];
                notification_sms($phonenumber, $body_sms);
                sendEmail($not_parameters, $email, $not_template);
//                echo $body_sms;
            }
        }
    } else {

        $sql2 = selectQuery_tc_clients("role='$not_ids' ");
        foreach ($sql2 as $row2) {
            $email = $row2['email'];
            $phonenumber = $row2['phonenumber'];
            notification_sms($phonenumber, $body_sms);
            sendEmail($not_parameters, $email, $not_template);
        }

    }
    updateQuery('tc_notification', "not_status='send'", "id='$id'");
}

?>