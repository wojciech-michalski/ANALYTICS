<?php
require_once('views/head.php');
require_once('config/config.php');
require('konekt_MySQL.php');
$data=date('Y-m-d');
foreach(array_keys($_POST) as $klucz){
    $dane[$klucz]=mysqli_escape_string($kon,$_POST[$klucz]);
}
//print_r($dane);
$qstart="INSERT INTO `$dane[ankieta]` (`data`,";
unset ($dane['ankieta']);
foreach (array_keys($dane) as $kolumna){
    //echo strpos($kolumna,"-");
    if(strpos($kolumna,"-")>0) {
       // echo "checkbox ! ";
        $kolarray=explode("-",$kolumna);
        $koltrue=$kolarray[0];
        $searchstring="$koltrue-";
        $n=0;
        do {
            $warianty[]=$dane["$searchstring$n"];
            //unset($dane["$searchstring$n"]);
            $n++;
        }
        while($n<25);
        $dane[$koltrue]=implode(";|;",$warianty);
        unset($warianty);
      //  echo "$dane[$koltrue]";
      //  echo "$koltrue - $dane[$koltrue]";
    }
   // else
    //echo "$kolumna - $dane[$kolumna]<br/>";
    //odfiltr
}
foreach(array_keys($dane) as $kolumna){
      if(strpos($kolumna,"-")>0) {
          unset($dane[$kolumna]);
      }
    if(strpos($dane[$kolumna],";|;;|;")>0) {
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
          $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
        $dane[$kolumna]=str_replace(";|;;|;",";|;",$dane[$kolumna]);
    }
}
$querystring_=implode("`,`",array_keys($dane));
//echo $querystring_;
$querystring_1="`$querystring_`) VALUES (";
//echo "$qstart $querystring_1";
$values="'$data','".implode("','",$dane)."')";
$query="$qstart $querystring_1$values";
//echo $query;
if(mysqli_query($kon,$query)){
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
       <strong>Dziękujemy za wypełnienie ankiety !</strong> Twoje informacje pomogą nam poprawić jakość kształcenia !
  <a href="http://wseiz.pl"><button type="button" class="close" aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button></a>
</div>
<?php }
else {echo "Something went horribly wrong !";}
