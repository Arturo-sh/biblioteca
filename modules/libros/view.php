    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row my-2">
          <div class="col-md-12 d-inline-flex">
            <div class="col-md-6">
              <h1>Libros</h1>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Tabla que muestra los libros traidos de la BD -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class='col-12 col-sm-12 col-md-3'>
            <form method='POST' id='form' action='modules/libros/model.php' enctype='multipart/form-data'>
              <div class='card-body row'>
                <div class='col-md-12 col-6 p-1'>
                  <label for='titulo_libro'>Título del libro</label>
                  <input type='hidden' class='form-control' id='id_libro' name='id_libro'>
                  <textarea class='form-control' id='titulo_libro' name='titulo_libro' rows='1' required></textarea>
                </div>
                <div class='col-md-12 col-6 p-1'>
                  <label for='autor'>Autor(es)</label>
                  <textarea class='form-control' id='autor' name='autor' rows='1' required></textarea>
                </div>
                <div class='col-md-12 col-6 p-1'>
                  <!-- Input para digitar una nueva editorial si no existe en la lista -->
                  <label for='id_editorial'>Editorial</label>
                  <select class='form-select' id='id_editorial' name='id_editorial' required>
                    <option value='0' selected disabled>Seleccionar</option>
                    <!-- LLenado dinámico -->
                  </select>
                  <label for='nueva_editorial'>Nueva editorial</label>
                  <input type="text" class="form-control" id="nueva_editorial" name="nueva_editorial">
                </div>
                <div class='col-md-12 col-6 p-1'>
                  <label for='id_categoria'>Categoría</label>
                  <select class="form-select" id="id_categoria" name="id_categoria" required>
                    <option value='0' selected disabled>Seleccionar</option>
                    <!-- LLenado dinámico -->
                  </select>
                  <label for='nueva_categoria'>Nueva categoría</label>
                  <input type="text" class="form-control" id="nueva_categoria" name="nueva_categoria">
                </div>
                <div class='col-md-12 col-6 p-1'>
                  <label for='unidades_totales'>Unidades totales</label>
                  <input type='number' class='form-control' id='unidades_totales' name='unidades_totales' placeholder='Ej. 1' pattern='[0-9]+' value="1" title='Digite solo números sin espacios' required>
                </div>
                <div class='col-md-12 col-6 p-1'>
                  <label for='imagen'>Portada (opcional)</label>
                  <input type='file' class='form-control' id='imagen' name='imagen'>
                </div>
                <div class='col-md-12 p-1 image-field' hidden>
                  <img id='image-view' src='dist/portadas/portada_default.png' style='width: 100%;'>
                </div>
                <div class='col-md-12 col-6 p-1'>
                  <label for='descripcion'>Descripción</label>
                  <textarea class='form-control' id='descripcion' name='descripcion' rows='1' placeholder='(Opcional) Ej. Libro en buenas condiciones...'></textarea>
                </div>
                <div class='col-md-12 col-6 p-1'>
                  <label for='estado_libro'>Estatus</label>
                  <select class='form-select estatus' id='estado_libro' name='estado_libro' disabled>
                    <option value='Activo'>Activo</option>
                    <option value='Suspendido'>Suspendido</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->
              <div class='text-center mb-4'>
                <button type='reset' class='btn btn-sm btn-outline-danger' onclick='resetForm()'>Cancelar</button>
                <button type='submit' class='btn btn-sm btn-outline-success btn-next' action='insert'>Guardar</button>
              </div>
            </form>
          </div>

          <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Título</th>
                      <th>Autor(es)</th>
                      <th>Editorial</th>
                      <th>Categoría</th>
                      <th>Stock</th>
                      <th>Imagen</th>
                      <th>Descripción</th>
                      <th>Estatus</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Llenado dinámico -->
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.table -->

    <div class='modal fade' id='modal-image' id='staticBackdrop' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h4 class='modal-title'>Portada</h4>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div class='modal-body'>
            <img src="#" id="image-form" alt="Recurso no disponible" style="width: 100%;">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <script src="dist/js/libros.js"></script>