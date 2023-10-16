    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0">Libros</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Tabla que muestra los libros traidos de la BD -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <?php
          $table_width = "col-md-12";
          if ($_SESSION['rol_usuario'] == "Admin") {
            require_once "modules/database.php";
            $table_width = "col-md-9";
    
            $query_get_publishers = "SELECT id_editorial, nombre_editorial FROM editoriales";
            $result_get_publishers = mysqli_query($conn, $query_get_publishers);

            $query_get_categories = "SELECT id_categoria, nombre_categoria FROM categorias";
            $result_get_categories = mysqli_query($conn, $query_get_categories);

            echo "
            <div class='col-md-3'>
              <form method='POST' action='modules/libros/model.php' enctype='multipart/form-data'>
                <div class='card-body row'>
                  <div class='form-group col-md-12'>
                    <label for='titulo_libro'>Título del libro</label>
                    <input type='hidden' class='form-control' id='id_libro' name='id_libro'>
                    <input type='text' class='form-control' id='titulo_libro' name='titulo_libro' placeholder='Ejemplo: El principito' required>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='id_editorial'>Editorial</label>
                    <select class='form-control select2' style='width: 100%;' id='id_editorial' name='id_editorial' required>
                      <option value='0' selected disabled>Seleccionar</option>";
                      while ($row = mysqli_fetch_array($result_get_publishers)) {
                        $id_editorial = $row['id_editorial'];
                        $nombre_editorial = $row['nombre_editorial'];

                        echo "<option value='$id_editorial'>$nombre_editorial</option>";
                      }
                    echo "
                    </select>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='id_categoria'>Categoría</label>
                    <select class='form-control select2' style='width: 100%;' id='id_categoria' name='id_categoria' required>
                      <option value='0' selected disabled>Seleccionar</option>";
                      while ($row = mysqli_fetch_array($result_get_categories)) {
                        $id_categoria = $row['id_categoria'];
                        $nombre_categoria = $row['nombre_categoria'];

                        echo "<option value='$id_categoria'>$nombre_categoria</option>";
                      }
                    echo "
                    </select>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='unidades_totales'>Unidades totales</label>
                    <input type='text' class='form-control' id='unidades_totales' name='unidades_totales' placeholder='1' pattern='[0-9]+' title='Digite solo números sin espacios' required>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='unidades'>Imagen portada</label>
                    <div class='custom-file'>
                      <input type='file' class='custom-file-input' id='imagen' name='imagen'>
                      <label class='custom-file-label' for='exampleInputFile'></label>
                    </div>
                  </div>
                  <div class='form-group col-md-12 image-field' hidden>
                    <img id='image-view' src='dist/portadas/portada_default.png' style='width: 100%;'>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='descripcion'>Breve descripción</label>
                    <input type='text' class='form-control' id='descripcion' name='descripcion' placeholder='Ejemplo: Libro en buenas condiciones...'>
                  </div>
                  <div class='form-group col-md-12'>
                    <label for='estado_libro'>Estatus</label>
                    <select class='form-control' id='estado_libro' name='estado_libro' disabled> 
                      <option value='Activo'>Activo</option>
                      <option value='Inactivo'>Inactivo</option>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class='text-center mb-4'>
                  <button type='reset' class='btn btn-outline-danger' onclick='reset_book_data()'>Cancelar</button>
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
                    <th>Título</th>
                    <th>Editorial</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Descripción</th>
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

                  $query_get_books = "SELECT l.id_libro, l.titulo_libro, e.nombre_editorial, c.nombre_categoria, l.unidades_totales, l.imagen_portada, l.descripcion, l.estado_libro FROM libros AS l INNER JOIN editoriales AS e ON l.id_editorial = e.id_editorial INNER JOIN categorias AS c ON l.id_categoria = c.id_categoria";
                  $result_get_books = mysqli_query($conn, $query_get_books);

                  while ($row = mysqli_fetch_array($result_get_books)) {
                    $id_libro = $row['id_libro'];
                    $titulo_libro = $row['titulo_libro'];
                    $nombre_editorial = $row['nombre_editorial'];
                    $nombre_categoria = $row['nombre_categoria'];
                    $unidades_totales = $row['unidades_totales'];
                    $imagen_portada = $row['imagen_portada'];
                    $descripcion = $row['descripcion'];
                    $estado_libro = $row['estado_libro'];

                    $badge_color = "bg-danger";
                    if ($estado_libro == "Activo") $badge_color = "bg-success";
                        
                    echo "
                      <tr>
                        <td>$titulo_libro</td>
                        <td>$nombre_editorial</td>
                        <td>$nombre_categoria</td>
                        <td>$unidades_totales</td>
                        <td>";
                        if ($imagen_portada != "portada_default.png") {
                          echo "
                          <button image-name='$imagen_portada' class='btn btn-sm btn-warning btn-view' data-toggle='modal' data-target='#modal-image' >
                            <i class='fas fa-eye'></i>
                          </button>";
                        }
                        echo "
                        </td>
                        <td>$descripcion</td>
                        <td class='text-center'><span class='badge $badge_color'>$estado_libro</span></td>";
                        if ($_SESSION['rol_usuario'] == "Admin") {
                          echo "
                            <td>
                              <button id='$id_libro' url='modules/libros/model.php' class='btn btn-sm btn-primary btn-edit'>
                                <i class='fas fa-pen'></i>
                              </button>
                              <button id='$id_libro' url='modules/libros/model.php' class='btn btn-sm btn-danger btn-delete'>
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

    <div class='modal fade' id='modal-image' id='staticBackdrop' data-backdrop='static' tabindex='-1' role='dialog' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
      <div class='modal-dialog' role='document'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h4 class='modal-title'>Imagen portada</h4>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>
          <div class='modal-body'>
            <img src="#" id="image-form" alt="Recurso no disponible" style="width: 100%;">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->