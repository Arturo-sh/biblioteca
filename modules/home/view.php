<?php include "model.php"; ?>

<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Inicio</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $_SESSION['cantidad_prestamos']; ?></h3>

                <p>Préstamos activos</p>
              </div>
              <div class="icon">
                <i class="ion ion-edit"></i>
              </div>
              <a href="?module=prestamos" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $_SESSION['cantidad_libros']; ?></h3>

                <p>Libros registrados</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-stats-bars"></i> -->
                <i class="nav-icon fas fa-book"></i>
              </div>
              <a href="?module=libros" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner text-white">
                <h3><?php echo $_SESSION['cantidad_alumnos']; ?></h3>

                <p>Alumnos inscritos</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="?module=alumnos" class="small-box-footer" style="color: white !important;">Administrar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $_SESSION['cantidad_administradores']; ?></h3>

                <p>Usuarios administradores</p>
              </div>
              <div class="icon">
                <!-- <i class="ion ion-pie-graph"></i> -->
                <i class="ion ion-person-add"></i>
              </div>
              <a href="?module=usuarios" class="small-box-footer">Administrar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->