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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Basic</li>
                        </ol>
                    </div>
                    <h4 class="page-title">REGISTRO DE ROLES Y PERMISOS</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-5">
                <div class="card-box">
                    <h4 class="header-title">REGISTRAR ROL <button type="button"  class="btn btn-outline-success waves-effect mb-2" id="regis"><i class="mdi mdi-plus mr-1"></i>NEW</button>
                    </h4>
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

            <div class="col-lg-7">
                <div class="card-box">
                    <h4 class="header-title">REGISTRAR PRIVILEGIOS</h4>
                    <p class="sub-header">
                        You can also invert the colors—with light text on dark backgrounds—with <code class="highlighter-rouge">.table-dark</code>.
                    </p>

                    <div class="table-responsive">
                        <table class="table table-dark mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
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
    <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.datepicker-fork/1.3.0/js/locales/bootstrap-datepicker.it.js"></script>
    <script src="{{asset('js/administracion/permisos.js')}}"></script>

    <script>
        var url = '{{url('Permisos')}}'
        var urldelete = '{{url('delete')}}'
    </script>



@endsection

