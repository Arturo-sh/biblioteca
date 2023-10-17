function fill_tbl_loans() {
  let cols = [
    { data: "id_prestamo" },
    { data: "nombre_alumno" },
    { data: "titulo_libro" },
    { data: "unidades_prestamo" },
    { data: "fecha_prestamo" },
    { data: "fecha_entrega" },
    { data: "nombre_usuario" },
    { 
      data: "estado_prestamo",
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
    {
      data: "id_prestamo",
      render: function (data, type) {
        if (type === 'display') {
          template = `
          <button id='${data}' mod='prestamos' class='btn btn-sm btn-primary btn-edit'>
            <i class='fas fa-pen'></i>
          </button>
          <button id='${data}' mod='prestamos' class='btn btn-sm btn-danger btn-delete'>
            <i class='fas fa-trash'></i>
          </button>`;
        }
        return template;
      }
    }];
  return cols;
}

function fill_tbl_students() {
  let cols = [
    { data: "id_alumno" },
    { data: "matricula" },
    { data: "nombre_alumno" },
    { data: "semestre" },
    { 
      data: "estado_alumno",
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
    {
      data: "id_alumno",
      render: function (data, type) {
        if (type === 'display') {
          template = `
          <button id='${data}' mod='alumnos' class='btn btn-sm btn-primary btn-edit'>
            <i class='fas fa-pen'></i>
          </button>
          <button id='${data}' mod='alumnos' class='btn btn-sm btn-danger btn-delete'>
            <i class='fas fa-trash'></i>
          </button>`;
        }
        return template;
      }
    }];
  return cols;
}

function fill_tbl_users() {
  let cols = [
    { data: "id_usuario" },
    { data: "usuario" },
    { data: "nombre_usuario" },
    { data: "telefono_usuario" },
    { data: "correo_usuario" },
    { data: "creacion_cuenta" },
    { 
      data: "estado_usuario",
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
    {
      data: "rol_usuario",
      render: function (data, type, row, meta) {
        if (type === 'display') {
          let template = `
          <button id='${row.id_usuario}' mod='usuarios' class='btn btn-sm btn-primary btn-edit' data-toggle='modal' data-target='#modal-default'>
            <i class='fas fa-pen'></i>
          </button>`;
 
        if (data != "Admin") {
          template = `
          <button id='${row.id_usuario}' mod='usuarios' class='btn btn-sm btn-primary btn-edit' data-toggle='modal' data-target='#modal-default'>
            <i class='fas fa-pen'></i>
          </button>
          <button id='${row.id_usuario}' mod='usuarios' class='btn btn-sm btn-danger btn-delete'>
            <i class='fas fa-trash'></i>
          </button>`;
        }
        return template;
      }
      return data;
    }
  }];
  return cols;
}