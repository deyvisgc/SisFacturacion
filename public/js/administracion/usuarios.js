$(document).ready(function () {
    var urlgeneral='http://127.0.0.1:8000/';
  var clave;
  var clave_confir;
    $(".select2").select2({
        theme: "bootstrap",
        placeholder: "SELECCIONE EL ROL",

    } );
    $('#clave,#confir_clave').keyup(function (event) {
        var clave=$('#clave').val();
        var confgir_clave=$('#confir_clave').val();
        if (clave == confgir_clave) {
            $('#message').html('contraseñas correctas').css('color', 'green');
        } else
            $('#message').html('contraseñas incorrectas').css('color', 'red');

    });
    $("#file").change(function () {
        filePreview(this);
    });
    $('#regisusuario').click(function (e) {
        e.preventDefault();
        alert('sdsds');
        guardar(urlgeneral);

    })
});
function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imagen').removeAttr('src');
            $('#imagen').attr('src', e.target.result).fadeIn('slow');
        };
        reader.readAsDataURL(input.files[0]);
    }

}
function guardar(url) {

 var dataString= $('form').serialize();
    alert('Datos serializados: '+dataString);
 var usuario=$('#usuario').val();
 var clave=$('#clave').val();
 var rol=$('#rol').val();


}
