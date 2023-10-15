<?php
session_start();
require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['btn_insert'])) {
        $matricula = htmlspecialchars(trim($_POST['matricula']), ENT_QUOTES, 'UTF-8'); 
        $nombre_alumno = htmlspecialchars(trim($_POST['nombre_alumno']), ENT_QUOTES, 'UTF-8'); 
        $semestre = htmlspecialchars(trim($_POST['semestre']), ENT_QUOTES, 'UTF-8'); 
        $_SESSION['student_insert'] = ["icon" => "error", "action" => "insertar"];

        $query_student_insert = "INSERT INTO alumnos(id_alumno, matricula, nombre_alumno, semestre) VALUES(NULL, $matricula, '$nombre_alumno', $semestre)";
        $result_student_insert = mysqli_query($conn, $query_student_insert);

        if ($result_student_insert) {
            $_SESSION['student_insert'] = ["icon" => "success", "title" => "Alumn@ registrado!"];
        }

        header("Location: ../../index.php?module=alumnos");
    }

    if (isset($_POST['edit_id'])) {
        $id_alumno = $_POST['edit_id'];
        
        $query_student_data = "SELECT * FROM alumnos WHERE id_alumno = $id_alumno";
        $student_data = mysqli_query($conn, $query_student_data);
        $row = mysqli_fetch_all($student_data, MYSQLI_ASSOC);

        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }
        
    if (isset($_POST['btn_update'])) {
        $id_alumno = htmlspecialchars(trim($_POST['id_alumno']), ENT_QUOTES, 'UTF-8'); 
        $matricula = htmlspecialchars(trim($_POST['matricula']), ENT_QUOTES, 'UTF-8'); 
        $nombre_alumno = htmlspecialchars(trim($_POST['nombre_alumno']), ENT_QUOTES, 'UTF-8'); 
        $semestre = htmlspecialchars(trim($_POST['semestre']), ENT_QUOTES, 'UTF-8'); 
        $estado_alumno = htmlspecialchars(trim($_POST['estado_alumno']), ENT_QUOTES, 'UTF-8'); 
        $_SESSION['student_update'] = ["icon" => "error", "action" => "actualizar"];

        $query_student_update = "UPDATE alumnos SET matricula = $matricula, nombre_alumno  = '$nombre_alumno', semestre = $semestre, estado_alumno = '$estado_alumno' WHERE id_alumno = $id_alumno";
        $result_student_update = mysqli_query($conn, $query_student_update);
    
        if ($result_student_update) {
            $_SESSION['student_update'] = ["icon" => "success", "title" => "Datos del alumn@ actualizados!"];
        }

        header("Location: ../../index.php?module=alumnos");
    }

    if (isset($_POST['delete_id'])) {
        $id_alumno = $_POST['delete_id'];
        
        $student_deleted = ["icon" => "error", "title" => "Ha ocurridó un error, inténtelo de nuevo!"];
        
        $query_student_delete = "DELETE FROM alumnos WHERE id_alumno = $id_alumno";
        $result_student_delete = mysqli_query($conn, $query_student_delete);    

        if ($result_student_delete) {
            $student_deleted = ["icon" => "success", "title" => "Alumn@ eliminado!"];
        }

        echo json_encode($student_deleted);
    }

    if (isset($_POST['action_id'])) {
        $action_id = $_POST['action_id'];

        $action = $action_id == 1 ? "less" : "more";
        $semester = $action_id == 1 ? 1 : 6;
        $grade_students = $semester == 1 ? "1er" : "6to";
        $response = ["total_students" => 0, "grade_students" => 0, "action" => $action];

        $query_get_students = "SELECT COUNT(semestre) FROM alumnos WHERE semestre = $semester AND estado_alumno != 'Baja'";
        $result_get_students = mysqli_query($conn, $query_get_students);
        $total_students = mysqli_fetch_row($result_get_students)[0];

        if ($total_students > 0) {
            $response = ["total_students" => $total_students, "grade_students" => $grade_students, "action" => $action];
        } 
        
        echo json_encode($response);
    }

    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        $response = ["icon" => "error", "title" => "Ha ocurridó un error al actualizar los datos, inténtelo de nuevo!"];

        $query_update_students = "UPDATE alumnos SET semestre = semestre - 1";
        if ($action == "more") {
            $query_update_students = "UPDATE alumnos SET semestre = semestre + 1";
        } 

        $result_update_students = mysqli_query($conn, $query_update_students);
        
        $query_withdraw_students = "UPDATE alumnos SET estado_alumno = 'Baja' WHERE semestre > 6 OR semestre < 1";
        $result_withdraw_students = mysqli_query($conn, $query_withdraw_students);    

        if ($result_update_students && $result_withdraw_students) {
            $response = ["icon" => "success", "title" => "Datos actualizados!"];
        } 
        
        echo json_encode($response);
    }
}

mysqli_close($conn);
?>