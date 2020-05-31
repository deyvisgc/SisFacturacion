<div class="modal fade bd-example-modal-lg" id="modalAddProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Nuevo Producto</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation formaddproducto" id="formaddproducto" accept-charset="multipart/form-data"  >
                    {{ csrf_field() }}
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label >Nombre Producto</label>
                                <input class="form-control pro_nombre" id="pro_nombre" name="pro_nombre" type="text" autocomplete="off" onKeyPress="return SoloNumeros(event);" >
                            </div>
                            <div class="col-md-4 mb-3" id="selectcate">
                                <label>Categoria</label>
                                <select  name="idcategoria" id="pro_categoria" class="form-control pro_Catego" data-width="100%">
                                    <option data-tokens="ketchup mustard" value="" disabled selected>Seleccionar</option>
                                    @foreach($categoriaActivo as $row)
                                        <option value="{{$row->idcategoria}}" selected >{{$row->Nombre_Categoria}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 mb-3">
                                <label >Precio Venta</label>
                                <input class="form-control pro_preventa" id="pro_precio"  name="precio_Venta" type="text" placeholder="" >
                            </div>
                            <div class="col-md-2 mb-3">
                                <label >Precio Compra</label>
                                <input class="form-control pro_precompra" id="pro_precompra"  name="precio_compra" type="text" placeholder="" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label >Codigo</label>
                                <input class="form-control pro_codigo" id="pro_codigo"  name="codigo" type="text" placeholder="" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label >Stock</label>
                                <input class="form-control pro_stock" id="pro_stock"  name="stock" type="text" placeholder="" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label >Modelo</label>
                                <input class="form-control pro_modelo" id="pro_model"   name="modelo" type="text" placeholder="" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label >Imagen</label>
                                <div class="custom-file">
                                    <input type="file" id="pro_imagen" accept="image/*" class="custom-file-input pro_imagen"  name="imagen">
                                    <label class="custom-file-label" for="inputGroupFile04">Escojer Imagen</label>
                                </div><br><br>
                                <img  id="imagenPrevisualizacion" style="width: 100px;align-content: center">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label >Descripcion</label>
                                <textarea class="form-control pro_descripcion" id="pro_descrip" name="descripcion" ></textarea>
                            </div>
                        </div>
                    <input type="hidden"  id="rg_img1" value="{{asset("img/producto/dora.jpg")}}"/>
                    <div class="card-footer">
                        <div class="col-sm-9 offset-sm-3" >
                            <button class="btn btn-success" style="margin-left: 100px" id="RegistrarProducto" type="button">Registrar</button>
                            <button class="btn btn-success" style="margin-left: 100px" id="ActualizarProducto" type="button">Actualizar</button>
                            <input class="btn btn-danger" type="reset" value="Borrar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

