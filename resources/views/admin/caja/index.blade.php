@extends('partials.layout')
@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                    </ol>
                </div>
                <h4 class="page-title">CAJA</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div align="center">
                        <button type="button" id="modalCategoria" class="btn btn-outline-success waves-effect waves-light">AGREGAR</button>
                    </div>

                    <table id="example" class="table table-striped dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Abierta</th>
                            <th>Monto Inicial</th>
                            <th>Monto Final</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>


                        <tbody>

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    @include('admin.caja.add')
@endsection
@section('script')
<script src="{{asset("js/Movimiento/caja.js")}}"></script>
@endsection
