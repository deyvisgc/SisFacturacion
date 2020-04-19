$(document).ready(function () {
    var tabla;
    $('#regis').click(function () {
        $('#modalnewrol').modal('show');
    });
    $('.btnguardar').click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        var frm=$('#frmrol').serialize();
        $.ajax({
            url:url,
            type:'post',
            dataType:'json',
            data: frm,
            success:function (respues) {
                $('#modalnewrol').modal('hide');
                $('#rol').val("");
                toastr.options ={ "closeButton":true, "progressBar": true};
                toastr.success(
                    "!Registro Exitoso",
                );
                tabla.ajax.reload();

            }

        })
    });
     tabla=$('#tbrol').DataTable({
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
        ajax: url,
        columns: [
            {data: 'nombre_rol', name: 'nombre_rol'},
            {data: 'estado_rol',
                "render": function (data, type, row) {
                    if (row.estado_rol === '1') {
                        return ' <label class="badge badge-success badge-pill">Activo</label>';
                    }else{
                        return '<label class="badge badge-danger badge-pill">Inactivo</label>';
                    }
                }
                },
            {"mRender": function ( data, type, row ) {
                    return '<a onclick="editrol('+row.id_rol+')" href="javascript:void(0)" title="Editar" ><i class="fe-edit fa-2x" style="color: green"></i></a>'+
                            '<a onclick="deleterol('+row.id_rol+')" href="javascript:void(0)" title="Editar" ><i class="fas fa-trash-alt" style="color: red;font-size: 25px"></i></a>'
            }
            }

        ],
    });

});

function deleterol(id_rol) {
    $('#deleterolmodal').modal('show');
    $('#deletemodal').click(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        $.ajax({
            url:urldelete,
            type:'post',
            dataType:'json',
            data: {
                'idrol':id_rol
            },
            success:function (respues) {
                $('#deleterolmodal').modal('hide');
                toastr.options ={ "closeButton":true, "progressBar": true};
                toastr.success(
                    "!Registro Eliminado correctamente",
                );
                $('#tbrol').DataTable().ajax.reload();

            }

        })
    })

}
