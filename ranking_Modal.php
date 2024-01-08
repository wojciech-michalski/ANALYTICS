<div class="modal fade" id="rankingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel121" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
       <!--<div class="modal-content"><form method="POST" action="core/ranking_obron.php">-->
               <div class="modal-content"><form method="POST" action="main.php?mode=deanreport3">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel121">Wprowadź dane do filtra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
   <div class="row">
      <div class="col-md-6">
                        <select class="mdb-select"  name="rok_akademicki">
                            <option value="" disabled selected>wybierz rok akademicki</option>
                            <?php
                            $roka=substr($RA,0,4);
                            $rokb=substr($RA,1,3)+1;
                            do {
                                echo "<option>$roka/$rokb</option>";
                                $roka=$roka-1;
                                $rokb=$rokb-1;
                            }
                            while($roka>2010);
                            ?>
                        </select></div>
       <div class="col-md-6">
         <select class="mdb-select" multiple name="kierunki[]">
    <option value="" disabled selected>wybierz kierunki</option>
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
                         <select class="mdb-select" multiple name="typy[]">
    <option value="" disabled selected>wybierz typy studiów</option>   
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
                           <select class="mdb-select"  multiple name="rodzaje[]"> 
                               <option value="" disabled selected>wybierz rodzaje studiów</option>   
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
                           <select class="mdb-select" multiple name="tytuly[]">  
                               <option value="" disabled selected>wybierz tytuły zawodowe</option>  
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
                            <select class="mdb-select" multiple name="profile[]">  
                               <option value="" disabled selected>wybierz profil studiów</option>  
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
                
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button type="submit" onclick="spinner()" class="btn btn-primary">Pokaż ranking</button>
            </div></form>
        </div>
    </div>
    </div></div>

