<div class="jumbotron jumbotron-fluid">
  <div class="container">
      <form method="post" action="insert_ankiety.php" >
      <h4 class="display-5">WYŻSZA SZKOŁA EKOLOGII I ZARZĄDZANIA W WARSZAWIE</h4>
<p>STUDENCKA ANKIETA OCENY PRAKTYK ZAWODOWYCH</p>
    <?php 
    echo "<p><strong>PRZEDMIOT:</strong> $naglowek[przedmiot]<span style=\"margin-left:20px;\"><strong>KIERUNEK:</strong> $naglowek[kierunek]</span></p>"; 
    echo "<p><strong>FORMA STUDIÓW:</strong> $forma <span style=\"margin-left:20px;\"></p>"; 
    ?>
  
<input type="hidden" name="id_zajec" value="<?php echo $id_prowadzacy;?>">
<input type="hidden" name="ankieta" value="<?php echo $ankieta;?>">
  </div>
</div>
<div class="container">
    <p>DROGA STUDENTKO! DROGI STUDENCIE!</p>
    <p>   Ankieta dotyczy oceny praktyk realizowanych przez studentów Wyższej Szkoły Ekologii i Zarządzania w Warszawie.</p>
    <p>Uprzejmie prosimy o wypełnienie ankiety i udzielenie odpowiedzi, oceniając w skali od 1 do 5, gdzie 1 oznacza ocenę bardzo słabą, a 5 – bardzo dobrą.</p>
<p>Wyniki ankiety nie wpływają na zaliczenie praktyk zawodowych.</p><hr/>

<?php
        $ile_pytan=mysqli_num_rows($pytania);
        
        $k=0;
        do {
            $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<p><strong>$nrpytania. $pytanie[tresc] </strong></p>";
            
            if ($nn==2){
                ?> <div class="form-check form-check-inline" style="margin-bottom:20px;">
  <input type="radio" name="<?php echo $pytanie['pytanie'];?>" class="form-check-input" id="materialInline<?php echo "$k$n-T";?>" value="TAK" required>
  <label class="form-check-label" for="materialInline<?php echo "$k$n-T";?>">TAK</label>
</div> 
    <div class="form-check form-check-inline" style="margin-bottom:20px;">
  <input type="radio" name="<?php echo $pytanie['pytanie'];?>" class="form-check-input" id="materialInline<?php echo "$k$n-N";?>" value="NIE">
  <label class="form-check-label" for="materialInline<?php echo "$k$n-N";?>">NIE</label>
</div><hr/>
 <?php    
            }
            else {
                ?>
 
 
 <?php 
     $q=1;
     do {
     echo "<div class=\"form-check form-check-inline\">
  <input type=\"radio\" class=\"form-check-input\" id=\"materialInline$k$q\" value=\"$q\" name=\"$pytanie[pytanie]\" required>
  <label class=\"form-check-label\" for=\"materialInline$k$q\">$q</label>
</div>";
     $q=$q+1;
  
              }
               while($q<6);
                echo "<hr/>";
            
               
            
        }
         $k=$k+1;
        }
while ($k<$ile_pytan);
?>

<!--Textarea with icon prefix-->

<button type="submit" class="btn btn-light">Wyślij ankietę</button></form>
</div>
