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
                        <label for='titulo'>Título del libro</label>
                        <input type='text' class='form-control' id='titulo' name='titulo' placeholder='Ejemplo: El principito' required>
                    </div>
                    <div class='form-group  col-md-6'>
                        <label>Editorial</label>
                        <select class='form-control select2' style='width: 100%;' name='editorial' required>";
                        while ($row = mysqli_fetch_array($result_get_publishers)) {
                            $id_editorial = $row['id_editorial'];
                            $nombre_editorial = $row['nombre_editorial'];

                            echo "<option value='$id_editorial'>$nombre_editorial</option>";
                        }
                        echo "
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label>Categoría</label>
                        <select class='form-control select2' style='width: 100%;' name='categoria' required>";
                        while ($row = mysqli_fetch_array($result_get_categories)) {
                            $id_categoria = $row['id_categoria'];
                            $nombre_categoria = $row['nombre_categoria'];

                            echo "<option value='$id_categoria'>$nombre_categoria</option>";
                        }
                        echo "
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='unidades'>Unidades totales</label>
                        <input type='text' class='form-control' id='unidades' name='unidades' placeholder='1' pattern='[0-9]+' title='Digite solo números sin espacios' required>
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
} 

elseif ($_GET['action'] == "edit") {
    $id = $_GET['id'];

    require_once "modules/database.php";

    $query_student_data = "SELECT * FROM alumnos WHERE id_alumno = $id";
    $student_data = mysqli_query($conn, $query_student_data);
    $row = mysqli_fetch_array($student_data);

    $id_alumno = $row['id_alumno'];
    $matricula = $row['matricula'];
    $nombre = $row['nombre_alumno'];
    $semestre = $row['semestre'];
    $grupo = $row['grupo_alumno'];
    $estatus = $row['estado_alumno'];

    $activo = ""; 
    $baja = "";

    $activo = $estatus == "Activo" ? "selected" : "";
    $baja = $estatus == "Baja" ? "selected" : "";

    echo "
    <!-- Content Header (Page header) -->
    <div class='content-header'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-sm-6'>
                    <h1 class='m-0'>Editar alumno</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class='content'>
        <div class='container-fluid'>
            
        </div>
    </section>";

    mysqli_close($conn);
}

else {
    echo "<script> window.location.href = 'index.php?module=alumnos'; </script>";
}

?>