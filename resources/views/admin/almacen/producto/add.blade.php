<div class="modal fade bd-example-modal-lg" id="modalAddProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Nuevo Producto</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation formaddproducto"  >
                    {{ csrf_field() }}
                    <input class="f_id_user" type="hidden" name="id_user">
                    <input class="f_id_per" type="hidden" name="id_per">
                    <input class="f_id_serv" type="hidden" name="id_serv">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label >Nombre Producto</label>
                                <input class="form-control pro_nombre" name="dni" type="text" autocomplete="off" onKeyPress="return SoloNumeros(event);" >
                            </div>
                            <div class="col-md-2 mb-3">
                                <label >Precio</label>
                                <input class="form-control pro_precio"   name="precio" type="text" placeholder="" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Categoria</label>
                                <select class="selectpicker" data-live-search="true" name="idcategoria" id="pro_categoria"  data-width="100%">
                                    <option data-tokens="ketchup mustard" value="" disabled selected>Seleccionar</option>
                                    @foreach($categoriaActivo as $row)
                                        <option value="{{$row->idcategoria}}" >{{$row->Nombre_Categoria}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label >Codigo</label>
                                <input class="form-control pro_codigo"   name="codigo" type="text" placeholder="" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label >Stock</label>
                                <input class="form-control pro_stock"   name="stock" type="text" placeholder="" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label >Modelo</label>
                                <input class="form-control pro_modelo"   name="model" type="text" placeholder="" >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label >Imagen</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="pro_imagen" placeholder="ed" name="imagen">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label >Descripcion</label>
                                <textarea class="form-control pro_descripcion" name="descripcion" ></textarea>
                            </div>
                        </div>
                    <input type="hidden" id="rg_addproducto" value="{{url('admin/alamacen/producto/Addproducto')}}">
                    <input type="hidden"  id="rg_lisproducto" value="{{url('admin/alamacen/producto/listarproducto')}}"/>
                    <input type="hidden"  id="rg_getproducto" value="{{url('admin/alamacen/producto/getproducto')}}"/>
                    <input type="hidden"  id="rg_updateproducto" value="{{url('admin/alamacen/producto/updateproducto')}}"/>
                    <input type="hidden"  id="rg_Eliminarproducto" value="{{url('admin/alamacen/producto/eliminarproducto')}}"/>
                    <input type="hidden"  id="rg_estadoInactivoproducto" value="{{url('admin/alamacen/producto/estadoInactivoproducto')}}"/>
                    <input type="hidden"  id="rg_estadoActivoproducto" value="{{url('admin/alamacen/producto/estadoActivoproducto')}}"/>
    
                    <input type="hidden"  id="rg_img1" value="{{asset("img/producto/dora.jpg")}}"/>
                    <input type="hidden"  id="rg_img2" value="{{asset("img/producto")}}"/>
                    <div class="card-footer">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary GuardarProducto" type="button">Guardar</button>
                            <button class="btn btn-primary UpdateProducto" type="button">Cambiar</button>
                            <input class="btn btn-light" type="reset" value="Borrar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
