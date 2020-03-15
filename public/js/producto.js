$(document).ready(function() {
    var ListProducto    = $('#rg_lisproducto').val();
    var imagen1    = $('#rg_img1').val();
    var imagen2    = $('#rg_img2').val();
    tabla=$('#example').DataTable({
        "pageLength": 10,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                title: "lista de Clientes",
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdfHtml5',
                title:"lista de Clientes",
                exportOptions:{
                    columns:[0,1,2,3,4,5]
                }
            },
            {
                extend:  'csvHtml5',
                title:"lista de Clientes",
                exportOptions:{
                    columns:[0,1,2,3,4,5]
                }
            }
        ],
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
            {data: 'Nombre_Productos', name: 'Nombre_Productos'},
            {data: 'Precio_Productos',name:'Precio_Productos'},
            {data: 'descripcion_Productos',name:'descripcion_Productos'},
            {data: 'Nombre_Categoria',name:'Nombre_Categoria'},
            {data: 'ruta_imagen',
                "render": function (data, type, JsonResultRow, meta) {
                    if(data==null){
                        return '<img src="'+imagen1+'" style="width: 50px">';
                    }else{
                        return '<img src="'+imagen2+'/'+JsonResultRow.ruta_imagen+'" style="width: 50px">';
                    }
                }},
            {data: 'Stock_Productos',name:'Stock_Productos'},
            {data: 'Estado_Producto',
                "render": function (data, type, row) {
                    if (row.Estado_Producto === 0) {
                        return ' <label class="badge badge-success badge-pill">Activo</label>';
                    }
                    else if(row.Estado_Producto === "1"){
                        return '<label class="badge badge-danger badge-pill">Inactivo</label>';
                    }
                }},
            {data: 'modelo_producto',name:'modelo_producto'},
            {"mRender": function ( data, type, row ) {
                    if (row.Estado_Producto===0){
                        return '<a onclick="editarCategoria('+row.idProductos+')" href="javascript:void(0)" title="Editar" ><i class="fe-edit fa-2x" style="color: green"></i></a>'+
                            '<a onclick="EliminarCategoria('+row.idProductos+')" href="javascript:void(0)" title="Eliminar" ><i class="fa fa-trash fa-2x" style="color: red"></i></a>'+
                            '<a onclick="inactivoCategoria('+row.idProductos+')" href="javascript:void(0)" title="Cambiar de estado" ><i class="fa fa-exclamation-triangle fa-2x" style="color: yellow"></i></a>'
                    }else if (row.Estado_Producto==="1"){
                        return '<a onclick="editarCategoria('+row.idProductos+')" href="javascript:void(0)" title="Editar" ><i class="fe-edit fa-2x" style="color: green"></i></a>'+
                            '<a onclick="EliminarCategoria('+row.idProductos+')" href="javascript:void(0)" title="Eliminar" ><i class="fa fa-trash fa-2x" style="color: red"></i></a>'+
                            '<a onclick="activoCategoria('+row.idProductos+')" href="javascript:void(0)" title="Cambiar de estado" ><i class="fa fa-check fa-2x" style="color: green"></i></a>'
                    }
                    ;}
            }

        ],
    });
    $('.UpdateProducto').hide();
});
$('#modalProducto').click(function () {
    $('.formaddproducto')[0].reset();
    $('.modal-title').text('Nuevo Producto');
    $('#modalAddProducto').modal('show');
});
jQuery('.GuardarProducto').click(funcionRegistrar);
function funcionRegistrar(e){
    var addInfo    = jQuery('#rg_addproducto').val();
    e.preventDefault();

    var nombre = jQuery('.pro_nombre').val();
    var precio = jQuery('.pro_precio').val();
    var categoria = jQuery('#pro_categoria').val();
    var codigo = jQuery('#pro_codigo').val();
    var stock = jQuery('.pro_stock').val();
    var modelo = jQuery('.pro_modelo').val();
    var descripcion = jQuery('.pro_descripcion').val();
    var foto = document.getElementById('pro_imagen');// You need to use standard javascript object here
    var file = foto.files[0];
    var formData = new FormData();
    formData.append('nombre', nombre);
    formData.append('categoria', categoria);
    formData.append('precio', precio);
    formData.append('codigo', codigo);
    formData.append('stock', stock);
    formData.append('modelo', modelo);
    formData.append('descripcion', descripcion);
    formData.append('foto', file);
    //falta ahcer para mañana loca
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery.ajax({
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
//// reset form ////////
$('#modalProducto').click(function () {
    $('.formaddproducto')[0].reset();
    $('#pro_categoria').val('default').selectpicker('refresh');
});
