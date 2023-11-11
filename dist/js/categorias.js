$(document).ready(function () {
  var table = $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": true, 
    pageLength: 5,
    ajax: {
      url: "modules/categorias/model.php",
      method: "POST",
      data: {
        categories_table: true
      },
      dataSrc: ""
    },
    columns: [
      { data: "id_categoria" },
      { data: "nombre_categoria" },
      { data: "descripcion_categoria",
        render: function (data, type) {
          if (type === 'display') {
            if (data === '') data = 'Sin descripción';
          }
          return data;
        }
      },
      { data: "id_categoria", "orderable": false,
        render: function (data, type) {
          if (type === 'display') {
            template = `
            <button id='${data}' class='btn btn-sm btn-primary btn-edit'>
              <i class='fas fa-pen'></i>
            </button>
            <button id='${data}' class='btn btn-sm btn-danger btn-delete'>
              <i class='fas fa-trash'></i>
            </button>`;
          }
          return template;
        }
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
  
  // Se previene el redireccionamiento que produce el envío del formulario.
  $("form").submit(function(e){
      e.preventDefault();
  });

  // Funcion para habilitar el boton para registrar categorias cuando se rellene el formulario.
  function checkForm() {
      var camposCompletos = true;
      
      if ($('#nombre_categoria').val() === '') camposCompletos = false;
  
      $('.btn-next').attr('disabled', !camposCompletos);
  }

  $("form").on("keyup change", "textarea", function() {
      checkForm();
  });

  checkForm();

  // Registrar categoria.
  $(document).on('click', '.btn-next', function() {
      let action = $(this).attr("action");
  
      let form = document.getElementById("form");
      let formData = new FormData(form);
      formData.append('action', action);
  
      $.ajax({
          url: "modules/categorias/model.php",
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

  // Cargar datos de la categoria al formulario.
  $(document).on('click', '.btn-edit', function() {
      var edit_id = $(this).attr("id");
  
      $.ajax({
          url: "modules/categorias/model.php",
          method: "POST",
          data: {
              edit_id
          },
          success: function(response) {
              let data = JSON.parse(response);
      
              $("#id_categoria").val(data[0].id_categoria);
              $("#nombre_categoria").val(data[0].nombre_categoria);
              $("#descripcion_categoria").val(data[0].descripcion_categoria);
              $(".btn-next").attr("action", "update");
              $(".btn-next").text("Actualizar");

              checkForm();
          }
      });
  });

  // Eliminar categoria.
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
                  url: "modules/categorias/model.php",
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