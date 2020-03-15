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
