$(document).ready(function () {
  var table = $("#example1").DataTable({
    responsive: true,
    lengthChange: false,
    autoWidth: false,
    ordering: true, // pagingType: 'simple_numbers', // Opciones: 'simple', 'simple_numbers', 'full', 'full_numbers'
    pageLength: 5,
    ajax: {
      url: "modules/alumnos/model.php",
      method: "POST",
      data: {
        students_table: true,
      },
      dataSrc: "",
    },
    columns: [
      { data: "id_alumno" },
      { data: "matricula" },
      { data: "nombre_alumno" },
      {
        data: "semestre",
        render: function (data, type) {
          if (type === "display") {
            switch (data) {
              case "1": case "3": data = `${data}er`; break;
              case "2": data = `${data}do`; break;
              case "4": case "5": case "6": data = `${data}to`; break;
            }
          }
          return data;
        },
      },
      {
        data: "estado_alumno",
        render: function (data, type) {
          if (type === "display") {
            let badge_color = data == "Activo" ? "bg-success" : "bg-danger";

            let template = `
            <td class='text-center'>
              <span class='badge ${badge_color}'>${data}</span>
            </td>`;
            return template;
          }
          return data;
        },
      },
      {
        data: "id_alumno",
        orderable: false,
        render: function (data, type) {
          if (type === "display") {
            template = `
            <button id='${data}' class='btn btn-sm btn-primary btn-edit'>
              <i class='fas fa-pen'></i>
            </button>
            <button id='${data}' class='btn btn-sm btn-danger btn-delete'>
              <i class='fas fa-trash'></i>
            </button>`;
          }
          return template;
        },
      },
    ],
    buttons: [
      {
        extend: "collection",
        text: "Exportar",
        buttons: [
          {
            extend: "pdf",
            text: "Generar PDF",
            pageSize: "LEGAL",
            exportOptions: {
              columns: [0, 1, 2, 3, 4],
            },
            modifier: {
              search: "applied",
            },
          },
          {
            extend: "excel",
            text: "Generar Excel",
            exportOptions: {
              columns: [0, 1, 2, 3, 4],
            },
            modifier: {
              search: "applied",
            },
          },
          {
            extend: "print",
            text: "Imprimir",
            exportOptions: {
              columns: [0, 1, 2, 3, 4],
            },
            modifier: {
              search: "applied",
            },
          },
        ],
      },
      {
        extend: "colvis",
        text: "Visor de columnas",
      },
    ],
    language: {
      emptyTable: "No hay registros",
      info: "Mostrando _START_ a _END_ de _TOTAL_ resultados",
      infoEmpty: "Mostrando 0 a 0 de 0 resultados",
      infoFiltered: "(Filtrado de _MAX_ entradas totales)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ resultados",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Ultimo",
        next: "Siguiente",
        previous: "Anterior",
      },
    },
    initComplete: function () {
      table.buttons().container().appendTo("#example1_wrapper .col-md-6:eq(0)");
    },
  });

  // Se previene el redireccionamiento que produce el envío del formulario.
  $("form").submit(function (e) {
    e.preventDefault();
  });

  // Funcion para cargar la siguiente matricula a almacenar
  function loadLastConfig() {
    $.ajax({
      type: "POST",
      url: "modules/alumnos/model.php",
      data: {
        last_config: true
      },
      success: function (response) {
        let data = JSON.parse(response);
        if (data == "") $("#matricula").val("C1360");
        let ultimosDigitos = data[0].matricula.slice(1); 
        let siguienteMatricula = parseInt(ultimosDigitos) + 1; 
        $("#matricula").val(`C${siguienteMatricula}`);
        $("#semestre").val(data[0].semestre);
      }
    });
  }

  loadLastConfig();

  // Funcion para habilitar el boton para registrar alumnos cuando se rellene el formulario.
  function checkForm() {
    var camposCompletos = true;

    $("#matricula, #nombre_alumno").each(function () {
      if ($(this).val() === "") {
        camposCompletos = false;
        return false;
      }
    });

    $(".btn-next").attr("disabled", !camposCompletos);
  }

  $("form").on("keyup change", "textarea, select", function () {
    checkForm();
  });

  checkForm();

  // Registrar alumno.
  $(document).on("click", ".btn-next", function () {
    let action = $(this).attr("action");

    let form = document.getElementById("form");
    let formData = new FormData(form);
    formData.append("action", action);

    $.ajax({
      url: "modules/alumnos/model.php",
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (response) {
        if (response == "") return;
        Swal.fire({
          icon: "success",
          title: response,
          showConfirmButton: false,
          timer: 800,
        });
      },
      complete: function () {
        resetForm();
        loadLastConfig();
        table.ajax.reload();
      },
    });
  });

  // Cargar datos del alumno al formulario.
  $(document).on("click", ".btn-edit", function () {
    var edit_id = $(this).attr("id");

    $.ajax({
      url: "modules/alumnos/model.php",
      method: "POST",
      data: {
        edit_id,
      },
      success: function (response) {
        let data = JSON.parse(response);

        $("#id_alumno").val(data[0].id_alumno);
        $("#matricula").val(data[0].matricula);
        $("#nombre_alumno").val(data[0].nombre_alumno);
        $("#semestre").val(data[0].semestre);
        $("#estado_alumno").val(data[0].estado_alumno);
        $(".btn-next").attr("action", "update");
        $(".btn-next").text("Actualizar");
        $("#estado_alumno").removeAttr("disabled");

        checkForm();
      },
    });
  });

  // Eliminar alumno.
  $(document).on("click", ".btn-delete", function () {
    var delete_id = $(this).attr("id");

    Swal.fire({
      title: `Esta seguro de eliminar el registro ${delete_id}?`,
      text: "Esto no se puede revertir!",
      icon: "error",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, continuar!",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "modules/alumnos/model.php",
          method: "POST",
          data: {
            delete_id,
          },
          success: function (response) {
            Swal.fire({
              icon: "success",
              title: response,
              showConfirmButton: false,
              timer: 2000,
            });
          },
          complete: function () {
            table.ajax.reload();
          },
        });
      }
    });
  });

  // Aumento / Decremento de grado escolar.
  $(document).on("click", ".btn-change-grade", function () {
    var action_id = $(this).attr("id");

    $.ajax({
      url: "modules/alumnos/model.php",
      method: "POST",
      data: {
        action_id: action_id,
      },
      success: function (response) {
        let data = JSON.parse(response);
        let action_change_semester = data.action;
        let msg = data.msg;

        Swal.fire({
          title: msg,
          text: "Este cambio se puede revertir únicamente de forma manual!",
          icon: "question",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, continuar!",
          cancelButtonText: "Cancelar",
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: "modules/alumnos/model.php",
              method: "POST",
              data: {
                action_change_semester,
              },
              success: function (response) {
                Swal.fire({
                  icon: "success",
                  title: response,
                  showConfirmButton: false,
                  timer: 2000,
                });
              },
              complete: function () {
                table.ajax.reload();
              },
            });
          }
        });
      },
    });
  });
});
