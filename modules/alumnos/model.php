<?php
session_start();
require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['students_table'])) {
        $query_get_students = "SELECT * FROM alumnos";
        $students_data = mysqli_query($conn, $query_get_students);
    
        $data = mysqli_fetch_all($students_data, MYSQLI_ASSOC);
    
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "insert") {
        $matricula = htmlspecialchars(trim($_POST['matricula']), ENT_QUOTES, 'UTF-8'); 
        $nombre_alumno = htmlspecialchars(trim($_POST['nombre_alumno']), ENT_QUOTES, 'UTF-8'); 
        $semestre = htmlspecialchars(trim($_POST['semestre']), ENT_QUOTES, 'UTF-8'); 

        $query_student_insert = "INSERT INTO alumnos(id_alumno, matricula, nombre_alumno, semestre) VALUES(NULL, $matricula, '$nombre_alumno', $semestre)";
        $result_student_insert = mysqli_query($conn, $query_student_insert);

        if ($result_student_insert) echo "Alumn@ registrado!";
    }

    if (isset($_POST['edit_id'])) {
        $id_alumno = $_POST['edit_id'];
        
        $query_student_data = "SELECT * FROM alumnos WHERE id_alumno = $id_alumno";
        $student_data = mysqli_query($conn, $query_student_data);
        $row = mysqli_fetch_all($student_data, MYSQLI_ASSOC);

        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }
        
    if (isset($_POST['action']) && $_POST['action'] == "update") {
        $id_alumno = htmlspecialchars(trim($_POST['id_alumno']), ENT_QUOTES, 'UTF-8'); 
        $matricula = htmlspecialchars(trim($_POST['matricula']), ENT_QUOTES, 'UTF-8'); 
        $nombre_alumno = htmlspecialchars(trim($_POST['nombre_alumno']), ENT_QUOTES, 'UTF-8'); 
        $semestre = htmlspecialchars(trim($_POST['semestre']), ENT_QUOTES, 'UTF-8'); 
        $estado_alumno = htmlspecialchars(trim($_POST['estado_alumno']), ENT_QUOTES, 'UTF-8'); 

        $query_student_update = "UPDATE alumnos SET matricula = $matricula, nombre_alumno  = '$nombre_alumno', semestre = $semestre, estado_alumno = '$estado_alumno' WHERE id_alumno = $id_alumno";
        $result_student_update = mysqli_query($conn, $query_student_update);
    
        if ($result_student_update) echo "Datos del alumn@ actualizados!";
    }

    if (isset($_POST['delete_id'])) {
        $id_alumno = $_POST['delete_id'];
                
        $query_student_delete = "DELETE FROM alumnos WHERE id_alumno = $id_alumno";
        $result_student_delete = mysqli_query($conn, $query_student_delete);    

        if ($result_student_delete) echo "Alumn@ eliminado!";
    }

    if (isset($_POST['action_id'])) {
        $action_id = $_POST['action_id'];

        $action = $action_id == 1 ? "less" : "more";
        $semester = $action_id == 1 ? 1 : 6;
        $grade_students = $semester == 1 ? "1er" : "6to";

        $query_get_students = "SELECT COUNT(semestre) FROM alumnos WHERE semestre = $semester AND estado_alumno != 'Baja'";
        $result_get_students = mysqli_query($conn, $query_get_students);
        $total_students = mysqli_fetch_row($result_get_students)[0];

        if ($total_students > 0) {
            echo json_encode(["action" => $action, "msg" => "Este cambio dará de baja a $total_students alumnos de $grade_students semestre.\n¿Desea continuar?"], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(["action" => $action, "msg" => "Este cambio modificará el semestre de todos los registros (menos los dados de baja).\n¿Desea continuar?"], JSON_UNESCAPED_UNICODE);
        }      
    }

    if (isset($_POST['action_change_semester'])) {
        $action = $_POST['action_change_semester'];

        if ($action == "more") {
            $query_withdraw_students = "UPDATE alumnos SET estado_alumno = 'Baja' WHERE semestre = 6";
            $query_update_students = "UPDATE alumnos SET semestre = semestre + 1 WHERE estado_alumno != 'Baja'";
        } else {
            $query_withdraw_students = "UPDATE alumnos SET estado_alumno = 'Baja' WHERE semestre = 1";
            $query_update_students = "UPDATE alumnos SET semestre = semestre - 1 WHERE estado_alumno != 'Baja'";
        }

        $result_withdraw_students = mysqli_query($conn, $query_withdraw_students);
        $result_update_students = mysqli_query($conn, $query_update_students);

        if ($result_update_students && $result_withdraw_students) echo "Registros actualizados!";
    }
}

mysqli_close($conn);
?>