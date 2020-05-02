$(document).ready(function() {
    var id=localStorage.getItem('cajabierta');
    mostrartotalcaja(id);
    var ListCategoria    = $('#rg_lisCategoria').val();
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
        ajax: ListCategoria,
        columns: [
            {data: 'caj_codigo', name: 'caj_codigo'},
            {data: 'caj_descripcion',name:'caj_descripcion'},
            {data: 'caj_abierta',name:'caj_abierta'},
            {data: 'monto_Caja_Inicial',name:'monto_Caja_Inicial'},
            {data: 'Monto_Caja_final',name:'Monto_Caja_final'},
            {data: 'estado',
                "render": function (data, type, row) {
                    if (row.estado === 0) {
                        return ' <label class="badge badge-success badge-pill">Activo</label>';
                    }
                    else if(row.estado === "1"){
                        return '<label class="badge badge-danger badge-pill">Inactivo</label>';
                    }
                }},
            {"mRender": function ( data, type, row ) {
                    if (row.estado===0){
                        return '<a onclick="editarCategoria('+row.idCaja+')" href="javascript:void(0)" title="Editar" ><i class="fe-edit fa-2x" style="color: green"></i></a>'+
                            '<a onclick="EliminarCategoria('+row.idCaja+')" href="javascript:void(0)" title="Eliminar" ><i class="fa fa-trash fa-2x" style="color: red"></i></a>'+
                            '<a onclick="inactivoCategoria('+row.idCaja+')" href="javascript:void(0)" title="Cambiar de estado" ><i class="fa fa-exclamation-triangle fa-2x" style="color: yellow"></i></a>'
                    }else if (row.estado==="1"){
                        return '<a onclick="editarCategoria('+row.idCaja+')" href="javascript:void(0)" title="Editar" ><i class="fe-edit fa-2x" style="color: green"></i></a>'+
                            '<a onclick="EliminarCategoria('+row.idCaja+')" href="javascript:void(0)" title="Eliminar" ><i class="fa fa-trash fa-2x" style="color: red"></i></a>'+
                            '<a onclick="activoCategoria('+row.idCaja+')" href="javascript:void(0)" title="Cambiar de estado" ><i class="fa fa-check fa-2x" style="color: green"></i></a>'
                    }
                    ;}
            }

        ],
    });
    $('.UpdateCategoria').hide();
$('#modalCategoria').click(function () {
    $('.formaddcategoria')[0].reset();
    $('.modal-title').text('Nueva Caja');
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
    $('.modal-title').text('Editar Caja');
    $.get(urlrf+'?id=' + id, function (data) {
        $('#idCaja').val(data[0].idCaja);
        $('.caj_descripcion').val(data[0].caj_descripcion);
        $('.caj_codigo').val(data[0].caj_codigo);
        $('.caj_abierta').val(data[0].caj_abierta);
        $('.Monto_Caja_final').val(data[0].Monto_Caja_final);
        $('.monto_Caja_Inicial').val(data[0].monto_Caja_Inicial);
        $('#usuarios_idusuarios').val(data[0].usuarios_idusuarios).selectpicker('refresh');;
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
    $('#usuarios_idusuarios').val('default').selectpicker('refresh');
});
function aperturarcaja() {
   var frm= $('#frmaperturarcaja').serialize();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
   $.ajax({
       'url':url,
       'type':'post',
       'data':frm,
       dataType:'json',
       success:function (response) {
           if (response.success==true){
               toastr.options ={ "closeButton":true, "progressBar": true};
               toastr.success(
                   "!Registro Exitoso",
                   "EXITO AL APERTURAR  CAJA",
               );
               $("#monto" ).prop( "disabled", true );
               var idcaja=response['caja']['id_Detallecaja'];
               var monto_apertura=response['caja']['Monto_Caja_apertura'];
                $('#montoapertura').val(monto_apertura);
               $("#caja" ).prop( "disabled", true );
               $('#aperturarcaja').hide();
               $('#btncaja').append(' <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2" id="aperturarcaja" onclick="cerrarcaja('+idcaja+')' +
                   '"><i class="mdi mdi-basket mr-1"></i>CERRAR CAJA</button>');

               localStorage.setItem('cajabierta','true');
           }else{
               console.log(response);
           }

       }

   })

}
function mostrartotalcaja(id) {
    var idcaja=$('#caja').val();

    if (id==='true'){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url:url1+'/gettotalcaja',
            type:'post',
            dataType:'json',
            data:{'idcaja':idcaja},
            success:function (response) {
                console.log('llego',response);
                $('#monto').val(response[0]['Monto_Caja_apertura']);
                var iddetalle=response[0]['id_Detallecaja'];

                $("#monto" ).prop( "disabled", true );
                $("#caja" ).prop( "disabled", true );
                $('#aperturarcaja').hide();
                $('#btncaja').append(' <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2"onclick="cerrarcaja('+iddetalle+')" id="cerrarrarcaja"><i class="mdi mdi-basket mr-1"></i>CERRAR CAJA</button>');
            }

        })

    }

}
function cerrarcaja(iddeta) {
    var monto=$('#monto').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        url:url1+'/cerrarcaja',
        type:'post',
        dataType:'json',
        data:{'monto':monto,'iddeta':iddeta},
        success:function (response) {
            $('#monto').val(0,0);
            return
            if (response.success==true){
                toastr.options ={ "closeButton":true, "progressBar": true};
                toastr.success(
                    "!Registro Exitoso",
                    "EXITO AL APERTURAR  CAJA",
                );
                $("#monto" ).prop( "disabled", true );
                $("#caja" ).prop( "disabled", true );
                $('#aperturarcaja').hide();
                $('#btncaja').append(' <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2"onclick="cerrarcaja()" id="aperturarcaja"><i class="mdi mdi-basket mr-1"></i>CERRAR CAJA</button>');

                localStorage.setItem('cajabierta','true');
            }else{
                console.log(response);
            }

        }

    })
}
