$(document).ready(function() {
    var ListProducto    = $('#rg_lisproducto').val();
    var imagen1    = $('#rg_img1').val();
    var imagen2    = $('#rg_img2').val();
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
        ajax: ListProducto,
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
                    if (data.Estado_Producto===0){
                        return '<a href="javascript:void(0);" style="margin-left: 20px;color: #F2EF1D" class="action-icon"> <i class="mdi mdi-eye"></i></a>'+
                            '<a onclick="editarProductos('+row.idProductos+')"  style="color: #18F526"  class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>'+
                            '<a  onclick="EliminarCategoria('+row.idProductos+')" href="javascript:void(0);" style="color: red;"  class="action-icon"> <i class="mdi mdi-delete"></i></a>'+
                            '<a  onclick="Activar('+row.idProductos+')" href="javascript:void(0);" style="color: red;"  class="action-icon"><i class="mdi mdi-check-outline"></i></a>'                            ;
                    }else{
                        return '<a href="javascript:void(0);" style="margin-left: 20px;color: #F2EF1D" class="action-icon"> <i class="mdi mdi-eye"></i></a>'+
                            '<a onclick="editarProductos('+row.idProductos+')"  style="color: #18F526"  class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>'+
                            '<a  onclick="EliminarCategoria('+row.idProductos+')" href="javascript:void(0);" style="color: red;"  class="action-icon"> <i class="mdi mdi-delete"></i></a>'+
                            '<a  onclick="Activar('+row.idProductos+')" href="javascript:void(0);" style="color: #2a9055;"  class="action-icon"><i class="mdi mdi-check-outline"></i></a>'
                            ;
                    }
                }
            }

        ],
    });
    $('.UpdateProducto').hide();
    $('#modalProducto').click(function () {
        $('.formaddproducto')[0].reset();
        $('#pro_categoria').val('default').selectpicker('refresh');
    });
    $('#modalProducto').click(function () {
        $('.formaddproducto')[0].reset();
        $('.modal-title').text('Nuevo Producto');
        $('#modalAddProducto').modal('show');
    });
    $('.GuardarProducto').click(funcionRegistrar);
    mostrarimagen();
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
        url: addInfo,
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
function editarProductos(id) {
    $('#formaddproducto')[0].reset();
    $("#pro_categoria").remove();
    $('#selectcategoria').append('<select class="form-control" id="updatecate"><option >escoger categoria</option></select>')
    $('.modal-title').text('Actualizar Producto');
    $('#modalAddProducto').modal('show');
    $.ajax({
        url:url+'getproducto',
        type:'post',
        dataType: 'json',
        data:{'id':id},
        success:function (response) {
            console.log(response);
        }
    })

}

