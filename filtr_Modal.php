
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid" role="document"> 
       <div class="modal-content"><form method="POST" action="main.php?mode=zestawienie" id="filtr">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Wprowadź dane do filtra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
             <?php if (isset($_SESSION['ustawienia_filtra'])) $ustawienia=$_SESSION['ustawienia_filtra'];
                else $ustawienia=array(
                   'data' =>"",
                   'kolumny' => "",
                   'kierunki' => array(),
                   'typy' => array(),
                   'rodzaje' => array(),
                   'own' => "",
                   'statusy' => array(),
                   'tytuly' => array());
                 ?>
             
   <div class="row">
       <div class="col-md-6">
                    <div class="md-form"><div class="md-form mb-0">
    <input placeholder="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" type="text" id="date-picker-example" 
           class="form-control datepicker" name="data" required />
   <label for="date-picker-example">Wybierz datę</label>
                        </div> </div></div>
       <div class="col-md-6"><div class="md-form mb-0">
         <select class="mdb-select" id="s1" multiple name="kierunki[]" required >
    <option value="" disabled >wybierz kierunki</option>
    <?php
    $k=0;
    do {
        $kierunek=sqlsrv_fetch_array($kierunki);
        if(in_array($kierunek[0],$ustawienia['kierunki'])) $selected="selected";
         else $selected="";
        echo "<option $selected>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ilekierunkow);
    ?>
</select>
<label for="s1">wybierz kierunki</label>
           </div></div>
   </div>
                    <div class="row">
                        <div class="col-md-6"><div class="md-form mb-0">
  <select class="mdb-select" id="s2" name="kolumny" required > 
      <option disabled>wybierz kolumny<option>
      <option value="plec" <?php if($ustawienia['kolumny']=='plec') echo "selected";?>>podział na płcie</option>
       <option value="obywatelstwo" <?php if($ustawienia['kolumny']=='obywatelstwo') echo "selected";?>>podział na kraje</option>
       <option value="numer_semestru" <?php if($ustawienia['kolumny']=='numer_semestru') echo "selected";?>>podział na semestry</option>
       <option value="specjalnosc_nazwa" <?php if($ustawienia['kolumny']=='specjalnosc_nazwa') echo "selected";?>>podział na specjalości</option>
       <option value="polon_miejsc" <?php if($ustawienia['kolumny']=='polon_miejsc') echo "selected";?>>podział na typ miejscowości POLON</option>
       <option value="stypendium_rodzaj" <?php if($ustawienia['kolumny']=='stypendium_rodzaj') echo "selected";?>>podział ze względu na pobieranie stypendium</option>
       <option value="mapowanie.profil" <?php if($ustawienia['kolumny']=='mapowanie.profil') echo "selected";?>>podział na profile</option>
       <option value="niepelnosprawnosc_typ" <?php if($ustawienia['kolumny']=='niepelnosprawnosc_typ') echo "selected";?>>podział na typy niepełnosprawności</option>
       <option value="status_studenta" <?php if($ustawienia['kolumny']=='status_studenta') echo "selected";?>>podział na statusy</option>
       <option value="mapowanie.forma" <?php if($ustawienia['kolumny']=='mapowanie.forma') echo "selected";?>>podział na formy studiów</option>
       <option value="mapowanie.stopien" <?php if($ustawienia['kolumny']=='mapowanie.stopien') echo "selected";?>>podział na stopień studiów</option>
       <option value="mapowanie.kierunek" <?php if($ustawienia['kolumny']=='mapowanie.kierunek') echo "selected";?>>podział na kierunki studiów</option>
  </select><label for="s2">wybierz kolumny</label></div></div>
                        <div class="col-md-6"><div class="md-form mb-0">
                         <select id="s3" class="mdb-select" multiple name="typy[]" required>
   <option value="" disabled>wybierz typy studiów</option>  
    <?php
    $t=0;
    do {
        $typ=mysqli_fetch_array($typy);
        if(in_array($typ[0],$ustawienia['typy'])) $selected="selected";
         else $selected="";
        echo "<option $selected>$typ[0]</option>";
        $t=$t+1;
    }
    while($t<$iletypow);
    ?></select><label for="s3">wybierz typy studiów</label></div>
                        </div> </div>
                    
                    <div class="row"><div class="col-md-6"><div class="md-form mb-0">
                        <select id="s4" class="mdb-select" multiple name="statusy[]" required >
    <option value="" disabled>wybierz statusy</option> 
    <?php
    $s=0;
    do {
        $status=mysqli_fetch_array($statusy);
        if(in_array($status[0],$ustawienia['statusy'])) $selected="selected";
         else $selected="";
        echo "<option $selected>$status[0]</option>";
        $s=$s+1;
    }
    while($s<$ilestatusow);
    ?></select><label for="s4">wybierz statusy</label></div>
                    </div> 
                        <div class="col-md-6"><div class="md-form mb-0">
                           <select class="mdb-select" id="s5" multiple name="rodzaje[]" required > 
                              <option value="" disabled >wybierz rodzaje studiów</option>  
                                <?php
    $r=0;
    do {
        $forma=mysqli_fetch_array($formy);
        if(in_array($forma[0],$ustawienia['rodzaje'])) $selected="selected";
         else $selected="";
        echo "<option $selected>$forma[0]</option>";
        $r=$r+1;
    }
    while($r<$ileform);
    ?></select><label for="s5">wybierz rodzaje studiów</label></div>
                           </div>
                        
                        </div>
      <div class="row">
<div class="col-md-6"><div class="md-form mb-0">
    <select class="mdb-select" id="s6" multiple name="tytuly[]" required > 
                               <option value="" disabled >wybierz tytuły zawodowe</option> 
                               <?php
                               $t=0;
                               do {
                                   $tytul=mysqli_fetch_array($tytuly);
                                   if(in_array($tytul[0],$ustawienia['tytuly'])) $selected="selected";
         else $selected="";
                                   echo "<option $selected>$tytul[0]</option>";
                                   $t=$t+1;
                               }
                               while($t<$iletytulow);
                               ?>
    </select><label for="s6">wybierz tytuły zawodowe</label></div>
</div>
       <div class="col-md-6">
           <h6>Własny warunek</h6>
           <div class="md-form">
           <input type="text" id="form1" class="form-control" name="own" value="<?php echo $ustawienia['own'];?>"/>
    <label for="form1" class="">Własny warunek SQL</label>
</div>
           <input type="hidden" id="dane_filtra" name="dane_filtra"/>
</div>   
      </div>          
             </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button type="button" class="btn btn-info" onclick="zapamietajFiltr();">Zapamiętaj ustawienia filtra</button>
                <button type="button" class="btn btn-warning" onclick="wyczyscFiltr();">Wyzeruj ustawienia filtra</button>
                <button type="submit" class="btn btn-indigo">Pokaż</button>
            </div>
       </form> </div>
    </div>
</div>
    

