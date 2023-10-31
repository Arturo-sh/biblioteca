    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0">Préstamos</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Tabla que muestra los prestamos traidos de la BD -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class='modal fade' id='modal-default' id='staticBackdrop' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Datos del préstamo</h4>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                  <div>
                    <div class='card-body row'>
                      <div class='form-group col-md-6'>
                        <label for='nombre_alumno'>Alumno</label>
                        <p class='form-control' id='label_nombre_alumno'></p>
                      </div>
                      <div class='form-group col-md-6'>
                        <label for='nombre_usuario'>Responsable</label>
                        <p class='form-control' id='label_nombre_usuario'></p>
                      </div>
                      <div class='form-group col-md-6'>
                        <label for='fecha_prestamo'>Fecha préstamo</label>
                        <p class='form-control' id='label_fecha_prestamo'></p>
                      </div>
                      <div class='form-group col-md-6'>
                        <label for='fecha_entrega'>Fecha entrega</label>
                        <p class='form-control' id='label_fecha_entrega'></p>
                      </div>
                      <div class='form-group col-md-12'>
                        <label for='titulo_libro'>Préstamo</label>
                        <ul id="lista-libros" style="list-style: none; padding: 0;"></ul>
                      </div>
                      <div class='form-group col-md-6' hidden>
                        <label for='estado_prestamo'>Estatus</label>
                        <p class='form-control' id='label_estado_prestamo'></p>
                      </div>
                    </div>
                    <!-- /.card-body -->
        
                    <div class='text-center'>
                      <button type='reset' class='btn btn-outline-info' data-dismiss='modal'>Regresar</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>N. Alumno</th>
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