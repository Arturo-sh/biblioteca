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
            <form method='POST' id='form' action='modules/alumnos/model.php'>
              <div class='card-body row'>
                <div class='form-group col-md-12'>
                  <label for='matricula'>Matrícula</label>
                  <input type='hidden' class='form-control' id='id_alumno' name='id_alumno'>
                  <input type='text' class='form-control' id='matricula' name='matricula' data-inputmask='"mask": "99999999"'data-mask placeholder='Ejemplo: 12435678' required>
                </div>
                <div class='form-group col-md-12'>
                  <label for='nombre_alumno'>Nombre</label>
                  <input type='text' class='form-control' id='nombre_alumno' name='nombre_alumno' pattern='^[^\d]+$' title='Ingrese un nombre válido' placeholder='Ejemplo: Jorge...' required>
                </div>
                <div class='form-group col-md-12'>
                  <label for='semestre'>Semestre</label>
                  <select class='form-select' id='semestre' name='semestre'>
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
                  <select class='form-select' id='estado_alumno' name='estado_alumno' disabled> 
                    <option value='Activo'>Activo</option>
                    <option value='Baja'>Baja</option>
                  </select>
                </div>
              </div>
              <!-- /.card-body -->

              <div class='text-center mb-4'>
                <button type='reset' class='btn btn-outline-danger' onclick='resetForm()'>Cancelar</button>
                <button type='submit' class='btn btn-outline-success btn-next' action='insert'>Guardar</button>
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
                    <th>Matrícula</th>
                    <th>Nombre</th>
                    <th>Semestre</th>
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

    <script src="dist/js/alumnos.js"></script>