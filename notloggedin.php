<?php
$ref = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].$_SERVER['QUERY_STRING'];
header("location:login.php?err=accessdenied&ref=$ref");
exit;
?>