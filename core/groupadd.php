<?php
require('../config/config.php');
require('../controller/session_controller.php');
include('../controller/konekt_MySQL.php');
include('view/header_intro.php');
//print_r($_POST);
$modules=implode(",",$_POST['modules']);
$privileges="\{$modules\}";
$sql="INSERT INTO `groups` (`nazwa`,`module_privileges`,`active`) VALUES ('".$_POST['group']."','$privileges',1)";
if(mysqli_query($kon,$sql)){
    ?>
<h5>Grupa utworzona prawidłowo</h5>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/groupmanager.php">
<?php
}
else {
    echo "<h5>Błąd - ne udało się utworzyć grupy</h5>";
?>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/groupmanager.php">
<?php }