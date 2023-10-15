    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0">Usuarios Administradores</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Tabla que muestra los usuarios traidos de la BD -->
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
              <form method='POST' action='modules/usuarios/model.php'>
                <div class='card-body row'>
                  <div class='form-group col-md-12'>
                    <label for='usuario'>Nombre de usuario</label>
                    <input type='hidden' class='form-control' id='id_usuario' name='id_usuario'>
                    <input type='text' class='form-control' id='usuario' name='usuario' pattern='^([\w]){6,}$' title='Ingrese nombre de usuario mayor a 5 carácteres y sin espacios' placeholder='Nombre corto (sin espacios)' required>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='contrasenia' id='pass-label'>Contraseña</label>
                    <input type='password' class='form-control' id='contrasenia' name='contrasenia' pattern='^([\w]){6,}$' title='Ingrese una contraseña mayor a 5 carácteres' required>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='nombre_usuario'>Nombre completo</label>
                    <input type='text' class='form-control' id='nombre_usuario' name='nombre_usuario' pattern='^[^\d]+$' title='Ingrese un nombre válido' placeholder='Ejemplo: Pedro...' required>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='telefono_usuario'>Teléfono</label>
                    <input type='text' class='form-control' id='telefono_usuario' name='telefono_usuario' data-inputmask='\"mask\": \"(999) 999-9999\"' data-mask placeholder='(999) 999-9999'>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='correo_usuario'>Correo</label>
                    <input type='email' class='form-control' id='correo_usuario' name='correo_usuario' placeholder='usuario@gmail.com'>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='rol_usuario'>Rol de usuario</label>
                    <select class='form-control' id='rol_usuario' name='rol_usuario'>
                      <option value='Usuario'>Usuario</option>
                      <option value='Admin'>Admin</option>
                    </select>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='rol_usuario'>Estatus</label>
                    <select class='form-control' id='estado_usuario' name='estado_usuario' disabled>
                      <option value='Activo'>Activo</option>
                      <option value='Suspendido'>Suspendido</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class='text-center mb-4'>
                  <button type='reset' class='btn btn-outline-danger'>Cancelar</button>
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
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Creación de cuenta</th>
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

                  $query_get_users = "SELECT id_usuario, rol_usuario, usuario, nombre_usuario, telefono_usuario, correo_usuario, creacion_cuenta, estado_usuario FROM usuarios";
                  $data_users = mysqli_query($conn, $query_get_users);

                  while ($row = mysqli_fetch_array($data_users)) {
                    $id_usuario = $row['id_usuario'];
                    $rol_usuario = $row['rol_usuario'];
                    $usuario = $row['usuario'];
                    $nombre_usuario = $row['nombre_usuario'];
                    $telefono_usuario = $row['telefono_usuario'];
                    $correo_usuario = $row['correo_usuario'];
                    $creacion_cuenta = $row['creacion_cuenta'];
                    $estado_usuario = $row['estado_usuario'];

                    if ($telefono_usuario == "") $telefono_usuario = "Indefinido";
                    if ($correo_usuario == "") $correo_usuario = "Indefinido";

                    $badge_color = "bg-danger";
                    if ($estado_usuario == "Activo") $badge_color = "bg-success";

                    echo "
                      <tr>
                        <td>$usuario</td>
                        <td>$nombre_usuario</td>
                        <td>$telefono_usuario</td>
                        <td>$correo_usuario</td>
                        <td>$creacion_cuenta</td>
                        <td class='text-center'><span class='badge $badge_color'>$estado_usuario</span></td>";
                        if ($_SESSION['rol_usuario'] == "Admin") {
                          echo "
                            <td>
                              <button id='$id_usuario' url='modules/usuarios/model.php' class='btn btn-sm btn-primary btn-edit'>
                                <i class='fas fa-pen'></i>
                              </button>";
                            if ($rol_usuario != 'Admin') {
                              echo "
                              <button id='$id_usuario' url='modules/usuarios/model.php' class='btn btn-sm btn-danger btn-delete'>
                                <i class='fas fa-trash'></i>
                              </button>
                            </td>";
                            } 
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