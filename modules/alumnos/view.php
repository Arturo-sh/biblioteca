    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0">Alumnos</h1>
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
              <a href='index.php?module=form_alumno&action=insert' class='btn btn-md btn-outline-primary my-2'>Nuevo alumno</a>
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
                    <th>Matrícula</th>
                    <th>Nombre</th>
                    <th>Semestre</th>
                    <th>Grupo</th>
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

                  $sql_alumnos = "SELECT * FROM alumnos";
                  $sql_alumnos = mysqli_query($conn, $sql_alumnos);

                  while ($row = mysqli_fetch_array($sql_alumnos)) {
                    $id_alumno = $row['id_alumno'];
                    $matricula = $row['matricula'];
                    $nombre_alumno = $row['nombre_alumno'];
                    $semestre = $row['semestre'];
                    $grupo_alumno = $row['grupo_alumno'];
                    $estado_alumno = $row['estado_alumno'];
                    
                    $badge_color = "bg-danger";
                    if ($estado_alumno == "Activo") $badge_color = "bg-success";
                      
                    echo "
                    <tr>
                        <td>$id_alumno</td>
                        <td>$matricula</td>
                        <td>$nombre_alumno</td>
                        <td>$semestre</td>
                        <td>$grupo_alumno</td>
                        <td class='text-center'><span class='badge $badge_color'>$estado_alumno</span></td>";
                        if ($_SESSION['rol_usuario'] == "Admin") {
                          echo "
                            <td>
                              <a href='index.php?module=form_alumno&action=edit&id=$id_alumno' class='btn btn-sm btn-primary'>
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