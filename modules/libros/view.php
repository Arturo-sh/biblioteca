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

    <?php
    if ($_SESSION['rol_usuario'] == "Admin") {
      echo "
      <!-- Main content -->
      <section class='content'>
        <div class='container-fluid'>
          <!-- Small boxes (Stat box) -->
          <div class='row'>
            <div class='col-lg-3 col-6'>
              <a href='index.php?module=form_libro&action=insert' class='btn btn-md btn-outline-primary my-2'>Nuevo libro</a>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->";
    }
    ?>

    <!-- Tabla que muestra los libros traidos de la BD -->
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

                  $sql_libros = "SELECT * FROM libros AS l INNER JOIN editoriales AS e ON l.id_editorial = e.id_editorial INNER JOIN categorias AS c ON l.id_categoria = c.id_categoria";
                  $sql_libros = mysqli_query($conn, $sql_libros);

                  while ($row = mysqli_fetch_array($sql_libros)) {
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
                        <td>$id_libro</td>
                        <td>$titulo_libro</td>
                        <td>$nombre_editorial</td>
                        <td>$nombre_categoria</td>
                        <td>$unidades_totales</td>
                        <td><img src='dist/portadas/$imagen_portada' style='width: 100%;'></td>
                        <td>$descripcion</td>
                        <td class='text-center'><span class='badge $badge_color'>$estado_libro</span></td>";
                        if ($_SESSION['rol_usuario'] == "Admin") {
                          echo "
                            <td>
                              <a href='index.php?module=form_libro&action=edit&id=$id_libro' class='btn btn-sm btn-primary'>
                                <i class='fas fa-pen'></i>
                              </a>
                              <a href='#' class='btn btn-sm btn-danger'>
                                <i class='fas fa-trash'></i>
                              </a>
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