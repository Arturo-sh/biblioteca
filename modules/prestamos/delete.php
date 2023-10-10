<?php
session_start();
require_once "../database.php";

if ($_GET['action'] == "confirm_delete" && $_SESSION['rol_usuario'] == "Admin") {
    $id_prestamo = $_GET['id'];
    $_SESSION['confirm_delete'] = ['id_registro' => "$id_prestamo", "url_confirmed" => "modules/prestamos/delete.php?action=delete&id=$id_prestamo"];
}

if ($_GET['action'] == "delete" && $_SESSION['rol_usuario'] == "Admin") {
    $id_prestamo = $_GET['id'];

    $query_loan_delete = "DELETE FROM prestamos WHERE id_prestamo = $id_prestamo";    
    $result_loan_delete = mysqli_query($conn, $query_loan_delete);

    $_SESSION['loan_deleted'] = ["icon" => "error", "action" => "eliminar"];

    if ($result_loan_delete) {
        $_SESSION['loan_deleted'] = ["icon" => "success", "title" => "Préstamo eliminado!"];
    }
}

mysqli_close($conn);
header("Location: ../../index.php?module=prestamos");
?>