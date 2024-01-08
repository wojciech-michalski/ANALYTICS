<div class="jumbotron jumbotron-fluid">
  <div class="container">
      
      <h4 class="display-5">WYŻSZA SZKOŁA EKOLOGII I ZARZĄDZANIA W WARSZAWIE</h4>
<?php //pobieram naglowek i metryki
require_once('config/config.php');
            require('konekt_MySQL.php');
$tytul=mysqli_fetch_array(mysqli_query($kon,"SELECT `nazwa`,`wstep` FROM `metryki` WHERE `ankieta`='$_GET[ank]'"));
echo "<p>$tytul[0]</p><hr/><p>$tytul[1]</p>";

?>
  </div></div>
<div class="container">
    <form method="post" action="insert_ankiety_sql.php">
        <input type="hidden" name="ankieta" value="<?php echo $_GET['ank'];?>"/>
    <?php $pytania=mysqli_query($kon,"SELECT `tresc`,`html` FROM `metryki` WHERE `ankieta`='$_GET[ank]' ORDER BY `id` ASC");
    $n=1;
    foreach($pytania as $pytanie){
        echo "<h4>$n. $pytanie[tresc]</h4>";
        echo $pytanie['html'];
        echo "<hr/>";
        $n++;
    }
    ?><button type="submit" class="btn btn-light">Wyślij ankietę</button></form>
</div>


<?php
require_once('views/footer.php');
?>