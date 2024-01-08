<?php
require('config/config.php');
require('controller/session_controller.php');
include('controller/konekt_MySQL.php');
$referrer=$_SERVER['HTTP_REFERER'];
//print_r($_GET);
mysqli_query($kon,"DELETE FROM `metryki` WHERE `ankieta`='$_GET[ank]'");
mysqli_query($kon,"DROP TABLE `$_GET[ank]`");
header("Location: $referrer");