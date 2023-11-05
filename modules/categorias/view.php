    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-md-12 d-inline-flex">
            <div class="col-md-6">
              <h1 class="">Categorías de libros</h1>
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
        <div class='col-md-3'>
            <form method='POST' id='form' action='modules/editoriales/model.php'>
              <div class='card-body row'>
                <div class='form-group col-md-12'>
                  <label for='nombre_categoria'>Categoría</label>
                  <input type='hidden' class='form-control' id='id_categoria' name='id_categoria'>
                  <input type='text' class='form-control' id='nombre_categoria' name='nombre_categoria' required>
                </div>
                <div class='form-group col-md-12'>
                  <label for='descripcion_categoria'>Breve descripción</label>
                  <input type='text' class='form-control' id='descripcion_categoria' name='descripcion_categoria'>
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
                      <th>Categoría</th>
                      <th>Descripción</th>
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

    <script src="dist/js/categorias.js"></script>