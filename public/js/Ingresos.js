$(document).ready(function () {
    var url;
    var ur11=$('#rutagetcar').val();

    $('#tablecar').DataTable({
        processing: false,
        serverSide: true,
        destroy:true,
        ajax: ur11,
        columns: [
            { data: 'Nombre_Productos' },
            {data: null,
                render: function ( data, type, row ) {
                    return '<input type="number" class="form-control" value="'+data.Cantidad+'">';
                }},
            { data: 'Precio_Productos' },
            { data: 'Subtotal'},
            { data: 'Igv'},
            {data: null,
                render: function ( data, type, row ) {
                    return '<button type="button" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-delete"></i></button>';
                }}
        ]
    });
    $('#searchproveedor').autocomplete({
        source:function (request ,response) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var ruta=$('#rutaProve').val();
            $.ajax({
                url:ruta,
                dataType:'json',
                type:'post',
                data:{
                    texto:request.term
                },
                success:function (data) {
                    response(data.list_cliente);

                },
                error:function (data) {
                    if (data.responseJSON.message=='Undefined variable: resulta'){
                        alert('no se encontroron registros de este proveedor');
                    }
                }
            });
        },
        delay:200,
        minlength:8,
        select:function (event,ui) {
            $('#producto').val();
            $('#razonsocial').val(ui.item.razonsocial);
            $('#searchproveedor').val(ui.item.ruc);
            $('#idprove').val(ui.item.idprovee);
            return false;
        }

    });
    $('#searchproducto').autocomplete({

        source:function (request ,response) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var rutapro=$('#rutapro').val();
            $.ajax({
                url:rutapro,
                dataType:'json',
                type:'post',
                data:{
                    texto:request.term
                },
                success:function (data) {
                    response(data.list_cliente);

                },
                error:function (data) {
                    if (data.responseJSON.message=='Undefined variable: resulta'){
                        alert('no se encontroron registros de este proveedor');
                    }
                }
            });
        },
        delay:200,
        minlength:8,
        select:function (event,ui) {
            $('#searchproducto').val(ui.item.value);
            $('#idprod').val(ui.item.idproducto);
            return false;
        }

    });
    $(".ui-autocomplete.ui-widget").css('font-size', '15px');


    $('#addcarrito').click(function () {
        var data1={};
        data1.idprodu=$('#idprod').val();
        data1.idprovee=$('#idprove').val();
        data1.cantidad=$('#cantidad_pro').val();
        var form=$(this).parents('form');
         url= form.attr('action');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:url,
            dataType:'json',
             type:'post',
            data:data1,
            success:function (data) {
                var url1=$('#rutagetcarr').val();
                var idprovee=$('#idprove').val();
             console.log(data[0]);
                $('#tablecar').DataTable({
                    processing: false,
                    serverSide: true,
                    destroy:true,
                    ajax: url1+idprovee,
                    columns: [
                        { data: 'Nombre_Productos' },
                        {data: null,
                            render: function ( data, type, row ) {
                                return '<input type="number" class="form-control" value="'+data.Cantidad+'">';
                            }},
                        { data: 'Precio_Productos' },
                        { data: 'Subtotal'},
                        { data: 'Igv'},
                        {data: null,
                            render: function ( data, type, row ) {
                                return '<button type="button" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-delete"></i></button>';
                            }}
                    ]
                });

            }
        })
    });



});
function validar() {
   var search= $('#searchproveedor').val();
   if (search===''){
      $('#razonsocial').val("");
   }
    var searchproducto= $('#searchproducto').val();
    if (searchproducto===''){
//    $('#razonsocial').val("");
}
}
