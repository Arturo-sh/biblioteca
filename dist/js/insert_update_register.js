// Añadir registros
$(document).on('click', '.btn-next', function() {
    var module = $(this).attr("mod");
    var action = $(this).attr("action");

    var id_usuario = $("#id_usuario").val();
    var rol_usuario = $("#rol_usuario").val();
    var usuario = $("#usuario").val();
    var contrasenia = $("#contrasenia").val();
    var nombre_usuario = $("#nombre_usuario").val();
    var telefono_usuario = $("#telefono_usuario").val();
    var correo_usuario = $("#correo_usuario").val();

    $.ajax({
        url: "modules/" + module + "/model.php",
        method: "POST",
        data: {
            action,
            id_usuario,
            rol_usuario,
            usuario,
            contrasenia,
            nombre_usuario,
            telefono_usuario,
            correo_usuario
        },
        success: function(response) {
            Swal.fire({
                icon: "success",
                title: response,
                showConfirmButton: false,
                timer: 2000
            });
        }
    });

    table.ajax.reload();
});