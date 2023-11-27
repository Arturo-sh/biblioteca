    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row my-2">
          <div class="col-md-12 d-inline-flex">
            <div class="col-md-6">
              <h1>Préstamos</h1>
            </div>
            <div class="col-md-6 text-right">
              <button id="nuevo-prestamo" class="btn btn-md btn-primary" data-toggle='modal' data-target='#modal-default'><i class='nav-icon fas fas fa-paperclip'></i> Nuevo préstamo</button>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Formulario de registro de prestamo -->
    <?php require_once 'modules/form_prestamo/view.php'; ?>

    <!-- Tabla que muestra los prestamos traidos de la BD -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>N. Alumno</th>
                      <th>Libro(s)</th>
                      <th>Responsable</th>
                      <th>Fecha préstamo</th>
                      <th>Fecha entrega</th>
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

    <script src="dist/js/prestamos.js"></script>
    <script src="dist/js/form_prestamo.js"></script>