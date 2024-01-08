
<!-- Modal -->
<div class="modal fade" id="rekrutacjaModal" tabindex="-1" role="dialog" aria-labelledby="rekrutacjaModal1" aria-hidden="true">
    <div class="modal-dialog modal-fluid" role="document">
        <div class="modal-content"><form method="POST" action="main.php?mode=deanreport4">
            <div class="modal-header">
                <h5 class="modal-title" id="rekrutacjaModal1">Wprowadź dane do filtra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
   <div class="row">
       <div class="col-md-6">
           <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
        Pokaż datami od do
    </button>
           <div class="collapse" id="collapseExample1">
                    <div class="md-form">
    <input placeholder="Wybrana data" type="text" id="date-picker-example" 
           class="form-control datepicker" name="data" >
    <label for="date-picker-example">Data od</label>
                    </div>
           <div class="md-form">
    <input placeholder="Wybrana data" type="text" id="date-picker-example" class="form-control datepicker"
            name="data2">
    <label for="date-picker-example">Data do</label>
           </div></div>
           </div>
       <div class="col-md-6">
<select class="mdb-select" multiple name="kierunki[]" required>
    <option value="" disabled >wybierz kierunki</option>
    <?php
    $k=0;
    do {
        $kierunek=sqlsrv_fetch_array($kierunki);
        echo "<option>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ilekierunkow);
    ?>
</select>
       </div>
   </div>
                    <div class="row">
              <div class="col-md-6">
                    <hr/> <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Pokaż miesiącami dla wybranego roku
    </button>
<div class="collapse" id="collapseExample">
    <div class="row"><div class="mt-6">
    <select class="mdb-select" name="miesiace">
        <?php 
        
        foreach ($miesiace as $month){
            echo "<option>$month</option>";
        }
        ?>
    </select></div>
        <div class="mt-6">
            <select class="mdb-select" name="rok">
                <option disabled>--Wybierz rok--</option>
                <?php
                for ($i = 2015; $i <= date("Y"); $i++) {
    echo "<option>$i</option>";
} 
?>
            </select>
    </div>
        
    </div> </div></div>
                        <div class="col-md-6">
                         <select class="mdb-select" multiple name="typy[]">
    <option value="" disabled>wybierz typy studiów</option>   
    <?php
    $t=0;
    do {
        $typ=mysqli_fetch_array($typy);
        echo "<option>$typ[0]</option>";
        $t=$t+1;
    }
    while($t<$iletypow);
    ?></select>
                        </div> </div>
                    
                    <div class="row"><div class="col-md-6">
             
                    </div> 
                        <div class="col-md-6">
                           <select class="mdb-select" multiple name="rodzaje[]"> 
                               <option value="" disabled>wybierz rodzaje studiów</option>   
                                <?php
    $r=0;
    do {
        $forma=mysqli_fetch_array($formy);
        echo "<option>$forma[0]</option>";
        $r=$r+1;
    }
    while($r<$ileform);
    ?></select>
                           </div>
                        
                        </div>
      <div class="row">
<div class="col-md-6">
    <select class="mdb-select" multiple name="tytuly[]"> 
                               <option value="" disabled>wybierz tytuły zawodowe</option> 
                               <?php
                               $t=0;
                               do {
                                   $tytul=mysqli_fetch_array($tytuly);
                                   echo "<option>$tytul[0]</option>";
                                   $t=$t+1;
                               }
                               while($t<$iletytulow);
                               ?>
    </select>
</div>
        <!--<div class="col-md-6">
              <div class="form-check">
  <input type="radio" name="obywatelstwo" class="form-check-input" id="material1" VALUE="*"  checked>
  <label class="form-check-label" for="material1">Wszystkie obywatelstwa</label>
</div>
              <div class="form-check">
  <input type="radio" name="obywatelstwo" class="form-check-input" id="material2" VALUE="PL">
  <label class="form-check-label" for="material2">Tylko PL</label></div>
  <div class="form-check">
  <input type="radio" name="obywatelstwo" class="form-check-input" id="material3" VALUE="FOREIGNER">
  <label class="form-check-label" for="material3">Tylko Obcokrajowcy</label>
</div>
          </div>-->
      </div>          
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button type="submit" onclick="spinner()" class="btn btn-primary">Pokaż</button>
            </div></form>
        </div>
    </div>
</div>
    

