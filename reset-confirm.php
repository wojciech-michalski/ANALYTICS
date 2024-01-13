<?php
include('view/header_intro.php');
include('config/config.php');
include('controller/konekt_MySQL.php');
$token=mysqli_real_escape_string($kon,$_GET['token']);
$t=explode("|",$token);
$hash=$t[0];
$id=$t[1];
//echo $token;
if(mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `users` WHERE `id`=$id AND `reset_token`='$token'"))>0){
    mysqli_query($kon,"UPDATE `users` SET `password`='$hash' WHERE `id`=$id AND `reset_token`='$token'");
    mysqli_query($kon,"UPDATE `users` SET `reset_token`='' WHERE `id`=$id AND `reset_token`='$token'");
    ?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Reset hasła</h4>
  <p>Pomyślnie zresetowano hasło</p>
  <hr>
  <p class="mb-0">Możesz teraz zalogować się do systemu z nowym hasłem.</p>
  <a href="index.php"> <button class="btn btn-indigo">Przejdż do strony logowania</button></a>
</div>
<?php
}
else {
    die("Niestety coś poszło nie tak...");
}

include('view/footer.php');?>

