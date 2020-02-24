$(document).ready(function () {
    var url;
    var tabla;
    var ur11=$('#rutagetcar').val();
  var id=localStorage.getItem("id");
    cargarDetalleCompra(id);
   tabla= $('#tablecar').DataTable({
        processing: false,
        serverSide: true,
        destroy:true,
        ajax: ur11+id,
        columns: [
            { data: 'Nombre_Productos' },
            {data: null,
                render: function ( data, type, row ) {
                    return '<input type="number" class="form-control" id="Cantidad"   onkeyup="sumCantidad('+row.id_Tem_Carito+')" value="'+data.Cantidad+'">'+
                        '<input type="number" class="form-control" hidden id="idprovedor" value="'+row.id_Proveedor+'">';
                }},
            { data: 'Precio_Productos' },
            { data: 'Subtotal'},
            { data: 'Igv'},
            {data: null,
                render: function ( data, type, row ) {
                    return '<button type="button" class="btn btn-danger waves-effect waves-light"><i class="mdi mdi-delete"></i></button>';
                }}
        ],
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
            var idprove=$('#idprove').val();
            localStorage.setItem("id", idprove);
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
                 $('#total').html(data['total']);
                $('#subtotal').html(data['subtotal']);
                $('#Igv').html(data['Igv']);
                $('#total1').html(data['total']);
                $('#tablecar').DataTable({
                    processing: false,
                    serverSide: true,
                    destroy:true,
                    ajax: url1+idprovee,
                    columns: [
                        { data: 'Nombre_Productos' },
                        {data: null,
                            render: function ( data, type, row ) {
                                return '<input type="number" onkeyup="sumCantidad('+row.id_Tem_Carito+')" id="Cantidad" class="form-control" value="'+row.Cantidad+'">'+
                                    '<input type="number" class="form-control" hidden id="idprove" value="'+row.id_Proveedor+'">';
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

function cargarDetalleCompra(id) {
    var ur11=$('#rutagetcarxprove').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:ur11+id,
        dataType:'json',
        type:'post',
        success:function (data) {
            $('#total').html(data['total']);
            $('#subtotal').html(data['subtotal']);
            $('#Igv').html(data['Igv']);
            $('#total1').html(data['total']);
        }
    });

}

function sumCantidad(id) {
    var data={};
    data.cantidad=$('#Cantidad').val();
    data.idprove=$('#idprovedor').val();
    data.idtem=id;
    var urlupdate=$('#UpdateCantidad').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:urlupdate,
        dataType:'json',
        type:'post',
        data:data,
        success:function (data) {
            var subtotal=data[0]['sumsubtotal'];
            var cantidad=$('#Cantidad').val();
            var sumSubTotal=parseFloat(subtotal);
            var Igv=parseFloat(sumSubTotal)*0.18;
            var Total=parseFloat(sumSubTotal)+parseFloat(Igv);
            $('#total').html(Total);
            $('#subtotal').html(sumSubTotal);
            $('#Igv').html(Igv);
            $('#total1').html(Total);
            $('#tablecar').DataTable().ajax.reload();
        }
    });


}
