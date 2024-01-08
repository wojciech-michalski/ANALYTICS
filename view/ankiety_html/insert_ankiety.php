<?php
require_once('views/head.php');
require_once('config/config.php');
require('konekt_MySQL.php');
//print_r($_POST);
foreach (array_keys($_POST) as $klucz) {

			
			$dane["$klucz"]=mysqli_real_escape_string($kon,$_POST["$klucz"]);		
		}
                $data=date("Y-m-d H:m:s");
  echo "<!--";
  print_r($dane);  
 
$forma_zajec="$dane[forma1];;$dane[forma2];;$dane[forma3];;$dane[forma4];;$dane[forma5]";
switch ($_POST['ankieta']) {
    case "ocena_pracy_nauczyciela":
        $insert="INSERT INTO `$dane[ankieta]` (`nieobecnosci`,`id_prowadzacy`,`PYT_1`,`PYT_2`,`PYT_3`,`PYT_4`,`PYT_5`,`PYT_6`,`PYT_7`,`PYT_8`,`PYT_9`,`PYT_10`,`PYT_11`,`PYT_12`,`PYT_13`,`PYT_14`,`PYT_15`,`PYT_16`,`data`,`forma_zajec`)"
        . "VALUES ('$dane[nieobecnosci]','$dane[id_zajec]','$dane[PYT_1]','$dane[PYT_2]','$dane[PYT_3]','$dane[PYT_4]','$dane[PYT_5]','$dane[PYT_6]','$dane[PYT_7]','$dane[PYT_8]','$dane[PYT_9]','$dane[PYT_10]','$dane[PYT_11]','$dane[PYT_12]','$dane[PYT_13]','$dane[PYT_14]','$dane[PYT_15]','$dane[PYT_16]','$data','$forma_zajec')";
        break;
    case "ocena_nakladu_pracy_studenta":
      $insert="INSERT INTO `$dane[ankieta]` (`data`,`id_prowadzacy`,`PYT_1`,`PYT_2`,`PYT_3`,`PYT_4`,`PYT_5`,`PYT_6`,`PYT_7`,`PYT_8`,`PYT_9`,`PYT_10`,`PYT_11`)"
        . "VALUES ('$data','$dane[id_zajec]','$dane[PYT_1]','$dane[PYT_2]','$dane[PYT_3]','$dane[PYT_4]','$dane[PYT_5]','$dane[PYT_6]','$dane[PYT_7]','$dane[PYT_8]','$dane[PYT_9]','$dane[PYT_10]','$dane[PYT_11]')";  
        break;
    case "ocena_praktyk_zawodowych":
        $insert="INSERT INTO `$dane[ankieta]` (`data`,`id_prowadzacy`,`PYT_1`,`PYT_2`,`PYT_3`,`PYT_4`,`PYT_5`,`PYT_6`,`PYT_7`,`PYT_8`,`PYT_9`,`PYT_10`,`PYT_11`,`PYT_12`,`PYT_13`,`PYT_14`,`PYT_15`)"
        . "VALUES ('$data','$dane[id_zajec]','$dane[PYT_1]','$dane[PYT_2]','$dane[PYT_3]','$dane[PYT_4]','$dane[PYT_5]','$dane[PYT_6]','$dane[PYT_7]','$dane[PYT_8]','$dane[PYT_9]','$dane[PYT_10]','$dane[PYT_11]','$dane[PYT_12]','$dane[PYT_13]','$dane[PYT_14]','$dane[PYT_15]')";  
        break;
    case "ocena_administracji2";
        $PYT_30="$dane[PYT_30a];;$dane[PYT_30b];;$dane[PYT_30c];;$dane[PYT_30d]";
        $insert="INSERT INTO `$dane[ankieta]` (`data`,`id_prowadzacy`,`PYT_1`,`PYT_2`,`PYT_3`,`PYT_4`,`PYT_5`,`PYT_6`,`PYT_7`,`PYT_8`,`PYT_9`,`PYT_10`,`PYT_11`,`PYT_12`,`PYT_13`,`PYT_14`,`PYT_15`,`PYT_16`,`PYT_17`,`PYT_18`,`PYT_19`,`PYT_20`,`PYT_21`,`PYT_22`,`PYT_23`,`PYT_24`,`PYT_25`,`PYT_26`,`PYT_27`,`PYT_28`,`PYT_29`,`PYT_30`,`PYT_31`)"
        . "VALUES ('$data','$dane[kierunek_studiow]','$dane[PYT_1]','$dane[PYT_2]','$dane[PYT_3]','$dane[PYT_4]','$dane[PYT_5]','$dane[PYT_6]','$dane[PYT_7]','$dane[PYT_8]','$dane[PYT_9]','$dane[PYT_10]','$dane[PYT_11]','$dane[PYT_12]','$dane[PYT_13]','$dane[PYT_14]','$dane[PYT_15]','$dane[PYT_16]','$dane[PYT_17]','$dane[PYT_18]','$dane[PYT_19]','$dane[PYT_20]','$dane[PYT_21]','$dane[PYT_22]','$dane[PYT_23]','$dane[PYT_24]','$dane[PYT_25]','$dane[PYT_26]','$dane[PYT_27]','$dane[PYT_28]','$dane[PYT_29]','$PYT_30','$dane[PYT_31]')";  
        break;
    case "covid-19-2021":
        $PYT_3=implode(";;",$_POST[PYT_3]);
        echo "$_POST[PYT_1]<br/>$_POST[PYT_2]>br/>$PYT_3";
         $insert="INSERT INTO `$dane[ankieta]` (`data`,`PYT_1`,`PYT_2`,`PYT_3`) VALUES ('$data','$_POST[PYT_1]','$_POST[PYT_2]','$PYT_3')";
         break;
}


//echo $insert;
 echo "-->";
 //echo $insert;
if (mysqli_query($kon,$insert)) {
    ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?php switch ($_POST['lang']) {
        default:
            ?>
    <strong>Dziękujemy za wypełnienie ankiety !</strong> Twoje informacje pomogą nam poprawić jakość kształcenia !
  <a href="http://wseiz.pl"><button type="button" class="close" aria-label="Close">
          <?php break;
          case "en":
              ?>
          <strong>THANK YOU FOR FILLING OUT THE FORM !</strong>
  <a href="http://wseiz.pl"><button type="button" class="close" aria-label="Close">
          <?php 
          break;
    }
    ?>
    <span aria-hidden="true">&times;</span>
      </button></a>
</div>
<?php
}
else echo "Something went horribly wrong :-(";
?>