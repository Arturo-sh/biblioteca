    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-md-12 d-inline-flex">
            <div class="col-md-6">
              <h1>Inicio</h1>
            </div>
            <div class="col-md-6 text-right">
              <button id="nuevo-prestamo" class="btn btn-md btn-primary" data-toggle='modal' data-target='#modal-default'><i class='nav-icon fas fas fa-paperclip'></i> Nuevo préstamo</button>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-sm-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3 id="card_prestamos"></h3>
                <p>Préstamos activos</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-edit"></i>
              </div>
              <a href="prestamos" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-sm-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="card_libros"></h3>
                <p>Libros registrados</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-stats-bars"></i> -->
                <i class="nav-icon fas fa-book"></i>
              </div>
              <a href="libros" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-sm-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner text-white">
                <h3 id="card_alumnos"></h3>
                <p>Alumnos inscritos</p>
              </div>
              <div class="icon">
                <i class="nav-icon fas fa-graduation-cap"></i>
              </div>
              <a href="alumnos" class="small-box-footer" style="color: white !important;">Administrar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-sm-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="card_usuarios"></h3>
                <p>Administradores</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-pie-graph"></i> -->
                <i class="nav-icon fas fa-users"></i>
              </div>
              <a href="usuarios" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-sm-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
                <h3 id="card_editoriales"></h3>
                <p>Editoriales</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-pie-graph"></i> -->
                <i class="nav-icon fas fa-newspaper"></i>
              </div>
              <a href="editoriales" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-sm-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="card_categorias"></h3>
                <p>Categorías de libros</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-pie-graph"></i> -->
                <i class="nav-icon fas fa-list"></i>
              </div>
              <a href="categorias" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script src="dist/js/inicio.js"></script>