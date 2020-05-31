$(document).ready(function() {
    tabla=$('.tbproductos').DataTable({
        "pageLength": 10,
        responsive: true,
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Ningún dato disponible en esta tabla",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            },
        },
        ajax: url+'/listarproducto',
        columns: [
            {
                mRender: function(data, type, row) {
                    return '<div class="custom-control custom-checkbox">\n' +
                        '<input type="checkbox" class="custom-control-input" id="customCheck2">\n' +
                        ' <label class="custom-control-label" for="customCheck2">&nbsp;</label>\n' +
                        '</div>'
                }
            },
            {data: 'Nombre_Productos', name: 'Nombre_Productos'},
            {data: 'Nombre_Categoria',name:'Nombre_Categoria'},
            {data: 'Stock_Productos',name:'Stock_Productos'},
            {data: 'precio_venta',name:'precio_venta'},
            {data: 'precio_compra',name:'precio_compra'},
            {data: 'imagen', name: 'imagen', orderable: true, searchable: true},
            {data: 'Estado_Producto',
                "render": function (data, type, row) {
                    if (row.Estado_Producto === 0) {
                        return ' <label class="badge badge-success badge-pill">Activo</label>';
                    }
                    else if(row.Estado_Producto === "1"){
                        return '<label class="badge badge-danger badge-pill">Inactivo</label>';
                    }
                }},
            {
                data: null,
                render: function (data, type, row) {
                    if (data.Estado_Producto === 0) {
                        return '<a onclick="editarProductos(' + row.idProductos + ')"  style="color: #18F526"  class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>' +
                            '<a  onclick="EliminarProducto(' + row.idProductos + ','+ row.idImagenes+')" href="javascript:void(0);" style="color: red;"  class="action-icon"> <i class="mdi mdi-delete"></i></a>' +
                            '<a  onclick="Activar(' + row.idProductos + ')" href="javascript:void(0);" style="color: red;"  class="action-icon"><i class="mdi mdi-check-outline"></i></a>';
                    } else {
                        return '<a onclick="editarProductos(' + row.idProductos + ')"  style="color: #18F526"  class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>' +
                            '<a  onclick="EliminarProducto(' + row.idProductos + ','+ row.idImagenes+')" href="javascript:void(0);" style="color: red;"  class="action-icon"> <i class="mdi mdi-delete"></i></a>' +
                            '<a  onclick="Desactivar(' + row.idProductos + ')" href="javascript:void(0);" style="color: #2a9055;"  class="action-icon"><i class="mdi mdi-check-outline"></i></a>'
                    }

                }
            }

        ],
    });

    $('#modalProducto').click(function () {
        $('.formaddproducto')[0].reset();
        $('.modal-title').text('Nuevo Producto');
        $('#modalAddProducto').modal('show');
        $('#RegistrarProducto').show();
        $('#ActualizarProducto').hide();
        $(".pro_Catego").show();

    });
    $('#RegistrarProducto').click(funcionRegistrar);
    mostrarimagen();
    $('body').on('hidden.bs.modal', '.modal', function () {
        $("#updatecate").empty();
        $('#updatecate').remove();

        $('#imagenPrevisualizacion').removeAttr('src');
    });

});
function funcionRegistrar(e){
    var addInfo    = $('#rg_addproducto').val();
    e.preventDefault();
    var nombre = $('.pro_nombre').val();
    var precio = $('.pro_precio').val();
    var categoria = $('#pro_categoria').val();
    var codigo = $('.pro_codigo').val();
    var stock = $('.pro_stock').val();
    var modelo = $('.pro_modelo').val();
    var descripcion = $('.pro_descripcion').val();
    var precioventa=$('.pro_preventa').val();
    var preciocompra=$('.pro_precompra').val();
    var foto = document.getElementById('pro_imagen');
    var file = foto.files[0];
    var formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('categoria', categoria);
    formData.append('codigo', codigo);
    formData.append('stock', stock);
    formData.append('modelo', modelo);
    formData.append('descripcion', descripcion);
    formData.append('foto', file);
    formData.append('precioventa', precioventa);
    formData.append('preciocompra', preciocompra);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url+'/Addproducto',
        dataType: 'json',
        type: 'post',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respon) {
            if (respon.success===true){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Se Agrego Correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalAddProducto').modal('hide');
                tabla.ajax.reload();
                $('.formaddproducto')[0].reset();
            } else {
            }
        }
    });
}
function mostrarimagen(){
    const $seleccionArchivos = document.querySelector("#pro_imagen"),
        $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");
// Escuchar cuando cambie
    $seleccionArchivos.addEventListener("change", () => {
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $seleccionArchivos.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            $imagenPrevisualizacion.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        $imagenPrevisualizacion.src = objectURL;
    });
}
var producto;
var idimagenes;
function editarProductos(id) {
    $('#formaddproducto')[0].reset();
    $(".pro_Catego").hide();
    $('#selectcate').append('<select class="form-control" name="cate" id="updatecate"><option ></option></select>');
    $('.modal-title').text('Actualizar Producto');
    $('#RegistrarProducto').hide();
    $('#ActualizarProducto').show();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    producto=id;

    $.ajax({
        url:url+'/getproducto',
        type:'post',
        dataType: 'json',
        data:{'id':id},
        success:function (response) {
            $.each(response.producto,function (index,val) {
                idimagenes=val.idImagenes;
                $('#modalAddProducto').modal('show');
                $('.pro_nombre').val(val.Nombre_Productos);
                $('.pro_preventa').val(val.precio_venta);
                $('.pro_precompra').val(val.precio_compra);
                $('.pro_codigo').val(val.codigo_Producto);
                $('.pro_stock').val(val.Stock_Productos);
                $('.pro_modelo').val(val.modelo_producto);
                $('.pro_descripcion').val(val.descripcion_Productos);
                $('#imagenPrevisualizacion').removeAttr('src');
                $('#imagenPrevisualizacion').attr('src', asset + val.imagen);
                $.each(response.cate,function (index,va) {
                    if(val.categoria_idcategoria===va.idcategoria){
                        $("#updatecate").append('<option value='+va.idcategoria+ '  selected >'+va.Nombre_Categoria+ '</option>');
                    }else {
                        $("#updatecate").append('<option value='+va.idcategoria+ '  >'+va.Nombre_Categoria+ '</option>');
                    }
                })
            });
        }
    })

}
$('#ActualizarProducto').click(function (e) {
    var form = $('.formaddproducto')[0];
    var formData = new FormData(form);
     formData.append('idimagenes',idimagenes);
    e.preventDefault();
    $.ajax({
        url:url+'/updateproducto/'+producto,
        dataType:'json',
        type:'post',
        processData: false,
        contentType: false,
        data: formData,
        success:function (response) {
            console.log(response);
            if (response.success===true){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Se Edito Correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalAddProducto').modal('hide');
                tabla.ajax.reload();
                $('.formaddproducto')[0].reset();
            } else {
            }


        }
    })


});
function EliminarProducto(idproducto,idimagen) {
    Swal.fire
    ({
        title:"Seguro de eliminar ?",
        text:"Este Producto!",
        type:"warning",
        height:50,
        showCancelButton:!0,confirmButtonText:"Si, Eliminar!",
        cancelButtonText:"No, cancelar!",confirmButtonClass:"btn btn-success mt-2",
        cancelButtonClass:"btn btn-danger ml-2 mt-2",
        buttonsStyling:!1})
        .then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: url+'/eliminarproducto',
                    type: 'post',
                    datType: 'json',
                    data:{'idproducto':idproducto,'idimagen':idimagen},
                    success: function (data) {
                        if (data.status=='succes'){
                            Swal.fire({title:"Deleted!",
                                text:"Su producto ha sido eliminado.",
                                type:"success"
                            })
                            $('.tbproductos').DataTable().ajax.reload();
                        }else{
                            $('.tbproductos').DataTable().ajax.reload();
                            t.dismiss===Swal.DismissReason.cancel&&Swal.fire({title:"Cancelled",text:"Error al eliminar este producto :)",
                                type:"error"});

                        }


                    }
                });
            }
            else {
                Swal.fire({title:"Cancelled",text:"Your imaginary file is safe :)",type:"error"})
            }
        })

}
function Activar(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(url+'/activarProducto',{'id':id}, function (data) {
        if (data) {tabla.ajax.reload();}
        Swal.fire(
            'Cambiado!',
            'El Estado fue Cambiado Correctamente.',
            'success'
        )
    });
}
function Desactivar(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.post(url+'/desactivarProducto',{'id':id}, function (data) {
        if (data) {tabla.ajax.reload();}
        Swal.fire(
            'Cambiado!',
            'El Estado fue Cambiado Correctamente.',
            'success'
        )
    });
}

