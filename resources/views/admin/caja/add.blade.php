<div class="modal fade bd-example-modal-lg" id="modalAddCategoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Nueva Caja</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation formaddcategoria"  >
                    {{ csrf_field() }}
                    <input type="hidden" id="idCaja" name="idCaja">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label >Codigo Caja</label>
                                <input class="form-control caj_codigo" name="caj_codigo" type="text" autocomplete="off" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label >Descripcion</label>
                                <input class="form-control caj_descripcion" name="caj_descripcion" type="text" autocomplete="off" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <label >Abierta</label>
                                <input class="form-control caj_abierta" name="caj_abierta" type="text" autocomplete="off" >
                            </div>
                        </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label >Monto Inicial</label>
                            <input class="form-control monto_Caja_Inicial" name="monto_Caja_Inicial" type="text" autocomplete="off" >
                        </div>
                        <div class="col-md-4 mb-3">
                            <label >Monto Final</label>
                            <input class="form-control Monto_Caja_final" name="Monto_Caja_final" type="text" autocomplete="off" >
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="usuarios_idusuarios">Usuario</label>
                            <select class="selectpicker" data-live-search="true" name="usuarios_idusuarios" id="usuarios_idusuarios"   data-width="100%">
                                <option data-tokens="ketchup mustard" value="" disabled selected>Seleccionar</option>
                                @foreach($user as $row)
                                    <option value="{{$row->idusuarios}}" >{{$row->usuario}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="rg_addCategoria" value="{{url('admin/caja/AddCaja')}}">
                    <input type="hidden"  id="rg_lisCategoria" value="{{url('admin/caja/listarCaja')}}"/>
                    <input type="hidden"  id="rg_getCategoria" value="{{url('admin/caja/getCaja')}}"/>
                    <input type="hidden"  id="rg_updateCategoria" value="{{url('admin/caja/updateCaja')}}"/>
                    <input type="hidden"  id="rg_Eliminar" value="{{url('admin/caja/eliminarcaja')}}"/>
                    <input type="hidden"  id="rg_estadoInactivo" value="{{url('admin/caja/estadoInactivoCaja')}}"/>
                    <input type="hidden"  id="rg_estadoActivo" value="{{url('admin/caja/estadoActivoCaja')}}"/>
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
