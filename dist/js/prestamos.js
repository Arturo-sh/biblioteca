$(document).ready(function () {
  var table = $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": true, 
    pageLength: 5,
    ajax: {
      url: "modules/prestamos/table.php",
      dataSrc: ""
    },
    columns: [
      { data: "id_transaccion" },
      { data: "nombre_alumno" },
      { data: "libro_prestamo",
        render: function(data, type, row) {
          var librosEnPrestamo = `<ul class='list-unstyled'>`;
            
          data.forEach(function(libro) {
            var titulo_libro = libro.titulo_libro;
            var unidades_prestamo = libro.unidades_prestamo;
            unidades_prestamo > 1 ? unidad = `unidades` : unidad = `unidad`;
    
            librosEnPrestamo += `<li><i class='fa fas fa-book'></i> ${titulo_libro} (${unidades_prestamo} ${unidad})</li>`;
          });

          librosEnPrestamo += `</ul>`;    
          return librosEnPrestamo;
        }
      },
      { data: "nombre_usuario" },
      { data: "fecha_prestamo" },
      { data: "fecha_entrega" },
      { data: "estado_prestamo",
        render: function (data, type) {
          if (type === 'display') {
            let badge_color = data == "Entregado" ? "bg-success" : "bg-danger";

            let template = `
            <td class='text-center'>
              <span class='badge ${badge_color}'>${data}</span>
            </td>`;
            return template;
          }
          return data;
        } 
      },
      { data: "id_transaccion", "orderable": false,
        render: function (data, type) {
          if (type === 'display') {
            template = `
            <button id='${data}' class='btn btn-sm btn-success btn-receive'>
              <i class='fas fa-arrow-right-arrow-left'></i>
            </button>
            <button id='${data}' class='btn btn-sm btn-danger btn-delete'>
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
            pageSize: 'LEGAL',
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 5, 6 ]
            },
            modifier: {
              search: 'applied'
            }
          },
          {
            extend: 'excel',
            text: 'Generar Excel',
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 5, 6 ]
            },
            modifier: {
              search: 'applied'
            }
          },
          {
            extend: 'print',
            text: "Imprimir",
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 5, 6 ]
            },
            modifier: {
              search: 'applied'
            }
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
    },
    initComplete: function () {
      table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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

  // Eliminar prestamo.
  $(document).on('click', '.btn-receive', function() {
      var update_id = $(this).attr("id");
  
      Swal.fire({
          title: `¿Desea cambiar el estado del préstamo con ID: ${update_id}?`,
          icon: 'question',
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
                      action: "update",
                      update_id
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

  // Eliminar prestamo.
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

});