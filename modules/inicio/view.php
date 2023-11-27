    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row my-2">
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

    <!-- Formulario de registro de prestamo -->
    <?php require_once 'modules/form_prestamo/view.php'; ?>

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

    <script src="dist/js/form_prestamo.js"></script>