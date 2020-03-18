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
});
function escogercliente(even) {
    if (even == 1) {
        $("#dni").remove();
        $("#ruc").remove();
        $("#dnilabel").remove();
        $("#rucsocial").remove();
        $('#clie').append('<div class="input-group"  id="rucsocial">\n' +'<div class="input-group-prepend">\n' + '<button class="btn btn-primary waves-effect btncliente waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CLIENTE</button>\n' + '</div>\n' + '<input type="text" class="form-control" id="cliente"  aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' +'</div>')
        $('#dni1').append('<label for="example-gridsize" style="color: black" id="dnilabel">DNI</label>\n' + '<div class="input-group">\n' + '<input type="number" class="form-control" id="dni" placeholder="DNI" aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' + '</div>');
    } else {
        $("#ruc").remove();
        $("#dni").remove();
        $("#dnilabel").remove();
        $('#cliente').remove();
        $('.btncliente').remove();
        $("#rucsocial").remove();
        $('#clie').append('<div class="input-group"  id="rucsocial">\n' +'<div class="input-group-prepend">\n' + '<button class="btn btn-primary waves-effect btncliente waves-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">RAZON SOCIAL</button>\n' + '</div>\n' + '<input type="text" class="form-control" id="razon_social"  aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' +'</div>')
        $('#dni1').append('<label for="example-gridsize" style="color: black" id="dnilabel">RUC</label>\n' + '<div class="input-group">\n' + '<input type="number" class="form-control ruc" id="ruc" placeholder="RUC" aria-label="Username" style=\'font-size: 12pt; font-weight: bold; color: #0000ff;\' aria-describedby="basic-addon1">\n' + '</div>')
    }

}
