// Alerta aumentar/decrementar semestre
function alert_changed_grade(data) {
    let e = JSON.parse(data);
    let icon = e.icon;
    let title = e.title;

    Swal.fire({
        icon: icon,
        title: title,
        showConfirmButton: false,
        timer: 2000
    });
}

function change_grade(action) {
    $.ajax({
        url: "modules/alumnos/model.php",
        method: "POST",
        data: {
            action: action
        },
        success: function(response) {
            alert_changed_grade(response);
            
            setTimeout(function() {
                window.location.reload();
            }, 1000);
        }
    });
}

function confirm_change_grade(data) {
    let e = JSON.parse(data);
    let total_students = e.total_students;
    let grade_students = e.grade_students;
    let action = e.action;
    let msg = "";

    if (total_students != 0) {
        msg = `Este cambio dará de baja a ${total_students} alumnos de ${grade_students} semestre.\n¿Desea continuar?`;
    } else {
        msg = `¿Seguro que desea continuar?`
    }

    Swal.fire({
        title: msg,
        text: 'Este cambio se puede revertir únicamente de forma manual!',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            change_grade(action);
        }
    });
}

$(document).on('click', '.btn-change-grade', function() {
    var action_id = $(this).attr("id");

    $.ajax({
        url: "modules/alumnos/model.php",
        method: "POST",
        data: {
            action_id: action_id
        },
        success: function(response) {
            confirm_change_grade(response);
        }
    });
});