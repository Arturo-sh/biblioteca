    <?php
    if ($_SESSION['rol_usuario'] == "Admin") {
      require_once "modules/database.php";
      
      $query_get_students = "SELECT id_alumno, matricula, nombre_alumno FROM alumnos WHERE estado_alumno = 'Activo'";
      $result_get_students = mysqli_query($conn, $query_get_students);

      $query_get_books = "SELECT id_libro, titulo_libro FROM libros WHERE estado_libro = 'Activo'";
      $result_get_books = mysqli_query($conn, $query_get_books);

      $option_students = "";
      $option_books = "";

      while ($row = mysqli_fetch_array($result_get_students)) {
        $id_alumno = $row['id_alumno'];
        $matricula = $row['matricula'];
        $nombre_alumno = $row['nombre_alumno'];

        $option_students .= "<option value='$id_alumno'>$matricula - $nombre_alumno</option>";
      }

      while ($row = mysqli_fetch_array($result_get_books)) {
        $id_libro = $row['id_libro'];
        $titulo_libro = $row['titulo_libro'];

        $option_books .= "<option value='$id_libro' class='add_book'>$titulo_libro</option>";
      }
    }
    ?>
    
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
          <div class='col-md-3'>
            <form method='POST' id='form' action='modules/prestamos/model.php'>
              <div class='card-body row'>
                <div class='form-group col-md-12'>
                  <input type='hidden' class='form-control' id='id_prestamo' name='id_prestamo'>
                  <label for='id_alumno'>Alumno</label>
                  <select class='form-control select2' style='width: 100%;' id='id_alumno' name='id_alumno' required>
                    <option value='0' selected disabled>Seleccionar</option>";
                    <?php echo $option_students; ?>
                  </select>
                </div>
                <div class='form-group col-md-12'>
                  <label for='id_libro'>Libro</label>
                  <select class='form-control select2' style='width: 100%;' id='id_libro' name='id_libro' required>
                    <option value='0' selected disabled>Seleccionar</option>";
                    <?php echo $option_books; ?>
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
                <button type='reset' class='btn btn-outline-danger' onclick='reset_loan_data()'>Cancelar</button>
                <button type='submit' mod='prestamos' class='btn btn-outline-success btn-next' action='insert'>Guardar</button>
              </div>
            </form>
          </div>

          <div class="col-md-9">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>N. Alumno</th>
                    <th>Título libro</th>
                    <th>Unidades préstamo</th>
                    <th>Fecha préstamo</th>
                    <th>Fecha entrega</th>
                    <th>Responsable</th>
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