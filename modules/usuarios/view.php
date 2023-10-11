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

    <?php
    if ($_SESSION['rol_usuario'] == "Admin") {
      echo "
      <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <!-- Small boxes (Stat box) -->
          <div class='row'>
            <div class='col-lg-3 col-6'>
              <a href='index.php?module=form_usuario&action=insert' class='btn btn-md btn-outline-primary my-2'>Nuevo usuario</a>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->";
    }
    ?>

    <!-- Tabla que muestra los usuarios traidos de la BD -->
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
                        <td>$id_usuario</td>
                        <td>$usuario</td>
                        <td>$nombre_usuario</td>
                        <td>$telefono_usuario</td>
                        <td>$correo_usuario</td>
                        <td>$creacion_cuenta</td>
                        <td class='text-center'><span class='badge $badge_color'>$estado_usuario</span></td>";
                        if ($_SESSION['rol_usuario'] == "Admin") {
                          echo "
                            <td>
                              <a href='index.php?module=form_usuario&action=edit&id=$id_usuario' class='btn btn-sm btn-primary'>
                                <i class='fas fa-pen'></i>
                              </a>";
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