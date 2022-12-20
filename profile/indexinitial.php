<?php
$ipaddress = $_SERVER['REMOTE_ADDR'];
if($userid>0){
$sql = "SELECT id, firstname, lastname, email, pass, phonenumber , priceplan , imgurl,role FROM tc_clients WHERE id='$userid'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                    $role = $row['role'];
                    $userid = $row['id'];
                    $fullname = $row['firstname']." ".$row['lastname'];
                    $pricePlan = $row['priceplan'];
                    $imgurl = $row['imgurl'];
                    $role = $row['role'];
                    //echo "Img Url ".$imgurl;
                    break;
            }
        }    
}
//echo "here<br>".$_POST["emaillogin"]."<br>".$_POST['pswlogin']."<hr>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty($_POST["emaillogin"]) && $userid==-1){
        $emaillogin = $_POST['emaillogin'];
        $pswlogin   = $_POST['pswlogin'];
        $sql = "SELECT id, firstname, lastname, email, pass, phonenumber , priceplan FROM tc_clients";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if(strcmp($row['email'],$emaillogin)==0 && strcmp($row['pass'],$pswlogin)==0){
                    $userid = $row['id'];
                    $fullname = $row['firstname']." ".$row['lastname'];
                    $pricePlan = $row['priceplan'];
                    //...
                    $sql = "INSERT INTO tc_session (userid, userip)
                    VALUES ('$userid', '$ipaddress')";
                    $conn->query($sql);                
                    //...
                    break;
                }
            }
        }
    }
    $codeadmin = $userid;

    if(!empty($_POST["free"])){
        $useridFree = $_POST["useridFree"];
        if ($useridFree > -1)
        {
            $sql = "UPDATE tc_clients SET priceplan ='free' WHERE id=$useridFree";
            $conn->query($sql);
        }
    }
    if(!empty($_POST["primary"])){
        $useridPrimary = $_POST["useridPrimary"];
        if ($useridPrimary > -1)
        {
            $sql = "UPDATE tc_clients SET priceplan ='primary' WHERE id=$useridPrimary";
            $conn->query($sql);
        }
    }
    if(!empty($_POST["professional"])){
        $useridProfessional = $_POST["useridProfessional"];
        if ($useridProfessional > -1)
        {
            $sql = "UPDATE tc_clients SET priceplan ='professional' WHERE id=$useridProfessional";
            $conn->query($sql);
        }
    }
}
?>