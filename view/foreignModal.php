<div class="modal fade" id="foreignModal" tabindex="-1" role="dialog" aria-labelledby="foreignModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"><form method="POST" action="main.php?mode=foreigners">
            <div class="modal-header">
                <h5 class="modal-title" id="foreignModalLabel1">Wprowadź dane do filtra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
<div class="md-form">
    <input placeholder="Stan na dzień" type="text" id="date-picker-example" class="form-control datepicker" name="data1">
    <label for="date-picker-example">Stan na dzień</label>
                    </div>
 <select class="mdb-select md-form" name="wydzial">
  <option value="" disabled selected>Wybierz wydział</option>
  <option value="1">Wydział Architektury</option>
  <option value="2">Wydział Inżynierii i Zarządzania</option>
  
</select>
              
                    
                
           
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button type="submit" class="btn btn-primary">Pokaż zestawienie Cudzoziemców</button>
            </div></form>
        </div>
    </div>
    </div>
</div>

