    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-12 d-inline-flex">
            <div class="col-md-6">
              <h1 class="">Editoriales</h1>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Tabla que muestra los usuarios traidos de la BD -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class='col-12 col-sm-12 col-md-3'>
            <form method='POST' id='form' action='modules/editoriales/model.php'>
              <div class='card-body row'>
                <div class='col-md-12 col-6 p-1'>
                  <label for='nombre_editorial'>Editorial</label>
                  <input type='hidden' class='form-control' id='id_editorial' name='id_editorial'>
                  <textarea class='form-control' id='nombre_editorial' name='nombre_editorial' rows='1' placeholder='Ej. Pearson' required></textarea>
                </div>
                <div class='col-md-12 col-6 p-1'>
                  <label for='pais_editorial'>País</label>
                  <textarea class='form-control' id='pais_editorial' name='pais_editorial' rows='1' placeholder='(Opcional) Ej. México'></textarea>
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
                      <th>Editorial</th>
                      <th>País</th>
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

    <script src="dist/js/editoriales.js"></script>