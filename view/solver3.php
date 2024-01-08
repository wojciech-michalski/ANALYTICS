<?php
 function konwersja_znakow($string){
    $znaki=array(
        "ó" => "Ã³",
        "ż" => "Å¼",
        "ł"=> "Å‚",
        "ś"=> "Å›",
        "ć" => "Ä‡",
        "ń" => "Å„",
        "ę" => "Ä™",
        "ą" => "Ä…"
    ) ;
    //$k=1;
    //$string[0]=$string;
    foreach (array_keys($znaki) as $conv){
        $string=str_replace($znaki[$conv],$conv,$string);
     //   $k++;
    }
    
    return $string;
}
       include('view/topnav.php');
     $metryka=$_POST['element'];
$metryka_=mysqli_fetch_array(mysqli_query($kon,"SELECT * FROM `metryki` WHERE `id`='$metryka'"));
$tabela="ankieta";
//echo $tabela;
switch($metryka_[2]){
         default:
    $pytanie="$metryka_[2]_";
break;
case "PYT_1":
    $pytanie="rok_ukonczenia";
    break;
case "PYT_2":
    $pytanie="kierunek_studiow";
    break; 
case "PYT_3":
    $pytanie="typ_studiow";
    break;
case "PYT_4":
    $pytanie="rodzaj_studiow";
    break;
case "PYT_5":
    $pytanie="specjalnosc";
    break;
}
$mozliwe_odpowiedzi=mysqli_query($kon,"SELECT DISTINCT `$pytanie` from `$tabela` WHERE 1 ORDER BY `$pytanie` ASC");

$ile=mysqli_num_rows($mozliwe_odpowiedzi);
    $n=0;
    do {
        $wariant=mysqli_fetch_array($mozliwe_odpowiedzi);
        
        $options[]="<option value=\"$wariant[0]\">".konwersja_znakow($wariant[0])."</option>";
        
        $n=$n+1;
    }
    while ($n<$ile);
//print_r($options);
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
            <span>ANALIZA ANKIETY <?php echo $_POST['ankieta']; //echo $_POST['rok_akademicki'];
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
 <h5>Badamy element <?php 
 switch($_POST['element']){
     default:
         echo "$metryka_[2] <em>$metryka_[3]</em> z ankiety $metryka_[1]";
         break;
         case "prowadzacy":
             echo "<em> Kierunek studiów</em> z ankiety $metryka_[1]";
             break;
 }
 
 ?></h5><hr/>
<form method="post" action="main.php?mode=solver3-1">
    <input type="hidden" name="element" value="<?php echo $pytanie;?>"/>
    <input type="hidden" name="tabela" value="<?php echo $tabela;?>"/>
   
    <h6>Podaj interesujący Cię wariant odpowiedzi</h6>
    <select name="value[]" class="mdb-select md-form" multiple><option value="" disabled selected>Wybierz</option>
        <?php $opcje=implode("",$options); echo $opcje;?><label class="mdb-main-label">Example label</label>
<button class="btn-save btn btn-primary btn-sm">Save</button></select>
    <hr/>
    <h6>Wyznacz czułość</h6>
        <span class="font-weight-bold blue-text mr-2 mt-1"><i class="fas fa-chevron-down"></i></span>
        <input class="border-0"  name="treshold" type="range" min="5" max="100" />
        <span class="font-weight-bold blue-text ml-2 mt-1"><i class="fas fa-chevron-up"></i></span>
        <hr/>
        <h6>Określ sposób badania zależności</h6>
        <div class="form-check">
  <input type="radio" class="form-check-input" id="materialUnchecked" name="exact" value="LIKE">
  <label class="form-check-label" for="materialUnchecked">LIKE</label>
  
</div>

<!-- Material checked -->
<div class="form-check">
  <input type="radio" class="form-check-input" id="materialChecked" name="exact" value="=" checked>
  <label class="form-check-label" for="materialChecked">EXACT</label>
  
</div>
<button type="button" class="btn btn-sm btn-primary" data-toggle="popover" title="EXACT i LIKE" 
        data-content="EXACT oznacza, że będą badane dokładnie tylko wskazane wartości, natomiast LIKE oznacza, że będą badane wartości podobne. W praktyce dotyczy to tylko odpowiedzi na pytania wielokrotnego wyboru. ">Co to znaczy ?</button>
<hr/>
        <button type="submit" class="btn btn-primary">Dalej <i class="fas fa-book ml-1"></i></button>
          <a type="button" class="btn btn-outline-primary waves-effect" href="main.php?mode=deanreport7">Anuluj</a>
 </form>
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

