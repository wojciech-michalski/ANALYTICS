<div class="modal fade" id="kmonModal" tabindex="-1" role="dialog" aria-labelledby="lmonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid" role="document"> 
       <div class="modal-content"><form method="POST" action="main.php?mode=KMON">
            <div class="modal-header">
                <h5 class="modal-title" id="kmonModalLabel">Wprowadź dane do filtra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                  <div class="row">
       <div class="col-md-6">
                    <div class="md-form"><div class="md-form mb-0">
    <input placeholder="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>" type="text" id="date-picker-example" 
           class="form-control datepicker" name="data" required />
   <label for="date-picker-example">Wybierz datę</label>
                        </div> </div></div>
       <div class="col-md-6"><div class="md-form mb-0">
         <select class="mdb-select" id="s21" multiple name="kierunki[]" required >
    <option value="" disabled >wybierz kierunki</option>
    <?php
    require('controller/U10_Przynaleznosci.php');
    $k=0;
    do {
        $kierunek=sqlsrv_fetch_array($kierunki);
        echo "<option>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ilekierunkow);
    ?>
</select>
<label for="s21">wybierz kierunki</label>
           </div></div>
   </div>
                <div class="row">
                    <div class="col-md-6"><div class="md-form mb-0">
                         <select id="s23" class="mdb-select" multiple name="typy[]" required>
   <option value="" disabled>wybierz typy studiów</option>  
    <?php
    $t=0;
    do {
        $typ=mysqli_fetch_array($typy);
        echo "<option>$typ[0]</option>";
        $t=$t+1;
    }
    while($t<$iletypow);
    ?></select><label for="s23">wybierz typy studiów</label></div>
                        </div>
                     <div class="col-md-6"><div class="md-form mb-0">
                           <select class="mdb-select" id="s25" multiple name="rodzaje[]" required > 
                              <option value="" disabled >wybierz rodzaje studiów</option>  
                                <?php
    $r=0;
    do {
        $forma=mysqli_fetch_array($formy);
        echo "<option>$forma[0]</option>";
        $r=$r+1;
    }
    while($r<$ileform);
    ?></select><label for="s25">wybierz rodzaje studiów</label></div>
                           </div>
                 </div>
                <div class="row">
<div class="col-md-6"><div class="md-form mb-0">
    <select class="mdb-select" id="s26" multiple name="tytuly[]" required > 
                               <option value="" disabled >wybierz tytuły zawodowe</option> 
                               <?php
                               $t=0;
                               do {
                                   $tytul=mysqli_fetch_array($tytuly);
                                   echo "<option>$tytul[0]</option>";
                                   $t=$t+1;
                               }
                               while($t<$iletytulow);
                               ?>
    </select><label for="s26">wybierz tytuły zawodowe</label></div>
</div><div class="col-md-6"><div class="md-form mb-0">
        <select class="mdb-select" id="s27" multiple name="jezyki[]" required > 
             <option value="" disabled >wybierz języki prowadzenia studiów</option> 
             <?php
                               $t=0;
                               do {
                                   $jezyk=mysqli_fetch_array($jezyki);
                                   echo "<option>$jezyk[0]</option>";
                                   $t=$t+1;
                               }
                               while($t<$ilejezykow);
                               ?>
    </select><label for="s27">wybierz tytuły zawodowe</label>
    </div></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button type="submit" class="btn btn-primary">Pokaż</button>
            </div>
            </div></form>
    </div>
</div>
    

