<?php
$referer=$_SERVER['HTTP_REFERER'];
   // print_r($_POST);
require('../config/config.php');
require('session_controller.php');
include('konekt_MySQL.php');
$nr=base64_decode($_GET['nr']);
mysqli_query($kon,"DELETE FROM `rachunki` WHERE `numer`='$nr'");
?>
<meta http-equiv="Refresh" content="0; url=../main.php?mode=showcardA" />

