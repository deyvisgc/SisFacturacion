$(document).ready(function (e) {
    $('#btn1').click(function () {
        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                document.getElementById('hola').style.display = 'none';
                document.getElementById('btn1').style.display = 'block';
            }
        });
    });
    $('#bsucardni').on('click', function() {
        $('#bsucardni').buttonLoader('start');
        var dni=$('#dni').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url:urlbuscar,
            type: 'post',
            dataType: 'json',
            data:{'dni':dni},
            success: function (response) {
                console.log(response);
                $('#bsucardni').buttonLoader('stop');
            }
        });

    });
});
function escogercliente(even) {
    if (even == 1) {
        $("#dni").remove();
        $("#ruc").remove();
        $("#dnilabel").remove();
        $("#rucsocial").remove();
        $('#clie').append('<div class="input-group"  id="rucsocial">\n' +'<div class="input-group-prepend">\n' + '<button class="btn btn-primary waves-effect btncliente waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CLIENTE</button>\n' + '</div>\n' + '<input type="text" class="form-control" id="cliente"  aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' +'</div>')
        $('#dni1').append('<label for="example-gridsize" style="color: black" id="dnilabel">DNI</label>\n' + '<div class="input-group">\n' + '<input type="text"  maxlength="8" onkeypress="return controltag(event)" class="form-control" id="dni" placeholder="DNI" aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' + '</div>');
    } else {
        $("#ruc").remove();
        $("#dni").remove();
        $("#dnilabel").remove();
        $('#cliente').remove();
        $('.btncliente').remove();
        $("#rucsocial").remove();
        $('#clie').append('<div class="input-group"  id="rucsocial">\n' +'<div class="input-group-prepend">\n' + '<button class="btn btn-primary waves-effect btncliente waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RAZON SOCIAL</button>\n' + '</div>\n' + '<input type="text" class="form-control" id="razon_social"  aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' +'</div>')
        $('#dni1').append('<label for="example-gridsize" style="color: black" id="dnilabel">RUC</label>\n' + '<div class="input-group">\n' + '<input type="text" maxlength="8"  onkeypress="return controltag(event)" class="form-control ruc" id="ruc" placeholder="RUC" aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' + '</div>')
    }


}

function escogerclientedelsistema(even) {
    if (even == 1) {
        $("#dnicliente").remove();
        $("#ruc1").remove();
        $("#dnilabelsistema").remove();
        $("#rucsocialcliente").remove();
        $("#dni2").remove();
        $('#rucsocialsistema').remove();
        $('#cliente_sistema').append('<div class="input-group"  id="rucsocialsistema">\n' +'<div class="input-group-prepend">\n' + '<button class="btn btn-primary waves-effect btnclientesistema waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CLIENTE</button>\n' + '</div>\n' + '<input type="text" class="form-control" id="client_sistema"  aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' +'</div>')
        $('#cli_dni').append('<label for="example-gridsize" style="color: black" id="dnilabelsistema">DNI</label>\n' + '<div class="input-group">\n' + '<input type="text" maxlength="8"  onkeypress="return controltag(event)"    class="form-control" id="dni2" placeholder="DNI" aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' + '</div>');
    } else {
        $("#dnicliente").remove();
        $("#ruc1").remove();
        $("#dnilabelsistema").remove();
        $('#client_sistema').remove();
        $('.btnclientesistema').remove();
        $("#dni2").remove();
        $("#rucsocialsistema").remove();
        $('#cliente_sistema').append('<div class="input-group"  id="rucsocialsistema">\n' +'<div class="input-group-prepend">\n' + '<button class="btn btn-primary waves-effect btnclientesistema waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RAZON SOCIAL</button>\n' + '</div>\n' + '<input type="text" class="form-control" id="razon_social1"  aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' +'</div>')
        $('#cli_dni').append('<label for="example-gridsize" style="color: black" id="dnilabelsistema">RUC</label>\n' + '<div class="input-group">\n' + '<input type="text"  onkeypress="return controltag(event)" class="form-control ruc" id="ruc1" placeholder="RUC" aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' + '</div>')
    }
}
function controltag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; // para la tecla de retroseso
    else if (tecla==0||tecla==9)  return true; //<-- PARA EL TABULADOR-> su keyCode es 9 pero en tecla se esta transformando a 0 asi que porsiacaso los dos
    patron =/[0-9\s]/;// -> solo numeros
    te = String.fromCharCode(tecla);
    return patron.test(te);
}
