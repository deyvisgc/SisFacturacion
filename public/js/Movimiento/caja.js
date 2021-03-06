$(document).ready(function() {
    var id=localStorage.getItem('cajabierta');
    mostrartotalcaja(id);
    Listarcaja();
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
function Listarcaja() {
    $('#tbcaja').DataTable({
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
        "ajax": {
            "url": url,
            "dataSrc": ""
        },
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
        columns: [
            {
                mRender: function(data, type, row) {
                    return ' <div class="custom-control custom-checkbox">\n' +
                        '<input type="checkbox" class="custom-control-input" id="customCheck2">\n' +
                        '<label class="custom-control-label" for="customCheck2">&nbsp;</label>\n' +
                        '</div>'
                }
            },
            {data: 'caj_codigo'},
            {data: 'Monto_Caja_apertura'},
            {data: 'Monto_Caja_final'},
            {data: 'fecha_apertura'},
            {data: 'fecha_cierre'},
            {
                mRender: function(data, type, row) {
                    return '<a style="color: #18F526"  class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>';
                }
            }

        ],
        destroy:true
    });

}
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
               localStorage.setItem('montoapertura',monto_apertura);

               $("#caja" ).prop( "disabled", true );
               $('#aperturarcaja').hide();
               $('#btncaja').append(' <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2" id="cerrarcaja" onclick="cerrarcaja('+idcaja+')' +
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
                if (response.length==''){
                    alert('monto de apertura 0');
                }else{
                    $('#monto').val(response[0]['Monto_Caja_apertura']);
                    var iddetalle=response[0]['id_Detallecaja'];
                    $("#monto" ).val('0.00');
                    $('#aperturarcaja').hide();
                    $('#btncaja').append(' <button type="button" class="btn btn-danger waves-effect waves-light mb-2 mr-2"onclick="cerrarcaja('+iddetalle+')" id="cerrarcaja"><i class="mdi mdi-basket mr-1"></i>CERRAR CAJA</button>');
                }

            }

        })

    }

}
function cerrarcaja(iddeta) {
    var monto=$('#monto').val();
    var montoapertura=localStorage.getItem('montoapertura');
    alert(montoapertura);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        url:url1+'/cerrarcaja',
        type:'post',
        dataType:'json',
        data:{'monto':monto,'iddeta':iddeta,'montoapertura':montoapertura},
        success:function (response) {
            $('#monto').val(0,0);
            if (response.success==true){
                toastr.options ={ "closeButton":true, "progressBar": true};
                toastr.success(
                    "!Registro Exitoso",
                    "EXITO AL CERRAR  CAJA",
                );
                $("#monto" ).prop( "disabled", true );
                $("#caja" ).prop( "disabled", true );
                localStorage.setItem('cajabierta',false)
                $('#aperturarcaja').show();
                $('#cerrarcaja').remove();
                $('#tbcaja').DataTable({
                    destroy:true
                });
            }else{
                console.log(response);
            }

        }

    })
}
function buscar() {
    var fecha= $('#range-datepicker').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        'url':url1+'/buscar',
        'type':'post',
        'data':{'fecha':fecha},
        dataType:'json',
        success:function (response) {
            $('#range-datepicker').val("");
            $('#tbcaja').DataTable({
                destroy:true
            });
        }

    })
}
