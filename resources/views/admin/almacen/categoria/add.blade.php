<div class="modal fade bd-example-modal-lg" id="modalAddCategoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Nueva Categoria</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation formaddcategoria"  >
                    {{ csrf_field() }}
                    <input type="hidden" id="rg_idcategoria" name="idcategoria">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label >Nombre Categoria</label>
                                <input class="form-control ca_nombre" name="Nombre_Categoria" type="text" autocomplete="off" >
                            </div>
                            <div class="col-md-4 mb-3">
                            </div>
                        </div>
                    <input type="hidden" id="rg_addCategoria" value="{{url('admin/almacen/categoria/AddCategoria')}}">
                    <input type="hidden"  id="rg_lisCategoria" value="{{url('admin/almacen/categoria/listarCategoria')}}"/>
                    <input type="hidden"  id="rg_getCategoria" value="{{url('admin/almacen/categoria/getCategoria')}}"/>
                    <input type="hidden"  id="rg_updateCategoria" value="{{url('admin/almacen/categoria/updateCategoria')}}"/>
                    <input type="hidden"  id="rg_Eliminar" value="{{url('admin/almacen/categoria/eliminar')}}"/>
                    <input type="hidden"  id="rg_estadoInactivo" value="{{url('admin/almacen/categoria/estadoInactivo')}}"/>
                    <input type="hidden"  id="rg_estadoActivo" value="{{url('admin/almacen/categoria/estadoActivo')}}"/>
                    <div class="card-footer">
                        <div  align="center">
                            <button class="btn btn-primary GuardarCategoria" type="button">Guardar</button>
                            <button class="btn btn-primary UpdateCategoria" type="button">Cambiar</button>
                            <input class="btn btn-light" type="reset" value="Borrar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
