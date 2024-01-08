<?php

if (isset($_POST['data1'])&&isset($_POST['data1'])) {
    $collectdata1=$_POST['data1'];
    $rok_akademicki=substr($collectdata1,0,4);
    $collectdata2=$_POST['data2'];
    }
else {
$collectdata1="$rok_akademicki-10-31";
$rend=$rok_akademicki+1;
$collectdata2="$rend-10-31";}
//pobieram dla każdego kierunku stan studentów z I semestru, zapisanych w danym roku akademickim
$kierunki_odsiew=mysqli_query($kon,"SELECT * FROM `mapowanie` WHERE `stopien`<>'Podyplomowe' AND `stopien`<>'Kurs'");
$ile_kierunkow=mysqli_num_rows($kierunki_odsiew);
$no=0;
    do{
        $kierunekodsiew=mysqli_fetch_array($kierunki_odsiew);
        $no=$no+1;
        // ponieważ do kilku mapowań mogą być podpięte kierunki robimy myk
      //  echo "SELECT * FROM `mapowanie` WHERE `kierunek`='$kierunekodsiew[2]' AND `stopien`='$kierunekodsiew[5]' AND `forma`='$kierunekodsiew[4]' AND `tytul`='$kierunekodsiew[7]' AND `profil`='$kierunekodsiew[13]' AND `jezyk`='$kierunekodsiew[6]'";
        $kierunekodsiew_prec=mysqli_query($kon,"SELECT * FROM `mapowanie` WHERE `kierunek`='$kierunekodsiew[2]' AND `stopien`='$kierunekodsiew[5]' AND `forma`='$kierunekodsiew[4]' AND `tytul`='$kierunekodsiew[7]' AND `profil`='$kierunekodsiew[13]' AND `jezyk`='$kierunekodsiew[6]'");
        $ile_prec=mysqli_num_rows($kierunekodsiew_prec);
        $nop=0;
        $ilu=0;
            do {
                //liczę studentów
                $kier_prec=mysqli_fetch_array($kierunekodsiew_prec);
                $nop=$nop+1;
               // echo "SELECT `id` FROM `studenci` WHERE `id_mapowanie`='$kier_prec[0]' AND `collect_data`='$collectdata1' AND `numer_semestru`=1 AND `data_rozpoczecia` LIKE '$rok_akademicki-10%'";
                $ilu=$ilu+mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `studenci` WHERE `id_mapowanie`='$kier_prec[0]' AND `collect_data`='$collectdata1' AND `numer_semestru`=1 AND `data_rozpoczecia` LIKE '$rok_akademicki-10%' "));
                
                
            }
            while($nop<$ile_prec);
            if($ilu>0) $odsiewarray["$kierunekodsiew[2];;$kierunekodsiew[4];;$kierunekodsiew[5];;$kierunekodsiew[6];;$kierunekodsiew[7];;$kierunekodsiew[13]"]=$ilu;
    }       
while($no<$ile_kierunkow);
//pobieram stan aktualny

 $kierunki_odsiew2=mysqli_query($kon,"SELECT * FROM `mapowanie` WHERE `stopien`<>'Podyplomowe' AND `stopien`<>'Kurs'");
$ile_kierunkow2=mysqli_num_rows($kierunki_odsiew2);
$no2=0;
    do{
        $kierunekodsiew2=mysqli_fetch_array($kierunki_odsiew2);
        $no2=$no2+1;
        // ponieważ do kilku mapowań mogą być podpięte kierunki robimy myk
      // echo "SELECT * FROM `mapowanie` WHERE `kierunek`='$kierunekodsiew[2]' AND `stopien`='$kierunekodsiew[5]' AND `forma`='$kierunekodsiew[4]' AND `tytul`='$kierunekodsiew[7]' AND `profil`='$kierunekodsiew[13]' AND `jezyk`='$kierunekodsiew[6]'";
        $kierunekodsiew_prec2=mysqli_query($kon,"SELECT * FROM `mapowanie` WHERE `kierunek`='$kierunekodsiew2[2]' AND `stopien`='$kierunekodsiew2[5]' AND `forma`='$kierunekodsiew2[4]' AND `tytul`='$kierunekodsiew2[7]' AND `profil`='$kierunekodsiew2[13]' AND `jezyk`='$kierunekodsiew2[6]'");
        $ile_prec2=mysqli_num_rows($kierunekodsiew_prec2);
        $nop2=0;
        $ilu2=0;
            do {
                //liczę studentów
                $kier_prec2=mysqli_fetch_array($kierunekodsiew_prec2);
                $nop2=$nop2+1;
                //echo "SELECT `id` FROM `studenci` WHERE `id_mapowanie`='$kier_prec2[0]' AND `collect_data`='$collectdata2' AND (`numer_semestru`=1 OR `numer_semestru`=2 OR `numer_semestru`=3) AND `data_rozpoczecia` LIKE '$rok_akademicki-10%' AND `rok_semestru`=$rok_akademicki AND `status_studenta`<>'rezygnacja' AND `status_studenta`<>'skreślenie'";
                $ilu2=$ilu2+mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `studenci` WHERE `id_mapowanie`='$kier_prec2[0]' AND `collect_data`='$collectdata2' AND (`numer_semestru`=1 OR `numer_semestru`=2 OR `numer_semestru`=3) AND `data_rozpoczecia` LIKE '$rok_akademicki-10%' AND `status_studenta`<>'rezygnacja' AND `status_studenta`<>'skreślenie'"));
                
                
            }
            while($nop2<$ile_prec2);
            if($ilu2>0) $odsiewarray2["$kierunekodsiew2[2];;$kierunekodsiew2[4];;$kierunekodsiew2[5];;$kierunekodsiew2[6];;$kierunekodsiew2[7];;$kierunekodsiew2[13]"]=$ilu2;
    }       
while($no2<$ile_kierunkow2);