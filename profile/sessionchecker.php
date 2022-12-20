<?php
 $userid = -1;
 $ipaddress = $_SERVER['REMOTE_ADDR'];
 $uptime    = time();
 $sql = "SELECT id, userid, userip, lastsession FROM tc_session WHERE userip='$ipaddress'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if($row['userip']==$ipaddress && ($uptime-$row['lastsession'])<1900){
                    $userid = $row['userid'];
             $sql2 = "UPDATE tc_session SET userip='$ipaddress', lastsession='$uptime' WHERE userid='$userid'";
             $conn->query($sql2);
                    //...
		$sql3 = "SELECT * FROM tc_clients WHERE id='$userid'";
        $result3 = $conn->query($sql3);
        if ($result3->num_rows > 0) {
            // output data of each row
            while($row3 = $result3->fetch_assoc()) {
                    $fullname = $row3['firstname']." ".$row3['lastname'];
                    $pricePlan = $row3['priceplan'];
                    $currentpass  = $row3['pass'];
                    $currentemail = $row3['email'];
                    $currentphone = $row3['phonenumber'];
                    $currentcity = $row3['city'];
                    $currentcountry = $row3['country'];
                    $currentintroduction = $row3['introduction'];
                    $balance = $row3['balance'];
                    //...
                    break;
            }
        }     
                    //...
		$sql4 = "SELECT * FROM tc_project WHERE creatoruid='$userid' OR developeruid='$userid'";
        $result4 = $conn->query($sql4);
        $prnumber = $result4->num_rows;
                    //...
                    break;
                }
            }
        }
//...
if($userid==-1){
    echo "<script type='text/javascript'>
            window.location = 'https://tradicoders.ir';
    </script>";
}
//...
?>    