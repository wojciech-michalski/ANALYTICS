<?php
function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
include('view/header_intro.php');
include('config/config.php');
include('controller/konekt_MySQL.php');
$checkmail=mysqli_real_escape_string($kon,$_POST['email']);
$query=mysqli_query($kon,"SELECT `id`,`name` FROM `users` WHERE `email`='$checkmail' AND `active`=1");
//echo "SELECT `id` FROM `users` WHERE `email`='$checkmail' AND `active`=1";
if(mysqli_num_rows($query)>0){
    $id=mysqli_fetch_array($query);

    //generuję hasło:
    $password=random_str(8);
    $pass_hash=crypt($password,$salt);
    mysqli_query($kon,"UPDATE `users` SET `reset_token`='$pass_hash|$id[0]' WHERE `id`='$id[0]'");
  require_once "Mail.php";  
    $to=$checkmail;
    $subject = "Zgłosiłeś reset hasła w systemie ANALYTICS";
$body = "Dzień dobry  <br/>
Dostaliśmy zgłoszenie dotyczące resetu hasła do systemu ANALYTICS <br/>
Twoja nazwa użytkownika:<h2>$id[1]</h2><br/>
Zresetowane nowe hasło to: <br/>
<h2>$password</h2> <br/>
Potwierdź klikając w poniższy link.<br/>
<a href=\"$siteurl/reset-confirm.php?token=$pass_hash|$id[0]\">POTWIERDZAM</a>
<br/>
</strong>Administrator Analytics<strong>";

$headers = array ('From' => $MailFrom,
   'To' => $to,
  'Subject' => $subject,
  'Content-Type' => $contenttype,
  'Content-Transfer-Encodin' => $transfer);
$smtp = Mail::factory('smtp',
  array ('host' => $mailhost,
    'auth' => true,
    'username' => $mailusername,
    'password' => $mailpassword));
$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
 } else {
     ?>
<div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Reset hasła</h4>
  <p>Sprawdź swoją skrzynkę mailową i potwierdź reset hasła</p>
  <hr>
  <p class="mb-0">Po potwierdzeniu możesz zalogować się Twoją nazwą użytkownika i przesłanym hasłem.</p>
   <a href="index.php"> <button class="btn btn-indigo">Przejdż do strony logowania</button></a>
</div>
<?php
}
}
else {
    ?>
<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading">Reset hasła</h4>
  <p>Niestety nie mamy takiego adresu w systemie :-(</p>
  <hr>
  <p class="mb-0">Użyj uczelnianego adresu email w formacie imie.nazwisko@wseiz.pl</p>
   <a href="index.php"> <button class="btn btn-indigo">Przejdż do strony logowania</button></a>
</div>
<?php
}
 include('view/footer.php');?>
  
</body>

</html>
