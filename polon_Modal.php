<div class="modal fade" id="polonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"><form method="POST" action="/core/polon.php">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Wprowadź dane do filtra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
   <div class="row">
       <div class="col-md-6">
                    <div class="md-form">
    <input placeholder="Wybrana data" type="text" id="date-picker-example" class="form-control datepicker" 
           name="data" required>
    <label for="date-picker-example">Data</label>
                    </div> </div>
       <div class="col-md-6">
         <select class="mdb-select" name="kierunki" required>
    <option value="" selected disabled >wybierz kierunki</option>
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
                         <select class="mdb-select"  name="typy" required>
    <option value="" selected disabled >wybierz typy studiów</option>   
    <?php
    $t=0;
    do {
        $typ=mysqli_fetch_array($typy);
        echo "<option>$typ[0]</option>";
        $t=$t+1;
    }
    while($t<$iletypow);
    ?></select>
                        </div> <div class="col-md-6">
                           <select class="mdb-select"  name="rodzaje" required> 
                               <option value="" selected disabled >wybierz rodzaje studiów</option>   
                                <?php
    $r=0;
    do {
        $forma=mysqli_fetch_array($formy);
        echo "<option>$forma[0]</option>";
        $r=$r+1;
    }
    while($r<$ileform);
    ?></select>
                           </div></div>
                    
                   <div class="row">
                                              
                          <div class="col-md-6">
                           <select class="mdb-select" name="tytuly" required>  
                               <option value="" selected disabled >wybierz tytuły zawodowe</option>  
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
                       <div class="col-md-6">
                            <select class="mdb-select" name="profile" required>  
                               <option value="" selected disabled >wybierz profil studiów</option>  
                               <?php
                               $p=0;
                               do {
                                  $profil=mysqli_fetch_array($profile);
                                   echo "<option>$profil[0]</option>";
                                   $p=$p+1;  
                               }
                               while($p<$ileprofili);
                              ?>
                           </select>
                        </div> 
                
            </div>
                <div class="row">
                 <div class="form-group col-md-6">
     <select class="mdb-select" name="obc" required>  
                               <option value="PL" selected>Polacy</option>  
                               <option value="OBC">Obcokrajowcy</option> 
     </select>
</div>   <div class="form-group col-md-6">
     <select class="mdb-select" name="rokaka" required>  
                               <option value="<?php echo date('Y');?>" ><?php echo date('Y')-1;?></option>
                               <option value="<?php echo date('Y');?>" selected><?php echo date('Y');?></option> 
                               <option value="<?php echo date('Y');?>" ><?php echo date('Y')+1;?></option>
                               
     </select>
</div>   
              
                </div>
            <div class="modal-footer">
                <a href="main.php?mode=PAPI"><button type="button" class="btn btn-indigo" >Parametry POLON API</button></a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button type="submit" class="btn btn-primary">Generuj xml</button>
            </div></form>
        </div>
    </div>
</div>
</div>
