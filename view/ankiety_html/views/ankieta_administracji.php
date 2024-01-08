<div class="jumbotron jumbotron-fluid">
  <div class="container">
      <form method="post" action="insert_ankiety.php" >
      <h4 class="display-5"><!--WYŻSZA SZKOŁA EKOLOGII I ZARZĄDZANIA W WARSZAWIE--></h4>
<p>ANKIETA STUDENCKIEJ OCENY
ADMINISTRACJI ORAZ ORGANIZACJI PROCESU I ZAPLECZA DYDAKTYCZNEGO
WYŻSZEJ SZKOŁY EKOLOGII I ZARZĄDZANIA W WARSZAWIE</p>
<?php// echo "SELECT * FROM `prowadzacy` WHERE `id`='$id_prowadzacy'";?>
    <?php echo "<strong>KIERUNEK:</strong> $naglowek[kierunek]<span style=\"margin-left:20px;\"><strong>ROK AKADEMICKI:</strong> $naglowek[rok_akademicki] </span></p>"; 
    
    ?>
<!-- Material inline 1 -->

<input type="hidden" name="kierunek_studiow" value="<?php echo $naglowek['id'];?>">
<input type="hidden" name="ankieta" value="<?php echo $ankieta;?>">

  </div>
</div>
<div class="container">
    <h4>1. Oceń jakość obsługi w Dziekanacie <!--WSEiZ-->, przypisując poszczególnym elementom oceny w skali 1-5 (gdzie 1 to ocena niedostateczna, a 5 – bardzo dobra):</h4>

<?php
        $ile_pytan=mysqli_num_rows($pytania);
        
        $k=0;
        do {
            $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<p><strong>$pytanie[tresc] </strong></p>";
            
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
 <!-- <div class="d-flex justify-content-center my-4">
  <div class="range-field w-75">
    <input id="slider<?php echo "$k$n";?>" class="border-0" type="range" min="1" max="5" name="<?php echo $pytanie['pytanie'];?>"/>
  </div>
  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan" id="valueSpan<?php echo "$k$n";?>"></span>
</div>  -->
 
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
while ($k<6);
?>

<?php
       
        do {
      $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<h4>2. $pytanie[tresc] </h4>";
            
            if ($nn==2){
                ?> <div class="form-check form-check-inline" style="margin-bottom:20px;">
  <input type="radio" onclick="pokaz_wu" name="<?php echo $pytanie['pytanie'];?>" class="form-check-input" id="materialInline<?php echo "$k$n-T";?>" value="TAK" >
  <label onclick="pokaz_wu()" class="form-check-label" for="materialInline<?php echo "$k$n-T";?>">TAK</label>
</div> 
    <div class="form-check form-check-inline" style="margin-bottom:20px;">
  <input type="radio" onclick="schowaj_wu()" name="<?php echo $pytanie['pytanie'];?>" class="form-check-input" id="materialInline<?php echo "$k$n-N";?>" value="NIE">
  <label onclick="schowaj_wu()" class="form-check-label" for="materialInline<?php echo "$k$n-N";?>">NIE</label>
</div><hr/>
 <?php    
            }
            else {
                ?>
 <!-- <div class="d-flex justify-content-center my-4">
  <div class="range-field w-75">
    <input id="slider<?php echo "$k$n";?>" class="border-0" type="range" min="1" max="5" name="<?php echo $pytanie['pytanie'];?>"/>
  </div>
  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan" id="valueSpan<?php echo "$k$n";?>"></span>
</div>  -->
 
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
while ($k<7);
?><div id="wu"><p>Jeśli tak, prosimy ocenić jego funkcjonowanie posługując się skalą od 1 do 5, 
        (gdzie 1 to ocena niedostateczna, a 5 – bardzo dobra):</p>
 <?php
       
        do {
      $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<p><strong>$pytanie[tresc]</strong></p>";
            
            if ($nn==2){
                ?> <div class="form-check form-check-inline" style="margin-bottom:20px;">
  <input type="radio" onclick="pokaz_wu" name="<?php echo $pytanie['pytanie'];?>" class="form-check-input" id="materialInline<?php echo "$k$n-T";?>" value="TAK" >
  <label onclick="pokaz_wu()" class="form-check-label" for="materialInline<?php echo "$k$n-T";?>">TAK</label>
</div> 
    <div class="form-check form-check-inline" style="margin-bottom:20px;">
  <input type="radio" onclick="schowaj_wu()" name="<?php echo $pytanie['pytanie'];?>" class="form-check-input" id="materialInline<?php echo "$k$n-N";?>" value="NIE">
  <label onclick="schowaj_wu()" class="form-check-label" for="materialInline<?php echo "$k$n-N";?>">NIE</label>
</div><hr/>
 <?php    
            }
            else {
                ?>
 <!-- <div class="d-flex justify-content-center my-4">
  <div class="range-field w-75">
    <input id="slider<?php echo "$k$n";?>" class="border-0" type="range" min="1" max="5" name="<?php echo $pytanie['pytanie'];?>"/>
  </div>
  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan" id="valueSpan<?php echo "$k$n";?>"></span>
</div>  -->
 
 <?php 
     $q=1;
     do {
     echo "<div class=\"form-check form-check-inline\">
  <input type=\"radio\" class=\"form-check-input\" id=\"materialInline$k$q\" value=\"$q\" name=\"$pytanie[pytanie]\" >
  <label class=\"form-check-label\" for=\"materialInline$k$q\">$q</label>
</div>";
     $q=$q+1;
  
              }
               while($q<6);
                echo "<hr/>";
            
               
            
        }
         $k=$k+1;
        }
while ($k<10);
?>
</div>
    <h4>3.  Posługując się skalą od 1 do 5, proszę ocenić (gdzie 1 to ocena niedostateczna, a 5 – bardzo dobra):</h4>

<?php
       
        do {
            $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<p><strong>$pytanie[tresc] </strong></p>";
            
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
 <!-- <div class="d-flex justify-content-center my-4">
  <div class="range-field w-75">
    <input id="slider<?php echo "$k$n";?>" class="border-0" type="range" min="1" max="5" name="<?php echo $pytanie['pytanie'];?>"/>
  </div>
  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan" id="valueSpan<?php echo "$k$n";?>"></span>
</div>  -->
 
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
while ($k<12);
?>

 <h4>4. Posługując się skalą od 1 do 5, proszę przypisać każdemu z elementów ocenę (gdzie 1 to ocena niedostateczna, a 5 – bardzo dobra):</h4>

<?php
       
        do {
            $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<p><strong>$pytanie[tresc] </strong></p>";
            
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
 <!-- <div class="d-flex justify-content-center my-4">
  <div class="range-field w-75">
    <input id="slider<?php echo "$k$n";?>" class="border-0" type="range" min="1" max="5" name="<?php echo $pytanie['pytanie'];?>"/>
  </div>
  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan" id="valueSpan<?php echo "$k$n";?>"></span>
</div>  -->
 
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
while ($k<16);
?>
 <h4>5. Posługując się skalą od 1 do 5, proszę przypisać każdemu z elementów ocenę (gdzie 1 to ocena niedostateczna, a 5 – bardzo dobra):</h4>

<?php
       
        do {
            $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<p><strong>$pytanie[tresc] </strong></p>";
            
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
 <!-- <div class="d-flex justify-content-center my-4">
  <div class="range-field w-75">
    <input id="slider<?php echo "$k$n";?>" class="border-0" type="range" min="1" max="5" name="<?php echo $pytanie['pytanie'];?>"/>
  </div>
  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan" id="valueSpan<?php echo "$k$n";?>"></span>
</div>  -->
 
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
while ($k<18);
?>
  <h4>6. Czy Pani/Pana zdaniem liczba miejsc w salach dydaktycznych dostosowana jest do liczby studentów?</h4>

<?php
       
        do {
            $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<p>(gdzie: 1. zdecydowanie nie;	2. raczej nie	;	3.  raczej tak	;	4. zdecydowanie tak)</p>";
            
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
 <!-- <div class="d-flex justify-content-center my-4">
  <div class="range-field w-75">
    <input id="slider<?php echo "$k$n";?>" class="border-0" type="range" min="1" max="5" name="<?php echo $pytanie['pytanie'];?>"/>
  </div>
  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan" id="valueSpan<?php echo "$k$n";?>"></span>
</div>  -->
 
 <?php 
     $q=1;
     do {
     echo "<div class=\"form-check form-check-inline\">
  <input type=\"radio\" class=\"form-check-input\" id=\"materialInline$k$q\" value=\"$q\" name=\"$pytanie[pytanie]\" required>
  <label class=\"form-check-label\" for=\"materialInline$k$q\">$q</label>
</div>";
     $q=$q+1;
  
              }
               while($q<5);
                echo "<hr/>";
            
               
            
        }
         $k=$k+1;
        }
while ($k<18);
?>
  <h4>7. Posługując się skalą od 1 do 5, proszę ocenić (gdzie 1 to ocena niedostateczna, a 5 – bardzo dobra):</h4>

<?php
       
        do {
            $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<p><strong>$pytanie[tresc] </strong></p>";
            
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
 <!-- <div class="d-flex justify-content-center my-4">
  <div class="range-field w-75">
    <input id="slider<?php echo "$k$n";?>" class="border-0" type="range" min="1" max="5" name="<?php echo $pytanie['pytanie'];?>"/>
  </div>
  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan" id="valueSpan<?php echo "$k$n";?>"></span>
</div>  -->
 
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
while ($k<28);
?>
  <h4>8. Jak ocenia Pani/Pan jakość wykorzystywanego podczas zajęć sprzętu dydaktycznego?:</h4>

<?php
       
        do {
            $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<p>(gdzie: 1. zdecydowanie niska ; 2. raczej niska		; 3. przeciętna; 4. raczej wysoka	; 5. bardzo wysoka jakość)</p>";
            
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
 <!-- <div class="d-flex justify-content-center my-4">
  <div class="range-field w-75">
    <input id="slider<?php echo "$k$n";?>" class="border-0" type="range" min="1" max="5" name="<?php echo $pytanie['pytanie'];?>"/>
  </div>
  <span class="font-weight-bold text-primary ml-2 mt-1 valueSpan" id="valueSpan<?php echo "$k$n";?>"></span>
</div>  -->
 
 <?php 
     $q=1;
     do {
     echo "<div class=\"form-check form-check-inline\">
  <input ";
        if ($q==1||$q==2) echo "onclick=\"pokaz_pyc()\"";
            else echo "onclick=\"schowaj_pyc()\"";
     echo "type=\"radio\" class=\"form-check-input\" id=\"materialInline$k$q\" value=\"$q\" name=\"$pytanie[pytanie]\" required>
  <label class=\"form-check-label\" for=\"materialInline$k$q\">$q</label>
</div>";
     $q=$q+1;
  
              }
               while($q<6);
                echo "<hr/>";
            
               
            
        }
         $k=$k+1;
        }
while ($k<28);
?>
 <div id="pyc">
      <h4>9. Jeśli uważa Pani/Pan, że jest przeciętna lub niska, proszę wskazać dlaczego (zaznaczyć wszystkie właściwe):</h4>
<div class="form-check form-check-inline">
  <input type="checkbox" class="form-check-input" id="materialInline1" name="PYT_30a" value="jest niedostosowany do potrzeb">
  <label class="form-check-label" for="materialInline1">jest niedostosowany do potrzeb	</label>
</div>

<!-- Material inline 2 -->
<div class="form-check form-check-inline">
    <input type="checkbox" class="form-check-input" id="materialInline2" name="PYT_30b" value="często się psuje">
    <label class="form-check-label" for="materialInline2">często się psuje</label>
</div>

<!-- Material inline 3 -->
<div class="form-check form-check-inline">
    <input type="checkbox" class="form-check-input" id="materialInline3" name="PYT_30c" value="jest uszkodzony">
    <label class="form-check-label" for="materialInline3">jest uszkodzony</label>
</div>
<div class="form-check form-check-inline">
    <input type="checkbox" class="form-check-input" id="materialInline4" name="PYT_30d" value="jest przestarzały technologicznie">
    <label class="form-check-label" for="materialInline4">jest przestarzały technologicznie</label>
</div>
<hr/>
 </div>
 <h4>10. Inne uwagi i opinie:</h4>
<div class="md-form" >
  <textarea id="form7" class="md-textarea form-control" name="PYT_31" rows="3"></textarea>
  <label for="form7">Czy chciałbyś/chciałabyś dodać coś od siebie? Oto miejsce na Twoją wypowiedź:</label>
</div>
<!--Textarea with icon prefix-->

<button type="submit" class="btn btn-light">Wyślij ankietę</button></form>
</div>
