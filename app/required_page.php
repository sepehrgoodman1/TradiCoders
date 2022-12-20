<?php
require('../config.php');
require("../central.php");
include_once('../access.php');
require('../sessionchecker.php');
if (!isset($_GET['request'])){
    echo "<script async src=\"https://www.googletagmanager.com/gtag/js?id=G-YTGXME61R2\"></script>
<script>
    window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-YTGXME61R2');
</script>";
}
?>