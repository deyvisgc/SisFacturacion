@extends('partials.layout')
@section('contenido')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">PRODUCTO</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div>
                            <button type="button" id="modalProducto" class="btn btn-outline-success waves-effect waves-light">AGREGAR</button>
                        </div><br><br>
                        <table class="table table-centered mb-0 tbproductos">
                            <thead class="thead-light">
                            <tr>
                                <th style="width: 20px;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th>Producto</th>
                                <th>Categoria</th>
                                <th>Stock</th>
                                <th>Precio Venta</th>
                                <th>Precio Compra</th>
                                <th>Foto</th>
                                <th>Estado</th>
                                <th style="width: 125px;">Acciones</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    @include('admin.almacen.producto.add')
@endsection
@section('script')
    <script src="{{asset("js/Almacen/producto.js")}}"></script>
    <script>
        var url = '{{url('admin/alamacen/producto/')}}';
    </script>
@endsection
