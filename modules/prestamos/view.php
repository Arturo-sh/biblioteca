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
          <?php
          $table_width = "col-md-12";
          if ($_SESSION['rol_usuario'] == "Admin") {
            require_once "modules/database.php";
            $table_width = "col-md-9";

            $query_get_students = "SELECT id_alumno, matricula, nombre_alumno FROM alumnos WHERE estado_alumno = 'Activo'";
            $result_get_students = mysqli_query($conn, $query_get_students);

            $query_get_books = "SELECT id_libro, titulo_libro FROM libros WHERE estado_libro = 'Activo'";
            $result_get_books = mysqli_query($conn, $query_get_books);

            echo "
            <div class='col-md-3'>
              <form method='POST' action='modules/prestamos/model.php'>
                <div class='card-body row'>
                  <div class='form-group col-md-12'>
                    <input type='hidden' class='form-control' id='id_prestamo' name='id_prestamo'>
                    <label for='id_alumno'>Alumno</label>
                    <select class='form-control select2' style='width: 100%;' id='id_alumno' name='id_alumno' required>
                      <option selected disabled>Seleccionar</option>";
                      while ($row = mysqli_fetch_array($result_get_students)) {
                        $id_alumno = $row['id_alumno'];
                        $matricula = $row['matricula'];
                        $nombre_alumno = $row['nombre_alumno'];

                        echo "<option value='$id_alumno'>$matricula - $nombre_alumno</option>";
                      }
                    echo "
                    </select>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='id_libro'>Libro</label>
                    <select class='form-control select2' style='width: 100%;' id='id_libro' name='id_libro' required>
                      <option selected disabled>Seleccionar</option>";
                      while ($row = mysqli_fetch_array($result_get_books)) {
                        $id_libro = $row['id_libro'];
                        $titulo_libro = $row['titulo_libro'];

                        echo "<option value='$id_libro' class='add_book'>$titulo_libro</option>";
                      }
                    echo "
                    </select>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='unidades_prestamo'>Unidades préstamo</label>
                    <input type='text' class='form-control' id='unidades_prestamo' name='unidades_prestamo' placeholder='1' pattern='[0-9]+' title='Digite solo números sin espacios' required>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='fecha_entrega'>Fecha entrega</label>
                    <input type='date' class='form-control' id='fecha_entrega' name='fecha_entrega' required>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='estado_prestamo'>Estatus</label>
                    <select class='form-control' id='estado_prestamo' name='estado_prestamo' disabled> 
                      <option value='Pendiente'>Pendiente</option>
                      <option value='Entregado'>Entregado</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class='text-center mb-4'>
                  <button type='reset' mod='prestamos' class='btn btn-outline-danger btn-reset'>Cancelar</button>
                  <button type='submit' class='btn btn-outline-success btn-next' name='btn_insert'>Guardar</button>
                </div>
              </form>
            </div>";
          }
          ?>

          <div class="<?php echo $table_width; ?>">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Alumno</th>
                    <th>Título libro</th>
                    <th>Unidades préstamo</th>
                    <th>Fecha préstamo</th>
                    <th>Fecha entrega</th>
                    <th>Responsable</th>
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

                  $sql_prestamos = "SELECT p.id_prestamo, a.nombre_alumno, l.titulo_libro, p.unidades_prestamo, p.fecha_prestamo, p.fecha_entrega, u.nombre_usuario, p.estado_prestamo FROM prestamos AS p INNER JOIN alumnos AS a ON p.id_alumno = a.id_alumno INNER JOIN libros AS l ON p.id_libro = l.id_libro INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario";
                  $sql_prestamos = mysqli_query($conn, $sql_prestamos);

                  while ($row = mysqli_fetch_array($sql_prestamos)) {
                    $id_prestamo = $row['id_prestamo'];
                    $nombre_alumno = $row['nombre_alumno'];
                    $nombre_libro = $row['titulo_libro'];
                    $unidades_prestamo = $row['unidades_prestamo'];
                    $fecha_prestamo = $row['fecha_prestamo'];
                    $fecha_entrega = $row['fecha_entrega'];
                    $nombre_usuario = $row['nombre_usuario'];
                    $estado_prestamo = $row['estado_prestamo'];

                    $badge_color = "bg-primary";
                    if ($estado_prestamo == "Entregado") $badge_color = "bg-success";

                    echo "
                      <tr>
                        <td>$nombre_alumno</td>
                        <td>$nombre_libro</td>
                        <td>$unidades_prestamo</td>
                        <td>$fecha_prestamo</td>
                        <td>$fecha_entrega</td>
                        <td>$nombre_usuario</td>
                        <td class='text-center'><span class='badge $badge_color'>$estado_prestamo</span></td>";
                        if ($_SESSION['rol_usuario'] == "Admin") {
                          echo "
                            <td>
                              <button id='$id_prestamo' url='modules/prestamos/model.php' class='btn btn-sm btn-primary btn-edit'>
                                <i class='fas fa-pen'></i>
                              </button>
                              <button id='$id_prestamo' url='modules/prestamos/model.php' class='btn btn-sm btn-danger btn-delete'>
                                <i class='fas fa-trash'></i>
                              </button>
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