    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row my-2">
          <div class="col-md-12 d-inline-flex">
            <div class="col-md-6">
              <h1>Usuarios</h1>
            </div>
            <div class="col-md-6 text-right">
              <button class='btn btn-md btn-primary btn-add' data-toggle='modal' data-target='#modal-default' onclick='resetForm()'><i class='nav-icon fas fas fa-user'></i> Nuevo usuario</button>
            </div>
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
          <div class='modal fade' id='modal-default' id='staticBackdrop' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
            <div class='modal-dialog' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Datos de usuario</h4>
                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>
                <div class='modal-body'>
                  <form method='POST' id='form' action='modules/usuarios/model.php'>
                    <div class='card-body row'>
                      <div class='col-md-6 p-1'>
                        <label for='usuario'>Nombre de usuario</label>
                        <input type='hidden' class='form-control' id='id_usuario' name='id_usuario'>
                        <textarea class='form-control' id='usuario' name='usuario' rows='2' placeholder='Nombre corto (preferentemente sin espacios)' required></textarea>
                      </div>
                      <div class='col-md-6 p-1'>
                        <label for='contrasenia' id='pass-label'>Contraseña</label>
                        <input type='password' class='form-control' id='contrasenia' name='contrasenia' pattern='^([\w]){6,}$' title='Ingrese una contraseña mayor a 5 carácteres' required>
                      </div>
                      <div class='col-md-6 p-1'>
                        <label for='nombre_usuario'>Nombre completo</label>
                        <textarea class='form-control' id='nombre_usuario' name='nombre_usuario' rows='1' placeholder='Nombre completo' required></textarea>
                      </div>
                      <div class='col-md-6 p-1'>
                        <label for='telefono_usuario'>Teléfono</label>
                        <input type='text' class='form-control' id='telefono_usuario' name='telefono_usuario' data-inputmask='"mask": "(999) 999-9999"' data-mask placeholder='(999) 999-9999'>
                      </div>
                      <div class='col-md-6 p-1'>
                        <label for='correo_usuario'>Correo</label>
                        <textarea class='form-control' id='correo_usuario' name='correo_usuario' rows='1' placeholder='(Opcional) Ej. admin@gmail.com'></textarea>
                      </div>
                      <div class='col-md-6 p-1'>
                        <label for='estado_usuario'>Estatus</label>
                        <select class='form-select estatus' id='estado_usuario' name='estado_usuario' disabled>
                          <option value='Activo'>Activo</option>
                          <option value='Suspendido'>Suspendido</option>
                        </select>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class='text-center mb-4'>
                      <button type='reset' class='btn btn-sm btn-outline-danger' data-dismiss='modal'>Cancelar</button>
                      <button type='submit' class='btn btn-sm btn-outline-success btn-next' action='insert' data-dismiss='modal'>Guardar</button>
                    </div>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Usuario</th>
                      <th>Nombre</th>
                      <th>Teléfono</th>
                      <th>Correo</th>
                      <th>Creación de cuenta</th>
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

    <script src="dist/js/usuarios.js"></script>