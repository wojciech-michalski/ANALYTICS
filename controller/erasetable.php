<?php
$referer=$_SERVER['HTTP_REFERER'];
require('../config/config.php');
require('session_controller.php');
include('konekt_MySQL.php');
$delete="DELETE FROM `karty_obciazen_w` WHERE `rok_akademicki`='$_POST[rok_akademicki]' "
        . "AND `semestr_ZL`='$_POST[semestr_ZL]' AND `wykladowca_imie`='$_POST[wykladowca_imie]' "
        . "AND `wykladowca_nazwisko`='$_POST[wykladowca_nazwisko]' AND `WYDZIAL`='$_POST[wydzial]'";
mysqli_query($kon,$delete);
 $wykladowca="$_POST[wykladowca_nazwisko];;$_POST[wykladowca_imie]";
?>
<form method="POST" action="<?php echo $referer;?>" id="auto_s">
    <input type="hidden" name="wykladowca" value="<?php echo $wykladowca;?>"/>
    <input type="hidden" name="rok_akademicki" value="<?php echo $_POST['rok_akademicki'];?>"/>
    <input type="hidden" name="semestr_ZL" value="<?php echo $_POST['semestr_ZL'];?>"/>
</form>
   
<script>
    document.getElementById("auto_s").submit();
</script>

