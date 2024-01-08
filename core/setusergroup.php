<?php
require('../config/config.php');
require('../controller/session_controller.php');
include('../controller/konekt_MySQL.php');
include('view/header_intro.php');
//print_r($_POST);
$sql="UPDATE `users` SET `group_id`='".$_POST['groups']."' WHERE `id`='".$_GET['id']."'";
if(mysqli_query($kon,$sql)){
    ?>
<h5>Grupa zmieniona</h5>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/usermanager.php">
<?php
}
else {
    echo "<h5>Błąd - nie udało się zmienić uprawnień</h5>";
?>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/usermanager.php">
<?php }

