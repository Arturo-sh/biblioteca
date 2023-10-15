// Edición de registros
function set_loan_data(response) {
    let data = JSON.parse(response);
    console.log(data)
    
    $("#id_prestamo").val(data[0].id_prestamo);
    $("#id_alumno").val(data[0].id_alumno).trigger("change");
    $("#id_libro").val(data[0].id_libro).trigger("change");
    $("#titulo_libro").val(data[0].titulo_libro);
    $("#unidades_prestamo").val(data[0].unidades_prestamo);
    $("#fecha_entrega").val(data[0].fecha_entrega);
    $("#estado_prestamo").val(data[0].estado_prestamo);
    $(".btn-next").attr("name", "btn_update");
    $(".btn-next").text("Actualizar");
    $("#estado_prestamo").removeAttr("disabled");
}

function reset_loan_data() {
    $("#id_alumno").val("1").trigger("change");
    // $("#id_libro").val("19").trigger("change");
    $("#id_libro").data('lastValue', $("#id_libro").val().trigger("change"));


}

function set_book_data(response) {
    let data = JSON.parse(response);

    $("#id_libro").val(data[0].id_libro);
    $("#titulo_libro").val(data[0].titulo_libro);
    $("#id_editorial").val(data[0].id_editorial).trigger("change");
    $("#id_categoria").val(data[0].id_categoria).trigger("change");
    $("#unidades_totales").val(data[0].unidades_totales);
    $("#image-view").attr("src", "dist/portadas/" + data[0].imagen_portada);
    $(".image-field").removeAttr("hidden");
    $("#descripcion").val(data[0].descripcion);
    $("#estado_libro").val(data[0].estado_libro);
    $(".btn-next").attr("name", "btn_update");
    $(".btn-next").text("Actualizar");
    $("#estado_libro").removeAttr("disabled");
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

$(document).on('click', '.btn-edit', function() {
    var edit_id = $(this).attr("id");
    var url = $(this).attr("url");

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
                    set_loan_data(response);
                    break;
                case 'libros':
                    set_book_data(response);
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
});

$(document).on('click', '.btn-reset', function() {
    var module = $(this).attr("mod");    

    switch(module) {
        case 'prestamos':
            reset_loan_data();
            break;
        case 'libros':
            reset_book_data();
            break;
        case 'alumnos':
            reset_student_data();
            break;
        case 'usuarios':
            reset_user_data();
            break;
        }
});