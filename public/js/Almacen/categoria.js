$(document).ready(function() {
    var ListCategoria    = $('#rg_lisCategoria').val();
    tabla=$('#example').DataTable({
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
        ajax: ListCategoria,
        columns: [
            {data: 'idcategoria', name: 'idcategoria'},
            {data: 'Nombre_Categoria',name:'Nombre_Categoria'},
            {data: 'Estado_categoria',
                "render": function (data, type, row) {
                    if (row.Estado_categoria === 0) {
                        return ' <label class="badge badge-success badge-pill">Activo</label>';
                    }
                    else if(row.Estado_categoria === "1"){
                        return '<label class="badge badge-danger badge-pill">Inactivo</label>';
                    }
                }},
            {"mRender": function ( data, type, row ) {
                    if (row.Estado_categoria===0){

                        return '<a onclick="editarCategoria('+row.idcategoria+')" style="color: #18F526"  class="action-icon" href="javascript:void(0)" title="Editar" ><i class="mdi mdi-square-edit-outline"></i></a>'+
                            '<a onclick="EliminarCategoria('+row.idcategoria+')" href="javascript:void(0)" title="Eliminar" style="color: red;" class="action-icon" ><i class="mdi mdi-delete"></i></a>'+
                            '<a onclick="inactivoCategoria('+row.idcategoria+')" href="javascript:void(0)" title="Cambiar de estado" class="action-icon" style="color: red;"><i class="mdi mdi-check-outline"></i></a>'
                    }else if (row.Estado_categoria==="1"){
                        return '<a onclick="editarCategoria('+row.idcategoria+')" href="javascript:void(0)" style="color: #18F526"  class="action-icon" title="Editar" ><i class="mdi mdi-square-edit-outline"></i></a>'+
                            '<a onclick="EliminarCategoria('+row.idcategoria+')" href="javascript:void(0)" title="Eliminar" style="color: red;" class="action-icon" ><i class="mdi mdi-delete"></i></a>'+
                            '<a onclick="activoCategoria('+row.idcategoria+')" href="javascript:void(0)" title="Cambiar de estado" class="action-icon" style="color: green;" ><i class="mdi mdi-check-outline"></i></a>'
                    }
            }
            }

        ],
    });
    $('.UpdateCategoria').hide();
});
$('#modalCategoria').click(function () {
    $('.formaddcategoria')[0].reset();
    $('.modal-title').text('Nuevo Categoria');
    $('#modalAddCategoria').modal('show');
});
var categoria;
$('.GuardarCategoria').click(funcionRegistrar);
function funcionRegistrar(e) {
    var addCategoria    = $('#rg_addCategoria').val();
    var frm=$('.formaddcategoria');
    e.preventDefault();
    $.ajax({
        url:addCategoria,
        type:'post',
        dataType:'json',
        data:frm.serialize(),
        success:function (respons) {
            if (respons.success===true){
                console.log(respons);
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Se Agrego Correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalAddCategoria').modal('hide');
                tabla.ajax.reload();
                $('.formaddcategoria')[0].reset();
            } else {
            }
        }
    });
}
function editarCategoria(id) {
    var urlrf    = $('#rg_getCategoria').val();
    categoria=id;
    $('.UpdateCategoria').show();
    $('.GuardarCategoria').hide();
    $('.modal-title').text('Editar Categoria');
    $.get(urlrf+'?id=' + id, function (data) {
        $('#rg_idcategoria').val(data[0].idcategoria);
        $('.ca_nombre').val(data[0].Nombre_Categoria);
        $('#modalAddCategoria').modal('show');
    });
}
$('.UpdateCategoria').click(function (e) {
    var urlrf    = $('#rg_updateCategoria').val();
    var frm=$('.formaddcategoria');
    e.preventDefault();
    $.ajax({
        url:urlrf+'/'+categoria,
        dataType:'json',
        type:'post',
        data:frm.serialize(),
        success:function (response) {
            if (response.success===true){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Se Edito Correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#modalAddCategoria').modal('hide');
                tabla.ajax.reload();
                $('.formaddcategoria')[0].reset();
            } else {
            }


        }
    })
});
function EliminarCategoria(id) {
    var urlrf    = $('#rg_Eliminar').val();
    Swal.fire({
        title: 'Esta Seguro de Eliminar la Categoria.. ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.value) {
            $.get(urlrf+'?id=' + id, function (data) {
                if (data) {
                    tabla.ajax.reload();
                }
                Swal.fire(
                    'Eliminado!',
                    'success'
                )
            });
        }
    })
}
function inactivoCategoria(id) {
    var urlrf    = $('#rg_estadoInactivo').val();
    Swal.fire({
        title: 'Esta Seguro de Cambiar de estado.. ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.value) {
            $.get(urlrf+'?id=' + id, function (data) {
                if (data) {
                    tabla.ajax.reload();
                }
                Swal.fire(
                    'Cambiado!',
                    'El Estado fue Cambiado Correctamente.',
                    'success'
                )
            });
        }
    })
}
function activoCategoria(id) {
    var urlrf    = $('#rg_estadoActivo').val();
    Swal.fire({
        title: 'Esta Seguro de Cambiar de estado.. ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.value) {
            $.get(urlrf+'?id=' + id, function (data) {
                if (data) {
                    tabla.ajax.reload();
                }
                Swal.fire(
                    'Cambiado!',
                    'El Estado fue Cambiado Correctamente.',
                    'success'
                )
            });
        }
    })
}
//// reset form ////////
$('#modalCategoria').click(function () {
    $('.formaddcategoria')[0].reset();
});
