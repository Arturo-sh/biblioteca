$(document).ready(function() {
    id_libros = []; // Arreglo para almacenar los id de los libros que se van a prestar.

    // Funcion para habilitar el boton para registrar préstamos cuando se rellene el formulario.
    function checkForm() {
        var camposCompletos = true;

        if ($('#id_alumno').val() <= 0) camposCompletos = false;
        if ($('#fecha_entrega').val() === '') camposCompletos = false;
        if ($('#tbl-libros tr').length <= 0) camposCompletos = false;
        $('#tbl-libros tr').each(function () {
            if ($(this).find('input[type="number"]').val() <= 0) camposCompletos = false;
        });

        $('.btn-next').attr('disabled', !camposCompletos);
    }
  
    $("form").on("keyup change", "input, select", function() {
        checkForm();
    });
  
    checkForm();

    // Cargar datos para los cards.
    function load_cards() {
        $.ajax({
            type: "POST",
            url: "modules/inicio/model.php",
            data: { cards_info: true },
            success: function (response) {
                let data = JSON.parse(response);

                $("#card_prestamos").text(data.card_prestamos);
                $("#card_libros").text(data.card_libros);
                $("#card_editoriales").text(data.card_editoriales);
                $("#card_categorias").text(data.card_categorias);
                $("#card_alumnos").text(data.card_alumnos);
                $("#card_usuarios").text(data.card_usuarios);
            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    // Se ejecuta la funcion que carga los datos de los cards.
    load_cards();

    // Cargar lista de alumnos en el select.
    $("#nuevo-prestamo").on("click", function() {
        $("#id_alumno").html("");
        $.ajax({
            type: "POST",
            url: "modules/inicio/model.php",
            data: { students_select: true },
            success: function (response) {
                $("#id_alumno").append(response);
                let fecha = new Date();
                let year = fecha.getFullYear();
                let month = (fecha.getMonth() + 1).toString().padStart(2, '0'); // Agrega ceros al mes si es necesario
                let day = fecha.getDate().toString().padStart(2, '0'); // Agrega ceros al día si es necesario

                current_date = `${year}-${month}-${day}`;
                $("#fecha_entrega").val(current_date);

                $("#tbl-libros").html("");
            },
            error: function (response) {
                console.log(response);
            }
        });
    });

    // Autocompletado de libros
    $('#key').on('keyup', function() {
        var key = $(this).val();		

        $.ajax({
            type: "POST",
            url: "modules/inicio/model.php",
            data: {
                autocomplete: true,
                key: key
            },
            success: function(response) {
            $('#suggestions').fadeIn(100).html(response);
            $('.suggest-element').on('click', function(){
                var id = $(this).attr('id');
                var libro = $(this).text();
        
                var existingRow = $('#tbl-libros tr[data-id="' + id + '"]');
                if (existingRow.length > 0) {
                    var cantidadInput = existingRow.find('input[type="number"]');
                    var cantidad = parseInt(cantidadInput.val());
                    cantidadInput.val(cantidad + 1);
                } else {
                    template = `
                    <tr data-id="${id}">
                        <td>${libro}</td>
                        <td>
                            <div class="form-outline">
                                <input type="number" class="form-control" value="1"/>
                            </div>
                        </td>
                        <td class='text-center'>
                            <button id="${id}" class="btn btn-sm btn-outline-danger delete-book" data-id="${id}">
                                <i class="fa fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>`;
                    $('#tbl-libros').append(template);
                }
                id_libros.push(id);
        
                checkForm();
                $('#suggestions').fadeOut(100);
                $("#key").val("");
                return false;
            });
            }
        });
    });

    // Manejador de eventos para eliminar libros de la tabla
    $('#tbl-libros').on('click', '.delete-book', function () {
        var id = $(this).data('id');

        // Eliminar el producto de la tabla
        $(this).closest('tr').remove();

        // Eliminar el producto del arreglo
        var index = id_libros.indexOf(id);
        if (index !== -1) {
            id_productos.splice(index, 1);
        }

        checkForm();
    });

    // Se envian los datos al servidor
    $(".btn-next").click(function() {
        var dataToSend = [];

        $('#tbl-libros tr').each(function () {
            var id_libro = $(this).data('id');
            var unidades_prestamo = parseInt($(this).find('input[type="number"]').val());
            dataToSend.push({ id_libro: id_libro, unidades_prestamo: unidades_prestamo });
        });

        dataToSend.push({ fecha_entrega: $("#fecha_entrega").val() });
        dataToSend.push({ id_alumno: $("#id_alumno").val() });

        // Enviar los datos al servidor como un objeto JSON
        $.ajax({
            type: "POST",
            url: "modules/inicio/model.php",
            data: { prestamo: JSON.stringify(dataToSend) },
            success: function (response) {
                if (response == "") return false;
                Swal.fire({
                    icon: "success",
                    title: response,
                    showConfirmButton: false,
                    timer: 1500
                });
			},
            complete: function() {
                resetForm();
                load_cards();
                $("#tbl-libros").html("");
            }
        });
	});

  });