<?php
require('../config/config.php');
require('../controller/session_controller.php');
include('../controller/konekt_MySQL.php');
include('view/header_intro.php');
switch($_GET['id'])
{
    case 1:
      echo "<h5>Błąd - nie można usunąć użytkownika Admin</h5>";
?>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/usermanager.php">
<?php   
break;
    default:


$sql="DELETE FROM `users` WHERE `id`=".$_GET['id'];
if(mysqli_query($kon,$sql)){
    ?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Sukces</h4>
  <p>Użytkownik został usunięty</p>
  <hr>
  <p class="mb-0">Identyfikator: <?php echo $_POST['id'];?></p>
</div>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/usermanager.php">
<?php
}
else {
    echo "<h5>Błąd - nie udało się usunąć użytkownika</h5>";
?>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/usermanager.php">
<?php }
break;
}