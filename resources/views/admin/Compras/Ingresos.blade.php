@extends('partials.layout')
@section('contenido')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
                <h4 class="page-title">Compras <i class="mdi mdi-basket text-warning  mr-1" style=" width:10px; height:20px;"></i></h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-8">
                            <ul class="nav nav-tabs nav-bordered">
                                <li class="nav-item">
                                    <a href="#home-b1" data-toggle="tab" aria-expanded="false" class="nav-link"> <i class="mdi mdi-account-circle"></i>
                                        Proveedores del Sistema
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#profile-b1" data-toggle="tab" aria-expanded="true" class="nav-link">
                                        Proveedores Nuevos
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home-b1">
                                    <form action="{{url('AddCarrito')}}" id="frmaddcarrito">
                                        <div class="form-row">
                                            <div class="form-group col-md-6" >
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-primary waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Producto</button>
                                                    </div>
                                                    <input type="text" class="form-control" id="searchproducto" placeholder="Buscar" aria-label="Username" onkeyup="validar()" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                                </div>
                                                <input  class="form-control" id="rutapro" hidden value="{{url('Buscar/Producto')}}" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-label="" aria-describedby="basic-addon1">
                                                <input  class="form-control" id="idprod" hidden  aria-describedby="basic-addon1">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-primary waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cantidad</button>
                                                    </div>
                                                    <input type="text" class="form-control" id="cantidad_pro" placeholder="0" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-label="" aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-primary waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Precio</button>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0.00" aria-label="Username" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-primary waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Proveedor</button>
                                                    </div>
                                                    <input type="text" class="form-control" id="searchproveedor" placeholder="Buscar por Ruc" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-label="" aria-describedby="basic-addon1" onkeyup="validar()">
                                                    <input  class="form-control" id="rutaProve" hidden value="{{url('Buscar/Proveedor')}}" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-label="" aria-describedby="basic-addon1">

                                                </div>
                                            </div>
                                            <input type="text" class="form-control"  id="idprove"hidden placeholder="Escribir....." aria-label="Username" readonly style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
<input id="pruebahola" value="{{url('getcarrito')}}" hidden>
                                            <div class="text-lg-center" style="margin-left: 25%">
                                                <button type="button" id="addcarrito" class="btn btn-success waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-basket mr-1"></i>Agregar Al carrito</button>
                                                <input type="hidden" id="rutaaddcarr" value="{{url('AddCarrito')}}">
                                                <input type="hidden" id="rutagetcarr" value="{{url('getcarrito')}}/">
                                                <input type="hidden" id="rutagetcar" value="{{url('getcarr')}}">
                                                <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-delete mr-1"></i>Limpiar Campos</button>

                                            </div>
                                        </div>
                                    </form>
                                    <div class="table-responsive">
                                        <table class="table table-centered mb-0" id="tablecar">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio
                                                <th>Subtotal</th>
                                                <th>Importe</th>
                                                <th style="width: 125px;">Accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane show" id="profile-b1">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Producto</button>
                                                </div>
                                                <input type="text" class="form-control" id="searchproducto" placeholder="Buscar" aria-label="Username" onkeyup="validar()" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                            </div>
                                            <input  class="form-control" id="rutapro" hidden value="{{url('Buscar/Producto')}}" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-label="" aria-describedby="basic-addon1">
                                            <input  class="form-control" id="idprod" hidden  aria-describedby="basic-addon1">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cantidad</button>
                                                </div>
                                                <input type="text" class="form-control" id="searchproducto" placeholder="0" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-label="" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Precio</button>
                                                </div>
                                                <input type="text" class="form-control" placeholder="0.00" aria-label="Username" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Proveedor</button>
                                                </div>
                                                <input type="text" class="form-control" id="searchproveedor" placeholder="Buscar por Ruc" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-label="" aria-describedby="basic-addon1" onkeyup="validar()">
                                                <input  class="form-control" id="rutaProve" hidden value="{{url('Buscar/Proveedor')}}" style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-label="" aria-describedby="basic-addon1">

                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary waves-effect waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Razon Social</button>
                                                </div>
                                                <input type="text" class="form-control" id="razonsocial" placeholder="Escribir....." aria-label="Username" readonly style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <input type="text" class="form-control"  id="idprove"hidden placeholder="Escribir....." aria-label="Username" readonly style='font-size: 12pt; font-weight: bold; color: #0000ff;' aria-describedby="basic-addon1">

                                        <div class="text-lg-center" style="margin-left: 25%">
                                            <button type="button" class="btn btn-success waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-basket mr-1"></i>Agregar Al carrito</button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-delete mr-1"></i>Limpiar Campos</button>

                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-centered mb-0">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio</th>
                                                <th>Vuelto</th>
                                                <th>Importe</th>
                                                <th>Subtotal</th>
                                                <th style="width: 125px;">accion</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header bg-blue py-3 text-white">
                                    <div class="card-widgets">
                                        <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                        <a data-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="true" aria-controls="cardCollpase2" class=""><i class="mdi mdi-minus"></i></a>
                                    </div>
                                    <h1 class="card-title mb-0 text-white"style="text-align: center">S/ 120.00</h1>
                                </div>
                                <div id="cardCollpase5" class="collapse show" style="">
                                    <div class="card-body">
                                        <div class="col-lg-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <strong><label for="inputEmail4" class="col-form-label" style="color: black">DOCUMENTO</label></strong>
                                                    <select class="custom-select" id="status-select" autocomplete="true">
                                                        <option selected="">Choose...</option>
                                                        <option value="1">Factura</option>
                                                        <option value="2">Boleta</option>
                                                        <option value="3">Ticket</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <strong><label for="inputPassword4" class="col-form-label" style="color: black">Tipo Pago</label></strong>
                                                    <select class="custom-select" id="status-select" autocomplete="true">
                                                        <option selected="">Choose...</option>
                                                        <option value="1">Credito</option>
                                                        <option value="2">Debito</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <strong><label for="inputEmail4" class="col-form-label" style="color: black">Serie</label></strong>
                                                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">

                                                </div>
                                                <div class="form-group col-md-4">
                                                    <strong><label for="inputPassword4" class="col-form-label" style="color: black">N° Venta</label></strong>
                                                    <input type="number" class="form-control" id="inputAddress" placeholder="0">

                                                </div>
                                            </div>
                                            <hr class="new1" style="border-top: 1px solid black;width: 100%">
                                            <div class="float-left">
                                                <p><b>Sub-total:</b> <span class="float-right">$4597.50</span></p>
                                                <p><b>IGV (18%):</b> <span class="float-right"> &nbsp;&nbsp;&nbsp; $459.75</span></p>
                                                <p><b>Total:</b> <span class="float-right">$4597.50</span></p>
                                            </div>
                                            <button type="button" style="margin-left: 25%" class="btn btn-success waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-basket mr-1"></i>Comprar</button>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div><!-- end col-->
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
@endsection
@section('script')
    <script src="{{asset('js/Ingresos.js')}}"></script>

@endsection
