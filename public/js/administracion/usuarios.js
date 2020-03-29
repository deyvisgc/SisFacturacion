
$(document).ready(function () {
    var urlgeneral='http://127.0.0.1:8000/',clave,clave_confir,imagen;
    listar(urlgeneral);
    $('#clave,#confir_clave').keyup(function (event) {
        var clave=$('#clave').val();
        var confgir_clave=$('#confir_clave').val();
        if (clave == confgir_clave) {
            $('#message').html('contraseñas correctas').css('color', 'green');
        } else
            $('#message').html('contraseñas incorrectas').css('color', 'red');

    });
    $("#file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imagen').removeAttr('src');
                $('#imagen').attr('src', e.target.result).fadeIn('slow');
            };
            imagen=this.files[0];
            reader.readAsDataURL(this.files[0]);

        }
      //  filePreview(this);
    });
    $('#correo').change(function (e) {
        var emailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var EmailId = this.value;

        if (emailRegex.test(EmailId))
            this.style.backgroundColor = "";
        else

            this.style.backgroundColor = "LightPink";
    });
    $("#file").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#file1').removeAttr('src');
                $('#file1').attr('src', e.target.result).fadeIn('slow');
            };
            imagen=this.files[0];
            reader.readAsDataURL(this.files[0]);
        }
        //  filePreview(this);
    });
    $('#regis').click(function () {
        $('#myModal').modal('show');
    });
    $('#regisusuario').click(function (e) {
        e.preventDefault();
        guardar(urlgeneral,imagen);

    });
    $('#btnactualizar').click(function (e) {
        e.preventDefault();
        let formData = new FormData();
        formData.append('usuario', $('#usuarios').val());
        formData.append('rol', $('#rol_up').val());
        formData.append('nombre', $('#nombre_up').val());
        formData.append('apellidos', $('#apellidos_up').val());
        formData.append('telefono', $('#telefono_up').val());
        formData.append('dni', $('#dni_up').val());
        formData.append('correo', $('#correo_up').val());
        formData.append('fecha_naci', $('#fecha_naci_up').val());
        formData.append('id_user', $('#id_user').val());
        formData.append('id_persona', $('#id_persona').val());
        formData.append('files', imagen);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });
        $.ajax({
            url: urlgeneral + 'update',
            dataType: 'json',
            type: 'post',
            data: formData,
            cache: false,
            processData: false,  // tell jQuery not to process the data
            contentType: false,
            success: function (respon) {
                if (respon.succes === true) {
                    //  table.api().ajax.reload();
                    toastr.options ={ "closeButton":true, "progressBar": true};
                    toastr.success(
                        "!Registro Exitoso",
                    );
                    console.log(respon)
                    $('#updateuser').modal('hide');
                    $('.tbusuarios').DataTable().ajax.reload();
                } else {
                    alert('error');
                }
            }
        });

    });

    $('body').on('hidden.bs.modal', '.modal', function () {
        $("#rol_up").empty();
    });
});



function controltag(e) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8) return true; // para la tecla de retroseso
    else if (tecla==0||tecla==9)  return true; //<-- PARA EL TABULADOR-> su keyCode es 9 pero en tecla se esta transformando a 0 asi que porsiacaso los dos
    patron =/[0-9\s]/;// -> solo numeros
    te = String.fromCharCode(tecla);
    return patron.test(te);
}

function guardar(url,imagen) {
    let formData = new FormData();
    formData.append('usuario', $('#usuario').val());
    formData.append('clave', $('#clave').val());
    formData.append('rol', $('#rol').val());
    formData.append('nombre', $('#nombre').val());
    formData.append('apellidos', $('#apellidos').val());
    formData.append('telefono', $('#telefono').val());
    formData.append('dni', $('#dni').val());
    formData.append('correo', $('#correo').val());
    formData.append('fecha_naci', $('#fecha_nacimiento').val());
    formData.append('file', imagen);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        url: url + 'Usuario',
        dataType: 'json',
        type: 'post',
        data: formData,
        cache: false,
        processData: false,  // tell jQuery not to process the data
        contentType: false,
        success: function (respon) {
            if (respon.succes === true) {
                //  table.api().ajax.reload();
                $('#myModal').modal('hide');
                $('.tbusuarios').DataTable().ajax.reload();
            } else {
                alert('error');
            }
        }
    });
}
function listar(urlgeneral) {
    $('.tbusuarios').DataTable({
        processing: false,
        serverSide: true,
        destroy: true,
        ajax: urlgeneral+'Usuario',
        columns: [
            {
                mRender: function(data, type, row) {
                    return '<div class="custom-control custom-checkbox">\n' +
                        '<input type="checkbox" class="custom-control-input" id="customCheck2">\n' +
                        ' <label class="custom-control-label" for="customCheck2">&nbsp;</label>\n' +
                        '</div>'
                }
            },
            {data: 'nombres'},
            {data: 'usuario'},
            {data: 'nombre_rol'},
            {data: 'telefono_per'},
            {data: 'dni_per'},
            {data: 'imagen', name: 'imagen', orderable: true, searchable: true},
            {
                data: null,
                render: function (data, type, row) {

                    return '<a href="javascript:void(0);" style="margin-left: 20px;color: #F2EF1D" class="action-icon"> <i class="mdi mdi-eye"></i></a>'+
                            '<a onclick="actualizar('+row.idPersona+')"  style="color: #18F526"  class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>'+
                             '<a href="javascript:void(0);" style="color: red;"  class="action-icon"> <i class="mdi mdi-delete"></i></a>';
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
function actualizar(id) {
    var urlgeneral='http://127.0.0.1:8000/';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $.ajax({
        url: urlgeneral + 'edit/'+id,
        type: 'post',
        dataType: 'json',
        success: function (respon) {
       $.each(respon.perso,function (index,val) {
           $('#usuarios').val(val.usuario);
           $('#file1').removeAttr('src');
           $('#file1').attr('src', asset + val.user_foto);
           $('#nombre_up').val(val.nombre_per);
           $('#apellidos_up').val(val.apellidos_per);
           $('#telefono_up').val(val.telefono_per);
           $('#dni_up').val(val.dni_per);
           $('#correo_up').val(val.gmail);
           $('#fecha_naci_up').val(val.Fecha_Nacimiento);
           $('#id_user').val(val.idusuarios);
           $('#nombre_perfil').html(val.nombre_per + ' ' + val.apellidos_per);
           $('#id_persona').val(val.idPersona);
           $.each(respon.rol, function (index, va) {
               if (va.id_rol === val.Id_Rol) {
                   $('#rol_up').append('<option selected  value="' + va.id_rol + '">' + va.nombre_rol + '</option>')
               } else {
                   $('#rol_up').append('<option  value="' + va.id_rol + '">' + va.nombre_rol + '</option>')
               }
           });
           $('#updateuser').modal('show');
       })
        }

    });

}

$(document).ready(function(){
    $.fn.datepicker.defaults.language = 'it';
});


$(document).ready(function(){
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
});




