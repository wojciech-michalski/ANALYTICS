  <?php 
        //określam semestr i rok akademicki
  $rok=date('Y');
  $miesiac=date('m');
  switch($miesiac){
      case "03":
      case "04":
      case "05":
      case "06":
      case "07":
      case "08":
      case "09":
      case "10":
          $rok_akademicki=$rok-1;
          $semestr="0";
          break;
      case "01":
      case "02":
          $rok_akademicki=$rok-2;
          $semestr="1";
          break;
      case "11":
      case "12":
          $rok_akademicki=$rok-1;
          $semestr="1";
          break;
         
  }
  
  //echo "$rok_akademicki $semestr";
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
            <span>SEMESTRALNY RAPORT OCEN</span>
          </h4>

         

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
          <?php //include ('controller/raport_semestralny_ocen.php');
         ?>
         
     
         

         
         <div class="card-header text-center">Analizy gotowe <a href="#przygotujDane"><button class="btn btn-sm btn-success">Przejdź do przygotowywania analiz</button></a></div>
          
<div class="card-body">  
    <div class="list-group">  
        <?php
        $pdata=mysqli_query($kon,"SELECT DISTINCT `rok_akademicki`,`semestr` FROM `analiza_ocen` WHERE 1 ORDER BY `id` DESC");
        foreach($pdata as $analiza){
            switch($analiza['semestr']){
                case 1:
                    $zl="letni";
                    break;
                case 0:
                    $zl="zimowy";
                    break;
                    
            }
            $rak="$analiza[rok_akademicki]/".$analiza['rok_akademicki']+1;
            $ile_przedmiotow=mysqli_num_rows(mysqli_query($kon,"SELECT DISTINCT `przedmiot` "
                    . "FROM `analiza_ocen` WHERE `rok_akademicki`='$analiza[rok_akademicki]' AND `semestr`="
                    . "'$analiza[semestr]' "));
            $ile_ocen=mysqli_num_rows(mysqli_query($kon,"SELECT `id` "
                    . "FROM `analiza_ocen` WHERE `rok_akademicki`='$analiza[rok_akademicki]' AND `semestr`="
                    . "'$analiza[semestr]' "));
            ?>
                 <div class="list-group-item list-group-item-action flex-column align-items-start">
                     <form method="POST"action="main.php?mode=deanreport10">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1">Analiza ocen rok akademicki <?php echo $rak;?> semestr <?php echo $zl;?></h5>
      <small>Zbadano <?php echo $ile_przedmiotow;?> przedmiotów i przeanalizowano <?php echo $ile_ocen;?> ocen</small>
    </div>
                         <input type="hidden" name="analiza" value="<?php echo "$analiza[rok_akademicki];$analiza[semestr]";?>"/>
                          <select class="mdb-select" multiple name="kierunki[]" required >
    <option value="" disabled selected>wybierz kierunki</option>
    <?php
    $kierunki=mysqli_query($kon,"SELECT DISTINCT `kierunek` FROM `analiza_ocen` WHERE 1");
    $ilekierunkow=mysqli_num_rows($kierunki);
    $k=0;
    do {
        $kierunek=mysqli_fetch_array($kierunki);
        echo "<option>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ilekierunkow);
    ?>
</select>
     <select class="mdb-select" multiple name="stopnie[]" required >
    <option value="" disabled selected>wybierz stopnie</option>
    <?php
    $kierunki=mysqli_query($kon,"SELECT DISTINCT `stopien` FROM `analiza_ocen` WHERE 1");
    $ilekierunkow=mysqli_num_rows($kierunki);
    $k=0;
    do {
        $kierunek=mysqli_fetch_array($kierunki);
        echo "<option>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ilekierunkow);
    ?>
</select>    
     <select class="mdb-select" multiple name="formy[]" required >
    <option value="" disabled selected>wybierz formy</option>
    <?php
    $kierunki=mysqli_query($kon,"SELECT DISTINCT `forma` FROM `analiza_ocen` WHERE 1");
    $ilekierunkow=mysqli_num_rows($kierunki);
    $k=0;
    do {
        $kierunek=mysqli_fetch_array($kierunki);
        echo "<option>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ilekierunkow);
    ?>
</select>        
    <hr/>
    
    <button type="submit" class="btn btn-unique">ANALIZA</button></form>
        </div>
        <?php
        }
        ?>
    </div>
    <?php
  //   $pdata=mysqli_query($kon,"SELECT DISTINCT `rok_akademicki`,`semestr` FROM `analiza_ocen` WHERE 1;");?>
  <!--  <div class="row">
        <div class="col-md-6">
            Analizy gotowe
        </div>
        <div class="col-md-6"><form method="POST"action="main.php?mode=deanreport10">
    <div class="md-form">
         <select class="mdb-select" name="analiza">
    <option value="" disabled selected>Wybierz rok akademicki i semestr</option>
    <?php foreach($pdata as $opcja){
        switch($opcja['semestr']){
            case 0:
                $semwidoczny="Zimowy";
                break;
            case 1:
                $semwidoczny="Letni";
                break;
        }
        echo "<option value=\"$opcja[rok_akademicki];$opcja[semestr]\">$opcja[rok_akademicki]/".$opcja['rok_akademicki']+1 ." sem. $semwidoczny</option>";
    }
   // include('controller/U10_Przynaleznosci.php');
   ?>
         </select>
        <select class="mdb-select" multiple name="kierunki[]" required >
    <option value="" disabled selected>wybierz kierunki</option>
    <?php
    $kierunki=mysqli_query($kon,"SELECT DISTINCT `kierunek` FROM `analiza_ocen` WHERE 1");
    $ilekierunkow=mysqli_num_rows($kierunki);
    $k=0;
    do {
        $kierunek=mysqli_fetch_array($kierunki);
        echo "<option>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ilekierunkow);
    ?>
</select>
     <select class="mdb-select" multiple name="stopnie[]" required >
    <option value="" disabled selected>wybierz stopnie</option>
    <?php
    $kierunki=mysqli_query($kon,"SELECT DISTINCT `stopien` FROM `analiza_ocen` WHERE 1");
    $ilekierunkow=mysqli_num_rows($kierunki);
    $k=0;
    do {
        $kierunek=mysqli_fetch_array($kierunki);
        echo "<option>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ilekierunkow);
    ?>
</select>    
     <select class="mdb-select" multiple name="formy[]" required >
    <option value="" disabled selected>wybierz formy</option>
    <?php
    $kierunki=mysqli_query($kon,"SELECT DISTINCT `forma` FROM `analiza_ocen` WHERE 1");
    $ilekierunkow=mysqli_num_rows($kierunki);
    $k=0;
    do {
        $kierunek=mysqli_fetch_array($kierunki);
        echo "<option>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ilekierunkow);
    ?>
</select>        
        <button type="submit" class="button btn btn-primary">Analiza</button><hr/>
    </div></form>
       </div>
  </div>--><a name="przygotujDane"></a>
    <div class="card-header text-center">Przygotuj dane</div>
            
        
         <form method="POST"action="main.php?mode=deanreport11">
                 
           <div class="md-form">
         <select class="mdb-select" name="prepare" required>
    <option value="" disabled selected>Wybierz rok akademicki i semestr</option>
<?php $n=5;
$rtoday=date('Y');
do {
    $rok_aka=$rtoday-1;
    if(mysqli_num_rows(mysqli_query($kon,"SELECT DISTINCT `rok_akademicki`,`semestr` FROM `analiza_ocen` "
            . "WHERE `rok_akademicki`='$rok_aka' AND `semestr`=1;"))==0){
            echo "<option value=\"".$rtoday-1 .";1\">".$rtoday-1 ."/".$rtoday ." sem. letni</option>";}
            else echo"";
            if(mysqli_num_rows(mysqli_query($kon,"SELECT DISTINCT `rok_akademicki`,`semestr` FROM `analiza_ocen` "
            . "WHERE `rok_akademicki`='$rok_aka' AND `semestr`=0;"))==0){
            echo "<option value=\"".$rtoday-1 .";0\">".$rtoday-1 ."/".$rtoday ." sem. zimowy</option>";}
            else echo"";
    $n--;
    $rtoday--;
}
while($n>0);
?>
         </select><button onclick="spinner()" type="submit" class="button btn btn-primary">Przygotuj dane</button><hr/>
           </div>
             </form>  </div>
    </div>

         
     </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div>
        
       </div>

    
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');?>
 
  
  
 
</body>

</html>