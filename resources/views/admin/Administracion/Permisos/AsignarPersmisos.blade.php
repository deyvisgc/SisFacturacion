@extends('partials.layout')
@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">

                    <h4 class="page-title">REGISTRO DE PERMISOS</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <!-- Portlet card -->
                <div class="card">
                    <div class="card-header bg-blue py-3 text-white">
                        <div class="card-widgets">
                            <a href="javascript:;" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                            <a data-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                            <a href="#" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                        </div>
                        <h5 class="card-title mb-0 text-white">Asignar Permisos</h5>
                    </div>
                    <div id="cardCollpase5" class="collapse show">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-lg-12">
                                    <form class="form-inline">
                                        <div class="row col-lg-3" >
                                            <label for="status-select" class="mr-2 text-lg-center">ROL</label>
                                            <div class="dropdown bootstrap-select">
                                                <select class="selectpicker" id="rol" name="rol" data-live-search="true" data-style="btn-info" tabindex="-98">
                                                    <option  selected="">Choose...</option>
                                                    @foreach($rol as $r)
                                                        <option value="{{$r->id_rol}}">{{$r->nombre_rol}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row col-lg-3" style="margin-left: 20px" >
                                            <label for="status-select" class="mr-2  text-lg-center">GRUPO</label>
                                            <div class="dropdown bootstrap-select">
                                                <select class="selectpicker" id="idpadre" name="idpadre" data-live-search="true" data-style="btn-warning" tabindex="-98">
                                                    <option  selected="">Escoger...</option>
                                                    @foreach($privipadre as $pri)
                                                        <option value="{{$pri->id_Privilegios}}">{{$pri->nombre_Privi}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row col-lg-4" style="margin-left: 20px">
                                            <div class="dropdown bootstrap-select show-tick">
                                                <label for="status-select" class="mr-2">PRIVILEGIOS</label>
                                                <select class="selectpicker" id="privi" style="width: 50px" multiple="" data-live-search="true"data-live-search="true" data-style="btn-danger" tabindex="-98">

                                                </select>
                                            </div>
                                        </div><br><hr>
                                        <div class="row col-lg-2" >
                                            <div class="dropdown bootstrap-select show-tick">
                                                <button type="button" STYLE="margin-left: 10px;margin-top: 35px"   class="btn btn-outline-success waves-effect mb-2 " id="regispermisos">GUARDAR</button>
                                            </div>
                                        </div>


                                    </form><br><br>
                                    <div class="table-responsive">
                                        <table class="table table-centered table-borderless mb-0" id="tbpermisos">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>NOMBRE</th>
                                                <th>GRUPO</th>
                                                <th>ROL</th>
                                                <th>ESTADO</th>
                                                <th>ACCIONES</th>
                                            </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>
                                    </div> <!-- .table-responsive -->
                                </div>

                            </div>
                        </div>

                    </div>

                </div> <!-- end card-->
            </div><!-- end col -->
        </div>

    </div>

@endsection
@section('script')
    <link href="{{asset('css/alertjs.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/multiselect/multi-select.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('js/administracion/permisos.js')}}"></script>
    <script src="{{asset('assets/libs/multiselect/jquery.multi-select.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script>
        var url = '{{url('Permisos')}}'
        var url1 = '{{url('PriviRol')}}'
        var urldelete = '{{url('delete')}}'
    </script>



@endsection

