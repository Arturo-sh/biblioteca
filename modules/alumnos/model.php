<?php
    session_start();
    require_once "../database.php";

    if (isset($_POST['btn_insert'])) {
        $matricula = mysqli_real_escape_string($conn, trim($_POST['matricula']));
        $nombre = mysqli_real_escape_string($conn, trim($_POST['nombre']));
        $semestre = mysqli_real_escape_string($conn, trim($_POST['semestre']));
        $grupo = mysqli_real_escape_string($conn, trim($_POST['grupo']));

        $query_student_insert = "INSERT INTO alumnos(id_alumno, matricula, nombre_alumno, semestre, grupo_alumno) VALUES(NULL, $matricula, '$nombre', $semestre, '$grupo')";
        $result_student_insert = mysqli_query($conn, $query_student_insert);

        $error_msg = "Ha ocurrido un error al insertar el registro, intentelo de nuevo!";
        $_SESSION['student_insert'] = ["icon" => "error", "title" => $error_msg];

        if ($result_student_insert) {
            $_SESSION['student_insert'] = ["icon" => "success", "title" => "Alumn@ registrado!"];
        }
    } if (isset($_POST['btn_update'])) {
        $id_alumno = mysqli_real_escape_string($conn, trim($_POST['id_alumno']));
        $matricula = mysqli_real_escape_string($conn, trim($_POST['matricula']));
        $nombre = mysqli_real_escape_string($conn, trim($_POST['nombre']));
        $semestre = mysqli_real_escape_string($conn, trim($_POST['semestre']));
        $grupo = mysqli_real_escape_string($conn, trim($_POST['grupo']));
        $estatus = mysqli_real_escape_string($conn, trim($_POST['estatus']));

        $query_student_update = "UPDATE alumnos SET matricula = $matricula, nombre_alumno  = '$nombre', semestre = $semestre, grupo_alumno = '$grupo', estado_alumno = '$estatus' WHERE id_alumno = $id_alumno";
        $result_student_update = mysqli_query($conn, $query_student_update);

        $error_msg = "Ha ocurrido un error al actualizar el registro, intentelo de nuevo!";
        $_SESSION['student_update'] = ["icon" => "error", "title" => $error_msg];

        if ($result_student_update) {
            $_SESSION['student_update'] = ["icon" => "success", "title" => "Datos del alumn@ actualizados!"];
        }
    }
    
    mysqli_close($conn);
    header("Location: ../../?module=alumnos");
?>