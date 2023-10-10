<?php
    session_start();
    require_once "../database.php";

    if (isset($_POST['btn_insert'])) {
        $matricula = htmlspecialchars(trim($_POST['matricula']), ENT_QUOTES, 'UTF-8'); 
        $nombre_alumno = htmlspecialchars(trim($_POST['nombre_alumno']), ENT_QUOTES, 'UTF-8'); 
        $semestre = htmlspecialchars(trim($_POST['semestre']), ENT_QUOTES, 'UTF-8'); 

        $query_student_insert = "INSERT INTO alumnos(id_alumno, matricula, nombre_alumno, semestre) VALUES(NULL, $matricula, '$nombre_alumno', $semestre)";
        $result_student_insert = mysqli_query($conn, $query_student_insert);

        $_SESSION['student_insert'] = ["icon" => "error", "action" => "insertar"];

        if ($result_student_insert) {
            $_SESSION['student_insert'] = ["icon" => "success", "title" => "Alumn@ registrado!"];
        }
    } 
    
    if (isset($_POST['btn_update'])) {
        $id_alumno = htmlspecialchars(trim($_POST['id_alumno']), ENT_QUOTES, 'UTF-8'); 
        $matricula = htmlspecialchars(trim($_POST['matricula']), ENT_QUOTES, 'UTF-8'); 
        $nombre_alumno = htmlspecialchars(trim($_POST['nombre_alumno']), ENT_QUOTES, 'UTF-8'); 
        $semestre = htmlspecialchars(trim($_POST['semestre']), ENT_QUOTES, 'UTF-8'); 
        $estado_alumno = htmlspecialchars(trim($_POST['estado_alumno']), ENT_QUOTES, 'UTF-8'); 

        $query_student_update = "UPDATE alumnos SET matricula = $matricula, nombre_alumno  = '$nombre_alumno', semestre = $semestre, estado_alumno = '$estado_alumno' WHERE id_alumno = $id_alumno";
        $result_student_update = mysqli_query($conn, $query_student_update);

        $_SESSION['student_update'] = ["icon" => "error", "action" => "actualizar"];
       
        if ($result_student_update) {
            $_SESSION['student_update'] = ["icon" => "success", "title" => "Datos del alumn@ actualizados!"];
        }
    }
    
    mysqli_close($conn);
    header("Location: ../../?module=alumnos");
?>