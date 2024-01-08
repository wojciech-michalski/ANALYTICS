
<!-- Modal -->
<div class="modal fade" id="wystAnkModal" tabindex="-1" role="dialog" aria-labelledby="wystAnkModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document"> 
       <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wystAnkModalModalLabel">Wystawianie ankiety</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Ankiety zdefiniowane</h5><div class="md-form">
                <form method="POST" action="main.php?mode=surveyprepare">
                    <select class="mdb-select" name="ankieta" id="a1" required>
                        
                        <option value="ocena_administracji2">Ocena pracy administracji</option>
                        <option value="ocena_pracy_nauczyciela">Ocena pracy nauczyciela akademickiego</option>
                        <option value="ocena_nakladu_pracy_studenta">Ocena nakładu pracy studenta</option>
                        <option value="ocena_praktyk_zawodowych">Ocena praktyk zawodowych</option>
                         
                    </select><label for="a1">Wybierz predefiniowaną ankietę</label>
                    <select class="mdb-select" name="rok_akademicki" id="a2">
                        <?php $rok=date('Y');
                            do {
                                echo "<option>$rok / ".$rok+1 ."</option>";
                                echo "<option>".$rok-1 ."/".$rok."</option>";
                                $rok--;
                            }
                         while($rok>2020);
                         ?>
                    </select><label for="a2">Wybierz rok akademicki</label>
                    <select class="mdb-select" name="semestrZL" id="a3">
                        <option value="Z">Zimowy</option>
                        <option value="L">Letni</option>
                    </select><label for="a3">Wybierz rodzaj semestru</label>
                    <button type="submit" class="btn btn-info">Przygotuj</button>
                </form></div>
                <hr/>
               <!-- <a class="button btn btn-success" href="main.php?mode=surveycreator">Kreator nowej ankiety</a>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                
            </div>
        </div>
    </div>
</div>
    

