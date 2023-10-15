// Edición de registros
function set_user_data(response) {
    let data = JSON.parse(response);
    
    $("#id_usuario").val(data[0].id_usuario);
    $("#rol_usuario").val(data[0].rol_usuario);
    $("#usuario").val(data[0].usuario);
    $("#nombre_usuario").val(data[0].nombre_usuario);
    $("#telefono_usuario").val(data[0].telefono_usuario);
    $("#correo_usuario").val(data[0].correo_usuario);
    $("#estado_usuario").val(data[0].estado_usuario);
    $(".btn-next").attr("name", "btn_update");
    $(".btn-next").text("Actualizar");
    $("#pass-label").text("Nueva contraseña");
    $("#contrasenia").removeAttr("required");
    $("#estado_usuario").removeAttr("disabled");
}

function set_student_data(response) {
    let data = JSON.parse(response);
    
    $("#id_alumno").val(data[0].id_alumno);
    $("#matricula").val(data[0].matricula);
    $("#nombre_alumno").val(data[0].nombre_alumno);
    $("#semestre").val(data[0].semestre);
    $("#estado_alumno").val(data[0].estado_alumno);
    $(".btn-next").attr("name", "btn_update");
    $(".btn-next").text("Actualizar");
    $("#estado_alumno").removeAttr("disabled");
}

function get_edit_info(edit_id, url) {
    let temp = url.split("/");
    let module = temp[1];

    $.ajax({
        url: url,
        method: "POST",
        data: {
            edit_id: edit_id
        },
        success: function(response) {
            switch(module) {
                case 'prestamos':
                    set_data_user(response);
                    break;
                case 'libros':
                    set_data_user(response);
                    break;
                case 'alumnos':
                    set_student_data(response);
                    break;
                case 'usuarios':
                    set_user_data(response);
                    break;     
            }
        }
    });
}

$(document).on('click', '.btn-edit', function() {
    var id = $(this).attr("id");
    var url = $(this).attr("url");
    get_edit_info(id, url);
});