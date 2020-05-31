@extends('partials.layout')
@section('contenido')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">REGISTRO DE ROLES Y PERMISOS</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-7">
                <div class="card-box">
                    <h4 style="text-align: center" class="header-title">REGISTRAR PRIVILEGIOS</h4>
                    <div class="table-responsive">
                        <h4 class="header-title"><button type="button"  class="btn btn-outline-info waves-effect mb-2" onclick="CrearPrivi(1)">Crear Grupo</button>
                                                  <button type="button"  class="btn btn-outline-warning waves-effect mb-2" onclick="CrearPrivi(2)">Crear Privilegio</button></h4>

                            <table class="table table-dark mb-0" id="tbprivilegio">
                            <thead>
                            <tr>
                                <th>NOMBRE</th>
                                <th>RUTA</th>
                                <th>GRUPO</th>
                                <th>ICON</th>
                                <th>ESTADO</th>
                                <th>OPCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>

                            </tr>

                            </tbody>
                        </table>

                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
            <div class="col-lg-5">
                <div class="card-box">
                    <h4 class="header-title" style="text-align: center" >REGISTRAR ROL</h4>
                    <button type="button"  class="btn btn-outline-success waves-effect mb-2" id="regis">Nuevo</button>
                    <div class="table-responsive">
                        <table class="table mb-0" id="tbrol">
                            <thead>
                            <tr>
                                <th>ROL</th>
                                <th>ESTADO</th>
                                <th>OPCIONES</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->


        </div>
        <!--- end row -->
        @include('admin.Administracion.Permisos.Permisosmodal')
    </div>

@endsection
@section('script')
    <link href="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/css/datepicker3.css" rel="stylesheet"/>
    <link href="{{asset('css/alertjs.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/multiselect/multi-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/libs/multiselect/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.it.js"></script>
    <script src="{{asset('js/administracion/permisos.js')}}"></script>

    <script>
        var url = '{{url('Permisos')}}'
        var url1 = '{{url('PriviRol')}}'
        var urldelete = '{{url('delete')}}'
    </script>



@endsection

