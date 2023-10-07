    <?php
    
    require_once "modules/database.php";

    $sql_alumnos = "SELECT * FROM alumnos";
    $sql_alumnos = mysqli_query($conn, $sql_alumnos);

    ?>
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
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    while ($row = mysqli_fetch_array($sql_alumnos)) {
                        $id_alumno = $row['id_alumno'];
                        $matricula = $row['matricula'];
                        $nombre_alumno = $row['nombre_alumno'];
                        $semestre = $row['semestre'];
                        $grupo_alumno = $row['grupo_alumno'];
                        $estado_alumno = $row['estado_alumno'];

                        echo "
                        <tr>
                            <td>$id_alumno</td>
                            <td>$matricula</td>
                            <td>$nombre_alumno</td>
                            <td>$semestre</td>
                            <td>$grupo_alumno</td>
                            <td>$estado_alumno</td>
                        </tr>";
                    }
                    mysqli_close($conn);
                    ?>

                  </tbody>
                  <!-- <tfoot>
                  <tr>
                  <th>ID</th>
                    <th>Matrícula</th>
                    <th>Nombre</th>
                    <th>Semestre</th>
                    <th>Grupo</th>
                    <th>Estatus</th>
                  </tr>
                  </tfoot> -->
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