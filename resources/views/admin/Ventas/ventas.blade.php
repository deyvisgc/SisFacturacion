
@extends('partials.layout')
@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">

                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-8 order-xl-1 order-2">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <form class="form-inline">
                                <div class="form-group mx-sm-3">
                                    <label for="status-select" class="mr-2"><i class="mdi mdi-cart-minus"  style="font-size: 30px;color: #1F7F6B;"></i></label>
                                    <h5>REGISTRO DE VENTAS</h5>
                                </div>
                            </form>
                        </div>
                    </div> <!-- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <ul class="nav nav-tabs nav-bordered">
                                        <li class="nav-item">
                                            <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link"> <i class="mdi mdi-account-circle"></i>
                                                DATOS DEL CLIENTE
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                DETALLE DE VENTAS
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home-b1">
                                            <div class="card">
                                                <i></i> <h5 class="card-header" style="background-color: #2E82C1"><label style="color: #ffffff">Datos del Cliente</label></h5>
                                                <div class="col-xl-12">
                                                    <div class="card-box">
                                                        <ul class="nav nav-pills navtab-bg nav-justified">
                                                            <li class="nav-item">
                                                                <a href="#home1" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                                                    CLIENTES NUEVOS
                                                                </a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a href="#profile1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                                                    CLIENTES DEL SISTEMA
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="home1">
                                                                <div class="card-box mb-2">
                                                                    <div class="row col-md-12">
                                                                        <div class="form-group col-md-4">
                                                                            <label for="example-gridsize" style="color: black">MODO DE VENTA</label>
                                                                            <select class="form-control"  onchange="escogercliente(this.value)">
                                                                                <option selected>Seleccionar</option>
                                                                                <option value="1" >DNI</option>
                                                                                <option value="2" >RUC</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-6" id="dni1" >
                                                                            <label for="example-gridsize" style="color: black" id="dnilabel">DNI</label>
                                                                            <div class="input-group">
                                                                                <input type="text"   maxlength="9" onkeypress="return controltag(event)" class="form-control" id="dni" placeholder="DNI" aria-label="Username" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label for="example-gridsize" style="color: black">Buscar</label>
                                                                            <button class="btn btn-primary my-btn has-spinner" data-style="expand-left" id="bsucardni"><span class="ladda-label">Buscar</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div></button>
                                                                            <button class="ladda-button  btn btn-primary" data-style="expand-left" id="btn1" style="display: none" ><span class="ladda-label">Buscar1</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px"></div></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col-md-12">
                                                                        <div class="form-group col-md-12" id="clie" >
                                                                            <div class="input-group"  id="rucsocial">
                                                                                <div class="input-group-prepend">
                                                                                    <button class="btn btn-primary waves-effect btncliente waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CLIENTE</button>
                                                                                </div>
                                                                                <input type="text" class="form-control" id="cliente"  aria-label="Username" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- end card-box-->
                                                            </div>
                                                            <div class="tab-pane show" id="profile1">
                                                                <div class="card-box mb-2">
                                                                    <div class="row col-md-12">
                                                                        <div class="form-group col-md-4">
                                                                            <label for="example-gridsize" style="color: black">MODO DE VENTA</label>
                                                                            <select class="form-control"  onchange="escogerclientedelsistema(this.value)">
                                                                                <option selected>Seleccionar</option>
                                                                                <option value="1" >DNI</option>
                                                                                <option value="2" >RUC</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-6" id="cli_dni" >
                                                                            <label for="example-gridsize" style="color: black" id="dnilabelsistema">DNI</label>
                                                                            <div class="input-group">
                                                                                <input type="text" class="form-control"  maxlength="8" onkeypress="return controltag(event)" id="dnicliente" placeholder="DNI" aria-label="Username" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-md-2">
                                                                            <label for="example-gridsize" style="color: black">Buscar</label>
                                                                            <button class="ladda-button  btn btn-primary" data-style="expand-left" id="hola" value="1"><span class="ladda-label">Buscar</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px;"></div></button>
                                                                            <button class="ladda-button  btn btn-primary" data-style="expand-left" id="btn1" style="display: none" ><span class="ladda-label">Buscar1</span><span class="ladda-spinner"></span><div class="ladda-progress" style="width: 0px"></div></button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row col-md-12">
                                                                        <div class="form-group col-md-12" id="cliente_sistema" >
                                                                            <div class="input-group"  id="rucsocialcliente">
                                                                                <div class="input-group-prepend">
                                                                                    <button class="btn btn-primary waves-effect btnclientesistema waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CLIENTE</button>
                                                                                </div>
                                                                                <input type="text" class="form-control" id="client_sistema"  aria-label="Username" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div> <!-- end card-box-->
                                                            </div>
                                                        </div>
                                                    </div> <!-- end card-box-->
                                                </div>

                                            </div>
                                        </div>
                                        <div class="tab-pane show" id="profile-b1">
                                            <div class="card">
                                                <h5 class="card-header" style="background-color: #2D6792"><label style="color: #ffffff">Detalle Venta</label></h5>
                                                <div class="card-box mb-2">
                                                    <div class="row align-items-center">
                                                        <div class="form-group col-md-7">
                                                            <label for="example-gridsize" style="color: black" id="dnilabel">PRODUCTO</label>

                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-primary waves-effect btncliente waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">BUSCAR</button>
                                                                </div>
                                                                <input type="text" placeholder="producto"  class="form-control" id="producto"  aria-label="Username" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="example-gridsize" style="color: black" id="dnilabel">CANTIDAD</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control"  id="cantidad" value="1" aria-label="Username" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-3" id="dni1" >
                                                            <label for="example-gridsize" style="color: black" id="dnilabel">PRECIO VENTA</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control" readonly id="precio_venta" placeholder="0.00" aria-label="Username" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>

                                                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100 dataTable no-footer dtr-inline collapsed" id="tablecar">
                                                            <thead class="thead-light">
                                                            <tr>
                                                                <th style="width:30%">Cliente</th>
                                                                <th>Producto</th>
                                                                <th style="width:9%">Cantidad</th>
                                                                <th>Precio Venta</th>
                                                                <th>Subtotal</th>
                                                                <th>Importe</th>
                                                                <th style="width: 125px;">Accion</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div> <!-- end row -->
                                                </div> <!-- end card-box-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- end card-body-->
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-4 order-xl-2 order-1">
            <div class="card-box">

                <div class="media mb-3">
                    <img class="d-flex mr-3 rounded-circle avatar-lg" src="assets/images/users/user-8.jpg" alt="Generic placeholder image">
                    <div class="media-body">
                        <h4 class="mt-0 mb-1">Jade M. Walker</h4>
                        <p class="text-muted">Branch manager</p>
                        <div class="row mt-2">
                            <div class="col-4">
                                <h3 data-plugin="counterup">1,284</h3>
                                <a href="javascript: void(0);" class="btn- btn-xs btn-info" >STOCK</a>
                            </div>
                            <div class="col-4">
                                <h3 data-plugin="counterup" style="margin-left: 15px">2</h3>
                                <a href="javascript: void(0);" class="btn- btn-xs btn-secondary">CAJA</a>
                            </div>
                        </div>
                    </div>
                </div>
              <!---<h5 class="mb-3 mt-4 text-uppercase bg-light p-2"><i class="mdi mdi-account-circle mr-1"></i>Detalle de PAGO</h5>-->
                <div class="card-header  py-3 text-white" style="background-color: black">
                    <div class="card-widgets">
                        <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                        <a data-toggle="collapse" href="#cardCollpase6" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                    </div>
                    <h3 class="card-title mb-0 text-white"  style="text-align: center">S/ <span id="total">0.00</span></h3>
                </div>

                <div id="cardCollpase5" class="collapse show" style="">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <strong><label for="inputEmail4" class="col-form-label" style="color: black">Comprobante</label></strong>
                                    <select class="custom-select"  id="comprobante" autocomplete="true">
                                        <option selected="">Choose...</option>

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <strong><label for="inputPassword4" class="col-form-label" style="color: black">Tipo Pago</label></strong>
                                    <select class="custom-select" id="pagos" autocomplete="true">
                                        <option selected="">Choose...</option>
                                        <option value="1">Credito</option>
                                        <option value="2">Debito</option>
                                        <option value="3">Efectivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <strong><label for="inputEmail4" class="col-form-label" style="color: black">N° Compra</label></strong>
                                    <input type="text" readonly class="form-control" id="n_venta" placeholder="1234 Main St">

                                </div>
                                <div class="form-group col-md-4">
                                    <strong><label for="inputPassword4" class="col-form-label" style="color: black">Serie</label></strong>
                                    <input type="number" class="form-control" id="serie" placeholder="0">
                                </div>
                            </div>
                            <hr class="new1" style="border-top: 1px solid black;width: 100%">
                            <div class="float-left">
                                <p><b>Sub-total:  </b> <span class="float-right" id="subtotal">0.00</span></p>
                                <p><b>IGV (18%):  </b> <span class="float-right" id="Igv" style="margin-left: 5px"> &nbsp;&nbsp;&nbsp;0.00</span></p>
                                <p><b>Total:</b>  <span class="float-right" id="total1">0.00</span></p>
                            </div>
                            <button id="btnmodal" type="button" style="margin-left: 25%" class="btn btn-success waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-basket mr-1"></i>Comprar</button>


                        </div>

                    </div>
                </div>

            </div> <!-- end card-box-->
        </div> <!-- end col -->


    </div>

    @endsection
@section('script')

    <link href="{{asset('css/buttonLoader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('js/Movimiento/ventas.js')}}"></script>
    <script src="{{asset('js/jquery.buttonLoader.js')}}"></script>
    <script>
        var url = '{{url('Ventas')}}';
        var urlbuscar = '{{url('buscardni')}}'
    </script>

    @endsection


