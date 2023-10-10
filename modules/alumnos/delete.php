<?php
session_start();
require_once "../database.php";

if ($_GET['action'] == "confirm_delete" && $_SESSION['rol_usuario'] == "Admin") {
    $id_alumno = $_GET['id'];
    $_SESSION['confirm_delete'] = ['id_registro' => "$id_alumno", "url_confirmed" => "modules/alumnos/delete.php?action=delete&id=$id_alumno"];
}

if ($_GET['action'] == "delete" && $_SESSION['rol_usuario'] == "Admin") {
    $id_alumno = $_GET['id'];

    $query_student_delete = "DELETE FROM alumnos WHERE id_alumno = $id_alumno";    
    $result_student_delete = mysqli_query($conn, $query_student_delete);

    $_SESSION['student_deleted'] = ["icon" => "error", "action" => "eliminar"];

    if ($result_student_delete) {
        $_SESSION['student_deleted'] = ["icon" => "success", "title" => "Alumn@ eliminado!"];
    }
}

mysqli_close($conn);
header("Location: ../../index.php?module=alumnos");
?>