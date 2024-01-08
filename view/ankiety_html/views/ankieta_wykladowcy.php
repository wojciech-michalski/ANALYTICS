<?php 
    if($_GET['lang']=='en') {
                ?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
      <form method="post" action="insert_ankiety.php" >
          <input type="hidden" name="lang" value="en"/>
      <h4 class="display-5">UNIVERSITY OF ECOLOGY AND MANAGEMENT IN WARSAW</h4>
<p>Academic staff evaluation form</p>
    <?php echo "<p><strong>TEACHER:</strong> $naglowek[nazwisko] $naglowek[imie] $naglowek[tytul]</p>";
    echo "<p><strong>SUBJECT:</strong> $naglowek[przedmiot]<span style=\"margin-left:20px;\"><strong>FIELD OF STUDY:</strong> $naglowek[kierunek]</span></p>"; 
    echo "<p><strong>FORM OF STUDY:</strong> $forma <span style=\"margin-left:20px;\"><strong>YEAR OF STUDY:</strong> $rok_akademicki</span></p>"; 
    echo "<p><strong>FORM OF CLASSES:</strong> <span style=\"margin-left:20px;\">"; 
    ?>
<!-- Material inline 1 -->
<div class="form-check form-check-inline">
  <input type="checkbox" name="forma1" value="lecture" class="form-check-input" id="materialInline1">
  <label class="form-check-label"  for="materialInline1">lecture</label>
</div>

<!-- Material inline 2 -->
<div class="form-check form-check-inline">
    <input type="checkbox"  name="forma2" value="auditory exercises" class="form-check-input" id="materialInline2">
    <label class="form-check-label" for="materialInline2">auditory exercises</label>
</div>

<!-- Material inline 3 -->
<div class="form-check form-check-inline">
    <input type="checkbox"  name="forma3" value="project exercises" class="form-check-input" id="materialInline3">
    <label class="form-check-label" for="materialInline3">project exercises</label>
</div>
<!-- Material inline 4 -->
<div class="form-check form-check-inline">
    <input type="checkbox" name="forma4" value="laboratory exercises" class="form-check-input" id="materialInline4">
    <label class="form-check-label"  for="materialInline4">laboratory exercises</label>
</div>
<!-- Material inline 5 -->
<div class="form-check form-check-inline">
    <input type="checkbox"  name="forma5" value="seminar" class="form-check-input" id="materialInline5">
    <label class="form-check-label" for="materialInline5">seminar</label>
</div>
<input type="hidden" name="id_zajec" value="<?php echo $id_prowadzacy;?>">
<input type="hidden" name="ankieta" value="<?php echo $ankieta;?>">
  </div>
</div>
<div class="container">
    <p>DEAR STUDENT!
       This semester is coming to an end and we would like you to evaluate honestly the classes in which you have participated. Please read the questions thoroughly. Evaluate the following elements of the classes and teacher’s work according to 1 to 5 scale where 1 means unsatisfactory and 5 means very good.</p>

<!--echo "<p><strong>LICZBA TWOICH NIEOBECNOŚCI NA TYCH ZAJĘCIACH: </strong></p>";
        ?>
<select name="nieobecnosci" class="mdb-select md-form">
  <option disabled selected >--wybierz wartośc z listy--</option>
  <option>0 nieobecności</option>
  <option>1 nieobecność</option>
  <option>2 nieobecności</option>
   <option>3 nieobecności lub więcej</option>
</select>-->
<?php
        $ile_pytan=mysqli_num_rows($pytania);
        
        $k=0;
        do {
            $pytanie=mysqli_fetch_array($pytania);
            $nrpytania=$k+1;
            $nn=$pytanie['n'];
            echo "<p><strong>$nrpytania. $pytanie[tresc_en] </strong></p>";
            
            if ($nn==2){
                ?> <div class="form-check form-check-inline" style="margin-bottom:20px;">
  <input type="radio" name="<?php echo $pytanie[pytanie];?>" class="form-check-input" id="materialInline<?php echo "$k$n-T";?>" value="TAK" required>
  <label class="form-check-label" for="materialInline<?php echo "$k$n-T";?>">YES</label>
</div> 
    <div class="form-check form-check-inline" style="margin-bottom:20px;">
  <input type="radio" name="<?php echo $pytanie[pytanie];?>" class="form-check-input" id="materialInline<?php echo "$k$n-N";?>" value="NIE">
  <label class="form-check-label" for="materialInline<?php echo "$k$n-N";?>">NO</label>
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
<div class="md-form">
  <textarea id="form7" class="md-textarea form-control" name="PYT_16" rows="3"></textarea>
  <label for="form7">Would you like to add something more? Here is a place for this:</label>
</div>
<!--Textarea with icon prefix-->

<button type="submit" class="btn btn-light">Submit evaluation form</button></form>
</div>
        
        
        
  <?php      
        
    }
    else {
        ?>
<div class="jumbotron jumbotron-fluid">
  <div class="container">
      <form method="post" action="insert_ankiety.php" >
      <h4 class="display-5">WYŻSZA SZKOŁA EKOLOGII I ZARZĄDZANIA W WARSZAWIE</h4>
<p>ANKIETA OCENY PRACY NAUCZYCIELA AKADEMICKIEGO</p>
    <?php echo "<p><strong>PROWADZĄCY:</strong> $naglowek[nazwisko] $naglowek[imie] $naglowek[tytul]</p>";
    echo "<p><strong>PRZEDMIOT:</strong> $naglowek[przedmiot]<span style=\"margin-left:20px;\"><strong>KIERUNEK:</strong> $naglowek[kierunek]</span></p>"; 
    echo "<p><strong>FORMA STUDIÓW:</strong> $forma <span style=\"margin-left:20px;\"><strong>ROK AKADEMICKI:</strong> $naglowek[rok_akademicki]</span></p>"; 
    echo "<p><strong>FORMA ZAJĘĆ:</strong> <span style=\"margin-left:20px;\">"; 
    ?>
<!-- Material inline 1 -->
<div class="form-check form-check-inline">
  <input type="checkbox" name="forma1" value="wykład" class="form-check-input" id="materialInline1">
  <label class="form-check-label"  for="materialInline1">wykład</label>
</div>

<!-- Material inline 2 -->
<div class="form-check form-check-inline">
    <input type="checkbox"  name="forma2" value="ćwiczenia audytoryjne" class="form-check-input" id="materialInline2">
    <label class="form-check-label" for="materialInline2">ćwiczenia audytoryjne</label>
</div>

<!-- Material inline 3 -->
<div class="form-check form-check-inline">
    <input type="checkbox"  name="forma3" value="ćwiczenia projektowe" class="form-check-input" id="materialInline3">
    <label class="form-check-label" for="materialInline3">ćwiczenia projektowe</label>
</div>
<!-- Material inline 4 -->
<div class="form-check form-check-inline">
    <input type="checkbox" name="forma4" value="ćwiczenia laboratoryjne" class="form-check-input" id="materialInline4">
    <label class="form-check-label"  for="materialInline4">ćwiczenia laboratoryjne</label>
</div>
<!-- Material inline 5 -->
<div class="form-check form-check-inline">
    <input type="checkbox"  name="forma5" value="seminarium" class="form-check-input" id="materialInline5">
    <label class="form-check-label" for="materialInline5">seminarium</label>
</div>
<input type="hidden" name="id_zajec" value="<?php echo $id_prowadzacy;?>">
<input type="hidden" name="ankieta" value="<?php echo $ankieta;?>">
  </div>
</div>
<div class="container">
    <p>DROGA STUDENTKO! DROGI STUDENCIE!
        Chcielibyśmy, abyś rzetelnie ocenił/a zajęcia, w których uczestniczysz. Przeczytaj uważnie ankietę. Oceń poniższe elementy zajęć oraz pracę nauczyciela w skali od 1 do 5 (gdzie 1 oznacza ocenę niedostateczną, a 5 ocenę bardzo dobrą) lub zaznacz odpowiedź we właściwym okienku.</p>
<?php
echo "<p><strong>LICZBA TWOICH NIEOBECNOŚCI NA TYCH ZAJĘCIACH: </strong></p>";
        ?>
<select name="nieobecnosci" class="mdb-select md-form">
  <option disabled selected >--wybierz wartośc z listy--</option>
  <option>0 nieobecności</option>
  <option>1 nieobecność</option>
  <option>2 nieobecności</option>
   <option>3 nieobecności lub więcej</option>
</select>
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
<div class="md-form">
  <textarea id="form7" class="md-textarea form-control" name="PYT_16" rows="3"></textarea>
  <label for="form7">Czy chciałbyś/chciałabyś dodać coś od siebie? Oto miejsce na Twoją wypowiedź:</label>
</div>
<!--Textarea with icon prefix-->

<button type="submit" class="btn btn-light">Wyślij ankietę</button></form>
</div>
<?php 
    }
    ?>