<div class="modal fade" id="modalSzykujKartaObciazen" tabindex="-1" role="dialog" aria-labelledby="exampleKOP" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"><form method="POST" action="main.php?mode=ko">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleKOP">Przygotowanie kart obciążeń</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                   <select class="mdb-select md-form" name="rok_akademicki">
   <option value="2021">2021/22</option>                    
  <option value="2022">2022/23</option>
  <option value="2023">2023/24</option>  
                   </select><label class="mdb-main-label">Rok akademicki</label>
                         <select class="mdb-select md-form" name="semestr_ZL">

  <option value="0">zimowy</option>
    <option value="1">letni</option>
                   </select><label class="mdb-main-label">Semestr</label>
        
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                <button type="submit" class="btn btn-primary">Przygotuj</button>
            </div>
        </form></div>
    </div>
</div>



