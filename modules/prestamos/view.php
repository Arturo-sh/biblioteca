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

    <?php
    if ($_SESSION['rol_usuario'] == "Admin") {
      echo "
      <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <!-- Small boxes (Stat box) -->
          <div class='row'>
            <div class='col-lg-3 col-6'>
              <a href='index.php?module=form_prestamo&action=insert' class='btn btn-md btn-outline-primary my-2'>Nuevo préstamo</a>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->";
    }
    ?>

    <!-- Tabla que muestra los alumnos traidos de la BD -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Alumno</th>
                    <th>Título ejemplar</th>
                    <th>Unidades préstamo</th>
                    <th>Fecha préstamo</th>
                    <th>Fecha entrega</th>
                    <th>Responsable</th>
                    <th>Detalles</th>
                    <th>Estatus</th>
                    <?php 
                    if ($_SESSION['rol_usuario'] == "Admin") {
                      echo "<th>Opciones</th>";
                    }
                    ?>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  require_once "modules/database.php";

                  $sql_prestamos = "SELECT * FROM prestamos AS p INNER JOIN alumnos AS a ON p.id_alumno = a.id_alumno INNER JOIN libros AS l ON p.id_libro = l.id_libro INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario";
                  $sql_prestamos = mysqli_query($conn, $sql_prestamos);

                  while ($row = mysqli_fetch_array($sql_prestamos)) {
                    $id_prestamo = $row['id_prestamo'];
                    $nombre_alumno = $row['nombre_alumno'];
                    $nombre_libro = $row['titulo_libro'];
                    $unidades_prestamo = $row['unidades_prestamo'];
                    $fecha_prestamo = $row['fecha_prestamo'];
                    $fecha_entrega = $row['fecha_entrega'];
                    $nombre_usuario = $row['nombre_usuario'];
                    $detalles_entrega = $row['detalles_entrega'];
                    $estado_prestamo = $row['estado_prestamo'];

                    $badge_color = "bg-danger";
                    if ($estado_prestamo == "Activo") $badge_color = "bg-success";

                    echo "
                      <tr>
                        <td>$id_prestamo</td>
                        <td>$nombre_alumno</td>
                        <td>$nombre_libro</td>
                        <td>$unidades_prestamo</td>
                        <td>$fecha_prestamo</td>
                        <td>$fecha_entrega</td>
                        <td>$nombre_usuario</td>
                        <td>$detalles_entrega</td>
                        <td class='text-center'><span class='badge $badge_color'>$estado_prestamo</span></td>";
                        if ($_SESSION['rol_usuario'] == "Admin") {
                          echo "
                            <td>
                              <a href='index.php?module=form_prestamo&action=edit&id=$id_prestamo' class='btn btn-sm btn-primary'>
                                <i class='fas fa-pen'></i>
                              </a>
                              <a href='#' class='btn btn-sm btn-danger'>
                                <i class='fas fa-trash'></i>
                              </a>
                            </td>";
                        }
                    echo "</tr>";
                  }
                  mysqli_close($conn);
                  ?>
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