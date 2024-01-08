<?php
require('../config/config.php');
require('../controller/session_controller.php');
include('../controller/konekt_MySQL.php');
include('view/header_intro.php');
$password=crypt($_POST['pass'],$salt);
$sql="UPDATE `users` SET `password`='$password' WHERE `id`='".$_POST['id']."'";
if(mysqli_query($kon,$sql)){
    ?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Sukces</h4>
  <p>Hasło dla użytkownika zostało zmienione</p>
  <hr>
  <p class="mb-0">Identyfikator: <?php echo $_POST['id'];?></p>
</div>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/usermanager.php">
<?php
}
else {
    echo "<h5>Błąd - nie udało się zmienić hasła</h5>";
?>
<meta http-equiv="refresh" content="1; url=<?php echo $siteurl;?>/core/usermanager.php">
<?php }
include('../view/footer.php');?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
  
  
 
</body>

</html>