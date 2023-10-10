<?php
session_start();
require_once "../database.php";

if ($_GET['action'] == "confirm_delete" && $_SESSION['rol_usuario'] == "Admin") {
    $id_usuario = $_GET['id'];
    $_SESSION['confirm_delete'] = ['id_registro' => "$id_usuario", "url_confirmed" => "modules/usuarios/delete.php?action=delete&id=$id_usuario"];
}

if ($_GET['action'] == "delete" && $_SESSION['rol_usuario'] == "Admin") {
    $id_usuario = $_GET['id'];

    $query_user_delete = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";    
    $result_user_delete = mysqli_query($conn, $query_user_delete);

    $_SESSION['user_deleted'] = ["icon" => "error", "action" => "eliminar"];

    if ($result_user_delete) {
        $_SESSION['user_deleted'] = ["icon" => "success", "title" => "Usuario eliminado!"];
    }
}

mysqli_close($conn);
header("Location: ../../index.php?module=usuarios");
?>