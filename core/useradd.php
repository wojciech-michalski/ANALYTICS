<?php
require('../config/config.php');
require('../controller/session_controller.php');
include('../controller/konekt_MySQL.php');
include('view/header_intro.php');
$password=crypt($_POST['haslo'],$salt);
$sql="INSERT INTO `users` (`name`,`email`,`password`,`group_id`,`active`) VALUES ('".$_POST['user']."','".$_POST['email']."','$password',1,1)";
if(mysqli_query($kon,$sql)){
    ?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Sukces</h4>
  <p>Użytkownik został dodany</p>
  <hr>
  <p class="mb-0">Identyfikator: <?php echo $_POST['user'];?></p>
</div>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/usermanager.php">
<?php
}
else {
    echo "<h5>Błąd</h5>";
?>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/usermanager.php">
<?php }