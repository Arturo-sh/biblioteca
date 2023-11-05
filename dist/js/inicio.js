$(document).ready(function() {
    id_libros = [];

    // Cargar datos para los cards.
    function load_cards() {
        $.ajax({
            type: "POST",
            url: "modules/home/model.php",
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
        $.ajax({
            type: "POST",
            url: "modules/home/model.php",
            data: { students_select: true },
            success: function (response) {
                $("#id_alumno").append(response);
                let fecha = new Date();
                let year = fecha.getFullYear();
                let month = (fecha.getMonth() + 1).toString().padStart(2, '0'); // Agrega ceros al mes si es necesario
                let day = fecha.getDate().toString().padStart(2, '0'); // Agrega ceros al día si es necesario

                current_date = `${year}-${month}-${day}`;
                $("#fecha_entrega").val(current_date);
            },
            error: function (response) {
                console.log(response);
            }
        });
    });

    // Autocompletado de libros
    $('#key').on('keyup', function() {
        var key = $(this).val();		
        var dataString = 'key='+key;

        $.ajax({
            type: "POST",
            url: "modules/home/model.php",
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
        var index = id_productos.indexOf(id);
        if (index !== -1) {
            id_productos.splice(index, 1);
        }
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
            url: "modules/home/model.php",
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
                load_cards();
                $("#tbl-libros").html("");
                // habilitar_venta();
            }
        });
	});


    // Funcion que habilita el boton de venta cuando hay productos en la tabla 
    // function habilitar_venta() {
    //     var existingRows = $('#tbl-productos tr');
    //     if (existingRows.length > 0 && parseFloat($('#total-pagar').text()) > 0) {
    //         $("#tbl-header").removeAttr("hidden");
	//         $("#btn-sell").removeAttr("disabled");
    //         $("#btn-sell").fadeIn(500);

    //     } else {
    //         $("#tbl-header").attr("hidden", true);
    //         $("#btn-sell").attr("disabled", true);
    //         $("#btn-sell").fadeOut(500);
    //     }
    // }

    // habilitar_venta();

  });