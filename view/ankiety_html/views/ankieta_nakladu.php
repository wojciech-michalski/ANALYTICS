<div class="jumbotron jumbotron-fluid">
  <div class="container">
      <form method="post" action="insert_ankiety.php" >
      <h4 class="display-5">WYŻSZA SZKOŁA EKOLOGII I ZARZĄDZANIA W WARSZAWIE</h4>
<p>STUDENCKA OCENA NAKŁADU PRACY NA ZAJĘCIACH DYDAKTYCZNYCH</p>
    <?php 
    echo "<p><strong>PRZEDMIOT:</strong> $naglowek[przedmiot]<span style=\"margin-left:20px;\"></p><p><strong>KIERUNEK:</strong> $naglowek[kierunek]</span></p>"; 
    echo "<p><strong>FORMA STUDIÓW:</strong> $naglowek[forma] <span style=\"margin-left:20px;\"><strong>ROK STUDIÓW:</strong> $naglowek[rok_studiow]</span></p>"; 
    ?>
<input type="hidden" name="id_zajec" value="<?php echo $id_prowadzacy;?>">
<input type="hidden" name="ankieta" value="<?php echo $ankieta;?>">
  </div>
</div>
<div class="container">
    <p>
    W trosce o zapewnienie i doskonalenie jakości kształcenia, prosimy o wypełnienie niniejszej ankiety,
    która pozwoli nam ocenić Twój nakład pracy, jaki niezbędny jest do osiągnięcia zakładanych efektów uczenia się 
    <strong>w ramach CAŁEGO przedmiotu</strong>, tzn. <strong>wszystkich form zajęć</strong>, w których prowadzony
    jest dany przedmiot. Ankieta dotyczy wyłącznie oceny nakładu Twojej pracy samodzielnej związanej np. z lekturą
    książek, przygotowywaniem się do kolokwiów oraz egzaminów. </p><p>
Prosimy Cię o rzetelną ocenę. Wyniki badania umożliwią nam przypisanie poszczególnym przedmiotom właściwej 
liczby punktów ECTS.</p><p>
W poniższej tabeli wpisz rzeczywistą liczbę godzin przeznaczonych na poszczególne działania w całym semestrze, w ramach wszystkich form zajęć w ramach przedmiotu.
    </p>
    
        <table class="table">
       <thead class="black white-text">
<tr><th scope="col">RODZAJ DZIAŁANIA</th><th scope="col">LICZBA GODZIN W SEMESTRZE</th><th scope="col">NIE DOTYCZY</th></tr> 
       </thead><tbody> 
<?php
        $ile_pytan=mysqli_num_rows($pytania);
        
        $k=0;
        do {
            $pytanie=mysqli_fetch_array($pytania);
            $k=$k+1;
            echo "<tr><td style=\"font-size:1.3em;\">$pytanie[tresc]</td><td><div class=\"md-form form-lg\" id=\"ajdi$k\">
  <input type=\"text\" name=\"$pytanie[pytanie]\" id=\"inputLGEx$k\" class=\"form-control form-control-lg\" maxlength=\"3\">
  <label for=\"inputLGEx$k\">Liczba godzin</label>
</div></td><td><div class=\"form-check\">
    <input type=\"checkbox\" class=\"form-check-input\" id=\"materialUnchecked$k\">
    <label class=\"form-check-label\" for=\"materialUnchecked$k\">Nie dotyczy</label>
</div></td></tr>";
                   }
while ($k<$ile_pytan);
$ile_radio=mysqli_num_rows($pytania_radio);
$n=0;
do {
    $radio=mysqli_fetch_array($pytania_radio);
    echo"<tr><td style=\"font-size:1.3em;\">$radio[tresc]</td><td colspan=\"2\">";
    $ile_elementow=$radio[n];
        $l=0;
        do {
            switch ($l){
              case 0:
                  $label="za mała";
                  break;
              case 1:
                  $label="wystarczająca";
                  break;
              case 2:
                  $label="za duża";
                  break;
          }
          echo " <div class=\"form-check form-check-inline\">
  <input type=\"radio\" class=\"form-check-input\" id=\"materialInline$l\" value=\"$label\" name=\"$radio[pytanie]\">
  <label class=\"form-check-label\" for=\"materialInline$l\">";
          
          echo "$label</label></div> ";
            
            $l=$l+1;
        }
        while ($l<$ile_elementow);
    echo "</td></tr>";
    $n=$n+1;
}
while($n<$ile_radio);
?>

<!--Textarea with icon prefix-->
</tbody></table>
<button type="submit" class="btn btn-light">Wyślij ankietę</button></form>
</div>


