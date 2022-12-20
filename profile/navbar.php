<?php 



function notificatin($mess_bodys, $newMess, $timeMess, $request, $timeRequest ){

    $notif = $newMess + $request ;

    $typeTimeMess = 'دقیقه';
    if($timeMess > 525600){
        $typeTimeMess = 'سال';
        $timeMess /= 525600;
    }else if($timeMess > 43200){
        $typeTimeMess = 'ماه';
        $timeMess /= 43200;
    }else if($timeMess > 10080){
        $typeTimeMess = 'هفته';
        $timeMess /= 10080;
    } else if($timeMess > 1440){
        $typeTimeMess = 'روز';
        $timeMess /= 1440;
    } else if($timeMess > 60){
        $typeTimeMess = 'ساعت';
        $timeMess /= 60;
    }

    $typeTimeReq = 'دقیقه';
    if($timeRequest > 525600){
        $typeTimeReq = 'سال';
        $timeRequest /= 525600;
    }else if($timeMess > 43200){
        $typeTimeReq = 'ماه';
        $timeRequest /= 43200;
    }else if($timeRequest > 10080){
        $typeTimeReq = 'هفته';
        $timeRequest /= 10080;
    } else if($timeRequest > 1440){
        $typeTimeReq = 'روز';
        $timeRequest /= 1440;
    } else if($timeRequest > 60){
        $typeTimeReq = 'ساعت';
        $timeRequest /= 60;
    }






$finish_notif = '<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
</ul>
<!-- Right navbar links -->
<ul class="navbar-nav mr-auto">
    <li class="LogOutBtn">
    <a href="https://tradicoders.ir/logout.php" class="NormalLink"> 
        <div class="">
            <i class="fa-solid fa-right-from-bracket"></i>
        </div></a>
    </li>
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown" id="ff">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell-o"></i>
            <span class="badge badge-warning navbar-badge">'.$notif.'</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left" id="showNotif"  style="padding:10px;">
            <span class="dropdown-item dropdown-header">'.$notif.' نوتیفیکیشن</span>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" onclick="showMessNotif()">
                <i class="fa fa-envelope ml-2"></i> '.$newMess.' پیام جدید
                <span class="float-left text-muted text-sm">'.(int)$timeMess.' '.$typeTimeMess.'</span>
            </a>
            <div id="messBody" style="display:none;">';

            foreach($mess_bodys as $body){
                $finish_notif .= '
                <div class="dropdown-divider"></div>
                    <span style="font-size: 12px;">'.$body.'</span>
                ';
            }

            $finish_notif .= '</div>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
                <i class="fa fa-users ml-2"></i> '.$request.' درخواست دوستی
                <span class="float-left text-muted text-sm">'.(int)$timeRequest.' '.$typeTimeReq.'</span>
            </a>
        </div>
    </li>
    
</ul>
</nav>
<script>
function nowShow(){
    
    document.getElementById("messBody").style.display = "block";
    document.getElementById("showNotif").classList.add("show");
    document.getElementById("ff").classList.add("show");
    
}


function showMessNotif(){
    setTimeout(nowShow, 50);
}

</script>';

echo $finish_notif;

}

$newMess = 0;
$request = 0;
$report = 0;
$timeMess = 0;
$timeRequest = 0;
$timeReport = 0;

$dateTo = date("Y/m/d H:i:s");


$dateFrom = "";
$sql8 = "SELECT * from tc_message WHERE userid='$userid' and status='open' ORDER BY id ASC LIMIT 6";
$result8 = mysqli_query($conn, $sql8);
$newMess = $result8->num_rows ;
$mess_bodys = array();
if ($result8->num_rows > 0) {
    while ($row8 = $result8->fetch_assoc()) {
        $dateFrom = $row8['reg_date'];
        array_push($mess_bodys, $row8['message']);
    }
}

if($newMess != 0){
    $timeMess = dateToMin($dateFrom, $dateTo);
}


notificatin($mess_bodys, $newMess, $timeMess, $request, $timeRequest);



?>