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
            <button id='${data}' class='btn btn-sm btn-primary btn-edit' data-toggle='modal' data-target='#modal-default'>
              <i class='fas fa-eye'></i>
            </button>
            <button id='${data}' class='btn btn-sm btn-success btn-receive'>
              <i class='fas fa-check'></i>
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

  // Cargar datos del prestamo al card de visualizacion.
  $(document).on('click', '.btn-edit', function() {
      var edit_id = $(this).attr("id");
      $('#lista-libros').html("");

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
                  let template = `
                  <li class="d-inline-flex mr-1" style="list-style: none !important;">
                    <span class="p-1 rounded"><i class="fa fa-sm fa-book"></i> ${libro.titulo_libro} (${libro.unidades_prestamo} unidades)</span>
                  </li>`;
                  var li = $(template);
                  listaLibros.append(li);
              });
          }
      });
  });

  // Eliminar prestamo.
  $(document).on('click', '.btn-receive', function() {
      var update_id = $(this).attr("id");
  
      Swal.fire({
          title: `¿Desea recepcionar el préstamo con ID ${update_id}?`,
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