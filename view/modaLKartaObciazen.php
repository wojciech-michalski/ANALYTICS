<div class="modal fade" id="modaLKartaObciazen" tabindex="-1" role="dialog" aria-labelledby="exampleKO" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"><form method="POST"action="main.php?mode=koA">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleKO">Filtr dla Karty Obciążeń Architektura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                   <select class="mdb-select md-form" name="rok_akademicki">
<?php $la=mysqli_query($kon,"SELECT DISTINCT `rok_akademicki` FROM `karta_obciazen` WHERE 1");
foreach($la as $rok_a){
   echo "<option value=\"$rok_a[rok_akademicki]\">$rok_a[rok_akademicki]/".$rok_a['rok_akademicki']+1 ."</option>";
}
  ?>
    
                   </select><label class="mdb-main-label">Rok akademicki</label>
                         <select class="mdb-select md-form" name="semestr_ZL">

  <option value="0">zimowy</option>
    <option value="1">letni</option>
                   </select><label class="mdb-main-label">Semestr</label>
             <select class="mdb-select md-form" searchable="szukaj.." name="wykladowca">       
                 
                 <?php $wykladowcy=mysqli_query($kon,"SELECT `wykladowca_nazwisko`,`wykladowca_imie` FROM `karta_obciazen`"
                         . " WHERE 1 GROUP BY `wykladowca_nazwisko`,`wykladowca_imie` ORDER BY  `wykladowca_nazwisko` ASC");
                 foreach($wykladowcy as $wykladowca){
                     echo "<option value=\"$wykladowca[wykladowca_nazwisko];;$wykladowca[wykladowca_imie]\">"
                             . "$wykladowca[wykladowca_nazwisko] $wykladowca[wykladowca_imie]<option>";
                 }
                 ?>
             </select><label class="mdb-main-label">Wykładowca</label>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button type="submit" class="btn btn-primary">Pokaż</button>
            </div>
        </div></form>
    </div>
</div>



