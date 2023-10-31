<?php
session_start();
require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['edit_id'])) {
        $id_transaccion = $_POST['edit_id'];
        
        $query_transaction_data = "SELECT t.id_transaccion, a.nombre_alumno, u.nombre_usuario, t.fecha_prestamo, t.fecha_entrega, t.estado_prestamo FROM transaccion_prestamo AS t INNER JOIN prestamos AS p ON t.id_transaccion = p.id_transaccion INNER JOIN alumnos AS a ON t.id_alumno = a.id_alumno INNER JOIN usuarios AS u ON t.id_usuario = u.id_usuario WHERE t.id_transaccion = $id_transaccion";
        $transaction_data = mysqli_query($conn, $query_transaction_data);
        $row = mysqli_fetch_all($transaction_data, MYSQLI_ASSOC);

        $query_books_data = "SELECT l.titulo_libro, p.unidades_prestamo FROM prestamos AS p INNER JOIN libros AS l ON p.id_libro = l.id_libro WHERE id_transaccion = $id_transaccion";
        $books_data = mysqli_query($conn, $query_books_data);
        $row_books = mysqli_fetch_all($books_data, MYSQLI_ASSOC);
        
        // Combinar los resultados en un solo arreglo
        $resultado_combinado = array("transaccion_data" => $row, "libros_data" => $row_books);

        // Codificar como JSON
        echo json_encode($resultado_combinado, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {
        $id_transaccion = $_POST['update_id'];
        // $estado_prestamo = htmlspecialchars(trim($_POST['estado_prestamo']), ENT_QUOTES, 'UTF-8');

        $query_transaction_update = "UPDATE transaccion_prestamo SET estado_prestamo = 'Entregado' WHERE id_transaccion = $id_transaccion";                
        $result_transaction_update = mysqli_query($conn, $query_transaction_update);
        
        if ($result_transaction_update) echo "Recepción exitosa!";
    }

    if (isset($_POST['delete_id'])) {
        $id_transaccion = $_POST['delete_id'];
        
        $query_transaction_delete = "DELETE FROM transaccion_prestamo WHERE id_transaccion = $id_transaccion";
        $result_transaction_delete = mysqli_query($conn, $query_transaction_delete);    
        
        if ($result_transaction_delete) echo "Préstamo eliminado!";
    }
}

mysqli_close($conn);
?>