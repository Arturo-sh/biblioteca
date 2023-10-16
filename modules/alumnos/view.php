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

    <!-- Tabla que muestra los alumnos traidos de la BD -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php
          $table_width = "col-md-12";
          if ($_SESSION['rol_usuario'] == "Admin") {
            $table_width = "col-md-9";

            echo "
            <div class='col-md-3'>
              <div class='row'>
                <div class='form-group col-md-6'>
                  <button id='1' url='modules/alumnos/model.php' class='btn btn-md btn-outline-danger btn-change-grade'>
                    <i class='fas fa-minus'></i> 1 semestre
                  </button>
                </div>
                <div class='form-group col-md-6'>
                  <button id='2' url='modules/alumnos/model.php' class='btn btn-md btn-outline-primary btn-change-grade'>
                    <i class='fas fa-plus'></i> 1 semestre
                  </button>
                </div>
              </div>
              <form method='POST' action='modules/alumnos/model.php'>
                <div class='card-body row'>
                  <div class='form-group col-md-12'>
                    <label for='matricula'>Matrícula</label>
                    <input type='hidden' class='form-control' id='id_alumno' name='id_alumno'>
                    <input type='text' class='form-control' id='matricula' name='matricula' pattern='[0-9]{8}' title='Ingrese una mátricula válida' placeholder='Ejemplo: 12435678' required>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='nombre_alumno'>Nombre</label>
                    <input type='text' class='form-control' id='nombre_alumno' name='nombre_alumno' pattern='^[^\d]+$' title='Ingrese un nombre válido' placeholder='Ejemplo: Jorge...' required>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='semestre'>Semestre</label>
                    <select class='form-control' id='semestre' name='semestre'>
                      <option value='1'>1er semestre</option>
                      <option value='2'>2do semestre</option>
                      <option value='3'>3er semestre</option>
                      <option value='4'>4to semestre</option>
                      <option value='5'>5to semestre</option>
                      <option value='6'>6to semestre</option>
                    </select>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='estado_alumno'>Estatus</label>
                    <select class='form-control' id='estado_alumno' name='estado_alumno' disabled> 
                      <option value='Activo'>Activo</option>
                      <option value='Baja'>Baja</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class='text-center mb-4'>
                  <button type='reset' class='btn btn-outline-danger' onclick='reset_student_data()'>Cancelar</button>
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
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Nombre</th>
                    <th>Semestre</th>
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

                  $sql_alumnos = "SELECT * FROM alumnos ORDER BY estado_alumno";
                  $sql_alumnos = mysqli_query($conn, $sql_alumnos);

                  while ($row = mysqli_fetch_array($sql_alumnos)) {
                    $id_alumno = $row['id_alumno'];
                    $matricula = $row['matricula'];
                    $nombre_alumno = $row['nombre_alumno'];
                    $semestre = $row['semestre'];
                    $estado_alumno = $row['estado_alumno'];
                    
                    $badge_color = "bg-danger";
                    if ($estado_alumno == "Activo") $badge_color = "bg-success";
                    if ($semestre < 1 || $semestre > 6) $semestre = "Indefinido";
                      
                    echo "
                    <tr>
                        <td>$id_alumno</td>
                        <td>$matricula</td>
                        <td>$nombre_alumno</td>
                        <td>$semestre</td>
                        <td class='text-center'><span class='badge $badge_color'>$estado_alumno</span></td>";
                        if ($_SESSION['rol_usuario'] == "Admin") {
                          echo "
                            <td>
                              <button id='$id_alumno' url='modules/alumnos/model.php' class='btn btn-sm btn-primary btn-edit'>
                                <i class='fas fa-pen'></i>
                              </button>
                              <button id='$id_alumno' url='modules/alumnos/model.php' class='btn btn-sm btn-danger btn-delete'>
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