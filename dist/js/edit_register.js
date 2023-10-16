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
    $("#id_prestamo").val("");
    $("#id_alumno").val("0").trigger("change");
    $("#id_libro").val("0").trigger("change");
    $("#titulo_libro").val("");
    $("#unidades_prestamo").val("");
    $("#fecha_entrega").val("");
    $("#estado_prestamo").val("Pendiente");
    $(".btn-next").attr("name", "btn_insert");
    $(".btn-next").text("Guardar");
    $("#estado_prestamo").attr("disabled", true);
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

function reset_book_data() {
    $("#id_libro").val("");
    $("#titulo_libro").val("");
    $("#id_editorial").val("0").trigger("change");
    $("#id_categoria").val("0").trigger("change");
    $("#unidades_totales").val("");
    $("#image-view").attr("src", "dist/portadas/portada_default.png");
    $(".image-field").attr("hidden", true);
    $("#descripcion").val("");
    $("#estado_libro").val("Activo");
    $(".btn-next").attr("name", "btn_insert");
    $(".btn-next").text("Guardar");
    $("#estado_libro").attr("disabled", true);
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

function reset_student_data() {    
    $("#id_alumno").val("");
    $("#matricula").val("");
    $("#nombre_alumno").val("");
    $("#semestre").val("1");
    $("#estado_alumno").val("Activo");
    $(".btn-next").attr("name", "btn_insert");
    $(".btn-next").text("Guardar");
    $("#estado_alumno").attr("disabled", true);
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
    $("#contrasenia").removeAttr("required");
    $("#estado_usuario").removeAttr("disabled");
}

function reset_user_data() {
    $("#id_usuario").val("");
    $("#rol_usuario").val("Usuario");
    $("#usuario").val("");
    $("#nombre_usuario").val("");
    $("#telefono_usuario").val("");
    $("#correo_usuario").val("");
    $("#estado_usuario").val("");
    $(".btn-next").attr("name", "btn_insert");
    $(".btn-next").text("Guardar");
    $("#pass-label").text("Contraseña");
    $("#estado_usuario").val("Activo"); 
    $("#contrasenia").attr("required", true);
    $("#estado_usuario").attr("disabled", true);
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

// $(document).on('click', '.btn-reset', function() {
//     var module = $(this).attr("mod");    

//     switch(module) {
//         case 'prestamos':
//             reset_loan_data();
//             break;
//         case 'libros':
//             reset_book_data();
//             break;
//         case 'alumnos':
//             reset_student_data();
//             break;
//         case 'usuarios':
//             reset_user_data();
//             break;
//         }
// });