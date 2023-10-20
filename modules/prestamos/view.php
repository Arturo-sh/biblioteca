    <?php
    if ($_SESSION['rol_usuario'] == "Admin") {
      require_once "modules/database.php";
      
      $query_get_students = "SELECT id_alumno, matricula, nombre_alumno FROM alumnos WHERE estado_alumno = 'Activo'";
      $result_get_students = mysqli_query($conn, $query_get_students);

      $student_options = "";

      while ($row = mysqli_fetch_array($result_get_students)) {
        $id_alumno = $row['id_alumno'];
        $matricula = $row['matricula'];
        $nombre_alumno = $row['nombre_alumno'];

        $student_options .= "<option value='$id_alumno'>$matricula - $nombre_alumno</option>";
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

    <style>
    #suggestions {
      box-shadow: 2px 2px 8px 0 rgba(0,0,0,.2);
      height: auto;
      position: absolute;
      top: 66px;
      z-index: 9999;
      width: 216px;
      max-height: 250px;
      overflow-y: auto;
    }
    
    #suggestions .suggest-element {
      background-color: #EEEEEE;
      border-top: 1px solid #d6d4d4;
      cursor: pointer;
      padding: 8px;
      width: 100%;
      float: left;
    }
    </style>

<!-- Tabla que muestra los prestamos traidos de la BD -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class='col-md-3'>
            <form method='POST' id='form' action='modules/prestamos/model.php'>
              <div class='card-body row'>
                <div class='form-group col-md-12'>
                  <label for='id_alumno'>Alumno</label>
                  <select class='form-control select2' style='width: 100%;' id='id_alumno' name='id_alumno' required>
                    <option value='0' selected disabled>Seleccionar</option>
                    <?php echo $student_options; ?>
                  </select>
                </div>
                <div class='form-group col-md-12'>
                  <label for='id_libro'>Libro</label>
                  <div class="input-group input-group-sm">
                    <input class="search_query form-control" type="text" name="key" id="key" placeholder="Buscar...">
                    <span class="btn btn-info btn-sm"><i class="fa fa-search"></i></span>
                  </div>
                  <div id="suggestions"></div>
                </div>
                <div class='form-group col-md-12'>
                  <label for='#'>Libros préstamo</label>
                  <div id="libros-prestamo">
                    <!-- Se rellena con los libros seleccionados -->
                  </div>
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