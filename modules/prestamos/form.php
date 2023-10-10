<?php
if ($_SESSION['rol_usuario'] != "Admin") {
    echo "<script> window.location.href = 'index.php?module=prestamos'; </script>";
}

if ($_GET['action'] == "insert") {
    require_once "modules/database.php";
    
    $query_get_students = "SELECT id_alumno, matricula, nombre_alumno FROM alumnos";
    $result_get_students = mysqli_query($conn, $query_get_students);

    $query_get_books = "SELECT id_libro, titulo_libro FROM libros";
    $result_get_books = mysqli_query($conn, $query_get_books);

    echo "
    <!-- Content Header (Page header) -->
    <div class='content-header'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-sm-6'>
                    <h1 class='m-0'>Registro de préstamo</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class='content'>
        <div class='container-fluid'>
            <form method='POST' action='modules/prestamos/model.php'>
                <div class='card-body row'>
                    <div class='form-group col-md-6'>
                        <label for='id_alumno'>Alumno</label>
                        <select class='form-control select2' style='width: 100%;' id='id_alumno' name='id_alumno' required>";
                        while ($row = mysqli_fetch_array($result_get_students)) {
                            $id_alumno = $row['id_alumno'];
                            $matricula = $row['matricula'];
                            $nombre_alumno = $row['nombre_alumno'];

                            echo "<option value='$id_alumno'>$matricula - $nombre_alumno</option>";
                        }
                        echo "
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='id_libro'>Libro</label>
                        <select class='form-control select2' style='width: 100%;' id='id_libro' name='id_libro' required>";
                        while ($row = mysqli_fetch_array($result_get_books)) {
                            $id_libro = $row['id_libro'];
                            $titulo_libro = $row['titulo_libro'];

                            echo "<option value='$id_libro'>$titulo_libro</option>";
                        }
                        echo "
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='unidades_prestamo'>Unidades préstamo</label>
                        <input type='text' class='form-control' id='unidades_prestamo' name='unidades_prestamo' placeholder='1' pattern='[0-9]+' title='Digite solo números sin espacios' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='fecha_entrega'>Fecha entrega</label>
                        <input type='date' class='form-control' id='fecha_entrega' name='fecha_entrega' required>
                    </div>
                </div>
                <!-- /.card-body -->
    
                <div class='text-center'>
                    <a href='?module=prestamos' class='btn btn-outline-danger'>Regresar</a>
                    <button type='submit' class='btn btn-outline-success' name='btn_insert'>Guardar</button>
                </div>
            </form>
        </div>
    </section>";

    mysqli_close($conn);
} 

elseif ($_GET['action'] == "edit") {
    $id_prestamo = $_GET['id'];

    require_once "modules/database.php";

    $query_loan_data = "SELECT * FROM prestamos WHERE id_prestamo = $id_prestamo";
    $loan_data = mysqli_query($conn, $query_loan_data);
    $row = mysqli_fetch_array($loan_data);

    $id_alumno = $row['id_alumno'];
    $id_libro = $row['id_libro'];
    $unidades_prestamo = $row['unidades_prestamo'];
    $fecha_prestamo = $row['fecha_prestamo'];
    $fecha_entrega = $row['fecha_entrega'];
    $id_usuario = $row['id_usuario'];

    $query_user_data = "SELECT nombre_usuario FROM usuarios WHERE id_usuario = $id_usuario";
    $user_data = mysqli_query($conn, $query_user_data);
    $row = mysqli_fetch_array($user_data);
    $nombre_usuario = $row['nombre_usuario'];

    $query_get_students = "SELECT id_alumno, matricula, nombre_alumno FROM alumnos";
    $result_get_students = mysqli_query($conn, $query_get_students);

    $query_get_books = "SELECT id_libro, titulo_libro FROM libros";
    $result_get_books = mysqli_query($conn, $query_get_books);

    echo "
    <!-- Content Header (Page header) -->
    <div class='content-header'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-sm-6'>
                    <h1 class='m-0'>Registro de préstamo</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class='content'>
        <div class='container-fluid'>
            <form method='POST' action='modules/prestamos/model.php'>
                <div class='card-body row'>
                <div class='form-group col-md-6'>
                        <label for='fecha_prestamo'>Fecha préstamo</label>
                        <input type='hidden' class='form-control' id='id_prestamo' name='id_prestamo' value='$id_prestamo'>
                        <input type='text' class='form-control' id='fecha_prestamo' name='fecha_prestamo' value='$fecha_prestamo' disabled>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='responsable_prestamo'>Responsable</label>
                        <input type='text' class='form-control' id='responsable_prestamo' name='responsable_prestamo' value='$nombre_usuario' disabled>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='id_alumno'>Alumno</label>
                        <select class='form-control select2' style='width: 100%;' id='id_alumno' name='id_alumno' required>";
                        while ($row = mysqli_fetch_array($result_get_students)) {
                            $id_alumno_row = $row['id_alumno'];
                            $matricula_row = $row['matricula'];
                            $nombre_alumno_row = $row['nombre_alumno'];

                            if ($id_alumno_row == $id_alumno) {
                                echo "<option value='$id_alumno_row' selected>$matricula_row - $nombre_alumno_row</option>";
                            } else {
                                echo "<option value='$id_alumno_row'>$matricula_row - $nombre_alumno_row</option>";
                            }
                        }
                        echo "
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='id_libro'>Libro</label>
                        <select class='form-control select2' style='width: 100%;' id='id_libro' name='id_libro' required>";
                        while ($row = mysqli_fetch_array($result_get_books)) {
                            $id_libro_row = $row['id_libro'];
                            $titulo_libro_row = $row['titulo_libro'];

                            if ($id_libro_row == $id_libro) {
                                echo "<option value='$id_libro_row' selected>$titulo_libro_row</option>";
                            } else {
                                echo "<option value='$id_libro_row'>$titulo_libro_row</option>";
                            }
                        }
                        echo "
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='unidades_prestamo'>Unidades préstamo</label>
                        <input type='text' class='form-control' id='unidades_prestamo' name='unidades_prestamo' value='$unidades_prestamo' placeholder='1' pattern='[0-9]+' title='Digite solo números sin espacios' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='fecha_entrega'>Fecha entrega</label>
                        <input type='date' class='form-control' id='fecha_entrega' name='fecha_entrega' value='$fecha_entrega' required>
                    </div>
                </div>
                <!-- /.card-body -->
    
                <div class='text-center'>
                    <a href='?module=prestamos' class='btn btn-outline-danger'>Regresar</a>
                    <button type='submit' class='btn btn-outline-success' name='btn_update'>Actualizar</button>
                </div>
            </form>
        </div>
    </section>";
    
    mysqli_close($conn);
}

else {
    echo "<script> window.location.href = 'index.php?module=prestamos'; </script>";
}
?>