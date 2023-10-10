<?php
session_start();
require_once "../database.php";

if ($_GET['action'] == "confirm_delete" && $_SESSION['rol_usuario'] == "Admin") {
    $id_libro = $_GET['id'];
    $_SESSION['confirm_delete'] = ['id_registro' => "$id_libro", "url_confirmed" => "modules/libros/delete.php?action=delete&id=$id_libro"];
}

if ($_GET['action'] == "delete" && $_SESSION['rol_usuario'] == "Admin") {
    $id_libro = $_GET['id'];

    $query_book_delete = "DELETE FROM libros WHERE id_libro = $id_libro";    
    $result_book_delete = mysqli_query($conn, $query_book_delete);

    $_SESSION['book_deleted'] = ["icon" => "error", "action" => "eliminar"];

    if ($result_loan_delete) {
        $_SESSION['book_deleted'] = ["icon" => "success", "title" => "Libro eliminado!"];
    }
}

mysqli_close($conn);
header("Location: ../../index.php?module=libros");
?>