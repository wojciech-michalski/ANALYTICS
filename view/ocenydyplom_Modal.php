<div class="modal fade" id="ocenydyplomModal" tabindex="-1" role="dialog" aria-labelledby="ocdypModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"><form method="POST" action="main.php?mode=deanreport2">
            <div class="modal-header">
                <h5 class="modal-title" id="ocdypModalLabel1">Wprowadź dane do filtra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<div class="md-form">
    <select class="mdb-select" name="RA">
    <option value="" disabled selected>Wybierz rok akademicki</option>
    <?php 
    $rokstart=2015;
    do {
        echo "<option value=\"$rokstart\">".$rokstart."/".$rokstart+1 ."</option>";
        $rokstart=$rokstart+1;
    }
    while($rokstart<date('Y'));
    ?>
   
</select>

                    </div>
 
              
                    
                
           
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button type="submit" onclick="spinner()" class="btn btn-primary spinnerek">Pokaż zestawienie</button>
            </div>
        </div></form>
    </div>
    </div>
</div>

