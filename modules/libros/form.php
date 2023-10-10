<?php

if ($_SESSION['rol_usuario'] != "Admin") {
    echo "<script> window.location.href = 'index.php?module=libros'; </script>";
}

if ($_GET['action'] == "insert") {
    require_once "modules/database.php";
    
    $query_get_publishers = "SELECT id_editorial, nombre_editorial FROM editoriales";
    $result_get_publishers = mysqli_query($conn, $query_get_publishers);

    $query_get_categories = "SELECT id_categoria, nombre_categoria FROM categorias";
    $result_get_categories = mysqli_query($conn, $query_get_categories);

    echo "
    <!-- Content Header (Page header) -->
    <div class='content-header'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-sm-6'>
                    <h1 class='m-0'>Nuevo libro</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class='content'>
        <div class='container-fluid'>
            <form method='POST' action='modules/libros/model.php' enctype='multipart/form-data'>
                <div class='card-body row'>
                    <div class='form-group col-md-6'>
                        <label for='titulo_libro'>Título del libro</label>
                        <input type='text' class='form-control' id='titulo_libro' name='titulo_libro' placeholder='Ejemplo: El principito' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='id_editorial'>Editorial</label>
                        <select class='form-control select2' style='width: 100%;' id='id_editorial' name='id_editorial' required>";
                        while ($row = mysqli_fetch_array($result_get_publishers)) {
                            $id_editorial = $row['id_editorial'];
                            $nombre_editorial = $row['nombre_editorial'];

                            echo "<option value='$id_editorial'>$nombre_editorial</option>";
                        }
                        echo "
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='id_categoria'>Categoría</label>
                        <select class='form-control select2' style='width: 100%;' id='id_categoria' name='id_categoria' required>";
                        while ($row = mysqli_fetch_array($result_get_categories)) {
                            $id_categoria = $row['id_categoria'];
                            $nombre_categoria = $row['nombre_categoria'];

                            echo "<option value='$id_categoria'>$nombre_categoria</option>";
                        }
                        echo "
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='unidades_totales'>Unidades totales</label>
                        <input type='text' class='form-control' id='unidades_totales' name='unidades_totales' placeholder='1' pattern='[0-9]+' title='Digite solo números sin espacios' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='unidades'>Imagen portada</label>
                        <div class='custom-file'>
                            <input type='file' class='custom-file-input' id='imagen' name='imagen'>
                            <label class='custom-file-label' for='exampleInputFile'></label>
                        </div>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='descripcion'>Breve descripción</label>
                        <input type='text' class='form-control' id='descripcion' name='descripcion' placeholder='Ejemplo: Libro en buenas condiciones...'>
                    </div>
                </div>
                <!-- /.card-body -->
    
                <div class='text-center'>
                    <a href='?module=libros' class='btn btn-outline-danger'>Regresar</a>
                    <button type='submit' class='btn btn-outline-success' name='btn_insert'>Guardar</button>
                </div>
            </form>
        </div>
    </section>";

    mysqli_close($conn);
} 

elseif ($_GET['action'] == "edit") {
    $id_libro = $_GET['id'];

    require_once "modules/database.php";

    $query_book_data = "SELECT * FROM libros WHERE id_libro = $id_libro";
    $book_data = mysqli_query($conn, $query_book_data);
    $row = mysqli_fetch_array($book_data);

    $titulo_libro = $row['titulo_libro'];
    $id_editorial = $row['id_editorial'];
    $id_categoria = $row['id_categoria'];
    $unidades_totales = $row['unidades_totales'];
    $imagen_portada = $row['imagen_portada'];
    $estado_libro = $row['estado_libro'];
    $descripcion = $row['descripcion'];

    $activo = ""; $suspendido = "";

    $activo = $estado_libro == "Activo" ? "selected" : "";
    $suspendido = $estado_libro == "Suspendido" ? "selected" : "";

    $query_get_publishers = "SELECT id_editorial, nombre_editorial FROM editoriales";
    $result_get_publishers = mysqli_query($conn, $query_get_publishers);

    $query_get_categories = "SELECT id_categoria, nombre_categoria FROM categorias";
    $result_get_categories = mysqli_query($conn, $query_get_categories);

    echo "
    <!-- Content Header (Page header) -->
    <div class='content-header'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-sm-6'>
                    <h1 class='m-0'>Editar libro</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class='content'>
        <div class='container-fluid'>
            <form method='POST' action='modules/libros/model.php' enctype='multipart/form-data'>
                <div class='card-body row'>
                    <div class='form-group col-md-6'>
                        <label for='titulo_libro'>Título del libro</label>
                        <input type='hidden' class='form-control' id='id_libro' name='id_libro' value='$id_libro'>
                        <input type='text' class='form-control' id='titulo_libro' name='titulo_libro' value='$titulo_libro' placeholder='Ejemplo: El principito' required>
                    </div>
                    <div class='form-group  col-md-6'>
                        <label for='id_editorial'>Editorial</label>
                        <select class='form-control select2' style='width: 100%;' id='id_editorial' name='id_editorial' required>";
                        while ($row = mysqli_fetch_array($result_get_publishers)) {
                            $id_editorial_row = $row['id_editorial'];
                            $nombre_editorial_row = $row['nombre_editorial'];

                            if ($id_editorial_row == $id_editorial) {
                                echo "<option value='$id_editorial_row' selected>$nombre_editorial_row</option>";
                            } else {
                                echo "<option value='$id_editorial_row'>$nombre_editorial_row</option>";
                            }
                        }
                        echo "
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='id_categoria'>Categoría</label>
                        <select class='form-control select2' style='width: 100%;' id='id_categoria' name='id_categoria' required>";
                        while ($row = mysqli_fetch_array($result_get_categories)) {
                            $id_categoria_row = $row['id_categoria'];
                            $nombre_categoria_row = $row['nombre_categoria'];

                            if ($id_categoria_row == $id_categoria) {
                                echo "<option value='$id_categoria_row' selected>$nombre_categoria_row</option>";
                            } else {
                                echo "<option value='$id_categoria_row'>$nombre_categoria_row</option>";
                            }
                        }
                        echo "
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='unidades_totales'>Unidades totales</label>
                        <input type='text' class='form-control' id='unidades_totales' name='unidades_totales' value='$unidades_totales' placeholder='1' pattern='[0-9]+' title='Digite solo números sin espacios' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='imagen'>Nueva imagen de portada</label>
                        <div class='custom-file'>
                            <input type='file' class='custom-file-input' id='imagen' name='imagen'>
                            <label class='custom-file-label' for='exampleInputFile'></label>
                            <img src='dist/portadas/$imagen_portada' style='width: 20%; margin: 10px 38%;'>
                        </div>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='descripcion'>Breve descripción</label>
                        <input type='text' class='form-control' id='descripcion' name='descripcion' value='$descripcion' placeholder='Ejemplo: Libro en buenas condiciones...'>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='estado_libro'>Estatus</label>
                        <select class='form-control' id='estado_libro' name='estado_libro'> 
                            <option value='Activo' $activo>Activo</option>
                            <option value='Suspendido' $suspendido>Suspendido</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
    
                <div class='text-center'>
                    <a href='?module=libros' class='btn btn-outline-danger'>Regresar</a>
                    <button type='submit' class='btn btn-outline-success' name='btn_update'>Actualizar</button>
                </div>
            </form>
        </div>
    </section>";
    
    mysqli_close($conn);
}

else {
    echo "<script> window.location.href = 'index.php?module=libros'; </script>";
}

?>