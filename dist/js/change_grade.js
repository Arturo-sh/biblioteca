$(document).on('click', '.btn-change-grade', function() {
    var action_id = $(this).attr("id");

    $.ajax({
        url: "modules/alumnos/model.php",
        method: "POST",
        data: {
            action_id: action_id
        },
        success: function(response) {
            let data = JSON.parse(response);
            let action_change_semester = data.action;
            let msg = data.msg;

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
                    $.ajax({
                        url: "modules/alumnos/model.php",
                        method: "POST",
                        data: {
                            action_change_semester
                        },
                        success: function(response) {
                            table.ajax.reload();
                            Swal.fire({
                                icon: "success",
                                title: response,
                                showConfirmButton: false,
                                timer: 2000
                            });
                        }
                    });
                }
            });
        }
    });
});