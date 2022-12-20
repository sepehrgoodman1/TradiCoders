<?php
require('../config.php');
require('../access.php');
require('../sessionchecker.php');
require('../central.php');
setOnlineDate();
update_rating();
$rates = check_rate();
if (!isset($_GET['requests'])){
    echo "<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-YTGXME61R2\"></script>
<script>
    window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YTGXME61R2');
</script>";
}
if ($userid == -1){
    closeProfile();
}
?>