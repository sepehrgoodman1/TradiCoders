<?php
if (isset($_GET['request'])) {
    require('required_page.php');
    $request = $_GET['request'];
    if ($request == "like") {
        addLike($_GET['answer_id']);
    } else if ($request == "dislike") {
        addDisike($_GET['answer_id']);
    }else if ($request == "sendMess"){
        $message = $_GET['message'];
        $projectid = $_GET['projectid'];
        $sender = $_GET['sender'];
        send_mess($message, $projectid, $sender);
    }else if ($request == "getMess"){
        $projectid = $_GET['projectid'];
        echo json_encode(selectQuery_tc_messenger("projectid='$projectid'"));
    }else if ($request == "createFile"){
        if ($userid > 0){
            $namefile = $_GET['namefile'];
            $typefile = $_GET['typefile'];
            $exist = sizeof(selectQuery_tc_codes("userid='$userid' and name='$namefile'"));
            if ($exist == 0){
                if ($typefile == ""){
                    $typefile = "txt";
                }
                $f = fopen("app/codes/$userid/$namefile.txt", "w") ;
                fwrite($f, '');
                fclose($f);
                insertQuery('tc_codes','userid, typefile, name',"'$userid', '$typefile', '$namefile'");
                echo 'true';
            }else{
                echo "exist";
            }
        }else{
            echo 'false';
        }

    }else if ($request == "checkCodes") {
        echo json_encode(selectQuery_tc_codes("userid='$userid'"));
    }else if ($request == "deleteFile") {
        if ($userid > 0) {
            $namefile = $_GET['namefile'];
            $typefile = $_GET['typefile'];
            unlink("app/codes/$userid/$namefile.txt");
            if (deleteQuery('tc_codes',"userid='$userid' and name='$namefile' and typefile='$typefile'")){
                echo 'true';
            }else{
                echo 'false';
            }
        }
    }else if ($request == "renameFile") {
        if ($userid > 0) {
            $namefile = $_GET['namefile'];
            $old_namefile = $_GET['old_namefile'];
            $old_typefile = $_GET['old_typefile'];
            $typefile = $_GET['typefile'];
            $exist = sizeof(selectQuery_tc_codes("userid='$userid' and name='$namefile'"));
            if ($exist == 0) {
                rename("app/codes/$userid/$old_namefile.txt", "app/codes/$userid/$namefile.txt");
                if (updateQuery('tc_codes', "name='$namefile' , typefile='$typefile'", "userid='$userid' and name='$old_namefile' and typefile='$old_typefile'")) {
                    echo 'true';
                } else {
                    echo 'false';
                }
            }else{
                echo "exist";
            }
        }
    }else if ($request == "baseCodes") {
        $namefile = $_GET['namefile'];
        $typefile = $_GET['typefile'];
        echo json_encode(baseCode($namefile, $typefile));
    }else if ($request == "saveCode"){
        if ($userid > 0){
            $namefile = $_GET['namefile'];
            $typefile = $_GET['typefile'];
            $code = $_GET['code'];
            if ($typefile == ""){
                $typefile = "txt";
            }
            $f = fopen("app/codes/$userid/$namefile.txt", "w") ;
            fwrite($f, $code);
            fclose($f);
            echo 'true';

        }else{
            echo 'false';
        }

    }else if ($request == "attr"){
        if ($userid > 0){
            $attr = $_GET['attr'];
            $value = $_GET['value'];
            $sql_them = selectQuery_tc_attr("userid='$userid' and attr='$attr'",'value');
            if (sizeof($sql_them) > 0){
                if (updateQuery('tc_attr',"value='$value'","userid='$userid' and attr='$attr'")){
                    echo $value;
                }else{
                    echo 'false';
                }
            }else{
                if (insertQuery('tc_attr','userid, attr, value',"'$userid', '$attr', '$value'")){
                    echo $value;
                }else{
                    echo 'false';
                }
            }

        }else{
            echo 'false';
        }

    }

}


?>