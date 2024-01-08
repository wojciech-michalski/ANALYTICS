<?php
require('../config/config.php');
require('../controller/session_controller.php');
include('../controller/konekt_MySQL.php');
include('view/header_intro.php');
 include('view/topnav.php');
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
            <span>KREATOR ANKIET</span>
          </h4>
                  </div>
      </div>
              <div class="row wow fadeIn">
        <!--Grid column-->
        <div class="col-md-12 mb-4">
          <!--Card-->
         
     <div class="card">
         
        <div class="card-header text-center">
           </div>
          
<div class="card-body">
<?php
$tablename= strtolower(str_replace(" ","_",$_POST['nazwa_ankiety']));
//echo $tablename;
?>
 <ul class="list-group">


  
<?php
foreach(array_keys($_POST) as $element) {
    if($element=="nazwa_ankiety" || $element=="wstep") {
        //nothing to do
    } else {
    //echo "$element - $_POST[$element]<br/>";
    if( strpos($element,"+")===0) {
      //  echo "<br/>$_POST[$element]<br/>";
      $klucz=str_replace("+","",$element);
        $pytania[$klucz][0]=$_POST[$element];
        $pola_tabel[]=$_POST[$element];
    }
else   //echo "$klucz - $element<br/>";
   $pytania[$klucz][]=$_POST[$element];
}

}
//tworzę tabelę
$createquerystart="CREATE TABLE $tablename ("
        . "id int(255),"
        . "data varchar(32) )";

if(mysqli_query($kon,$createquerystart)) {
echo "<li class=\"list-group-item\">Utworzono tabelę $tablename <i class=\"far fa-check-circle green-text\" style=\"margin-left:25%;\"></i></li>"; }
    else {echo "<li class=\"list-group-item\">Nie udało się utworzyć tabeli $tablename "
            . "<i class=\"far fa-dizzy red-text\" style=\"margin-left:25%;\"></i></li>"; 
    die();
    }
if (mysqli_query($kon,"ALTER TABLE `$tablename` "
        . "CHANGE `id` `id` INT(255) NULL DEFAULT NULL AUTO_INCREMENT, add PRIMARY KEY (`id`);")){
echo "<li class=\"list-group-item\">Skonfigurowano tabelę $tablename <i class=\"far fa-check-circle green-text\" style=\"margin-left:25%;\"></i></li>"; }
    else {echo "<li class=\"list-group-item\">Nie udało się skonfigurować tabeli $tablename <i class=\"far fa-dizzy red-text\" style=\"margin-left:25%;\"></i></li>"; 
    die();
    }

    
foreach(array_keys($pola_tabel) as $pole) {
    $nrpytania=$pole+1;
    $poletabeli="`PYT_$nrpytania`";
    $q="ALTER TABLE `$tablename` ADD $poletabeli VARCHAR(1024) CHARACTER SET utf8 COLLATE utf8_bin NULL ;";
    //echo "$q <br/>";
    if(mysqli_query($kon,$q)){
        echo "<li class=\"list-group-item\">Tworzę pole $pole w tabeli $tablename <i class=\"far fa-check-circle green-text\" style=\"margin-left:25%;\"></i></li>"; }
    else {echo "<li class=\"list-group-item\">Nie udało się pola w tabeli $tablename <i class=\"far fa-dizzy red-text\" style=\"margin-left:25%;\"></i></li>"; 
    die();
    }
    
    //tworzę metryki
    $q2="INSERT INTO `metryki` (`ankieta`,`pytanie`,`tresc`,`tresc_en`,`typ`,`n`,`nazwa`,`wstep`) VALUES (
        '$tablename','PYT_$nrpytania','$pola_tabel[$pole]','','',0,'$_POST[nazwa_ankiety]','$_POST[wstep]')";
   // echo "$q2 <br/>";
    if (mysqli_query($kon,$q2)){
        echo "<li class=\"list-group-item\">Utworzono metryki dla pytania PYT_$nrpytania i tabeli $tablename <i class=\"far fa-check-circle green-text\" style=\"margin-left:25%;\"></i></li>"; }
    else {echo "<li class=\"list-group-item\">Nie udało się utworzyć metryk <i class=\"far fa-dizzy red-text\" style=\"margin-left:25%;\"></i></li>"; 
    die();
    }
    
    
}
    mysqli_query($kon,"ALTER TABLE `$tablename` ADD `id_prowadzacy` int(16) NULL");

 //mam stworzoną tabelę ankiety, mam stworzone metryki
 //Teraz czas na zupdate-owanie metryk, tak aby stworzyć html-a

foreach(array_keys($pytania) as $nazwa_pytania){
    $typ=$pytania[$nazwa_pytania][1];
    $n=count($pytania[$nazwa_pytania])-2;
    //$pytname=$pytania[$nazwa_pytania];
    switch($typ){
        case "text":
            $html="<div class=\"md-form form-sm\">
  <input type=\"text\" id=\"$nazwa_pytania\" class=\"form-control form-control-sm\" name=\"$nazwa_pytania\">
  <label for=\"$nazwa_pytania\">".$pytania[$nazwa_pytania][0]."</label>
</div>";
            break;
        case "textarea":
            $html="<div class=\"md-form\">
  <textarea id=\"$nazwa_pytania\" name=\"$nazwa_pytania\" class=\"md-textarea form-control\" rows=\"3\"></textarea>
  <label for=\"$nazwa_pytania\">".$pytania[$nazwa_pytania][0]."</label>
</div>";
            break;
        case "radio":
            $k=0;
            do{
                
            $htmls[]="<div class=\"form-check\">
  <input type=\"radio\" class=\"form-check-input\" id=\"$nazwa_pytania-$k\" name=\"$nazwa_pytania\""
                    . " value=\"".$pytania[$nazwa_pytania][2+$k]."\">
  <label class=\"form-check-label\" for=\"$nazwa_pytania-$k\">".$pytania[$nazwa_pytania][2+$k]."</label>
</div>";
            $k++;
            }
            while($k<$n);
            $html=implode("",$htmls);
            unset($htmls);
            break;
        case "select":
            $k=0;
            $selectstart="<div class=\"md-form\"><select class=\"mdb-select\" id=\"$nazwa_pytania\" name=\"$nazwa_pytania\" ><option></option> ";
            do {
                $options[]="<option>".$pytania[$nazwa_pytania][2+$k]."</option>";
                $k++;
            }
            while($k<$n);
            $html=$selectstart.implode("",$options)."</select>"
                    . "<label for=\"$nazwa_pytania\">".$pytania[$nazwa_pytania][0]."</label></div>";
            unset($options);
            break;
        case "checkbox":
            $k=0;
            do{
                
            $htmls[]="<div class=\"form-check\">
  <input type=\"checkbox\" class=\"form-check-input\" id=\"$nazwa_pytania-$k\" name=\"$nazwa_pytania-$k\" "
                    . "value=\"".$pytania[$nazwa_pytania][2+$k]."\">
  <label class=\"form-check-label\" for=\"$nazwa_pytania-$k\">".$pytania[$nazwa_pytania][2+$k]."</label>
</div>";
            $k++;
            }
            while($k<$n);
            $html=implode("",$htmls);
            unset($htmls);
            break;
    }
   if (mysqli_query($kon,"UPDATE `metryki` SET `n`=$n,`typ`='$typ',`html`='$html' WHERE `pytanie`='$nazwa_pytania' AND `ankieta`='$tablename'")){
       echo "<li class=\"list-group-item\">Dodano widoki html do pytania $nazwa_pytania <i class=\"far fa-check-circle green-text\" style=\"margin-left:25%;\"></i></li>"; }
    else {echo "<li class=\"list-group-item\">Nie udało się utworzyć widoku HTML <i class=\"far fa-dizzy red-text\" style=\"margin-left:25%;\"></i></li>"; 
    die();
    
   }
}
$link="$surveyurl/?ankieta=sql&ank=$tablename";

?>
      <li class="list-group-item">Ankieta <?php echo $_POST['nazwa_ankiety'];?> gotowa
          Możesz ją wyświetlić pod linkiem:<em> <?php echo "$surveyurl/?ankieta=sql&ank=$tablename";?></em></li></ul>
            </div>
       </div>
              

         
     </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        
        
   
       </div>

    <?php
 include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');
     ?>