
    
<div class="jumbotron jumbotron-fluid">
  <div class="container">
      <form method="post" action="insert_ankiety.php" >
      <h4 class="display-5">WYŻSZA SZKOŁA EKOLOGII I ZARZĄDZANIA W WARSZAWIE</h4>
<p>ANKIETA DLA OSÓB REZYGNUJĄCYCH ZE STUDIÓW</p>
<p>Ponieważ dziś rozstajecie się z Wyższą Szkołą Ekologii i Zarządzania w Warszawie, zwracamy się z prośbą o udzielenie odpowiedzi na podane poniżej pytania, które pomogą nam poprawić jakość kształcenia obecnych i przyszłych studentów naszej Uczelni.</p>
<input type="hidden" name="id_zajec" value="<?php echo $id_prowadzacy;?>">
<input type="hidden" name="ankieta" value="<?php echo $ankieta;?>">
<!-- Material inline 1 -->
  </div>
</div>
<div class="container">
    
<?php
        $ile_pytan=mysqli_num_rows($pytania);
        
        $k=0;
       
            $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            
            
            if ($nn==2){
                ?> <div class="form-check form-check-inline" style="margin-bottom:20px;">
  <input type="radio" name="<?php echo $pytanie[pytanie];?>" class="form-check-input" id="materialInline<?php echo "$k$n-T";?>" value="TAK" required>
  <label class="form-check-label" for="materialInline<?php echo "$k$n-T";?>">TAK</label>
</div> 
    <div class="form-check form-check-inline" style="margin-bottom:20px;">
  <input type="radio" name="<?php echo $pytanie[pytanie];?>" class="form-check-input" id="materialInline<?php echo "$k$n-N";?>" value="NIE">
  <label class="form-check-label" for="materialInline<?php echo "$k$n-N";?>">NIE</label>
</div><hr/>
 <?php    
            }
            else {
                ?>
 <!-- <div class="d-flex justify-content-center my-4">
  <div class="range-field w-75">
    <input id="slider<?php echo "$k$n";?>" class="border-0" type="range" min="1" max="5" name="<?php echo $pytanie[pytanie];?>"/>
  </div>
  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan" id="valueSpan<?php echo "$k$n";?>"></span>
</div>  -->
 
 <?php 
     $q=1;
     echo "<p><strong>$nrpytania. $pytanie[tresc] </strong></p>";
     echo "<div class=\"form-check\">
  <input type=\"radio\" class=\"form-check-input\" id=\"materialInlinePYT_1a\" value=\"TAK\" name=\"PYT_1\" required>
  <label class=\"form-check-label\" for=\"materialInlinePYT_1a\">TAK</label>
</div>";
    
     echo "<div class=\"form-check\">
  <input type=\"radio\" class=\"form-check-input\" id=\"materialInlinePYT_1b\" value=\"NIE\" name=\"PYT_1\" required>
  <label class=\"form-check-label\" for=\"materialInlinePYT_1b\">NIE</label>
</div>";
  
      echo "<div class=\"form-check\">
  <input type=\"radio\" class=\"form-check-input\" id=\"materialInlinePYT_1c\" value=\"przyjąłem 1 dawkę\" name=\"PYT_1\" required>
  <label class=\"form-check-label\" for=\"materialInlinePYT_1c\">Przyjąłem tylko pierwszą dawkę szczepionki dwudawkowej i nie zamierzam przyjąć kolejnych</label>
</div>";
              
                echo "<hr/>";
      $pytanie=mysqli_fetch_array($pytania);  
       echo "<p><strong>2. $pytanie[tresc] </strong></p>";
      echo "<div class=\"form-check\">
  <input type=\"radio\" class=\"form-check-input\" id=\"materialInlinePYT_2a\" value=\"TAK\" name=\"PYT_2\" required>
  <label class=\"form-check-label\" for=\"materialInlinePYT_2a\">TAK</label>
</div>";
    
     echo "<div class=\"form-check\">
  <input type=\"radio\" class=\"form-check-input\" id=\"materialInlinePYT_2b\" value=\"NIE\" name=\"PYT_2\" required>
  <label class=\"form-check-label\" for=\"materialInlinePYT_2b\">NIE</label>
</div>";
  
      echo "<div class=\"form-check\">
  <input type=\"radio\" class=\"form-check-input\" id=\"materialInlinePYT_2c\" value=\"przyjąłem 1 dawkę\" name=\"PYT_2\" required>
  <label class=\"form-check-label\" for=\"materialInlinePYT_2c\">Nie wiem</label>
</div>";
            
     echo "<hr/>";
      $pytanie=mysqli_fetch_array($pytania);  
       echo "<p><strong>3. $pytanie[tresc] </strong></p>";
   echo "<div class=\"form-check\">
    <input type=\"checkbox\" class=\"form-check-input\" id=\"materialUncheckedPYT_3a\" name=\"PYT_3[]\" value=\"Twoje przekonania na temat realnego poziomu zagrożenia zachorowaniem na Covid-19\">
    <label class=\"form-check-label\" for=\"materialUncheckedPYT_3a\">Twoje przekonania na temat realnego poziomu zagrożenia zachorowaniem na Covid-19</label>
</div>";
    
      echo "<div class=\"form-check\">
    <input type=\"checkbox\" class=\"form-check-input\" id=\"materialUncheckedPYT_3b\" name=\"PYT_3[]\" value=\"Twoje przekonania na temat skuteczności szczepionek przeciw Sars-CoV-2\">
    <label class=\"form-check-label\" for=\"materialUncheckedPYT_3b\">Twoje przekonania na temat skuteczności szczepionek przeciw Sars-CoV-2</label>
</div>";
  
       echo "<div class=\"form-check\">
    <input type=\"checkbox\" class=\"form-check-input\" id=\"materialUncheckedPYT_3c\" name=\"PYT_3[]\" value=\"Twoje przekonania na temat bezpieczeństwa szczepionek przeciw Sars-CoV-2\">
    <label class=\"form-check-label\" for=\"materialUncheckedPYT_3c\">Twoje przekonania na temat bezpieczeństwa szczepionek przeciw Sars-CoV-2</label>
</div>";        
      echo "<div class=\"form-check\">
    <input type=\"checkbox\" class=\"form-check-input\" id=\"materialUncheckedPYT_3d\" name=\"PYT_3[]\" value=\"Twoje poczucie odpowiedzialności za innych i za ogólną sytuację społeczną\">
    <label class=\"form-check-label\" for=\"materialUncheckedPYT_3d\">Twoje poczucie odpowiedzialności za innych i za ogólną sytuację społeczną</label>
</div>";      
 echo "<div class=\"form-check\">
    <input type=\"checkbox\" class=\"form-check-input\" id=\"materialUncheckedPYT_3e\" name=\"PYT_3[]\" value=\"Presja ze strony Twojego bezpośredniego otoczenia i obawa o jego reakcje\">
    <label class=\"form-check-label\" for=\"materialUncheckedPYT_3e\">Presja ze strony Twojego bezpośredniego otoczenia i obawa o jego reakcje</label>
</div>";   
  echo "<div class=\"form-check\">
    <input type=\"checkbox\" class=\"form-check-input\" id=\"materialUncheckedPYT_3f\" name=\"PYT_3[]\" value=\"Spodziewane konsekwencje w traktowaniu osób zaszczepionych i niezaszczepionych\">
    <label class=\"form-check-label\" for=\"materialUncheckedPYT_3f\">Spodziewane konsekwencje w traktowaniu osób zaszczepionych i niezaszczepionych</label>
</div>"; 
    echo "<div class=\"form-check\">
    <input type=\"checkbox\" class=\"form-check-input\" id=\"materialUncheckedPYT_3g\" name=\"PYT_3[]\" value=\"Łatwość dostępu do szczepionki\">
    <label class=\"form-check-label\" for=\"materialUncheckedPYT_3g\">Łatwość dostępu do szczepionki</label>
</div>";
     echo "<div class=\"form-check\">
    <input type=\"checkbox\" class=\"form-check-input\" id=\"materialUncheckedPYT_3h\" name=\"PYT_3[]\" value=\"Inne\">
    <label class=\"form-check-label\" for=\"materialUncheckedPYT_3h\">Inne</label>
</div>";
        }
         
?>

<!--Textarea with icon prefix-->

<button type="submit" class="btn btn-light">Wyślij ankietę</button></form>
</div>
