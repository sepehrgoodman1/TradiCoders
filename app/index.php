<?php
require('required_page.php');
if (isset($_GET['id'])){
    if ($_GET['id'] == "editor" && $userid > -1){
        require "code_editor.php";
    }else if ($_GET['id'] == "editor"){
        alert("برای استفاده از ادیتور، وارد فضای کاربری خود شوید");
        openLink("https://tradicoders.ir/login.php?url_redirect=https://app.tradicoders.ir/editor");
    }else{
        require "learning.php";
    }
}else{
    require "learning.php";
}
?>