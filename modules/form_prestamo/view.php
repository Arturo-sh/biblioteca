<div class='modal fade' id='modal-default' id='staticBackdrop' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h4 class='modal-title'>Registro de préstamo</h4>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div class='modal-body'>
            <form method='POST' id='form' action='modules/home/model.php'>
              <div class='card-body row'>
                <div class='col-md-12 p-1'>
                  <label for='id_alumno'>Alumno</label>
                  <select class="form-select" id="id_alumno" name="id_alumno">
                    <!-- Se rellena dinamicamente -->
                  </select>
                </div>
                <div class='col-md-12 p-1'>
                  <label for='fecha_entrega'>Fecha de entrega</label>
                  <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required>
                </div>
                <div class='col-md-12 p-1'>
                  <label for='key'>Libro</label>
                  <input type="search" class="form-control" name="key" id="key" placeholder="Buscar libro...">
                  <div id="suggestions"></div>
                </div>
                <div class='col-md-12 p-1'>
                  <table class="table table-sm table-striped">
                    <thead id='tbl-header'>
                      <tr>
                        <th class="col-md-8">Libro</th>
                        <th class="col-md-2">Unidades</th>
                        <th class="col-md-2">Remover</th>
                      </tr>
                    </thead>
                    <tbody id="tbl-libros">
                      <!-- Llenado dinámico -->
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
              <div class='text-center mb-4'>
                <button type='reset' class='btn btn-sm btn-outline-danger' data-dismiss='modal'>Cancelar</button>
                <button type='submit' class='btn btn-sm btn-outline-success btn-next' action='insert' data-dismiss='modal'>Guardar</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->