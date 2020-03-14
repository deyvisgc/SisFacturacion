@extends('partials.layout')
@section('contenido')
    <style>
        #toast-container >
        .toast-error {
            background-image: none;
            background-color: #ee324d;
        }
        #toast-container >
        .toast-warning {
            background-image: none;
            background-color: #d17905;
        }
        #toast-container >
        .toast-success {
            background-image: none;
            background-color: #1d643b;
        }

    </style>
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Escritorio</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Administracion</a></li>
                                <li class="breadcrumb-item active">Usuario</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Bandeja de Usuarios</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-lg-7">
                                    <form class="form-inline">
                                        <div class="form-group mb-2">
                                            <label for="inputPassword2" class="sr-only">Search</label>
                                            <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                                        </div>
                                        <div class="form-group mx-sm-3 mb-2">
                                            <label for="status-select" class="mr-2">Status</label>
                                            <select class="custom-select" id="status-select">
                                                <option selected="">Choose...</option>
                                                <option value="1">Paid</option>
                                                <option value="2">Awaiting Authorization</option>
                                                <option value="3">Payment failed</option>
                                                <option value="4">Cash On Delivery</option>
                                                <option value="5">Fulfilled</option>
                                                <option value="6">Unfulfilled</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-5">
                                    <div class="text-lg-right">
                                        <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2"><i class="mdi mdi-basket mr-1"></i>Buscar Por Fechas</button>
                                        <button type="button"  class="btn btn-outline-success waves-effect mb-2" id="regis"><i class="mdi mdi-plus mr-1"></i> Nuevo Usuario</button>
                                    </div>
                                </div><!-- end col-->
                            </div>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 tbusuarios">
                                    <thead class="thead-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Rol</th>
                                        <th>Telefono</th>
                                        <th>Dni</th>
                                        <th>Foto</th>
                                        <th style="width: 125px;">Acciones</th>
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
            <!-- end row -->

        </div> <!-- container -->
    </div>
    @include('admin.Administracion.modal')
@endsection
@section('script')
    <link href="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/css/datepicker3.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.it.js"></script>
    <script src="{{asset('js/administracion/usuarios.js')}}"></script>

    <script>
        var asset = '{{asset('Imagenes/Usuarios/')}}/'
    </script>



@endsection
