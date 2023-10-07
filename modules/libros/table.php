    <?php
    
    require_once "modules/database.php";

    $sql_libros = "SELECT * FROM libros AS l INNER JOIN editoriales AS e ON l.id_editorial = e.id_editorial INNER JOIN categorias AS c ON l.id_categoria = c.id_categoria";
    $sql_libros = mysqli_query($conn, $sql_libros);

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
                    <th>Título</th>
                    <th>Editorial</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Estatus</th>
                    <th>Descripción</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    while ($row = mysqli_fetch_array($sql_libros)) {
                        $id_libro = $row['id_libro'];
                        $titulo_libro = $row['titulo_libro'];
                        $nombre_editorial = $row['nombre_editorial'];
                        $nombre_categoria = $row['nombre_categoria'];
                        $unidades_totales = $row['unidades_totales'];
                        $imagen_portada = $row['imagen_portada'];
                        $estado_libro = $row['estado_libro'];
                        $descripcion = $row['descripcion'];

                        echo "
                        <tr>
                            <td>$id_libro</td>
                            <td>$titulo_libro</td>
                            <td>$nombre_editorial</td>
                            <td>$nombre_categoria</td>
                            <td>$unidades_totales</td>
                            <td>$imagen_portada</td>
                            <td>$estado_libro</td>
                            <td>$descripcion</td>
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