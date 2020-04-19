
<div class="modal fade" id="modalnewrol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">NUEVO REGISTRO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="frmrol">
                    <div class="form-group row mb-3">
                        <label for="inputEmail3" class="col-3 col-form-label">NUEVO ROL</label>
                        <div class="col-9">
                            <input type="text" name="rol" class="form-control" id="rol" placeholder="Escriba aqui.....">
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnguardar">GUARDAR</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleterolmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">DELETE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                <a href="#delete"><button type="button" class="btn btn-primary" id="deletemodal">YES</button></a>
            </div>
        </div>
    </div>
</div>
