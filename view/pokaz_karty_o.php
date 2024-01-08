<?php
//include('controller/U10_Przynaleznosci.php');
//include('controller/statusyANALYTICS.php');
//include('controller/karta_obciazen.php');
$karty_zatwierdzone=mysqli_query($kon,"SELECT * FROM `karty_obciazen_w` WHERE `wydzial`=2 GROUP BY `wykladowca_nazwisko`,`rok_akademicki`,`semestr_ZL`");
   
     
 
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
            <span>Karty obciążeń</span> <span>/</span>
            <span>Karty zatwierdzone</span> <span>/</span> <span>Wydział IIZ</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
       <table id="dtMaterialDesignExample" class="table table-striped table-condensed" cellspacing="0" width="90%" >
           <thead><tr>
                   <th>L.P.</th>
                   <th>Wykładowca</th>
                   <th>Rok akademicki i semestr</th>
                   <th>Działania</th>
                   
               </tr>
           </thead>
           <?php $kn=1;
           foreach($karty_zatwierdzone as $karta){
               switch($karta['semestr_ZL']){
                   case 1:
                       $semZL="Letni";
                       break;
                   case 0:
                       $semZL="Zimowy";
                       break;
               }
               $rokA=$karta['rok_akademicki']."/".$karta['rok_akademicki']+1;
               ?>
           <tr><td><?php echo $kn;?></td>
               <td><?php echo $karta['wykladowca_tytul']." ".$karta['wykladowca_imie']." ".$karta['wykladowca_nazwisko'];?></td>
               <td><?php echo $rokA." ".$semZL;?></td>
               <td><form method="POST" action="main.php?mode=koI"><input type="hidden" name="rok_akademicki" 
                          value="<?php echo $karta['rok_akademicki'];?>"/>
                   <input type="hidden" name="semestr_ZL" 
                          value="<?php echo $karta['semestr_ZL'];?>"/>
                    <input type="hidden" name="wykladowca" 
                          value="<?php echo "$karta[wykladowca_nazwisko];;$karta[wykladowca_imie]";?>"/>
                    <button type="submit" class="btn btn-indigo">Pokaż kartę</button></form>
                   <?php  
                 
                 $pesel=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT OS_PESEL FROM OSOBA WHERE OS_IMIE_I='$karta[wykladowca_imie]' AND OS_NAZWISKO='$karta[wykladowca_nazwisko]' AND OS_PESEL IS NOT NULL"));
                 //echo "SELECT `id` FROM `rachunki` WHERE `pesel`='$pesel[0]' AND `data`>'$karta[rok_akademicki]'";
                    if(mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `rachunki` WHERE `pesel`='$pesel[0]' AND `data`>'$karta[rok_akademicki]'"))>0){
                 ?>
                   <form id="rach" method="POST" action="main.php?mode=invI">
    <input type="hidden" name="semestr_ZL" value="<?php echo $karta['semestr_ZL'];?>">
    <input type="hidden" name="rok_akademicki" value="<?php echo $karta['rok_akademicki'];?>">
    <input type="hidden" name="wykladowca_imie" value="<?php echo $karta['wykladowca_imie'];?>">
    <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $karta['wykladowca_nazwisko'];?>">
    <input type="hidden" name="wydzial" value="2">
    <button type="submit" class="btn btn-info" style="width:10rem;">Rachunki</button></form>
</form>
                    <?php }
                    else echo "";
                    ?>
               </td>
           </tr>
           <?php
           $kn++;
           }
        ?>
       </table>
    </div>
          </div>
          <!--/.Card-->
     </div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        
       
       
    <?php //include('view/filtr_Modal.php');?>
      <?php include('view/footer.php');?>

  
  
 
</body>

</html>

