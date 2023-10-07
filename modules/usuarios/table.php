    <?php
    
    require_once "modules/database.php";

    $sql_usuarios = "SELECT * FROM usuarios";
    $sql_usuarios = mysqli_query($conn, $sql_usuarios);

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
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Creación de cuenta</th>
                    <th>Estatus</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    while ($row = mysqli_fetch_array($sql_usuarios)) {
                        $id_usuario = $row['id_usuario'];
                        $nombre_usuario = $row['nombre_usuario'];
                        $telefono_usuario = $row['telefono_usuario'];
                        $correo_usuario = $row['correo_usuario'];
                        $creacion_cuenta = $row['creacion_cuenta'];
                        $estado_usuario = $row['estado_usuario'];

                        echo "
                        <tr>
                            <td>$id_usuario</td>
                            <td>$nombre_usuario</td>
                            <td>$telefono_usuario</td>
                            <td>$correo_usuario</td>
                            <td>$creacion_cuenta</td>
                            <td>$estado_usuario</td>
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