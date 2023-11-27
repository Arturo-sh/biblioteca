<?php
session_start();
if (!isset($_SESSION['id_usuario'])) exit;

require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['transactions_table'])) {
        $query_get_loans = "SELECT t.id_transaccion, a.nombre_alumno, u.nombre_usuario, DATE_FORMAT(t.fecha_prestamo, '%a. %d de %b. de %Y a las %r') AS fecha_prestamo, DATE_FORMAT(STR_TO_DATE(t.fecha_entrega, '%Y-%m-%d'), '%a. %d de %b. de %Y') AS fecha_entrega, t.estado_prestamo FROM transaccion_prestamo AS t INNER JOIN alumnos AS a ON t.id_alumno = a.id_alumno INNER JOIN usuarios AS u ON t.id_usuario = u.id_usuario";
        $data_loans = mysqli_query($conn, $query_get_loans);
        $data = mysqli_fetch_all($data_loans, MYSQLI_ASSOC);

        foreach ($data as $key => $value) {
            $id_transaccion = $value['id_transaccion'];

            $query_books_data = "SELECT l.titulo_libro, p.unidades_prestamo FROM prestamos AS p INNER JOIN libros AS l ON p.id_libro = l.id_libro WHERE id_transaccion = $id_transaccion";
            $books_data = mysqli_query($conn, $query_books_data);
            $row_books = mysqli_fetch_all($books_data, MYSQLI_ASSOC);

            $data[$key]["libro_prestamo"] = $row_books;
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {
        $id_transaccion = $_POST['update_id'];

        $query_verify_state = "SELECT estado_prestamo FROM transaccion_prestamo WHERE id_transaccion = $id_transaccion";
        $result_verify_state = mysqli_query($conn, $query_verify_state);
        $state = mysqli_fetch_assoc($result_verify_state);

        if ($state['estado_prestamo'] == "Entregado") {
            $query_transaction_update = "UPDATE transaccion_prestamo SET estado_prestamo = 'Pendiente' WHERE id_transaccion = $id_transaccion";
        } else {
            $query_transaction_update = "UPDATE transaccion_prestamo SET estado_prestamo = 'Entregado' WHERE id_transaccion = $id_transaccion";
        }

        $result_transaction_update = mysqli_query($conn, $query_transaction_update);
        if ($result_transaction_update) echo "Cambio de estado exitoso!";
    }

    if (isset($_POST['delete_id'])) {
        $id_transaccion = $_POST['delete_id'];

        $query_transaction_delete = "DELETE FROM transaccion_prestamo WHERE id_transaccion = $id_transaccion";
        $result_transaction_delete = mysqli_query($conn, $query_transaction_delete);

        if ($result_transaction_delete) echo "Préstamo eliminado!";
    }
}

mysqli_close($conn);
