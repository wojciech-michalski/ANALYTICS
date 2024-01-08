<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nowy użytkownik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="/core/useradd.php">
                   
    <div class="md-form">
        <i class="fa fa-user prefix grey-text"></i>
        <input type="text" id="orangeForm-name" class="form-control" name="user">
        <label for="orangeForm-name">Nazwa użytkownika</label>
    </div>
    <div class="md-form">
        <i class="fa fa-envelope prefix grey-text"></i>
        <input type="text" id="orangeForm-email" class="form-control" name="email">
        <label for="orangeForm-email">email</label>
    </div>

    <div class="md-form">
        <i class="fa fa-lock prefix grey-text"></i>
        <input type="password" id="orangeForm-pass" class="form-control" name="haslo">
        <label for="orangeForm-pass">hasło</label>
    </div>

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

