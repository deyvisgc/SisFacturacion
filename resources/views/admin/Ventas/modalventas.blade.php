<div class="modal fade" id="modalPagarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frm" action="{{url('Pagar')}}">
                <div class="modal-header custom-modal-title">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white">PAGO EFECTIVO CLIENTE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">TOTAL</label>
                                <input type="text" class="form-control" readonly id="totalapagarcliente" name="totalapagar" placeholder="Boston">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-5" class="control-label">MONTO</label>
                                <input type="text" name="monto" class="form-control" id="montocliente" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-6" class="control-label">VUELTO</label>
                                <input type="text" class="form-control" name="vuelto" readonly id="vueltocliente" value="0.00">
                                <input type="text" hidden class="form-control" name="idprovepagar" readonly id="idprovepagar">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-6" class="control-label">TELEFONO</label>
                                <input type="text" class="form-control" name="telefono_clie"  id="telefono_clien" placeholder="Escriba aqui....">
                                <span class="text-warning">opcional</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-6" class="control-label">CORREO ELECTRONICO </label>
                                <input type="text" class="form-control" placeholder="Escriba aqui...." name="correo_electr_cli"  id="correo_electr_cli">
                                <span class="text-warning">opcional</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="btnmodal" type="button"  class="btn btn-danger waves-effect waves-light mb-2 mr-2"  data-dismiss="modal">Cerrar</button>
                    <button id="btnpagarcliente" type="button"  class="btn btn-success waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-square-inc-cash mr-1"></i>Pagar</button>

                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalPagarProveedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frm" action="{{url('Pagar')}}">
                <div class="modal-header custom-modal-title">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white">PAGO EFECTIVO PROVEEDOR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">TOTAL</label>
                                <input type="text" class="form-control" readonly id="totalapagarproveedor" name="totalapagar" placeholder="Boston">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-5" class="control-label">MONTO</label>
                                <input type="text" name="monto" class="form-control" id="montoproveedor" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-6" class="control-label">VUELTO</label>
                                <input type="text" class="form-control" name="vuelto" readonly id="vueltoproveedor" value="0.00">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-6" class="control-label">TELEFONO</label>
                                <input type="text" class="form-control" name="telefono_empre"  id="telefono_empre" placeholder="Escriba aqui....">
                                <span class="text-warning">opcional</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-6" class="control-label">CORREO ELECTRONICO </label>
                                <input type="text" class="form-control" placeholder="Escriba aqui...." name="correo_electr_empre"  id="correo_electr_empre">
                                <span class="text-warning">opcional</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="btnmodal" type="button"  class="btn btn-danger waves-effect waves-light mb-2 mr-2"  data-dismiss="modal">Cerrar</button>
                    <button id="btnpagarproveedor" type="button"  class="btn btn-success waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-square-inc-cash mr-1"></i>Pagar</button>
                    <button class="btn btn-primary" type="button" id="btncargando" disabled="">
                        <span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>
                        Cargando...
                    </button>

                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalPagarnormal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="frm" action="{{url('Pagar')}}">
                <div class="modal-header custom-modal-title">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: white">PAGO EFECTIVO </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-4" class="control-label">TOTAL</label>
                                <input type="text" class="form-control" readonly id="totalapagarventanormal" name="totalapagar" placeholder="Boston">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-5" class="control-label">MONTO</label>
                                <input type="text" name="monto" class="form-control" id="montoventanormal" placeholder="0.00">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="field-6" class="control-label">VUELTO</label>
                                <input type="text" class="form-control" name="vuelto" readonly id="vueltoventanormal" value="0.00">
                                <input type="text" hidden class="form-control" name="idprovepagar" readonly id="idprovepagar">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button id="btnmodal" type="button"  class="btn btn-danger waves-effect waves-light mb-2 mr-2"  data-dismiss="modal">Cerrar</button>
                    <button id="btnpagarventasnormales" type="button"  class="btn btn-success waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-square-inc-cash mr-1"></i>Pagar</button>
                </div>
            </form>
        </div>
    </div>
</div>
