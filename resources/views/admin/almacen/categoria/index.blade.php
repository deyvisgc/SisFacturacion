@extends('partials.layout')
@section('contenido')
    <!-- start page title -->
    <div class="row">

    </div><br>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div >
                        <button type="button" id="modalCategoria" class="btn btn-outline-success waves-effect waves-light">AGREGAR</button>
                    </div><br><br>

                    <table id="example" class="table table-striped dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre</th>
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
    @include('admin.almacen.categoria.add')
@endsection
@section('script')
<script src="{{asset("js/Almacen/categoria.js")}}"></script>
@endsection
