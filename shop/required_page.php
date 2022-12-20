<?php
require('../config.php');
require("../central.php");
include_once('../access.php');
echo "1";
require('../sessionchecker.php');
echo "1";
echo '<script type="text/javascript">
    !function(){var i="yXCcP7",a=window,d=document;function g(){var g=d.createElement("script"),s="https://www.goftino.com/widget/"+i,l=localStorage.getItem("goftino_"+i);g.async=!0,g.src=l?s+"?o="+l:s;d.getElementsByTagName("head")[0].appendChild(g);}"complete"===d.readyState?g():a.attachEvent?a.attachEvent("onload",g):a.addEventListener("load",g,!1);}();
</script>';
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