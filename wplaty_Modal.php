
<!-- Modal -->
<div class="modal fade" id="wplatyModal" tabindex="-1" role="dialog" aria-labelledby="wplatyModal1" aria-hidden="true">
    <div class="modal-dialog modal-fluid" role="document">
        <div class="modal-content"><form method="POST" action="main.php?mode=deanreport5">
            <div class="modal-header">
                <h5 class="modal-title" id="wplatyModal1">Wprowadź dane do filtra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
             

   <div class="row">
       <div class="col-md-6">
         <select class="mdb-select"  name="rok_akademicki" required="">  
                  <option value="" disabled> </option>
                   <?php
                     for ($i = 2015; $i <= (date("Y")+1); $i++) {
    $lata[]= "<option value=\"".$i-1 ."\">".$i-1 ."/".$i ."</option>";
} 
arsort($lata);
foreach ($lata as $rok_aka){
    echo $rok_aka;
}

?>
                   
         </select><label class="mdb-main-label">wybierz rok akademicki</label>
           </div>
       <div class="col-md-6">
           <select class="mdb-select" name="semestrLZ" required="">
   <option value="" disabled> </option>
    <option value="0">Zimowy</option>
    <option value="1">Letni</option>
</select><label class="mdb-main-label">wybierz semestr</label>
       </div>
   </div>
                    <div class="row">
              <div class="col-md-6">
                  <select class="mdb-select" multiple name="kierunki[]" required="">
    <option value="" disabled> </option>
    <?php
    $k=0;
    do {
        $kierunek=sqlsrv_fetch_array($kierunki);
        echo "<option>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ilekierunkow);
    ?>
</select><label class="mdb-main-label">wybierz kierunki studiów</label>
                      
                   </div>
                        <div class="col-md-6">
                      <select class="mdb-select" multiple name="rodzaje[]" required=""> 
                             <option value="" disabled> </option>
                                <?php
    $r=0;
    do {
        $forma=mysqli_fetch_array($formy);
        echo "<option>$forma[0]</option>";
        $r=$r+1;
    }
    while($r<$ileform);
    ?></select><label class="mdb-main-label">wybierz rodzaje studiów</label>
                        </div> </div>
                    
                    <div class="row"><div class="col-md-6">
             <select class="mdb-select" multiple name="typy[]" required="">
  <option value="" disabled> </option>
    <?php
    $t=0;
    do {
        $typ=mysqli_fetch_array($typy);
        echo "<option>$typ[0]</option>";
        $t=$t+1;
    }
    while($t<$iletypow);
    ?></select><label class="mdb-main-label">wybierz typy studiów</label>
                    </div> 
                        <div class="col-md-6">
                           <select class="mdb-select" multiple name="tytuly[]" required=""> 
                             <option value="" disabled> </option> 
                               <?php
                               $t=0;
                               do {
                                   $tytul=mysqli_fetch_array($tytuly);
                                   echo "<option>$tytul[0]</option>";
                                   $t=$t+1;
                               }
                               while($t<$iletytulow);
                               ?>
    </select><label class="mdb-main-label">wybierz tytuły zawodowe</label>
                           </div>
                        
                        </div>
      <div class="row">
<div class="col-md-6">
    <select class="mdb-select" multiple name="rodzaje_oplat[]" required=""> 
       <option value="" disabled> </option>
         <option value="1">czesne</option> 
         <option value="68">odsetki</option> 
         <option value="18">opłata archiwizacyjna</option> 
         <option value="51">duplikat legitymacji</option> 
         <option value="15">powtórna realizacja przedmiotu</option> 
         <option value="19">opłata za urlop dziekański</option> 
         <option value="4">opłata rekrutacyjna</option> 
         <option value="49">opłata biblioteczna (kara)</option> 
        <option value="5">różnice programowe</option> 
         <option value="3">wpisowe</option> 
    </select><label class="mdb-main-label">wybierz rodzaje opłat</label>
</div>
      <div class="col-md-6">
          <div class="form-group">
    <input name="rozbite" type="radio" id="radio1" value="rozbite">
    <label for="radio1">Rozbite na przynależności</label>
</div>

<div class="form-group">
    <input name="rozbite" type="radio" id="radio2" value="zagregowane" checked="checked">
    <label for="radio2">Zagregowane</label>
</div>
      </div>
      </div>          
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button type="submit" onclick="spinner()" class="btn btn-primary">Pokaż</button>
            </div></form>
        </div>
    </div>
</div>
    

