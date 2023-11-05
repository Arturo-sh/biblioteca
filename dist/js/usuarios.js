$(document).ready(function () {
  var table = $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": true, 
    pageLength: 5,
    ajax: {
      url: "modules/usuarios/model.php",
      method: "POST",
      data: {
        users_table: true
      },
      dataSrc: ""
    },
    columns: [
      { data: "id_usuario" },
      { data: "usuario" },
      { data: "nombre_usuario" },
      { data: "telefono_usuario" },
      { data: "correo_usuario" },
      { data: "creacion_cuenta" },
      { data: "estado_usuario",
        render: function (data, type) {
          if (type === 'display') {
            let badge_color = data == "Activo" ? "bg-success" : "bg-danger";

            let template = `
            <td class='text-center'>
              <span class='badge ${badge_color}'>${data}</span>
            </td>`;
            return template;
          }
          return data;
        } 
      },
      { data: "rol_usuario", "orderable": false,
        render: function (data, type, row, meta) {
          if (type === 'display') {
            template = `
            <button id='${row.id_usuario}' class='btn btn-sm btn-primary btn-edit' data-toggle='modal' data-target='#modal-default'>
              <i class='fas fa-pen'></i>
            </button>
            <button id='${row.id_usuario}' class='btn btn-sm btn-danger btn-delete'>
              <i class='fas fa-trash'></i>
            </button>`;
            
            return template;
          }
          return data;
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
              columns: [ 0, 1, 2, 3, 4, 5 ]
            },
            modifier: {
              search: 'applied'
            }
          },
          {
            extend: 'excel',
            text: 'Generar Excel',
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 5 ]
            },
            modifier: {
              search: 'applied'
            }
          },
          {
            extend: 'print',
            text: "Imprimir",
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 5 ]
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

  // Se previene el redireccionamiento que produce el envío del formulario.
  $("form").submit(function(e){
      e.preventDefault();
  });

  // Registrar usuario.
  $(document).on('click', '.btn-next', function() {
      let action = $(this).attr("action");
  
      let form = document.getElementById("form");
      let formData = new FormData(form);
      formData.append('action', action);
  
      $.ajax({
          url: "modules/usuarios/model.php",
          method: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
              if(response == "") return
              let data = JSON.parse(response);
              Swal.fire({
                  icon: data.icon,
                  title: data.msg,
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

  // Cargar datos del usuario al formulario.
  $(document).on('click', '.btn-edit', function() {
      var edit_id = $(this).attr("id");
  
      $.ajax({
          url: "modules/usuarios/model.php",
          method: "POST",
          data: {
              edit_id
          },
          success: function(response) {
              let data = JSON.parse(response);
      
              $("#id_usuario").val(data[0].id_usuario);
              $("#rol_usuario").val(data[0].rol_usuario);
              $("#usuario").val(data[0].usuario);
              $("#nombre_usuario").val(data[0].nombre_usuario);
              $("#telefono_usuario").val(data[0].telefono_usuario);
              $("#correo_usuario").val(data[0].correo_usuario);
              $("#estado_usuario").removeAttr("disabled");
              $("#estado_usuario").val(data[0].estado_usuario);
              $("#contrasenia").removeAttr("required");
              $(".btn-next").attr("action", "update");
              $(".btn-next").text("Actualizar");
          }
      });
  });

  // Eliminar usuario.
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
                  url: "modules/usuarios/model.php",
                  method: "POST",
                  data: {
                      delete_id
                  },
                  success: function(response) {
                      let data = JSON.parse(response);
                      Swal.fire({
                          icon: data.icon,
                          title: data.msg,
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