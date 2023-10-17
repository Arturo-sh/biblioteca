// Alerta eliminación de registros
$(document).on('click', '.btn-delete', function() {
    var delete_id = $(this).attr("id");
    var module = $(this).attr("mod");

    Swal.fire({
        title: `Esta seguro de eliminar el registro ${delete_id}?`,
        text: 'Esto no se puede revertir!',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "modules/" + module + "/model.php",
                method: "POST",
                data: {
                    delete_id
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
});