<?php
include('../config/config.php');
//include('../controller/konekt_GURU.php');
include('../controller/konekt_MySQL.php');

$q1=mysqli_query($kon,"SELECT `id`,`id_kierunek`,`id_typ`,`id_rodzaj` FROM `mapowanie` WHERE 1");
$ilemapowan=mysqli_num_rows($q1);
$m=0;
do {
    $mapowanie=mysqli_fetch_array($q1);
    echo "UPDATE `studenci` SET `id_mapowanie`=$mapowanie[0] WHERE `id_kierunek`=$mapowanie[1] AND `id_typ`=$mapowanie[stopien] AND `id_rodzaj`=$mapowanie[forma]";
    mysqli_query($kon,"UPDATE `studenci` SET `id_mapowanie`=$mapowanie[0] WHERE `id_kierunek`=$mapowanie[1] AND `id_typ`=$mapowanie[2] AND `id_rodzaj`=$mapowanie[3]");
    $m=$m+1;
}
while($m<$ilemapowan);
