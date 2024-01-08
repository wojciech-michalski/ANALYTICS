<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nowa grupa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/core/groupadd.php">
                   
    <div class="md-form">
        <i class="fa fa-user prefix grey-text"></i>
        <input type="text" id="orangeForm-name" class="form-control" name="group">
        <label for="orangeForm-name">Nazwa grupy</label>
    </div>
    <div class="md-form" style="margin-bottom:30%;">
        <select class="mdb-select" multiple name="modules[]">
    <option value="" disabled selected>Uprawnienia do modułów</option>
    <option value="ALL">Wszystkie</option>
    <option value="Students">Dane o studentach</option>
    <option value="Didactics">Rozliczenie dydaktyki</option>
    <option value="Surveys">Ankiety</option>
    <option value="Admin">Administrator</option> </select>
<label>Wybierz jeden, lub więcej modułów</label>
       
    </div>

    <hr/>

    <div class="text-center">
        <button class="btn btn-deep-orange">Zapisz</button>
    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

