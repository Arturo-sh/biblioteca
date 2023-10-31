var table;

$(document).ready(function () {
  table = $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false, 
    pageLength: 5,
    ajax: {
      url: "modules/alumnos/table.php",
      dataSrc: ""
    },
    columns: [
      { data: "id_alumno" },
      { data: "matricula" },
      { data: "nombre_alumno" },
      { data: "semestre" },
      { data: "estado_alumno",
        render: function (data, type) {
          if (type === 'display') {
            let template = `
            <td class='text-center'>
              <span class='badge bg-danger'>${data}</span>
            </td>`;
     
            if (data == "Activo") {
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
      { data: "id_alumno",
        render: function (data, type) {
          if (type === 'display') {
            template = `
            <button id='${data}' class='btn btn-xs btn-primary btn-edit'>
              <i class='fas fa-pen'></i>
            </button>
            <button id='${data}' class='btn btn-xs btn-danger btn-delete'>
              <i class='fas fa-trash'></i>
            </button>`;
          }
          return template;
        }
      }],
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
  
  // Función limpiar para el formulario de alumnos.
  function resetForm() {
    $("#id_alumno").val("");
    $("#matricula").val("");
    $("#nombre_alumno").val("");
    $("#semestre").val("1");
    $("#estado_alumno").val("Activo");
    $("#estado_alumno").attr("disabled", true);
    $("#estado_alumno").attr("disabled", true);
    $(".btn-next").attr("action", "insert");
    $(".btn-next").text("Guardar");
  }

  // Registrar alumno.
  $(document).on('click', '.btn-next', function() {
      let action = $(this).attr("action");
  
      let form = document.getElementById("form");
      let formData = new FormData(form);
      formData.append('action', action);
  
      $.ajax({
          url: "modules/alumnos/model.php",
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

  // Cargar datos del alumno al formulario.
  $(document).on('click', '.btn-edit', function() {
      var edit_id = $(this).attr("id");
  
      $.ajax({
          url: "modules/alumnos/model.php",
          method: "POST",
          data: {
              edit_id
          },
          success: function(response) {
              let data = JSON.parse(response);
      
              $("#id_alumno").val(data[0].id_alumno);
              $("#matricula").val(data[0].matricula);
              $("#nombre_alumno").val(data[0].nombre_alumno);
              $("#semestre").val(data[0].semestre);
              $("#estado_alumno").val(data[0].estado_alumno);
              $(".btn-next").attr("action", "update");
              $(".btn-next").text("Actualizar");
              $("#estado_alumno").removeAttr("disabled");
          }
      });
  });

  // Eliminar alumno.
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
                  url: "modules/alumnos/model.php",
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

  // Aumento / Decremento de grado escolar.
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
          }
      });
  });

});