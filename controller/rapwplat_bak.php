<?php

//print_r($_POST);
//szukam w liście semestrów przynależności
//warunek na przynależność
$dzis=date('Y-m-d');
switch ($_POST['semestrLZ']){
    case 0:
        $semestrnazwa="Zimowy";
        break;
    case 1:
       $semestrnazwa="Letni";
        break; 
}

$kierunkidotabeli=implode(", ",$_POST['kierunki']);
$rodzajedotabeli=implode(", ",$_POST['rodzaje']);
$typydotabeli=implode(", ",$_POST['typy']);
$tytulydotabeli=implode(", ",$_POST['tytuly']);
$kierunki=implode("' OR `kierunek`='",$_POST['kierunki']);
$rodzaje=implode("' OR `forma`='",$_POST['rodzaje']);
$typp=implode("' OR `stopien`='",$_POST['typy']);
$tyt=implode("' OR `tytul`='",$_POST['tytuly']);
$przynquery_="SELECT `id_kierunek`,`id_typ`,`id_rodzaj` FROM `mapowanie` WHERE (`kierunek`='$kierunki') AND (`forma`='$rodzaje') AND (`stopien`='$typp') AND (`tytul`='$tyt')";
$base=mysqli_query($kon,$przynquery_);
$ile_p=mysqli_num_rows($base);
$counter=0;
do {
    $przynaleznosc=mysqli_fetch_array($base);
    $counter++;
    $queryarray[]="OR (Przynaleznosc.G_ID_KIERUNEK='$przynaleznosc[0]' AND Przynaleznosc.G_ID_TYP='$przynaleznosc[1]' AND Przynaleznosc.G_ID_RODZAJ='$przynaleznosc[2]')";
}
while($counter<$ile_p);
foreach($_POST['rodzaje_oplat'] as $oplata){
    $ro[]=$rodzaje_Oplat[$oplata];
}
$LOplatydotabelki= implode(", ",$ro);
$LOplatystring_= implode("' OR LOplaty.LO_RODZAJ='",$_POST['rodzaje_oplat']);
$LOplatystring="LOplaty.LO_RODZAJ='$LOplatystring_'";
//echo $przynquery_;
$querystring_=implode(" ",$queryarray);
$querystring=substr($querystring_,2);
$przynquery="SELECT Lista_Semestrow.ID_LISTA_SEMESTROW, Lista_Semestrow.L_LETNI, Lista_Semestrow.L_NR_SEMESTRU "
        . ",Lista_Semestrow.L_ROK, Przynaleznosc.G_NUMER_ALBUMU, LRata.LR_KWOTA, LRata.LR_STATUS,LRata.LR_DATA_PLATNOSCI,LRata.LR_DATA_ZMIANY_K,LOplaty.LO_RODZAJ FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . " WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring) AND ($LOplatystring) AND LRata.LR_DATA_PLATNOSCI<'$dzis'";
$iluquery="SELECT DISTINCT"
        . " Przynaleznosc.G_NUMER_ALBUMU FROM "
        . "Przynaleznosc INNER JOIN Lista_Semestrow ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc "
        . " WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]'  AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring)";
$ilu_studentow=sqlsrv_num_rows(sqlsrv_query($conn,$iluquery,array(), array( "Scrollable" => 'static')));
$czesne_oplacone_query="SELECT LinkOplaty.LL_ID_RATA,Lista_Semestrow.ID_LISTA_SEMESTROW, Lista_Semestrow.L_LETNI, Lista_Semestrow.L_NR_SEMESTRU "
        . ",Lista_Semestrow.L_ROK, Przynaleznosc.G_NUMER_ALBUMU, LRata.LR_KWOTA, LRata.LR_STATUS,LRata.LR_DATA_PLATNOSCI,LRata.LR_DATA_ZMIANY_K,LOplaty.LO_RODZAJ,LinkOplaty.LL_DATA ,LinkOplaty.LL_KWOTA,LinkOplaty.LL_STATUS FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . "INNER JOIN LinkOplaty ON LinkOplaty.LL_ID_RATA=LRata.ID_LRATA WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring)  AND ($LOplatystring) AND LRata.LR_STATUS=3 AND LinkOplaty.LL_DATA<=LRata.LR_DATA_PLATNOSCI";
$czesne_oplacone_po_terminie_query="SELECT LinkOplaty.LL_ID_RATA,Lista_Semestrow.ID_LISTA_SEMESTROW, Lista_Semestrow.L_LETNI, Lista_Semestrow.L_NR_SEMESTRU "
        . ",Lista_Semestrow.L_ROK, Przynaleznosc.G_NUMER_ALBUMU, LRata.LR_KWOTA, LRata.LR_STATUS,LRata.LR_DATA_PLATNOSCI,LRata.LR_DATA_ZMIANY_K,LOplaty.LO_RODZAJ,LinkOplaty.LL_DATA ,LinkOplaty.LL_KWOTA,LinkOplaty.LL_STATUS FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . "INNER JOIN LinkOplaty ON LinkOplaty.LL_ID_RATA=LRata.ID_LRATA WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring)  AND ($LOplatystring) AND LRata.LR_STATUS=3 AND LinkOplaty.LL_DATA>LRata.LR_DATA_PLATNOSCI";

$czesne_oplacone_czesciowo_query="SELECT Lista_Semestrow.ID_LISTA_SEMESTROW, Lista_Semestrow.L_LETNI, Lista_Semestrow.L_NR_SEMESTRU "
        . ",Lista_Semestrow.L_ROK, Przynaleznosc.G_NUMER_ALBUMU, LRata.LR_KWOTA, LRata.LR_STATUS,LRata.LR_DATA_PLATNOSCI,LRata.LR_DATA_ZMIANY_K,LOplaty.LO_RODZAJ,LinkOplaty.LL_DATA ,LinkOplaty.LL_KWOTA,LinkOplaty.LL_STATUS FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . "INNER JOIN LinkOplaty ON LinkOplaty.LL_ID_RATA=LRata.ID_LRATA WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring)  AND ($LOplatystring) AND LRata.LR_STATUS=1";

$czesne_nieoplacone_query="SELECT Lista_Semestrow.ID_LISTA_SEMESTROW, Lista_Semestrow.L_LETNI, Lista_Semestrow.L_NR_SEMESTRU "
        . ",Lista_Semestrow.L_ROK, Przynaleznosc.G_NUMER_ALBUMU, LRata.LR_KWOTA, LRata.LR_STATUS,LRata.LR_DATA_PLATNOSCI,LRata.LR_DATA_ZMIANY_K,LOplaty.LO_RODZAJ FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . " WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring) AND LRATA.LR_STATUS=0 AND ($LOplatystring) AND LRATA.LR_DATA_PLATNOSCI<'$dzis'";
$czesne_oplacone_ogolem_query="SELECT Lista_Semestrow.ID_LISTA_SEMESTROW, Lista_Semestrow.L_LETNI, Lista_Semestrow.L_NR_SEMESTRU "
        . ",Lista_Semestrow.L_ROK, Przynaleznosc.G_NUMER_ALBUMU, LRata.LR_KWOTA, LRata.LR_STATUS,LRata.LR_DATA_PLATNOSCI,LRata.LR_DATA_ZMIANY_K,LOplaty.LO_RODZAJ FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . "INNER JOIN LinkOplaty ON LinkOplaty.LL_ID_RATA=LRata.ID_LRATA WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring)  AND ($LOplatystring) AND LRata.LR_STATUS=3 ";
//echo $czesne_nieoplacone_query;

$suma_oplacone_czesciowo_query="SELECT SUM (LinkOplaty.LL_KWOTA) FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . "INNER JOIN LinkOplaty ON LinkOplaty.LL_ID_RATA=LRata.ID_LRATA WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring)  AND ($LOplatystring) AND LRata.LR_STATUS=1";

$suma_nieoplacone_query="SELECT  "
        . "SUM(LRata.LR_KWOTA)  FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . " WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring) AND LRATA.LR_STATUS=0 AND ($LOplatystring) AND LRATA.LR_DATA_PLATNOSCI<'$dzis'";

$suma_oplacone_po_terminie_query="SELECT SUM(LinkOplaty.LL_KWOTA) FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . "INNER JOIN LinkOplaty ON LinkOplaty.LL_ID_RATA=LRata.ID_LRATA WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring)  AND ($LOplatystring) AND LRata.LR_STATUS=3 AND LinkOplaty.LL_DATA>LRata.LR_DATA_PLATNOSCI";

$suma_oplacone_query="SELECT SUM(LinkOplaty.LL_KWOTA) FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . "INNER JOIN LinkOplaty ON LinkOplaty.LL_ID_RATA=LRata.ID_LRATA WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring)  AND ($LOplatystring) AND LRata.LR_STATUS=3 AND LinkOplaty.LL_DATA<=LRata.LR_DATA_PLATNOSCI";


$czesne_nieoplacone=sqlsrv_query($conn,$czesne_nieoplacone_query,array(), array( "Scrollable" => 'static'));
$ile_rat_nieoplacone=sqlsrv_num_rows($czesne_nieoplacone);
$czesne_oplacone=sqlsrv_query($conn,$czesne_oplacone_query,array(), array( "Scrollable" => 'static'));
$ile_rat_w_terminie=sqlsrv_num_rows($czesne_oplacone);
$czesne_oplacone_po_terminie=sqlsrv_query($conn,$czesne_oplacone_po_terminie_query,array(), array( "Scrollable" => 'static'));
$ile_rat_po_terminie=sqlsrv_num_rows($czesne_oplacone_po_terminie);
$czesne_oplacone_czesciowo=sqlsrv_query($conn,$czesne_oplacone_czesciowo_query,array(), array( "Scrollable" => 'static'));
$ile_rat_czesciowo=sqlsrv_num_rows($czesne_oplacone_czesciowo);

$czesne_oplacone_ogolem=sqlsrv_query($conn,$czesne_oplacone_ogolem_query,array(), array( "Scrollable" => 'static'));
$ile_rat_oplacone_ogolem=sqlsrv_num_rows($czesne_oplacone_ogolem);
$sumawplat=$ile_rat_oplacone_ogolem+$ile_rat_nieoplacone;
$udzial_terminowych=round(($ile_rat_w_terminie/$sumawplat)*100,2);
$udzial_nieterminowych=round(($ile_rat_po_terminie/$sumawplat)*100,2);
$udzial_nieoplaconych=round(($ile_rat_nieoplacone/$sumawplat)*100,2);

$suma_nieoplacone_=sqlsrv_fetch_array(sqlsrv_query($conn,$suma_nieoplacone_query));
$suma_nieoplacone=round($suma_nieoplacone_[0],2);

$suma_oplacone_czesciowo_=sqlsrv_fetch_array(sqlsrv_query($conn,$suma_oplacone_czesciowo_query));
$suma_oplacone_czesciowo=round($suma_oplacone_czesciowo_[0],2);

$suma_oplacone_po_terminie_=sqlsrv_fetch_array(sqlsrv_query($conn,$suma_oplacone_po_terminie_query));
$suma_oplacone_po_terminie=round($suma_oplacone_po_terminie_[0],2);

$suma_oplacone_=sqlsrv_fetch_array(sqlsrv_query($conn,$suma_oplacone_query));
$suma_oplacone=round($suma_oplacone_[0],2);

//$naliczone_query="SELECT  "
 //       . "SUM(LRata.LR_KWOTA) FROM "
 //       . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
 //       . " WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring) AND ($LOplatystring) AND LRATA.LR_DATA_PLATNOSCI<'$dzis'";

$naliczone_query="SELECT  "
        . "SUM(LRata.LR_KWOTA) FROM "
        . "Lista_Semestrow INNER JOIN Przynaleznosc ON Lista_Semestrow.L_ID_Przynaleznosc=Przynaleznosc.ID_Przynaleznosc INNER JOIN LOplaty ON LOplaty.LO_ID_LISTA_SEMESTROW=Lista_Semestrow.ID_Lista_Semestrow INNER JOIN LRata ON LRata.LR_ID_LOPLATA=LOplaty.ID_LOPLATA  "
        . " WHERE Lista_Semestrow.L_LETNI='$_POST[semestrLZ]' AND Lista_Semestrow.L_ROK='$_POST[rok_akademicki]' AND Przynaleznosc.G_NUMER_ALBUMU <>'' AND ($querystring) AND ($LOplatystring) AND LRATA.LR_DATA_PLATNOSCI<'$dzis'";
$suma_naliczone_=sqlsrv_fetch_array(sqlsrv_query($conn,$naliczone_query));
$suma_naliczone=round($suma_naliczone_[0],2);

$udzial_nieterminowych_k=round(($suma_oplacone_po_terminie/$suma_naliczone)*100,2);
$udzial_nieoplaconych_k=round(($suma_nieoplacone/$suma_naliczone)*100,2);
$udzial_terminowych_k=round(($suma_oplacone/$suma_naliczone)*100,2);
//$kierunek_do_tablicy[]=""