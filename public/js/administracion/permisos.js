$(document).ready(function () {
    var tabla,idrol,idprivihijos;
    var arrayidprivi = [];
    var arrayzise=[];
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
    //tabla listar roles
     tabla=$('#tbrol').DataTable({
        "pageLength": 10,
        responsive: true,
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ roles",
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
        ajax: url1+'/getrol',
        columns: [
            {data: 'nombre_rol'},
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
                    return '<a onclick="editrol('+row.id_rol+')"  style="color: #18F526"  class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>' +
                        '<a  onclick="deleterol('+row.id_rol+')"  href="javascript:void(0);" style="color: red;"  class="action-icon"> <i class="mdi mdi-delete"></i></a>'
            }
            }

        ],
    });
    //tabla listar Privilegios
  $('#tbprivilegio').DataTable({
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
        ajax: url1,
        columns: [
            {data: 'nombre_Privi', name: 'nombre_Privi'},
            {data: 'ruta_Privi',
                "render": function (data, type, row) {
                    if (row.ruta_Privi == null) {
                        return ' <label class="badge badge-danger badge-pill"> ES PADRE</label>';
                    }else{
                        return '<label class="badge badge-blue badge-pill">'+row.ruta_Privi+'</label>';
                    }
                }
            },
            {data: 'grupo_Privi',
                "render": function (data, type, row) {
                    if (row.id_privi_Padre == null) {
                        return ' <label class="badge badge-danger badge-pill">ES PADRE </label>';
                    }else{
                        return '<label class="badge badge-success badge-pill">'+row.grupo_Privi+'</label>';
                    }
                }
            },
            {data: 'icon_privi', name: 'icon_privi'},
            {data: 'estado_Privi',
                "render": function (data, type, row) {
                    if (row.estado_Privi === '1') {
                        return ' <label class="badge badge-success badge-pill">Activo</label>';
                    }else{
                        return '<label class="badge badge-danger badge-pill">Inactivo</label>';
                    }
                }
            },
            {"mRender": function ( data, type, row ) {
                    return '<a onclick="editarPrivilegio(' + row.id_Privilegios + ')"  style="color: #18F526"  class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>' +
                        '<a  onclick="EliminarPrivi(' + row.id_Privilegios + ')" href="javascript:void(0);" style="color: red;"  class="action-icon"> <i class="mdi mdi-delete"></i></a>'
                }
            }

        ],
      "order": []
    });
  //tabla listar permisos
    listarPermisos();
    $('body').on('hidden.bs.modal', '.modal', function () {
        $("#frmprivilegio")[0].reset();
    });
  $('#rol').change(function () {
         idrol=$( this ).val();

    });
    $('#idpadre').change(function () {
         idprivihijos=$( this ).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url:url+'/getprivihijos',
            type:'post',
            dataType:'json',
            data: {'idprivihijos':idprivihijos},
            success:function (respues) {
             if(respues.length>0){
                 $('#privi').empty();
                 $.each(respues,function (index,val) {
                     $("#privi").append('<option value='+val.id_Privilegios+ '  selected >'+val.nombre_Privi+ '</option>');
                     $('#privi').selectpicker('refresh');
                 });
             }else{
                 $('#privi').empty();
                 $('#privi').selectpicker('refresh');
             }
            }

        })

    });
    $('#privi').change(function () {
        var id=$(this).val();
        arrayidprivi = [];
        for (index=0;index<id.length;index++){
            arrayidprivi.push({
                'id':id[index]
            })
        }
        arrayzise = [{
            'id':arrayidprivi,
            'zise':id.length
        }];
        return arrayidprivi = [];

    });
    $('#regispermisos').click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url:url+'/regispermisos',
            dataType: 'json',
            type: 'post',
            data:{'data':arrayzise,'idrol':idrol,'idpadre':idprivihijos},
            success: function (respon) {
                if (respon.succes==true){
                    toastr.options ={ "closeButton":true, "progressBar": true};
                    toastr.success(
                        "!Permisos Registrados",
                    );
                    $('#tbpermisos').DataTable().ajax.reload();
                    $('#privi').empty();
                    $('#privi').selectpicker('refresh');
                }else{
                    alert('error');
                }
            }
        })
    })

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
function CrearPrivi(valor) {
     if (valor==1){
         $('#privilegios').modal('show');
         $('.modal-title').text("NUEVO GRUPO PRIVILEGIO")
         $('.ruta').hide();
         $('.grupo').hide();
         $("#frmprivilegio")[0].reset();
         $('.privi_padre').hide();
         $('#guardar').click(function (e) {guardar();})

     }else{
         $('#privilegios').modal('show');
         $('.modal-title').text("NUEVO PRIVILEGIO")
         $('.ruta').show();
         $('.grupo').show();
         $('.privi_padre').show();
         $("#frmprivilegio")[0].reset();
         $('#guardar').click(function (e) {guardar();})
     }

}
function guardar() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    var frm=$('#frmprivilegio').serialize();
    $.ajax({
        url:url1,
        type:'post',
        dataType:'json',
        data:frm,
        success:function (data) {
            if (data) {
                $('#tbprivilegio').DataTable().ajax.reload();
                $("#frmprivilegio")[0].reset();
                $('#privilegios').modal('hide');
                Swal.fire(
                    'Exito!',
                    'Se registro Correctamente.',
                    'success'
                );

            }else{
                Swal.fire(
                    'Cambiado!',
                    'Error al registrar.',
                    'error'
                )
            }
        }
    });

}
function listarPermisos() {
    $('#tbpermisos').DataTable({
        "pageLength": 10,
        responsive: true,
        language: {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ roles",
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
            {
                'render': function(data, type, full, meta) {
                    return meta.row + 1;
                }
            },
            {data: 'nombre_Privi'},
            {data: 'grupo_Privi'},
            {data: 'nombre_rol'},
            {data: 'rol_has_estado',
                "render": function (data, type, row) {
                    if (row.rol_has_estado == 1) {
                        return ' <label class="badge badge-success badge-pill">Activo</label>';
                    }else{
                        return '<label class="badge badge-danger badge-pill">Inactivo</label>';
                    }
                }
            },
            {"mRender": function ( data, type, row ) {
                    return '<a onclick="editrol('+row.id_rol+')"  style="color: #18F526"  class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>' +
                        '<a  onclick="deleterol('+row.id_rol+')"  href="javascript:void(0);" style="color: red;"  class="action-icon"> <i class="mdi mdi-delete"></i></a>'
                }
            }

        ],
    });

}


