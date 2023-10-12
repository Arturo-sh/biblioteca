<?php
session_start();
require_once "../database.php";

if (isset($_POST['btn_insert'])) {
    $id_alumno = htmlspecialchars(trim($_POST['id_alumno']), ENT_QUOTES, 'UTF-8');
    $id_libro = htmlspecialchars(trim($_POST['id_libro']), ENT_QUOTES, 'UTF-8');
    $unidades_prestamo = htmlspecialchars(trim($_POST['unidades_prestamo']), ENT_QUOTES, 'UTF-8');
    $fecha_entrega = $_POST['fecha_entrega'];
    $id_usuario = $_SESSION['id_usuario'];

    $query_loan_insert = "INSERT INTO prestamos(id_prestamo, id_alumno, id_libro, unidades_prestamo, fecha_entrega, id_usuario) VALUES (NULL, $id_alumno, $id_libro, $unidades_prestamo, '$fecha_entrega', $id_usuario)";                
    $result_loan_insert = mysqli_query($conn, $query_loan_insert);

    $_SESSION['loan_insert'] = ["icon" => "error", "action" => "insertar"];

    if ($result_loan_insert) {
        $_SESSION['loan_insert'] = ["icon" => "success", "title" => "Préstamo registrado!"];
    }

    mysqli_close($conn);
    header("Location: ../../index.php?module=prestamos");
} 

if (isset($_POST['btn_update'])) {
    $id_prestamo = htmlspecialchars(trim($_POST['id_prestamo']), ENT_QUOTES, 'UTF-8');
    $id_alumno = htmlspecialchars(trim($_POST['id_alumno']), ENT_QUOTES, 'UTF-8');
    $id_libro = htmlspecialchars(trim($_POST['id_libro']), ENT_QUOTES, 'UTF-8');
    $unidades_prestamo = htmlspecialchars(trim($_POST['unidades_prestamo']), ENT_QUOTES, 'UTF-8');
    $fecha_entrega = $_POST['fecha_entrega'];

    $query_loan_update = "UPDATE prestamos SET id_alumno = $id_alumno, id_libro = $id_libro, unidades_prestamo = $unidades_prestamo, fecha_entrega = '$fecha_entrega' WHERE id_prestamo = $id_prestamo";                
    $result_loan_update = mysqli_query($conn, $query_loan_update);

    $_SESSION['loan_update'] = ["icon" => "error", "action" => "actualizar"];

    if ($result_loan_update) {
        $_SESSION['loan_update'] = ["icon" => "success", "title" => "Datos del préstamo actualizados!"];
    }

    mysqli_close($conn);
    header("Location: ../../index.php?module=prestamos");
}

if (isset($_POST['delete_id']) && $_SESSION['rol_usuario'] == "Admin") {
    $id_prestamo = $_POST['delete_id'];
    
    $loan_deleted = ["icon" => "error", "title" => "Ha ocurridó un error, inténtelo de nuevo!"];
    
    $query_loan_delete = "DELETE FROM prestamos WHERE id_prestamo = $id_prestamo";
    $result_loan_delete = mysqli_query($conn, $query_loan_delete);    
    mysqli_close($conn);

    if ($result_loan_delete) {
        $loan_deleted = ["icon" => "success", "title" => "Préstamo eliminado!"];
        echo json_encode($loan_deleted);
        return;
    }
}
?>