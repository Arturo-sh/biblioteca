<?php
session_start();
require_once "../database.php";

// function is_admin($id_usuario) {
//     require_once "../database.php";

//     $query_get_user = "SELECT rol_usuario FROM usuarios WHERE id_usuario = $id_usuario";
//     $result_get_user = mysqli_query($conn, $query_get_user);
//     $row = mysqli_fetch_assoc($result_get_user);
//     mysqli_close($conn);
    
//     $rol_usuario = $row['rol_usuario'];
//     if ($rol_usuario == "Admin") {
//         return true;
//     } else {
//         return false;
//     }
// }

if ($_GET['action'] == "confirm_delete" && $_SESSION['rol_usuario'] == "Admin") {
    $id_usuario = $_GET['id'];
    
    $query_get_user = "SELECT rol_usuario FROM usuarios WHERE id_usuario = $id_usuario";
    $result_get_user = mysqli_query($conn, $query_get_user);
    $row = mysqli_fetch_assoc($result_get_user);
    
    $rol_usuario = $row['rol_usuario'];
    if ($rol_usuario != "Admin") {
        $_SESSION['confirm_delete'] = ['id_registro' => "$id_usuario", "url_confirmed" => "modules/usuarios/delete.php?action=delete&id=$id_usuario"];
    }
}

if ($_GET['action'] == "delete" && $_SESSION['rol_usuario'] == "Admin") {
    $id_usuario = $_GET['id'];

    $query_get_user = "SELECT rol_usuario FROM usuarios WHERE id_usuario = $id_usuario";
    $result_get_user = mysqli_query($conn, $query_get_user);
    $row = mysqli_fetch_assoc($result_get_user);
    
    $rol_usuario = $row['rol_usuario'];
    
    $_SESSION['user_deleted'] = ["icon" => "error", "action" => "eliminar"];
    
    if ($rol_usuario != "Admin") {
        $query_user_delete = "DELETE FROM usuarios WHERE id_usuario = $id_usuario";    
        $result_user_delete = mysqli_query($conn, $query_user_delete);    
        
        if ($result_user_delete) {
            $_SESSION['user_deleted'] = ["icon" => "success", "title" => "Usuario eliminado!"];
        }
    }
}

mysqli_close($conn);
header("Location: ../../index.php?module=usuarios");
?>