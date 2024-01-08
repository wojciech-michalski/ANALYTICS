<?php
$kierunki__=$_POST['kierunki'];
//echo $kierunki;
$typy__=$_POST['typy'];
$profile__=$_POST['profile'];
switch ($profile__){
    case "Profil Praktyczny":
        $pname="PP_";
        break;
    case "Profil Ogólnoakademicki":
        $pname="";
        break;
}
//$rodzaje__=ucfirst($_POST['rodzaje']);
$rodzaje__=$_POST['rodzaje'];
$tytuly__=$_POST['tytuly'];
$obc=$_POST['obc'];
$filename=str_replace(" ","","$kierunki__$typy__$rodzaje__$tytuly__$pname$obc.xml");
$rok_zdefiniowany=$_POST['rokaka'];
    $data_exploded=explode("-",$_POST['data']);
    switch($data_exploded[1]){
        case "10":
        case "11":
        case "12":
            $rok_akademicki=$data_exploded[0];
            $typ_semestru=1;
            break;
        
        case "01":
        case "02":
            $typ_semestru=1;
            $rok_akademicki=$data_exploded[0]-1;
        default:
            $rok_akademicki=$data_exploded[0]-1;
            $typ_semestru=2;
            break;
    }
$polonactive="active";
require('config/config.php');
require('controller/session_controller.php');
include('controller/konekt_GURU.php');
include('controller/konekt_MySQL.php');
include('controller/U10_Przynaleznosci.php');
include('controller/statusyANALYTICS.php');
include('view/header_intro.php');
include('view/polon_view2.php');
include('view/polon_Modal.php');


//include('view/footer.php');