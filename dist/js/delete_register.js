// Alerta eliminación de registros
function show_alert_deleted(data) {
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

function delete_register(id, url) {
    $.ajax({
        url: url,
        method: "POST",
        data: {
            delete_id: id
        },
        success: function(response) {
            show_alert_deleted(response);
            
            setTimeout(function() {
                window.location.reload();
            }, 1000);
        }
    });
}

function show_delete_alert(id, url) {
    Swal.fire({
        title: `Esta seguro de eliminar el registro ${id}?`,
        text: 'Esto no se puede revertir!',
        icon: 'error',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            delete_register(id, url);
        }
    });
}

$(document).on('click', '.btn-delete', function() {
    var id = $(this).attr("id");
    var url = $(this).attr("url");

    show_delete_alert(id, url);
});