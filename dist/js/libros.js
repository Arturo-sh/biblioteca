$(document).ready(function () {
  var table = $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": true, 
    pageLength: 5,
    ajax: {
      url: "modules/libros/model.php",
      method: "POST",
      data: {
        books_table: true
      },
      dataSrc: ""
    },
    columns: [
      { data: "id_libro" },
      { data: "titulo_libro" },
      { data: "nombre_editorial" },
      { data: "nombre_categoria" },
      { data: "unidades_totales" },
      { data: "imagen_portada", "orderable": false,
        render: function (data, type) {
          if (type === 'display') {
            template = ``;
            if (data != "portada_default.png") {
              template = `
              <button image-name='${data}' class='btn btn-sm btn-warning btn-view' data-toggle='modal' data-target='#modal-image' >
                <i class='fas fa-eye'></i>
              </button>`;
            }
          }
          return template;
        }
      },
      { data: "descripcion" },
      { data: "estado_libro",
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
      { data: "id_libro",
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
              columns: [ 0, 1, 2, 3, 4, 6, 7 ]
            },
            modifier: {
              search: 'applied'
            }
          },
          {
            extend: 'excel',
            text: 'Generar Excel',
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 6, 7 ]
            },
            modifier: {
              search: 'applied'
            }
          },
          {
            extend: 'print',
            text: "Imprimir",
            exportOptions: {
              columns: [ 0, 1, 2, 3, 4, 6, 7 ]
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
  
  // Cargar lista de alumnos en el select.
  $.ajax({
    type: "POST",
    url: "modules/libros/model.php",
    data: { load_selects: true },
    success: function (response) {
        let data = JSON.parse(response);

        $("#id_categoria").append(data.categorias);
        $("#id_editorial").append(data.editoriales);
    },
    error: function (response) {
        console.log(response);
    }
  });

  // Se previene el redireccionamiento que produce el envío del formulario.
  $("form").submit(function(e){
      e.preventDefault();
  });
  
  // Función limpiar para el formulario de libros.
  function resetForm() {
    $("#id_libro").val("");
    $("#titulo_libro").val("");
    $("#id_editorial").val("0").trigger("change");
    $("#id_categoria").val("0").trigger("change");
    $("#unidades_totales").val("");
    $("#image-view").attr("src", "dist/portadas/portada_default.png");
    $(".image-field").attr("hidden", true);
    $("#descripcion").val("");
    $("#estado_libro").val("Activo");
    $("#estado_libro").attr("disabled", true);
    $(".btn-next").attr("action", "insert");
    $(".btn-next").text("Guardar");
    $(".btn-next").attr("action", "insert");
    $(".btn-next").text("Guardar");
  }

  // Registrar libro.
  $(document).on('click', '.btn-next', function() {
      let action = $(this).attr("action");
  
      let form = document.getElementById("form");
      let formData = new FormData(form);
      formData.append('action', action);
  
      $.ajax({
          url: "modules/libros/model.php",
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

  // Cargar datos del libro al formulario.
  $(document).on('click', '.btn-edit', function() {
      var edit_id = $(this).attr("id");
  
      $.ajax({
          url: "modules/libros/model.php",
          method: "POST",
          data: {
              edit_id
          },
          success: function(response) {
              let data = JSON.parse(response);

              $("#id_libro").val(data[0].id_libro);
              $("#titulo_libro").val(data[0].titulo_libro);
              $("#id_editorial").val(data[0].id_editorial).trigger("change");
              $("#id_categoria").val(data[0].id_categoria).trigger("change");
              $("#unidades_totales").val(data[0].unidades_totales);
              $("#image-view").attr("src", "dist/portadas/" + data[0].imagen_portada);
              $(".image-field").removeAttr("hidden");
              $("#descripcion").val(data[0].descripcion);
              $("#estado_libro").val(data[0].estado_libro);
              $(".btn-next").attr("action", "update");
              $(".btn-next").attr("action", "update");
              $(".btn-next").text("Actualizar");
              $("#estado_libro").removeAttr("disabled");
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
                  url: "modules/libros/model.php",
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

  /*
  Función para visualizar las imágenes de portada de los libros (solo se
  puede visualizar cuando se haya subido alguna imagen al server). 
  */
  $(document).on('click', '.btn-view', function() {
      var image_name = $(this).attr("image-name");
      $("#image-form").attr("src", "dist/portadas/" + image_name);
  });
  
});