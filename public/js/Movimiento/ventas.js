$(document).ready(function (e) {
    var tipo_pago;
    var idpersona=localStorage.getItem("id_persona");
    var idvendedor=$('#idvendedor').html();
    var idproveedor=localStorage.getItem("idproveedor");;
    var comprobante;
    Listar(idpersona,idvendedor,idproveedor);
    obtenertotales(idvendedor,idpersona,idproveedor);

  $('#buscarruc').hide();
    $('#dnicliente').autocomplete({
        source: function (request, response) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: urlbuscar+'/buscardnixsistema',
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
            $('#client_sistema').val(ui.item.value);
            $('#dnicliente').val(ui.item.dni);
            $('#idcliente').val(ui.item.idpersona);
            return false;
        }

    });
    $('#producto').autocomplete({
        source: function (request, response) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: urlbuscar+'/Productoventa',
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
            $('#producto').val(ui.item.value);
            $('#precio_venta').val(ui.item.precio);
            $('#idproducto').val(ui.item.idproducto);
            $('#stcok').html(ui.item.stock);
            $('#file').removeAttr('src');
            $('#file').attr('src', asset + ui.item.ima);
            $('#modelproducto').html(ui.item.modelo);
            $('#precio_compra').val(ui.item.precio_compra);
            return false;
        }

    });
    $(".ui-autocomplete.ui-widget").css('font-size', '15px');
    $('#comprobante_venta').change(event,function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
         comprobante=event.target.value;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url:urlventas+'/Obtenercantidadcomprobante',
            type:'post',
            dataType:'json',
            data:{
                'idcompro':comprobante
            },
            success:function (res) {
                console.log(res[0]['id']);
                if (res[0]['id'] == comprobante){
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

    $('#pagos').change(event,function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        tipo_pago= event.target.value;

    });

    $('#btnmodal').click(function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        if (tipo_pago==2){
            $('#modalPagar').modal('show');
            var subtotal= $('#total1').html();
            $('#totalapagar').val(subtotal);
            var serie=$('#serie').val();
            var num_venta=$('#n_venta').val();
            document.getElementById('btncargando').style.display = 'none';
            $('#btnpagar').click(function () {
                document.getElementById('btnpagar').style.display = 'none';
                document.getElementById('btncargando').style.display = 'block';
                var data={};
                data.idcliente=idpersona;
                data.idusuario=idvendedor;
                data.monto_efectivo=$('#monto').val();
                data.vuelto=$('#vuelto').val();
                data.tipo_pago=tipo_pago;
                data.comprobante=comprobante;
                data.num_venta=num_venta;
                data.serie=$('#serie').val();
                console.log(data);
                $.ajax({
                    url: urlventas+'/Vender',
                    dataType: 'json',
                    type: 'post',
                    data:data,
                    success: function (data) {
                        console.log(data);
                        if(data.success==true){
                            toastr.options ={ "closeButton":true, "progressBar": true};
                            toastr.success(
                                "!Venta Exitosa",
                                "Productos vendidos",
                            );
                            $('#modalPagar').modal('hide');
                            $('#totalapagar').val(0);
                            $('#monto').val(0);
                            $('#vuelto').val(0);
                            document.getElementById('btncargando').style.display = 'none';
                            document.getElementById('btnpagar').style.display = 'block';
                            $('#tablecarventa').DataTable().ajax.reload();
                            $('#total').html(0);
                            $('#subtotal').html(0);
                            $('#Igv').html(0);
                            $('#total1').html(0);

                        }
                    },
                    error: function (data) {
                        if (data.error==true) {
                            toastr.options ={ "closeButton":true, "progressBar": true};
                            toastr.error(
                                "!Porfavor revisa los productos",
                                "No se encontraron productos",
                            );
                        }
                    }
                });
            });


        }else {
            alert('pago con tarjeta');
        }

    });
    $('#monto').keyup(function (event) {
        var monto=event.target.value;
        var total=$('#totalapagar').val();
        var vuelto=parseFloat(monto)-parseFloat(total);
        if (monto==''){
            $('#vuelto').val('0.00');
        }else {
            $('#vuelto').val(vuelto.toFixed(2));
        }
    });
    });


function escogercliente(even) {
    if (even == 1) {
        $("#dni").remove();
        $("#ruc").remove();
        $("#dnilabel").remove();
        $('#buscarruc').hide();
        $('#buscardni').show();
        $("#rucsocial").remove();
        $('#clie').append('<div class="input-group"  id="rucsocial">\n' +'<div class="input-group-prepend">\n' + '<button class="btn btn-primary waves-effect btncliente waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CLIENTE</button>\n' + '</div>\n' + '<input type="text" class="form-control" id="cliente"  aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' +'</div>')
        $('#dni1').append('<label for="example-gridsize" style="color: black" id="dnilabel">DNI</label>\n' + '<div class="input-group">\n' + '<input type="text"  maxlength="8" onkeypress="return controltag(event)" class="form-control" id="dni" placeholder="DNI" aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' + '</div>');
        localStorage.removeItem("idproveedor");
    } else {
        $("#ruc").remove();
        $("#dni").remove();
        $("#dnilabel").remove();
        $('#cliente').remove();
        $('.btncliente').remove();
        $('#buscarruc').show();
        $('#buscardni').hide();
        $("#rucsocial").remove();
        $('#clie').append('<div class="input-group"  id="rucsocial">\n' +'<div class="input-group-prepend">\n' + '<button class="btn btn-primary waves-effect btncliente waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RAZON SOCIAL</button>\n' + '</div>\n' + '<input type="text" class="form-control" id="razon_social"  aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' +'</div>')
        $('#dni1').append('<label for="example-gridsize" style="color: black" id="dnilabel">RUC</label>\n' + '<div class="input-group">\n' + '<input type="text"  onkeypress="return controltag(event)" class="form-control ruc" id="ruc" placeholder="RUC" aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' + '</div>')
        localStorage.removeItem("id_persona");
    }
    $('#addcarrito1').remove();
    $('#addcarrito').remove();
    $('#linpiar').remove();
    $('#btncarrito').append('<button type="button"  style="margin-left:395px"  class="btn btn-info waves-effect waves-light mb-2 mr-2" onclick="addcarritonuevos()" id="addcarrito"><i class="mdi mdi-basket mr-1"></i>Agregar</button>'+'<button type="button"   class="btn btn-danger waves-effect waves-light mb-2 mr-2" onclick="Limpiar()" id="linpiar"><i class="mdi mdi-account-remove mr-1"></i>Limpiar</button>');

}
function Listar(idpersona,idvendedor,idproveedor) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#tablecarventa').DataTable({
        processing: false,
        serverSide: true,
        destroy: true,
        "ajax": {
            "url":urlventas+'/Listarcarrito' ,
            "type": "POST",
            "data":{
                'idpersona':idpersona,
                'idvendedor':idvendedor,
                'idproveedor':idproveedor
            }
        },
        columns: [
            {data: 'nombres'},
            {data: 'Nombre_Productos'},
            {
                data: null,
                render: function (data, type, row) {
                    return '<input type="number"  onkeyup="sumCantidad(' + row.id_Tem_Carito + ')" id="Cantidad1" class="form-control" value="' + row.Cantidad + '">'+
                             '<input type="number"   id="idproveechangecan" hidden class="form-control" value="' + row.id_Proveedor + '">'+
                            '<input type="number"   id="idclienchangecan" hidden class="form-control" value="' + row.id_Persona + '">'
                }
            },
            {data: 'Precio_Venta'},
            {data: 'Subtotal'},
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

}
function escogerclientedelsistema(even) {
    if (even == 3) {
        $('#cliente_sistema').append('<div class="input-group"  id="dni_sistema">\n' +'<div class="input-group-prepend">\n' + '<button class="btn btn-primary waves-effect btnclientesistema waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CLIENTE</button>\n' + '</div>\n' + '<input type="text" class="form-control" id="client_sistema"  aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' +'</div>')
        $('#cli_dni').append('<label for="example-gridsize" style="color: black" id="dnilabelsistema">DNI</label>\n' + '<div class="input-group">\n' + '<input type="text" maxlength="8"  onkeypress="return controltag(event)"    class="form-control" id="dnicliente" placeholder="DNI" aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' + '</div>');
        $("#ruc1222").remove();
        $("#dnilabelsistema").remove();
        $("#rucsocialcliente").remove();
        $('#rucsocialsistema').remove();
        $('#dnicliente').remove();
        $('#dnicliente').autocomplete({
            source: function (request, response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: urlbuscar+'/buscardnixsistema',
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
                $('#client_sistema').val(ui.item.value);
                $('#dnicliente').val(ui.item.dni);
                $('#idcliente').val(ui.item.idpersona);
                return false;
            }

        });
        $(".ui-autocomplete.ui-widget").css('font-size', '15px');
        $('#idproveedor').val("");

    } else {
        $("#dnilabelsistema").remove();
        $('#client_sistema').remove();
        $('.btnclientesistema').remove();
        $("#dnicliente").hide();
        $("#dni_sistema").remove();
        $('#cliente_sistema').append('<div class="input-group"  id="rucsocialsistema">\n' +'<div class="input-group-prepend">\n' + '<button class="btn btn-primary waves-effect btnclientesistema waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RAZON SOCIAL</button>\n' + '</div>\n' + '<input type="text" class="form-control" id="razon_social1"  aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' +'</div>')
        $('#cli_dni').append('<label for="example-gridsize" style="color: black" id="dnilabelsistema">RUC</label>\n' + '<div class="input-group">\n' + '<input type="text"  onkeypress="return controltag(event)" class="form-control"   id="ruc1222" placeholder="RUC" aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' + '</div>')
        $('#ruc1222').autocomplete({
            source: function (request, response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: urlbuscar+'/Proveedor',
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
                $('#razon_social1').val(ui.item.razonsocial);
                $('#idproveedor').val(ui.item.idprovee);
                $('#ruc1222').val(ui.item.ruc);
                return false;
            }

        });
        $(".ui-autocomplete.ui-widget").css('font-size', '15px');
        $('#idcliente').val("");
        if (localStorage.getItem("id_persona")!=''){
            localStorage.removeItem('id_persona');
        }
    }
    $('#addcarrito1').remove();
    $('#addcarrito').remove();
    $('#linpiar').remove();
    $('#btncarrito').append('<button type="button"  style="margin-left:395px" class="btn btn-success waves-effect waves-light mb-2 mr-2" onclick="addcarritotypecliensistema()" id="addcarrito1"><i class="mdi mdi-basket mr-1"></i>Agregar</button>'+'<button type="button"   class="btn btn-danger waves-effect waves-light mb-2 mr-2" onclick="Limpiar()" id="linpiar"><i class="mdi mdi-account-remove mr-1"></i>Limpiar</button>');

}
function controltag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; // para la tecla de retroseso
    else if (tecla==0||tecla==9)  return true; //<-- PARA EL TABULADOR-> su keyCode es 9 pero en tecla se esta transformando a 0 asi que porsiacaso los dos
    patron =/[0-9\s]/;// -> solo numeros
    te = String.fromCharCode(tecla);
    return patron.test(te);
}
function buscardni() {
    $('#buscardni').buttonLoader('start');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    var dni=$('#dni').val();
    $.ajax({
        url:urlbuscar+'/buscardni',
        type: 'post',
        dataType: 'json',
        data:{'dni':dni},
        success: function (response) {
            console.log(response);
            localStorage.setItem('dni',response.dni);
            localStorage.setItem('nombres',response.nombre);
            localStorage.setItem('materno',response.materno);
            localStorage.setItem('paterno',response.paterno);
            localStorage.setItem('fecha_naci',response.nacimiento);
            $('#buscardni').buttonLoader('stop');
            $('#cliente').val(response.nombre.concat(' ',response.paterno,' ', response.materno));
        }
    });
}
function busarruc(){
    $('#buscarruc').buttonLoader('start');
    var ruc=$('#ruc').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        url:urlbuscar+'/buscarruc',
        type: 'post',
        dataType: 'json',
        data:{'ruc':ruc},
        success: function (response) {
            console.log(response);
            $('#buscarruc').buttonLoader('stop');
            $('#razon_social').val(response.nombre_o_razon_social);
            localStorage.setItem('ruc',response.ruc);
            localStorage.setItem('nombre_o_razon_social',response.nombre_o_razon_social);
            localStorage.setItem('estado_del_contribuyente',response.estado_del_contribuyente);
            localStorage.setItem('provincia',response.provincia);
            localStorage.setItem('departamento',response.departamento);
            localStorage.setItem('direccion',response.direccion);
        }
    });
}
function addcarritonuevos() {
    var dni= $('#dni').val();
    var ruc= $('#ruc').val();
    if (dni==''||ruc==''){
        toastr.options ={ "closeButton":true, "progressBar": true};
        toastr.warning(
            "!Porfavor complete su dni o su ruc",
            "Campo Requerido",);
    }else {
        if(dni==undefined){
            $.ajax({
                url:urlventas+'/validarruc',
                type:'post',
                dataType:'json',
                data:{'ruc':ruc},
                success:function (response) {
                    console.log(response);
                    if (response==''){
                        var ruc=localStorage.getItem("ruc");
                        var nombre_o_razon_social=localStorage.getItem("nombre_o_razon_social");
                        var estado_del_contribuyente=localStorage.getItem("estado_del_contribuyente");
                        var provincia=localStorage.getItem("provincia");
                        var departamento=localStorage.getItem("departamento");
                        var direccion=localStorage.getItem("direccion");
                        registrarnewclientexruc(ruc,nombre_o_razon_social,estado_del_contribuyente,provincia,departamento,direccion);
                    }
                    else {
                        validarcarrito();
                    }
                },
                error:function (response) {
                    alert(response)
                }
            });
        }else{
            $.ajax({
                url:urlventas+'/validardni',
                type:'post',
                dataType:'json',
                data:{'dni':dni},
                success:function (response) {
                    console.log(response);
                    if (response==''){
                        var dni=localStorage.getItem("dni");
                        var nombres=localStorage.getItem("nombres");
                        var paterno=localStorage.getItem("paterno");
                        var materno=localStorage.getItem("materno");
                        var fecha_nacimi=localStorage.getItem("fecha_naci");
                        registrarnewcliente(dni,nombres,paterno,materno,fecha_nacimi);
                    }
                    else {
                        validarcarrito();
                    }
                },
                error:function (response) {
                    alert(response)
                }
            });
        }

    }
}
function registrarnewcliente(dni,nombres,paterno,materno,fecha_nacimi) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:urlventas+'/crearnewcliente',
        type:'post',
        dataType:'json',
        data:{'dni':dni,'nombres':nombres,'paterno':paterno,'materno':materno,'fecha_nacimi':fecha_nacimi},
        success:function (response) {
            if (response!=''){
                localStorage.setItem('id_persona',response.id_Persona_nuevo);
                localStorage.removeItem('dni');
                localStorage.removeItem('nombres');
                localStorage.removeItem('paterno');
                localStorage.removeItem('materno');
                localStorage.removeItem('fecha_naci');
                localStorage.removeItem('apellidoma');
                validarcarrito();
            }
        }
    });
}
function registrarnewclientexruc(ruc, nombre_razon, estado_del_contribuyente, provincia, departamento, direccion){
   if (estado_del_contribuyente=='SUSPENSION TEMPORAL'){
       toastr.error("!Esta Empresa esta en suspencion temporal", "OOPSS",);
   }else{
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       $.ajax({
           url:urlventas+'/crearnewclientexruc',
           type:'post',
           dataType:'json',
           data:{'ruc':ruc,'nombre_razon':nombre_razon,'provincia':provincia,'departamento':departamento,'direccion':direccion},
           success:function (response) {

               if (response!=''){
                   localStorage.setItem('idproveedor',response.id_Persona_nuevo);
                   localStorage.removeItem('ruc');
                   localStorage.removeItem('nombre_o_razon_social');
                   localStorage.removeItem('estado_del_contribuyente');
                   localStorage.removeItem('provincia');
                   localStorage.removeItem('departamento');
                   localStorage.removeItem('direccion');
                   validarcarrito();
               }
           }
       });
   }
}

function obtenertotales(idvendedor,idcliente,idproveedor) {
    $.ajax({
        url: urlventas+'/Obtenertotales',
        dataType: 'json',
        type: 'post',
        data:{ 'idpersona':idcliente,
               'idvendedor':idvendedor,
                'idproveedor':idproveedor
        },
        success: function (data) {
            dataventa={};
            console.log(data);
            $('#total').html(data['total']);
            $('#total1').html(data['total']);
            $('#subtotal').html(data['subtotal']);
            $('#Igv').html(data['igv']);
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
}
function addcarritotypecliensistema() {
    var dni1= $('#dnicliente').val();
    var ruc1= $('#ruc1222').val();
    if (dni1==null ||ruc1==''){
        toastr.warning(
            "!Porfavor complete su dni o su ruc",
            "Campo Requerido",
        );
        return false;
    }else {
        validarcarrito();
    }
}
function validarcarrito() {
    var data={};
    var producto=$('#producto').val();
    var stcok=$('#stcok').html();

    var precio_Compra=$('#precio_compra').val();
    var precio_venta=$('#precio_venta').val();
    var ganan=parseFloat(precio_Compra)-parseFloat(precio_venta);
    var ganancias= Math.abs(ganan).toFixed(2);
    data.cantidad=$('#cantidad').val();
    data.precio=$('#precio_venta').val();
    data.idpersona=$('#idcliente').val();
    data.idproveedor=$('#idproveedor').val();
    data.idvendedor=$('#idvendedor').html();
    data.idcaja=$('#idcaja').html();
    data.idproducto=$('#idproducto').val();
    if (data.idpersona==''){
        data.idpersona=localStorage.getItem("id_persona");
    }
    if(data.idproveedor==''){
        data.idproveedor=localStorage.getItem("idproveedor");
    }
    data.ganancias=parseFloat(ganancias)*data.cantidad;
     console.log(data);
    if (producto==''){
        toastr.warning(
            "!Porfavor complete el producto",
            "Campo Requerido",
        );
    }
    else if(data.cantidad==''){
        toastr.warning(
            "!Porfavor complete la cantidad",
            "Campo Requerido",
        );
    } else if(parseInt(data.cantidad)>=parseInt(stcok)){
        toastr.error("!Cantidad de la venta sobrepasa el stock del producto", "OOPSS",);
    }
    else if(data.precio==''){
        toastr.warning(
            "!Porfavor complete el precio",
            "Campo Requerido",
        );
    }else{
        $.ajax({
            url: urlventas+'/ADDCARRITO',
            dataType: 'json',
            type: 'post',
            data:data,
            success: function (data) {
                console.log(data)
                dataventa={};
                console.log(data);
               dataventa.idpersona=data['id_persona'];
                dataventa.idproveedor=data['idproveedor'];
              localStorage.setItem("id_persona",data['id_persona']);
                localStorage.setItem("idproveedor",data['idproveedor']);

            //    console.log(dataventa.idproveedor);
                $('#total').html(data['total']);
                $('#total1').html(data['total']);
                $('#subtotal').html(data['subtotal']);
                $('#Igv').html(data['igv']);
                dataventa.idvendedor=$('#idvendedor').html();
                $('#tablecarventa').DataTable({
                    processing: false,
                    serverSide: true,
                    destroy: true,
                    "ajax": {
                        "url":urlventas+'/Listarcarrito' ,
                        "type": "POST",
                         "data":dataventa
                    },
                    columns: [
                        {data: 'nombres'},
                        {data: 'Nombre_Productos'},
                        {
                            data: null,
                            render: function (data, type, row) {
                                return '<input type="number"  onkeyup="sumCantidad(' + row.id_Tem_Carito + ')" id="Cantidad1" class="form-control" value="' + row.Cantidad + '">'
                            }
                        },
                        {data: 'Precio_Venta'},
                        {data: 'Subtotal'},
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
                Limpiar();


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

    }
}
function Limpiar() {
   $('#producto').val("");
   $('#cantidad').val(1);
   $('#precio_venta').val("");
   $('#stcok').html(0);

}
function sumCantidad(id) {
    var data = {};
    data.cantidad = $('#Cantidad1').val();
    data.idvendedor=$('#idvendedor').html();
    data.idtem = id;
    data.idproveechangecan=$('#idproveechangecan').val();
    data.idclienchangecan=$('#idclienchangecan').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: urlventas+'/UpdateCantidadd',
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
            $('#tablecarventa').DataTable().ajax.reload();
        }
    });

}
function Eliminar(id) {
    var idvendedor=$('#idvendedor').html();
    var idpersona=localStorage.getItem("id_persona");
    var idproveedor=localStorage.getItem("id_proveedor");
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
                    url: urlventas+'/EliminarCarrito',
                    type: 'post',
                    datType: 'json',
                    data:{'id':id,'iduser':idvendedor,'idpersona':idpersona,'idproveedor':idproveedor},
                    success: function (data) {
                        Swal.fire({title:"Deleted!",text:"Your file has been deleted.",type:"success"});
                        $('#tablecarventa').DataTable().ajax.reload();
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
function generarnumero(numero){
    if (numero>= 99999 && numero< 999999) {
        return Number(numero)+1;
    }
    if (numero>= 999 && numero< 9999) {
        return "0" + (Number(numero)+1);
    }
    if (numero>= 99 && numero< 999) {
        return "00" + (Number(numero)+1);
    }
    if (numero>= 9 && numero< 99) {
        return "000" + (Number(numero)+1);
    }
    if (numero < 9 ){
        return "0000" + (Number(numero)+1);
    }
}


