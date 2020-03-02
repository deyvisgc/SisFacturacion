$(document).ready(function () {
    var tipo_pago,comprobante,url,tabla,urlgetcarrito,idproveencri,idprovedesc;
    var urlgeneral='http://127.0.0.1:8000/';
    urlgetcarrito = $('#rutagetcar').val();
            //captura el id del storage del proveedor
       //     idproveencri  = localStorage.getItem("id");
           /*desencriptar idprove*/
           //  idprovedesc = atob(idproveencri);

            //cargar el detalle de la compra
            cargarDetalleCompra();
            tabla = $('#tablecar').DataTable({
                processing: false,
                serverSide: true,
                destroy: true,
                ajax: urlgetcarrito+1,
                columns: [
                    {data: 'Razon_social_Empre'},
                    {data: 'Nombre_Productos'},
                    {
                        data: null,
                        render: function (data, type, row) {
                            return '<input type="number" class="form-control" id="Cantidad"   onkeyup="sumCantidad(' + row.id_Tem_Carito + ')" value="' + data.Cantidad + '">' +
                                '<input type="number" class="form-control" hidden id="idprovedor" value="' + row.id_Proveedor + '">'+
                                '<input type="number" class="form-control" hidden id="idvalor" value="1">';
                        }
                    },
                    {data: 'Precio_Compra'},
                    {data: 'Subtotal'},
                    {data: 'Igv'},
                    {
                        data: null,
                        render: function (data, type, row) {

                            return '<button type="button" class="btn btn-danger waves-effect waves-light" onclick="Eliminar('+row.id_Tem_Carito+')"><i class="mdi mdi-delete"></i></button>';
                        }
                    }
                ],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
            $('#searchproveedor').autocomplete({
                source: function (request, response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var ruta = $('#rutaProve').val();
                    $.ajax({
                        url: ruta,
                        dataType: 'json',
                        type: 'post',
                        data: {
                            texto: request.term
                        },
                        success: function (data) {
                            response(data.list_cliente);

                        },
                        error: function (data) {
                            if (data.responseJSON.message == 'Undefined variable: resulta') {
                                toastr.options ={ "closeButton":true, "progressBar": true};
                                toastr.error(
                                    "!Porfavor revisa el Ruc",
                                    "No se encontraron proveedores",
                                );



                            }
                        }
                    });
                },
                delay: 200,
                minlength: 8,
                select: function (event, ui) {
                    $('#producto').val();
                    $('#razonsocial').val(ui.item.razonsocial);
                    $('#searchproveedor').val(ui.item.ruc);
                    $('#idprove').val(ui.item.idprovee);
                    var idprove = btoa($('#idprove').val());
                   /* localStorage.setItem("id", idprove);*/
                    return false;
                }

            });
            $('#searchproducto').autocomplete({

                source: function (request, response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var rutapro = $('#rutapro').val();
                    $.ajax({
                        url: rutapro,
                        dataType: 'json',
                        type: 'post',
                        data: {
                            texto: request.term
                        },
                        success: function (data) {
                            response(data.list_cliente);

                        },
                        error: function (data) {
                            if (data.responseJSON.message == 'Undefined variable: resulta') {
                                toastr.options ={ "closeButton":true, "progressBar": true};
                                toastr.error(
                                    "!Porfavor revisa los productos",
                                    "No se encontraron productos",
                                );
                            }
                        }
                    });
                },
                delay: 200,
                minlength: 8,
                select: function (event, ui) {
                    $('#searchproducto').val(ui.item.value);
                    $('#idprod').val(ui.item.idproducto);
                    $('#precio_compra').val(ui.item.precio_compra);
                    $('#precio_venta').val(ui.item.precio_venta);
                    return false;
                }

            });
            $(".ui-autocomplete.ui-widget").css('font-size', '15px');

//agregar al carrito de compras
            $('#addcarrito').click(function () {
                var data1 = {};
                data1.idprodu = $('#idprod').val();
                data1.iduser = 1;
                data1.cantidad = $('#cantidad_pro').val();
                data1.precio_compra=$('#precio_compra').val();
                data1.idprove= $('#idprove').val();
                var form = $(this).parents('form');
                url = form.attr('action');
                if ($('#searchproveedor').val()==''){
                    toastr.options ={ "closeButton":true, "progressBar": true};
                    toastr.warning(
                        "!Porfavor rellene el proveedor",
                        "campos requeridos",
                    );
                }else if ($('#searchproducto').val()==''){
                    toastr.options ={ "closeButton":true, "progressBar": true};
                    toastr.warning(
                        "!Porfavor rellene el producto",
                        "campos requeridos",
                    );
                }else if (data1.cantidad==''){
                    toastr.options ={ "closeButton":true, "progressBar": true};
                    toastr.warning(
                        "!Porfavor rellene la cantidad",
                        "campos requeridos",
                    );
                }else if (data1.precio_compra==''){
                    toastr.options ={ "closeButton":true, "progressBar": true};
                    toastr.warning(
                        "!Porfavor rellene el precio",
                        "campos requeridos",
                    );
                }else{
                   $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       }
                   });
                   $.ajax({
                       url: url,
                       dataType: 'json',
                       type: 'post',
                       data: data1,
                       success: function (data) {
                           var url1 = $('#rutagetcarr').val();
                           var idvendedor =1;
                           console.log(data[0]);
                           $('#total').html(data['total'].toFixed(4));
                           $('#subtotal').html(data['subtotal'].toFixed(4));
                           $('#Igv').html(data['Igv'].toFixed(4));
                           $('#total1').html(data['total'].toFixed(4));
                           $('#tablecar').DataTable({
                               processing: false,
                               serverSide: true,
                               destroy: true,
                               ajax: url1 + idvendedor,
                               columns: [
                                   {data: 'Razon_social_Empre'},
                                   {data: 'Nombre_Productos'},
                                   {
                                       data: null,
                                       render: function (data, type, row) {
                                           return '<input type="number"  onkeyup="sumCantidad(' + row.id_Tem_Carito + ')" id="Cantidad1" class="form-control" value="' + row.Cantidad + '">'
                                       }
                                   },
                                   {data: 'Precio_Compra'},
                                   {data: 'Subtotal'},
                                   {data: 'Igv'},
                                   {
                                       data: null,
                                       render: function (data, type, row) {
                                           return '<button type="button" class="btn btn-danger waves-effect waves-light" onclick="Eliminar('+row.id_Tem_Carito+')"><i class="mdi mdi-delete"></i></button>';
                                       }
                                   }
                               ],
                               language: {
                                   "decimal": "",
                                   "emptyTable": "No hay información",
                                   "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                   "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                                   "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                                   "infoPostFix": "",
                                   "thousands": ",",
                                   "lengthMenu": "Mostrar _MENU_ Entradas",
                                   "loadingRecords": "Cargando...",
                                   "processing": "Procesando...",
                                   "search": "Buscar:",
                                   "zeroRecords": "Sin resultados encontrados",
                                   "paginate": {
                                       "first": "Primero",
                                       "last": "Ultimo",
                                       "next": "Siguiente",
                                       "previous": "Anterior"
                                   }
                               },
                           });
                           limpiarcarrito();

                       }
                   })
               }

            });

            //capturar el valor del tipo de pago
            $('#pagos').change(event,function () {
                tipo_pago= event.target.value;
            });
            $('#comprobante').change(event,function () {
             comprobante = event.target.value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
              $.ajax({
                  url:urlgeneral+'getcantidadComprobante',
                  type:'post',
                  dataType:'json',
                  data:{
                      'idcompro':comprobante
                  },
                  success:function (res) {
                      console.log(res[0]['id']);
                      if (res[0]['id']== comprobante){
                          $('#serie').val(res[0]['serie']);
                          $('#n_venta').val(generarnumero(res[0]['cantidad']));
                      }else {
                          $("#n_venta").val(null);
                      }
                  },
                  error:function (error) {
                       alert(error);
                  }
              });
            });
            //calcular vuelto
           $('#monto').keyup(function (event) {
             var monto=event.target.value;
               var total=$('#totalapagar').val();
             var vuelto=parseFloat(monto)-parseFloat(total);
             if (monto==''){
                 $('#vuelto').val('0.00');
             }else {
                 $('#vuelto').val(vuelto.toFixed(4));
             }
           });
         $('#btnmodal').click(function () {
            var subtotal= $('#total1').html();$('#totalapagar').val(subtotal);
             var serie=$('#serie').val();
             var num_venta=$('#n_venta').val();
            if(comprobante==undefined){
                toastr.options ={ "closeButton":true, "progressBar": true};
                toastr.warning(
                    "!Porfavor seleccione  comprobante",
                    "campos requeridos",
                );
            }  else if(tipo_pago==undefined){
                toastr.options ={ "closeButton":true, "progressBar": true};
                toastr.warning(
                    "!Porfavor seleccione tipo de pago",
                    "campos requeridos",
                );
            }else if(serie==''){
                toastr.options ={ "closeButton":true, "progressBar": true};
                toastr.warning(
                    "!Porfavor rellene el numero de serie",
                    "campos requeridos",
                );
            }else if (num_venta==''){
                toastr.options ={ "closeButton":true, "progressBar": true};
                toastr.warning(
                    "!Porfavor rellene el numero de venta",
                    "campos requeridos",
                );
            }
            else {
                if (tipo_pago==3){
                    $ ("#modalPagar").modal("show");
                    $('#btnpagar').click(function () {
                        var data={};
                        data.idprove=$('#idprove').val();
                        data.idusuario=1;
                        data.monto_efectivo=$('#monto').val();
                        data.vuelto=$('#vuelto').val();
                        data.tipo_pago=tipo_pago;
                        data.comprobante=comprobante;
                        data.num_venta=num_venta;
                        var form = $(this).parents('form');
                        url = form.attr('action');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: url,
                            dataType: 'json',
                            type: 'post',
                            data: data,
                            success: function (data) {
                                toastr.options ={ "closeButton":true, "progressBar": true};
                                toastr.success(
                                    "!Compra Exitosa",
                                    "Revise su historial de compras",
                                );
                                $('#modalPagar').modal('hide');
                                limpiarcarrito();
                                $('#tablecar').DataTable().ajax.reload();
                                limpiardetalle();
                                console.log(data);
                            },
                            error:function (data) {
                                alert(data);
                            }
                        })
                    })
                }else {
                    alert('no pertenece al tipo de ágo efectivo');
                }
            }


    });



});

    function validar() {
        var search = $('#searchproveedor').val();
        if (search === '') {
            $('#razonsocial').val("");
        }
        var searchproducto = $('#searchproducto').val();
        if (searchproducto === '') {
            $('#precio_venta').val("");
            $('#precio_compra').val("");
        }
    }
    function cargarDetalleCompra() {
        var ur11 = $('#rutagetcarxprove').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: ur11 + 1,
            dataType: 'json',
            type: 'post',
            success: function (data) {
                $('#total').html(data['total'].toFixed(4));
                $('#subtotal').html(data['subtotal'].toFixed(4));
                $('#Igv').html(data['Igv'].toFixed(4));
                $('#total1').html(data['total'].toFixed(4));
            }
        });

    }
    function sumCantidad(id) {
        var idvalor=$('#idvalor').val();
        if (idvalor!=1){
            var data = {};
            data.cantidad = $('#Cantidad1').val();
            data.idvendedor =1;
          //  alert(data.idpro);
            data.idtem = id;
            var urlup = $('#UpdateCantCarr').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: urlup,
                dataType: 'json',
                type: 'post',
                data: data,
                success: function (data) {
                    var subtotal = data[0]['sumsubtotal'];
                    var cantidad = $('#Cantidad').val();
                    var sumSubTotal = parseFloat(subtotal);
                    var Igv = parseFloat(sumSubTotal) * 0.18;
                    var Total = parseFloat(sumSubTotal) + parseFloat(Igv);
                    $('#total').html(Total.toFixed(4));
                    $('#subtotal').html(sumSubTotal.toFixed(4));
                    $('#Igv').html(Igv.toFixed(4));
                    $('#total1').html('S/'+Total.toFixed(4));
                    $('#tablecar').DataTable().ajax.reload();
                }
            });
        }else {
            var data = {};
            data.cantidad = $('#Cantidad').val();
            data.idvendedor =1;
            data.idtem = id;
            var urlupdate = $('#UpdateCantidad').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: urlupdate,
                dataType: 'json',
                type: 'post',
                data: data,
                success: function (data) {
                    var subtotal = data[0]['sumsubtotal'];
                    var cantidad = $('#Cantidad').val();
                    var sumSubTotal = parseFloat(subtotal);
                    var Igv = parseFloat(sumSubTotal) * 0.18;
                    var Total = parseFloat(sumSubTotal) + parseFloat(Igv);
                    $('#total').html(Total.toFixed(4));
                    $('#subtotal').html(sumSubTotal.toFixed(4));
                    $('#Igv').html(Igv.toFixed(4));
                    $('#total1').html('S/'+ Total.toFixed(4));
                    $('#tablecar').DataTable().ajax.reload();
                }
            });
        }

    }
    function Eliminar(id) {
        var url=$('#deleteProducto').val();
      /*  var id = localStorage.getItem("id");
        var idd = atob(id);
        */
        Swal.fire
        ({
            title:"Are you sure?",
            text:"You won't be able to revert this!",
            type:"warning",
            height:50,
            showCancelButton:!0,confirmButtonText:"Yes, delete it!",
            cancelButtonText:"No, cancel!",confirmButtonClass:"btn btn-success mt-2",
            cancelButtonClass:"btn btn-danger ml-2 mt-2",
            buttonsStyling:!1})
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'post',
                        datType: 'json',
                        data:{'id':id,'iduser':1},
                        success: function (data) {
                            Swal.fire({title:"Deleted!",text:"Your file has been deleted.",type:"success"});
                            $('#tablecar').DataTable().ajax.reload();
                            $('#total').html(data['total'].toFixed(4));
                            $('#subtotal').html(data['subtotal'].toFixed(4));
                            $('#Igv').html(data['Igv'].toFixed(4));
                            $('#total1').html(data['total'].toFixed(4));
                        }
                    })
                }
                else {
                    Swal.fire({title:"Cancelled",text:"Your imaginary file is safe :)",type:"error"})
                }
            })
    }
    function limpiarcarrito() {
       $('#idprod').val("");
       $('#idprove').val("");
       $('#cantidad_pro').val("");
       $('#precio_pro').val("");
       $('#searchproducto').val("");
       $('#searchproveedor').val("");
        $('#precio_venta').val("");
        $('#precio_compra').val("");
        $('#totalapagar').val("");
        $('#monto').val("");
        $('#vuelto').val("");
    }
function limpiardetalle() {
    $('#total').html('S/.'+ '0.00');
    $('#subtotal').html('S/.'+ '0.00');
    $('#Igv').html('S/.'+ '0.00');
    $('#total1').html('S/.'+ '0.00');
    $('#n_venta').val('');
    $('#serie').val('');
    $('#comprobante option:first').prop('selected', true);
    $('#pagos option:first').prop('selected', true);
}


function generarnumero(numero){
    if (numero>= 99999 && numero< 999999) {
        return Number(numero)+1;
    }
    if (numero>= 9999 && numero< 99999) {
        return "0" + (Number(numero)+1);
    }
    if (numero>= 999 && numero< 9999) {
        return "00" + (Number(numero)+1);
    }
    if (numero>= 99 && numero< 999) {
        return "000" + (Number(numero)+1);
    }
    if (numero>= 9 && numero< 99) {
        return "0000" + (Number(numero)+1);
    }
    if (numero < 9 ){
        return "00000" + (Number(numero)+1);
    }
}



