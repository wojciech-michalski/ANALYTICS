<?php
require('../config/config.php');
require('../controller/session_controller.php');
include('../controller/konekt_MySQL.php');
include('view/header_intro.php');
$modules=implode(",",$_POST['modules']);
$privileges="\{$modules\}";
$sql="UPDATE `groups` SET `module_privileges`='$privileges' WHERE `id`='".$_GET['id']."'";
if(mysqli_query($kon,$sql)){
    ?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Sukces</h4>
  <p>Przyznano uprawnienia grupie</p>
  <hr>
  <p class="mb-0">Identyfikator: <?php echo $_GET['id'];?></p>
</div>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/groupmanager.php">
<?php
}
else {
    echo "<h5>Błąd - ne udało się przydzielić uprawnień</h5>";
?>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/groupmanager.php">
<?php }

