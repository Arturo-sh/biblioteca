    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0">Libros</h1>
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
          <div class='col-md-3'>
            <form method='POST' id='form' action='modules/libros/model.php' enctype='multipart/form-data'>
              <div class='card-body row'>
                <div class='form-group col-md-12'>
                  <label for='titulo_libro'>Título del libro</label>
                  <input type='hidden' class='form-control' id='id_libro' name='id_libro'>
                  <textarea class='form-control' id='titulo_libro' name='titulo_libro' rows='2' required></textarea>
                </div>
                <div class='form-group col-md-12'>
                  <label for='autor'>Autor(es)</label>
                  <textarea class='form-control' id='autor' name='autor' rows='2' required></textarea>
                </div>
                <div class='form-group col-md-12'>
                  <label for='id_editorial'>Editorial</label>
                  <select class='form-select' id='id_editorial' name='id_editorial' required>
                    <option value='0' selected disabled>Seleccionar</option>
                    <!-- LLenado dinámico -->
                  </select>
                </div>
                <div class='form-group col-md-12'>
                  <label for='id_categoria'>Categoría</label>
                  <select class="form-select" id="id_categoria" name="id_categoria"  required>
                    <option value='0' selected disabled>Seleccionar</option>
                    <!-- LLenado dinámico -->
                  </select>
                </div>
                <div class='form-group col-md-12'>
                  <label for='unidades_totales'>Unidades totales</label>
                  <input type='number' class='form-control' id='unidades_totales' name='unidades_totales' placeholder='Ej. 1' pattern='[0-9]+' title='Digite solo números sin espacios' required>
                </div>
                <div class='form-group col-md-12'>
                  <label for='imagen'>Imagen portada (opcional)</label>
                  <input type='file' class='form-control' id='imagen' name='imagen'>
                </div>
                <div class='form-group col-md-12 image-field' hidden>
                  <img id='image-view' src='dist/portadas/portada_default.png' style='width: 100%;'>
                </div>
                <div class='form-group col-md-12'>
                  <label for='descripcion'>Breve descripción (opcional)</label>
                  <textarea class='form-control' id='descripcion' name='descripcion' rows='2' placeholder='Ej. Libro en buenas condiciones ...' required></textarea>
                </div>
                <div class='form-group col-md-12'>
                  <label for='estado_libro'>Estatus</label>
                  <select class='form-select estatus' id='estado_libro' name='estado_libro' disabled> 
                    <option value='Activo'>Activo</option>
                    <option value='Suspendido'>Suspendido</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->
              <div class='text-center mb-4'>
                <button type='reset' class='btn btn-outline-danger' onclick='resetForm()'>Cancelar</button>
                <button type='submit' class='btn btn-outline-success btn-next' action='insert'>Guardar</button>
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
            <h4 class='modal-title'>Imagen portada</h4>
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