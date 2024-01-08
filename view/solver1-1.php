<?php
       include('view/topnav.php');
function chiKwadratCrit($iss,$pis)  {
    //$iss - ilość stopni swobody
    //$pis - poziom istotności
    //Ponieważ będę liczył dla alfa=0,01 i alfa=0,05 w praktyce $pis będie równe właśnie tyle
    switch ($pis){
        case 0.05:
          $chicritical=array("1" => 6.63490,"2" => 9.21034,"3" => 11.3449,"4" => 13.2767,"5" => 15.0863,"6" => 16.8119,"7" => 18.4753,"8" => 20.0902,"9" => 21.6660,"10" => 23.2093,"11" => 24.7250,"12" => 26.2170,"13" => 27.6882,"14" => 29.1412,"15" => 30.5779,"16" => 31.9999,"17" => 33.4087,"18" => 34.8053,"19" => 36.1909,"20" => 37.5662,"21" => 38.9322,"22" => 40.2894,"23" => 41.6384,"24" => 42.9798,"25" => 44.3141,"26" => 45.6417,"27" => 46.9629,"28" => 48.2782,"29" => 49.5879,"30" => 50.8922,"31" => 52.1914,"32" => 53.4858,"33" => 54.7755,"34" => 56.0609,"35" => 57.3421,"36" => 58.6192,"37" => 59.8925,"38" => 61.1621,"39" => 62.4281,"40" => 63.6907,"41" => 64.9501,"42" => 66.2062,"43" => 67.4593,"44" => 68.7095,"45" => 69.9568,"46" => 71.2014,"47" => 72.4433,"48" => 73.6826,"49" => 74.9195,"50" => 76.1539,"51" => 77.3860,"52" => 78.6158,"53" => 79.8433,"54" => 81.0688,"55" => 82.2921,"56" => 83.5134,"57" => 84.7328,"58" => 85.9502,"59" => 87.1657,"60" => 88.3794,"61" => 89.5913,"62" => 90.8015,"63" => 92.0100,"64" => 93.2169,"65" => 94.4221,"66" => 95.6257,"67" => 96.8278,"68" => 98.0284,"69" => 99.2275,"70" => 100.425,"71" => 101.621,"72" => 102.816,"73" => 104.010,"74" => 105.202,"75" => 106.393,"76" => 107.583,"77" => 108.771,"78" => 109.958,"79" => 111.144,"80" => 112.329,"81" => 113.512,"82" => 114.695,"83" => 115.876,"84" => 117.057,"85" => 118.236,"86" => 119.414,"87" => 120.591,"88" => 121.767,"89" => 122.942,"90" => 124.116,"91" => 125.289,"92" => 126.462,"93" => 127.633,"94" => 128.803,"95" => 129.973,"96" => 131.141,"97" => 132.309,"98" => 133.476,"99" => 134.642,"100" => 135.807,"101" => 136.971,"102" => 138.134,"103" => 139.297,"104" => 140.459,"105" => 141.620,"106" => 142.780,"107" => 143.940,"108" => 145.099,"109" => 146.257,"110" => 147.414,"111" => 148.571,"112" => 149.727,"113" => 150.882,"114" => 152.037,"115" => 153.191,"116" => 154.344,"117" => 155.496,"118" => 156.648,"119" => 157.800,"120" => 158.950,"121" => 160.100,"122" => 161.250,"123" => 162.398,"124" => 163.546,"125" => 164.694,"126" => 165.841,"127" => 166.987,"128" => 168.133,"129" => 169.278,"130" => 170.423,"131" => 171.567,"132" => 172.711,"133" => 173.854,"134" => 174.996,"135" => 176.138,"136" => 177.280,"137" => 178.421,"138" => 179.561,"139" => 180.701,"140" => 181.840,"141" => 182.979,"142" => 184.118,"143" => 185.256,"144" => 186.393,"145" => 187.530,"146" => 188.666,"147" => 189.802,"148" => 190.938,"149" => 192.073,"150" => 193.208,"151" => 194.342,"152" => 195.476,"153" => 196.609,"154" => 197.742,"155" => 198.874,"156" => 200.006,"157" => 201.138,"158" => 202.269,"159" => 203.400,"160" => 204.530,"161" => 205.660,"162" => 206.790,"163" => 207.919,"164" => 209.047,"165" => 210.176,"166" => 211.304,"167" => 212.431,"168" => 213.558,"169" => 214.685,"170" => 215.812,"171" => 216.938,"172" => 218.063,"173" => 219.189,"174" => 220.314,"175" => 221.438,"176" => 222.563,"177" => 223.687,"178" => 224.810,"179" => 225.933,"180" => 227.056,"181" => 228.179,"182" => 229.301,"183" => 230.423,"184" => 231.544,"185" => 232.665,"186" => 233.786,"187" => 234.907,"188" => 236.027,"189" => 237.147,"190" => 238.266,"191" => 239.386,"192" => 240.505,"193" => 241.623,"194" => 242.742,"195" => 243.860,"196" => 244.977,"197" => 246.095,"198" => 247.212,"199" => 248.329,"200" => 249.445,"205" => 255.023,"210" => 260.595,"215" => 266.159,"220" => 271.717,"225" => 277.269,"230" => 282.814,"235" => 288.354,"240" => 293.888,"245" => 299.417,"250" => 304.940,"255" => 310.457,"260" => 315.970,"265" => 321.478,"270" => 326.981,"275" => 332.480,"280" => 337.973,"285" => 343.463,"290" => 348.948,"295" => 354.429,"300" => 359.906,"305" => 365.379,"310" => 370.849,"315" => 376.314,"320" => 381.776,"325" => 387.234,"330" => 392.689,"335" => 398.140,"340" => 403.588,"345" => 409.032,"350" => 414.474,"355" => 419.912,"360" => 425.347,"365" => 430.779,"370" => 436.208,"375" => 441.635,"380" => 447.058,"385" => 452.479,"390" => 457.897,"395" => 463.312,"400" => 468.725,"405" => 474.135,"410" => 479.542,"415" => 484.947,"420" => 490.350,"425" => 495.750,"430" => 501.148,"435" => 506.544,"440" => 511.937,"445" => 517.328,"450" => 522.717,"455" => 528.104,"460" => 533.488,"465" => 538.871,"470" => 544.251,"475" => 549.630,"480" => 555.006,"485" => 560.381,"490" => 565.753,"495" => 571.124,"500" => 576.493,"510" => 587.225,"520" => 597.950,"530" => 608.668,"540" => 619.379,"550" => 630.084,"560" => 640.783,"570" => 651.475,"580" => 662.161,"590" => 672.841,"600" => 683.516,"610" => 694.184,"620" => 704.848,"630" => 715.506,"640" => 726.159,"650" => 736.807,"660" => 747.450,"670" => 758.088,"680" => 768.721,"690" => 779.349,"700" => 789.974,"710" => 800.593,"720" => 811.208,"730" => 821.819,"740" => 832.426,"750" => 843.029,"760" => 853.628,"770" => 864.223,"780" => 874.814,"790" => 885.401,"800" => 895.984,"810" => 906.564,"820" => 917.140,"830" => 927.713,"840" => 938.282,"850" => 948.848,"860" => 959.411,"870" => 969.970,"880" => 980.527,"890" => 991.080,"900" => 1001.63,"910" => 1012.18,"920" => 1022.72,"930" => 1033.26,"940" => 1043.80,"950" => 1054.33,"960" => 1064.87,"970" => 1075.40,"980" => 1085.92,"990" => 1096.45,"1000" => 1106.97);
            
            break;
        case 0.01:
            $chicritical=array("1" => 7.87944, "2" => 10.5966, "3" => 12.8382, "4" => 14.8603, "5" => 16.7496, "6" => 18.5476, "7" => 20.2777, "8" => 21.955, "9" => 23.5893, "10" => 25.1882, "11" => 26.7569, "12" => 28.2995, "13" => 29.8195, "14" => 31.3194, "15" => 32.8013, "16" => 34.2672, "17" => 35.7185, "18" => 37.1565, "19" => 38.5823, "20" => 39.9968, "21" => 41.4011, "22" => 42.7957, "23" => 44.1813, "24" => 45.5585, "25" => 46.9279, "26" => 48.2899, "27" => 49.6449, "28" => 50.9934, "29" => 52.3356, "30" => 53.672, "31" => 55.0027, "32" => 56.3281, "33" => 57.6484, "34" => 58.9639, "35" => 60.2748, "36" => 61.5812, "37" => 62.8833, "38" => 64.1814, "39" => 65.4756, "40" => 66.766, "41" => 68.0527, "42" => 69.336, "43" => 70.6159, "44" => 71.8926, "45" => 73.1661, "46" => 74.4365, "47" => 75.7041, "48" => 76.9688, "49" => 78.2307, "50" => 79.49, "51" => 80.7467, "52" => 82.0008, "53" => 83.2525, "54" => 84.5019, "55" => 85.749, "56" => 86.9938, "57" => 88.2364, "58" => 89.4769, "59" => 90.7153, "60" => 91.9517, "61" => 93.1861, "62" => 94.4187, "63" => 95.6493, "64" => 96.8781, "65" => 98.1051, "66" => 99.3304, "67" => 100.554, "68" => 101.776, "69" => 102.996, "70" => 104.215, "71" => 105.432, "72" => 106.648, "73" => 107.862, "74" => 109.074, "75" => 110.286, "76" => 111.495, "77" => 112.704, "78" => 113.911, "79" => 115.117, "80" => 116.321, "81" => 117.524, "82" => 118.726, "83" => 119.927, "84" => 121.126, "85" => 122.325, "86" => 123.522, "87" => 124.718, "88" => 125.913, "89" => 127.106, "90" => 128.299, "91" => 129.491, "92" => 130.681, "93" => 131.871, "94" => 133.059, "95" => 134.247, "96" => 135.433, "97" => 136.619, "98" => 137.803, "99" => 138.987, "100" => 140.169, "101" => 141.351, "102" => 142.532, "103" => 143.712, "104" => 144.891, "105" => 146.07, "106" => 147.247, "107" => 148.424, "108" => 149.599, "109" => 150.774, "110" => 151.948, "111" => 153.122, "112" => 154.294, "113" => 155.466, "114" => 156.637, "115" => 157.808, "116" => 158.977, "117" => 160.146, "118" => 161.314, "119" => 162.481, "120" => 163.648, "121" => 164.814, "122" => 165.979, "123" => 167.144, "124" => 168.308, "125" => 169.471, "126" => 170.634, "127" => 171.796, "128" => 172.957, "129" => 174.118, "130" => 175.278, "131" => 176.438, "132" => 177.597, "133" => 178.755, "134" => 179.913, "135" => 181.07, "136" => 182.226, "137" => 183.382, "138" => 184.538, "139" => 185.693, "140" => 186.847, "141" => 188.001, "142" => 189.154, "143" => 190.306, "144" => 191.458, "145" => 192.61, "146" => 193.761, "147" => 194.912, "148" => 196.062, "149" => 197.211, "150" => 198.36, "151" => 199.509, "152" => 200.657, "153" => 201.804, "154" => 202.951, "155" => 204.098, "156" => 205.244, "157" => 206.39, "158" => 207.535, "159" => 208.68, "160" => 209.824, "161" => 210.968, "162" => 212.111, "163" => 213.254, "164" => 214.396, "165" => 215.539, "166" => 216.68, "167" => 217.821, "168" => 218.962, "169" => 220.102, "170" => 221.242, "171" => 222.382, "172" => 223.521, "173" => 224.66, "174" => 225.798, "175" => 226.936, "176" => 228.074, "177" => 229.211, "178" => 230.347, "179" => 231.484, "180" => 232.62, "181" => 233.755, "182" => 234.891, "183" => 236.025, "184" => 237.16, "185" => 238.294, "186" => 239.428, "187" => 240.561, "188" => 241.694, "189" => 242.827, "190" => 243.959, "191" => 245.091, "192" => 246.223, "193" => 247.354, "194" => 248.485, "195" => 249.616, "196" => 250.746, "197" => 251.876, "198" => 253.006, "199" => 254.135, "200" => 255.264, "205" => 260.904, "210" => 266.537, "215" => 272.162, "220" => 277.779, "225" => 283.39, "230" => 288.994, "235" => 294.591, "240" => 300.182, "245" => 305.767, "250" => 311.346, "255" => 316.919, "260" => 322.487, "265" => 328.049, "270" => 333.606, "275" => 339.158, "280" => 344.705, "285" => 350.247, "290" => 355.784, "295" => 361.316, "300" => 366.844, "305" => 372.368, "310" => 377.888, "315" => 383.403, "320" => 388.914, "325" => 394.421, "330" => 399.924, "335" => 405.424, "340" => 410.92, "345" => 416.412, "350" => 421.9, "355" => 427.386, "360" => 432.867, "365" => 438.346, "370" => 443.821, "375" => 449.293, "380" => 454.761, "385" => 460.227, "390" => 465.69, "395" => 471.15, "400" => 476.606, "405" => 482.06, "410" => 487.512, "415" => 492.96, "420" => 498.406, "425" => 503.849, "430" => 509.289, "435" => 514.727, "440" => 520.163, "445" => 525.596, "450" => 531.026, "455" => 536.454, "460" => 541.88, "465" => 547.304, "470" => 552.725, "475" => 558.144, "480" => 563.561, "485" => 568.975, "490" => 574.388, "495" => 579.798, "500" => 585.207, "510" => 596.017, "520" => 606.82, "530" => 617.615, "540" => 628.402, "550" => 639.183, "560" => 649.956, "570" => 660.722, "580" => 671.482, "590" => 682.235, "600" => 692.982, "610" => 703.722, "620" => 714.457, "630" => 725.185, "640" => 735.908, "650" => 746.625, "660" => 757.337, "670" => 768.043, "680" => 778.745, "690" => 789.44, "700" => 800.131, "710" => 810.817, "720" => 821.499, "730" => 832.175, "740" => 842.847, "750" => 853.514, "760" => 864.177, "770" => 874.836, "780" => 885.49, "790" => 896.14, "800" => 906.786, "810" => 917.428, "820" => 928.066, "830" => 938.7, "840" => 949.331, "850" => 959.957, "860" => 970.58, "870" => 981.2, "880" => 991.815, "890" => 1002.43, "900" => 1013.04, "910" => 1023.64, "920" => 1034.24, "930" => 1044.84, "940" => 1055.44, "950" => 1066.03, "960" => 1076.62, "970" => 1087.21, "980" => 1097.79, "990" => 1108.37, "1000" => 1118.95);
    }
    $ss=array_keys($chicritical);
    //szukam stopnia swobody w macierzy $chicritical, jeśli go nie ma szukam najbliższego
    if($iss<200) {
        $chicrit=$chicritical[$iss];
    }
   if($iss>200 && $iss<500){
        $iss=floor($iss/10)*10;
        $chicrit=$chicritical[$iss];
    }
    if($iss>500) {
        $iss=floor($iss/10)*10;
        $chicrit=$chicritical[$iss];
    }
return $chicrit;
 
}
function silnia($liczba)
{
   if($liczba < 2) 
      return 1;
   else
    //  return $liczba*silnia($liczba-1);  
       return bcmul($liczba,silnia($liczba-1));
}
function newton($n,$k){
   
    return bcdiv(silnia($n),bcmul(silnia($k),silnia($n-$k)));
}
//znajdowanie relacji ikorelacji w zbiorze
//MariaDB
//include('MySQL_connect.php');
if(mysqli_num_rows(mysqli_query($kon,"SELECT * 
FROM information_schema.tables
WHERE table_schema = 'analytics' 
    AND table_name = 'TMP'
LIMIT 1;"))>0) {
mysqli_query($kon,"DROP VIEW `TMP`");
mysqli_query($kon,"DROP VIEW `TMP_NEGATIVE`");
//testy jednostkowe wykazały konieczność warunku
}
else {
    echo "<!--Nic do zrzucenia-->";
    //Nothing to drop
}
//1. Wybieramy element badany (po metryce)
//2. Ustawiamy czułość 50-100%
//3. Sprawdzamy dla każdego elementu
//4. Elementy prawdziwe do tablicy
//5. Sprawdzamy dla tablicy korelację odwrotną
//6. Jeśli zachodzi korelacja - WYNIK
//print_r($_POST);
$value=$_POST['value'];
$element=$_POST['element'];
//echo $element;
$treshold=$_POST['treshold'];
//echo $treshold;
$tabela=$_POST['tabela'];
//echo $tabela;
//print_r($value);
$condition=$_POST['exact'];
//echo $condition;

//print_r($values);
if ($condition=="=") {
   foreach ($value as $wartosc) {
    $values[]="'$wartosc'";
   // echo $wartosc;
} 
$values_query_element=implode(" OR `$element`=",$values);
$values_query="SELECT $tabela.id,$tabela.id_prowadzacy,
$tabela.PYT_1,
$tabela.PYT_2,
$tabela.PYT_3,
$tabela.PYT_4,
$tabela.PYT_5,
$tabela.PYT_6,
$tabela.PYT_7,
$tabela.PYT_8,
$tabela.PYT_9,
$tabela.PYT_10,
$tabela.PYT_11,
$tabela.PYT_12,
$tabela.PYT_13,
$tabela.PYT_14,
$tabela.PYT_15,
$tabela.PYT_16,
$tabela.data,
$tabela.forma_zajec,
$tabela.nieobecnosci FROM `$tabela` INNER JOIN `prowadzacy` ON prowadzacy.id=ocena_pracy_nauczyciela.id_prowadzacy "
        . "WHERE `$element`=$values_query_element AND prowadzacy.rok_akademicki LIKE '%$_POST[rok_akademicki]'";
$values_query_negative="SELECT $tabela.id,$tabela.id_prowadzacy,
$tabela.PYT_1,
$tabela.PYT_2,
$tabela.PYT_3,
$tabela.PYT_4,
$tabela.PYT_5,
$tabela.PYT_6,
$tabela.PYT_7,
$tabela.PYT_8,
$tabela.PYT_9,
$tabela.PYT_10,
$tabela.PYT_11,
$tabela.PYT_12,
$tabela.PYT_13,
$tabela.PYT_14,
$tabela.PYT_15,
$tabela.PYT_16,
$tabela.data,
$tabela.forma_zajec,
$tabela.nieobecnosci FROM `$tabela` "
        . "INNER JOIN `prowadzacy` ON prowadzacy.id=ocena_pracy_nauczyciela.id_prowadzacy "
        . "WHERE `$element`<>$values_query_element AND prowadzacy.rok_akademicki LIKE '%$_POST[rok_akademicki]'";
}
if ($condition=="LIKE") {
    foreach ($value as $wartosc) {
    $values[]="'%$wartosc%'";
   // echo $wartosc;
}
    $values_query_element=implode(" OR `$element` LIKE ",$values);
    $values_query="SELECT $tabela.id,$tabela.id_prowadzacy,
$tabela.PYT_1,
$tabela.PYT_2,
$tabela.PYT_3,
$tabela.PYT_4,
$tabela.PYT_5,
$tabela.PYT_6,
$tabela.PYT_7,
$tabela.PYT_8,
$tabela.PYT_9,
$tabela.PYT_10,
$tabela.PYT_11,
$tabela.PYT_12,
$tabela.PYT_13,
$tabela.PYT_14,
$tabela.PYT_15,
$tabela.PYT_16,
$tabela.data,
$tabela.forma_zajec,
$tabela.nieobecnosci FROM `$tabela`INNER JOIN `prowadzacy` ON prowadzacy.id=ocena_pracy_nauczyciela.id_prowadzacy "
            . "WHERE `$element` LIKE $values_query_element AND prowadzacy.rok_akademicki LIKE '%$_POST[rok_akademicki]'";
    $values_query_negative="SELECT  $tabela.id,$tabela.id_prowadzacy,
$tabela.PYT_1,
$tabela.PYT_2,
$tabela.PYT_3,
$tabela.PYT_4,
$tabela.PYT_5,
$tabela.PYT_6,
$tabela.PYT_7,
$tabela.PYT_8,
$tabela.PYT_9,
$tabela.PYT_10,
$tabela.PYT_11,
$tabela.PYT_12,
$tabela.PYT_13,
$tabela.PYT_14,
$tabela.PYT_15,
$tabela.PYT_16,
$tabela.data,
$tabela.forma_zajec,
$tabela.nieobecnosci FROM `$tabela` "
            . "INNER JOIN `prowadzacy` ON prowadzacy.id=ocena_pracy_nauczyciela.id_prowadzacy "
            . "WHERE `$element` NOT LIKE $values_query_element AND prowadzacy.rok_akademicki LIKE '%$_POST[rok_akademicki]'";
}
//echo "CREATE VIEW `TMP` AS ($values_query)";
//warunek z testów jednostkowych - żeby nie było błędu division by zero
if (mysqli_num_rows(mysqli_query($kon,$values_query))==0) {
    ?><div class="row" style="margin-top:70px;">
           <div class="col-md-2">
               <?php
       include('view/sidenav.php');
           ?>
           </div>
        <div class="col-md-10" style="padding-left:5%">
                 <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="#" target="_blank">Analytics</a>
            <span>/</span>
            <span>ANALIZA ANKIETY <?php echo $_POST['ankieta']; //echo strlen($ac);
            //echo $ile_naglowkow;?></span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Brak wyników</strong> Dla takiego parametru ilość wyników równa jest 0,<br/>
  Analiza jest niemożliwa.
  <a class="button close" href="main.php?mode=deanreport6" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </a>
</div></div></div></div>
<?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');
      foreach ($scripts as $script){
     echo $script;
 }?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
$(function () {
// popovers Initialization
$('[data-toggle="popover"]').popover();
});
  </script>
  
  
 
</body>

</html>
<?php die();
}
else
mysqli_query($kon,"CREATE VIEW `TMP` AS ($values_query) ");
mysqli_query($kon,"CREATE VIEW `TMP_NEGATIVE` AS ($values_query_negative) ");
$ile_wynikow_query=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `TMP` WHERE 1 "));
$ile_wynikow_query_negative=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `TMP_NEGATIVE` WHERE 1 "));
//echo "Wyniki spełniające warunek: $ile_wynikow_query <br/>";
$pytania=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `ankieta`='$tabela' AND `pytanie`<>'$element'");
$tresc_elbad=mysqli_fetch_array(mysqli_query($kon,"SELECT `tresc` FROM `metryki` WHERE `ankieta`='$tabela' AND `pytanie`='$element'"));
$ile=mysqli_num_rows($pytania);
$n=0;
//echo "<br/> MAM $ile pytań";
do {
    $question=mysqli_fetch_array($pytania);
    $warianty=mysqli_query($kon,"SELECT DISTINCT `$question[2]` FROM `TMP` WHERE 1 "); 
        $ile_wariantow=mysqli_num_rows($warianty);
        $k=0;
        do {
            $wariant=mysqli_fetch_array($warianty);
            $ile_wynikow=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `TMP` WHERE `$question[2]`='$wariant[0]' "));
            $rezultat_proc=round(($ile_wynikow/$ile_wynikow_query)*100,2);
            if($rezultat_proc>=$treshold){
                //Mam korelację pozytywną - trzeba sprawdzić negatywną
               $ile_wynikow_neg=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `TMP_NEGATIVE` WHERE `$question[2]`<>'$wariant[0]'"));
               $rezultat_proc_neg=round(($ile_wynikow_neg/$ile_wynikow_query_negative)*100,2); 
               if ($rezultat_proc_neg>=$treshold) {
            //echo "<br/> Pytanie $question[2] $question[3] - ilość odpowiedzi <b>$wariant[0]</b>: <em>$rezultat_proc %</em><br/>";
            $result_matrix[]="$question[2];;;$question[3];;;$wariant[0];;;$rezultat_proc;;;$rezultat_proc_neg";
            }
            }
            else echo"";
            $k=$k+1;
                    }
                    while ($k<$ile_wariantow);
    $n=$n+1;
//ile jest odpowiedzi m na pytanie n
}
while ($n<$ile);
    ?>
       
      
       <div class="row" style="margin-top:70px;">
           <div class="col-md-2">
               <?php
       include('view/sidenav.php');
           ?>
           </div>
        <div class="col-md-10" style="padding-left:5%">
                 <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="#" target="_blank">Analytics</a>
            <span>/</span>
            <span>ANALIZA ANKIETY <?php echo $_POST['ankieta']; //echo strlen($ac);
            //echo $ile_naglowkow;?></span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
         
        <div class="card-header text-center"><?php echo $_POST['analiza'];?>
        </div>
<div class="card-body">
    <?php 
   // print_r($_POST);
    switch($_POST['element']) {
                    default:
                        ?>
<h5> Poszukiwana jest zależność pomiędzy pytaniem <?php echo "$element : <em>$tresc_elbad[0]</em>";?> <br/>
        Udzielone odpowiedzi: <?php echo $values_query_element;?>
    </b> - a innymi elementami ankiety</h5>
    <?php break;
    case "id_prowadzacy":
       $idp=str_replace("'","",$values_query_element);
       // echo $values_query_element;
        $prow=mysqli_fetch_array(mysqli_query($kon,"SELECT `nazwisko`,`imie`,`tytul` FROM `prowadzacy`"
                . " WHERE `id`=$values_query_element"));
        ?>
    <h5> Poszukiwana jest zależność pomiędzy pytaniem Nauczyciel:  <br/>
        Udzielone odpowiedzi: <?php echo "$prow[0] $prow[1] $prow[2]";?>
    </b> - a innymi elementami ankiety</h5>
    <?php break;
    }
    ?>
     <a class="button btn btn-unique" href="main.php?mode=deanreport6">Powrót</a>
    
    <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
        <th class="th-sm">Numer pytania</th><th class="th-sm">Treść pytania i odpowiedź</th><th class="th-sm">Korelacja</th><!--<th class="th-sm">Korelacja negatywna</th>--><th class="th-sm">STAT <i class="fas fa-calculator"></i><BR/><span style="color:red; font-size:0.7em;">P-value dla niektórych wartości może wskazywać 0, w rzeczywistości jest to wartość niezerowa, jednak b. niewielka</span></th></tr>
       </thead>
       <tbody></tbody> <?php
        foreach($result_matrix as $result){
            $row=explode(";;;",$result);
            
            //P VALUE:
                $ka=$ile_wynikow_query;
                $en=mysqli_fetch_array(mysqli_query($kon,"SELECT `id`,`typ`,`n` FROM `metryki` WHERE `pytanie`='$row[0]'"));
                switch($en[1]) {
                    case "radio":
                        $N=$en[2];
                        break;
                    case "checkbox":
                        $class="visibility:hidden !important;";
                        break;
                }
                
        

                
                $val=str_replace(";","",$row[3]);
                $corelation=floatval($val);
                $sprzyjajace=round(($corelation/100)*$ka,0);
                //A=sigma od k=1 do wartości sprzyjających z n do k a więc:
                $number=$sprzyjajace;
                $B=0;
                do {
                    
                     $numbarray[]=$number;
                 // $A[]=pow($N,$number);
                  $A=newton($ka,$number);
                   $number=$number+1;
                   $B=bcadd($A,$B);
                 
                }
                while($number<$ka+1);
                $silniatest=silnia(283);
                $newtontest=newton(283,231);
             //$result_tab=print_r($numbarray);
               // echo $sprzyjajace;
                $P_VALUE=bcdiv($B,bcpow($N,$ka),15);
              //chi kwadrat
                $liczebnosc=round($ka*$corelation/100,0);
                $liczebnosc_i1=$ka-$liczebnosc;
                //obliczam liczebność dla badanej wartości z tabeli TMP_NEGATIVE:
                    $inne_wart_badana=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `TMP_NEGATIVE` WHERE `$row[0]`LIKE '%$row[2]%'"));
                    $inne_wszystkie=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `TMP_NEGATIVE` WHERE 1"));
                    $inne_inne=$inne_wszystkie-$inne_wart_badana;
                    $sum_wart_badana=$liczebnosc+$inne_wart_badana;
                    $liczebnosc_teoret=round($ka*$sum_wart_badana/($inne_wszystkie+$ka),2);
                    //if($liczebnosc_teoret=0) $liczebnosc_teoret=
                    $liczebnosc_teoret_inne_war_badana=round($inne_wszystkie*$sum_wart_badana/($inne_wszystkie+$ka),0);
                    $liczebnosc_teoret_inne_w1=round($ka*($ka-$liczebnosc+$inne_inne)/($inne_wszystkie+$ka),0);
                    $liczebnosc_teoret_inne_w2=round($inne_wszystkie*($ka-$liczebnosc+$inne_inne)/($inne_wszystkie+$ka),0);
                 //Mam liczebności:
    // |                        |WARTOŚĆ BADANA                 | INNE                       | SUMA                |
    // _____________________________________________________________________________________________________________
    // | WARTOŚĆ KORELOWANA     | $liczebnosc                   | $ka-$liczebnosc            | $ka                 |
    // _____________________________________________________________________________________________________________
    // | WARTOŚĆ NIESKORELOWANA | $inne_wart_badana             | $inne_inne                 | $inne_wszystkie     |
    // _____________________________________________ _______________________________________________________________
    // | SUMA                   | $liczebnosc+$inne_wart_badana | $ka-$liczebnosc+$inne_inne | $ka+$inne_wszystkie |
    // 
                      //Mam liczebności teoretyczne:
    // |                        |WARTOŚĆ BADANA                       | INNE                       | SUMA            |
    // _______________________________________________________________________________________________________________
    // | WARTOŚĆ KORELOWANA     | $liczebnosc_teoret                  | $liczebnosc_teoret_inne_w1 | $ka             |
    // _______________________________________________________________________________________________________________
    // | WARTOŚĆ NIESKORELOWANA | $liczebnosc_teoret_inne_wart_badana | $liczebnosc_teoret_inne_w2 | $inne_wszystkie |
    // _____________________________________________ _________________________________________________________________

                    $chikwadrat1=pow($liczebnosc-$liczebnosc_teoret,2)/$liczebnosc_teoret;
                    if($liczebnosc_teoret_inne_w1!=0 && $liczebnosc_teoret_inne_w2!=0 && $liczebnosc_teoret_inne_war_badana!=0){
                    $chikwadrat2=pow($ka-$liczebnosc-$liczebnosc_teoret_inne_w1,2)/$liczebnosc_teoret_inne_w1;
                    
                    $chikwadrat3=pow($inne_wart_badana-$liczebnosc_teoret_inne_war_badana,2)/$liczebnosc_teoret_inne_war_badana;
                    $chikwadrat4=pow($inne_inne-$liczebnosc_teoret_inne_w2,2)/$liczebnosc_teoret_inne_w2;
                    $chikwadrat=$chikwadrat1+$chikwadrat2+$chikwadrat3+$chikwadrat4;
                    }
                    else $chikwadrat=0;
                    //wyznaczam ilość stopni swobody - ilość kolumn to ilość wariantów odpowiedzi. 
                    //
                    //Ilość wierszy - zliczenie wierszy w widoku TMP 
                    $stopnie_swobody=($N-1); //kolumny to ilość wariantów ,wiersze są 2, więc ilość stopni swobody to ilość wariantów -1
                    $chicrit5=chiKwadratCrit($stopnie_swobody,0.05);
                    $chicrit1=chiKwadratCrit($stopnie_swobody,0.01);
                    if ($chikwadrat>$chicrit5) $alfa5chik="<i class=\"fas fa-check\" style=\"color:green\"></i> wynik istotny statystycznie na podst. chi-kwadrat dla &alpha;=0,05";
                        else $alfa5chik="<i class=\"fas fa-times\" style=\"color:red\"></i> wynik nieistotny statystycznie na podst. chi-kwadrat dla &alpha;=0,05";
                        if ($chikwadrat>$chicrit1) $alfa1chik="<i class=\"fas fa-check\" style=\"color:green\"></i> wynik istotny statystycznie na podst. chi-kwadrat dla &alpha;=0,01";
                        else $alfa1chik="<i class=\"fas fa-times\" style=\"color:red\"></i> wynik nieistotny statystycznie na podst. chi-kwadrat dla &alpha;=0,01";
                if($P_VALUE<0.05) $alfa5="<i class=\"fas fa-check\" style=\"color:green\"></i> wynik istotny statystycznie dla &alpha;=0,05";
                    else $alfa5="<i class=\"fas fa-times\" style=\"color:red\"></i> wynik nieistotny statystycznie dla &alpha;=0,05";
                    if($P_VALUE<0.01) $alfa1="<i class=\"fas fa-check\" style=\"color:green\"></i> wynik istotny statystycznie dla &alpha;=0,01";
                    else $alfa1="<i class=\"fas fa-times\" style=\"color:red\"></i> wynik nieistotny statystycznie dla &alpha;=0,01";
                $pmian=((1-$corelation/100)*$ka);
                         echo "<tr><td>$row[0]</td><td>$row[1]<br/><strong><em>$row[2]</em></strong></td>"
                                 . "<td>$row[3]</td><!--<td>$row[4]</td>--><td>"
                                 . "<div style=\"$class\"><em>k</em>=$ka, <em>n</em>=$N<br>stopni swobody: $stopnie_swobody X<sup>2</sup>crit.=$chicrit5 - $chicrit1<br/>"
                                 . "</div><em>X<span style=\"vertical-align:super;\">2</span></em>=".round($chikwadrat,4)."<hr/>$alfa5chik<br/>$alfa1chik</td></tr>";   
                unset($A);
                unset($B);
                unset($number);
                unset($numbarray);
        }
?>
    </tbody></table>
       </div>
              

         
     </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div>
        
   


 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');
      foreach ($scripts as $script){
     echo $script;
 }?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
$(function () {
// popovers Initialization
$('[data-toggle="popover"]').popover();
});
  </script>
  
  
 
</body>

</html>

