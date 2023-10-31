var table;

$(document).ready(function () {
  table = $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false, 
    pageLength: 5,
    ajax: {
      url: "modules/prestamos/table.php",
      dataSrc: ""
    },
    columns: [
      { data: "id_transaccion" },
      { data: "nombre_alumno" },
      { data: "nombre_usuario" },
      { data: "fecha_prestamo" },
      { data: "fecha_entrega" },
      { data: "estado_prestamo",
        render: function (data, type) {
          if (type === 'display') {
            let template = `
            <td class='text-center'>
              <span class='badge bg-primary'>${data}</span>
            </td>`;
    
            if (data == "Entregado") {
              template = `
              <td class='text-center'>
                <span class='badge bg-success'>${data}</span>
              </td>`;
            }
            return template;
          }
          return data;
        } 
      },
      { data: "id_transaccion",
        render: function (data, type) {
          if (type === 'display') {
            template = `
            <button id='${data}' class='btn btn-xs btn-primary btn-edit' data-toggle='modal' data-target='#modal-default' onclick='reset_transaction_data()'>
              <i class='fas fa-eye'></i>
            </button>
            <button id='${data}' class='btn btn-xs btn-success btn-receive'>
              <i class='fas fa-check'></i>
            </button>
            <button id='${data}' class='btn btn-xs btn-danger btn-delete'>
              <i class='fas fa-trash'></i>
            </button>`;
          }
          return template;
        }
      }
    ],
    buttons: [
      {
        extend: 'collection',
        text: 'Exportar',
        buttons: [
          {
            extend: 'pdf',
            text: "Generar PDF",
            pageSize: 'LEGAL'
          },
          {
            extend: 'excel',
            text: 'Generar Excel'
          },
          {
            extend: 'print',
            text: "Imprimir"
          }
        ]
      },
      {
        extend: 'colvis',
        text: 'Visor de columnas',
      }
    ],
    language: {
      "emptyTable": "No hay registros",
      "info": "Mostrando _START_ a _END_ de _TOTAL_ resultados",
      "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
      "infoFiltered": "(Filtrado de _MAX_ entradas totales)",
      "infoPostFix": "",
      "thousands": ",",
      "lengthMenu": "Mostrar _MENU_ resultados",
      "loadingRecords": "Cargando...",
      "processing": "Procesando...",
      "search": "Buscar:",
      "zeroRecords": "Sin resultados encontrados",
      "paginate": {
        "first": "Primero",
        "last": "Ultimo",
        "next": "Siguiente",
        "previous": "Anterior"
      }
    }
  });
  
  table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  // Se previene el redireccionamiento que produce el envío del formulario.
  $("form").submit(function(e){
      e.preventDefault();
  });
  
  // Función limpiar para el formulario de prestamos.
  function resetForm() {
    $("#label_nombre_alumno").text("");
    $("#label_nombre_usuario").text("");
    $("#label_fecha_prestamo").text("");
    $("#label_fecha_entrega").text("");

    $("#lista-libros").html("");  
  }

  // Registrar prestamo.
  $(document).on('click', '.btn-next', function() {
      let action = $(this).attr("action");
  
      let form = document.getElementById("form");
      let formData = new FormData(form);
      formData.append('action', action);
      formData.append('id_libros', id_libros);
  
      $.ajax({
          url: "modules/prestamos/model.php",
          method: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
              if(response == "") return
              Swal.fire({
                  icon: "success",
                  title: response,
                  showConfirmButton: false,
                  timer: 2000
              });
          },
          complete: function() {
              resetForm();
              table.ajax.reload();
          }
      });
  });

  // Cargar datos del prestamo al card.
  $(document).on('click', '.btn-edit', function() {
      var edit_id = $(this).attr("id");
  
      $.ajax({
          url: "modules/prestamos/model.php",
          method: "POST",
          data: {
              edit_id
          },
          success: function(response) {
              let data = JSON.parse(response);
      
              $("#label_nombre_alumno").text(data.transaccion_data[0].nombre_alumno);
              $("#label_nombre_usuario").text(data.transaccion_data[0].nombre_usuario);
              $("#label_fecha_prestamo").text(data.transaccion_data[0].fecha_prestamo);
              $("#label_fecha_entrega").text(data.transaccion_data[0].fecha_entrega);
              
              var librosData = data.libros_data;
              var listaLibros = $('#lista-libros');
              
              $.each(librosData, function(index, libro) {
                  var li = $('<li class="d-inline-flex m-1" style="list-style: none !important;"><span class="bg-warning p-2 rounded"><i class="fa fa-sm fa-book"></i> ' + libro.titulo_libro + '</span></li>');
                  listaLibros.append(li);
              });
          }
      });
  });

  // Eliminar libro.
  $(document).on('click', '.btn-delete', function() {
      var delete_id = $(this).attr("id");
  
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
                  url: "modules/prestamos/model.php",
                  method: "POST",
                  data: {
                      delete_id
                  },
                  success: function(response) {
                      Swal.fire({
                          icon: "success",
                          title: response,
                          showConfirmButton: false,
                          timer: 2000
                      });
                  },
                  complete: function() {
                      table.ajax.reload();
                  }
              });
          }
      });
  });

  // Autocompletado de libros
  $(document).ready(function() {
    id_libros = []; // Arreglo que almacena los id´s de los libros prestados
  
    $('#key').on('keyup', function() {
      var key = $(this).val();		
      var dataString = 'key='+key;
  
      $.ajax({
        type: "POST",
        url: "modules/prestamos/ajax.php",
        data: dataString,
        success: function(response) {
          //Escribimos las sugerencias que nos manda la consulta
          $('#suggestions').fadeIn(500).html(response);
          $('.suggest-element').on('click', function(){
            var id = $(this).attr('id');
            var titulo = $(this).attr('titulo');
            id_libros.push(id);
  
            let libros_seleccionados = $('#libros-prestamo').html();
            $('#libros-prestamo').html(libros_seleccionados + `<p id-libro='${id}'><i class='fa fa-sm btn-danger btn-remove-book' style='border: 1px; padding: 4px;'>x</i> <i class='fa fa-sm fa-book'></i> ${titulo}</p>`);
            $('#suggestions').fadeOut(500);
            $("#key").val("");
            return false;
          });
        }
      });
    });
  }); 

});