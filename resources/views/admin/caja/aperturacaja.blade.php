@extends('partials.layout')
@section('contenido')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                    <h4 class="page-title">APERTURA Y REPORTES DE CAJA</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-8">
                            <form class="form-inline" id="frmaperturarcaja">
                                <div class="form-group mx-sm-3" id="inputmonto">
                                    <label for="status-select" class="mr-2">MONTO</label>
                                    <input type="search" class="form-control" name="monto" id="monto" placeholder="0.00">
                                </div>

                                <div class="form-group mx-sm-3">
                                    <label for="status-select" class="mr-2">CAJA</label>
                                    <select class="custom-select"  name="caja" id="caja">
                                        <option selected>seleccionar caja</option>
                                        @foreach($caja as $ca)
                                            <option selected value="{{$ca->idCaja}}">{{$ca->caj_descripcion}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <input id="montoapertura" type="hidden">
                        <div class="col-lg-4">
                            <div class="text-lg-right mt-3 mt-lg-0" id="btncaja">
                                <button type="button" class="btn btn-success waves-effect waves-light mb-2 mr-2"onclick="aperturarcaja()" id="aperturarcaja"><i class="mdi mdi-basket mr-1"></i>APERTURAR CAJA</button>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                </div> <!-- end card-box -->
            </div> <!-- end col-->
        </div>
        <!-- end row-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-8">
                                <form class="form-inline">
                                    <div class="form-group mb-6">
                                        <label >SELECCION FECHAS</label>
                                        <input style="margin-left: 10px;width: 250px" type="text"  id="range-datepicker" class="form-control flatpickr-input" placeholder="2018-10-03 to 2018-10-10" readonly="readonly">
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <div class="text-md-right">
                                    <button type="button" class="btn btn-success waves-effect waves-light mb-2 mr-2" onclick="buscar()"><i class="mdi mdi-search-web mr-1"></i>BUSCAR</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-1"><i class="mdi mdi-settings"></i>LINPIAR</button>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <table class="table table-centered table-borderless table-hover mb-0" id="tbcaja">
                                <thead class="thead-light">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                        </div>
                                    </th>
                                    <th>CODIGO CAJA</th>
                                    <th>MONTO APERTURA</th>
                                    <th>MONTO CIERRE</th>
                                    <th>FECHA APERTURA</th>
                                    <th>FECHA CIERRE</th>
                                    <th style="width: 82px;">ACCIONES</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div>
@endsection
@section('script')



    <!-- Init js-->

    <script src="{{asset("js/Movimiento/caja.js")}}"></script>
    <script>
        var url = '{{url('Aperturacaja')}}';
        var url1 = '{{url('Movimiento')}}'
    </script>

@endsection

