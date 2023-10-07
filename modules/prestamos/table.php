    <?php
    
    require_once "modules/database.php";

    $sql_prestamos = "SELECT * FROM prestamos AS p INNER JOIN alumnos AS a ON p.id_alumno = a.id_alumno INNER JOIN libros AS l ON p.id_libro = l.id_libro INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario";
    $sql_prestamos = mysqli_query($conn, $sql_prestamos);

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
                    <th>Alumno</th>
                    <th>Título ejemplar</th>
                    <th>Unidades préstamo</th>
                    <th>Fecha préstamo</th>
                    <th>Fecha entrega</th>
                    <th>Responsable</th>
                    <th>Estatus</th>
                    <th>Detalles</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    while ($row = mysqli_fetch_array($sql_prestamos)) {
                        $id_prestamo = $row['id_prestamo'];
                        $nombre_alumno = $row['nombre_alumno'];
                        $nombre_libro = $row['titulo_libro'];
                        $unidades_prestamo = $row['unidades_prestamo'];
                        $fecha_prestamo = $row['fecha_prestamo'];
                        $fecha_entrega = $row['fecha_entrega'];
                        $nombre_usuario = $row['nombre_usuario'];
                        $estado_prestamo = $row['estado_prestamo'];
                        $detalles_entrega = $row['detalles_entrega'];

                        echo "
                        <tr>
                            <td>$id_prestamo</td>
                            <td>$nombre_alumno</td>
                            <td>$nombre_libro</td>
                            <td>$unidades_prestamo</td>
                            <td>$fecha_prestamo</td>
                            <td>$fecha_entrega</td>
                            <td>$nombre_usuario</td>
                            <td>$estado_prestamo</td>
                            <td>$detalles_entrega</td>
                        </tr>";
                    }
                    
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