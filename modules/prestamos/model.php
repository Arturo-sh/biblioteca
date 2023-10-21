<?php
session_start();
require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['action']) && $_POST['action'] == "insert") {
        $id_alumno = htmlspecialchars(trim($_POST['id_alumno']), ENT_QUOTES, 'UTF-8');
        $id_usuario = $_SESSION['id_usuario'];
        $fecha_entrega = $_POST['fecha_entrega'];
        $id_libros = $_POST['id_libros'];

        mysqli_begin_transaction($conn);

        try {
            // Se hace el insert en la tabla transaccion
            $query_transaction_insert = "INSERT INTO transaccion_prestamo(id_transaccion, id_alumno, id_usuario, fecha_entrega) VALUES (NULL, $id_alumno, $id_usuario, '$fecha_entrega')";                
            $result_transaction_insert = mysqli_query($conn, $query_transaction_insert);

            // Se obtiene el id de la ultima transaccion
            $id_transaccion = mysqli_insert_id($conn);

            $libros = explode(",", $id_libros);
            $limite = count($libros);

            for ($i = 0; $i < $limite; $i++) {
                $id_libro = $libros[$i];
                
                // Comienza el insert mediante un ciclo para insertar los libros ocurridos durante la transaccion
                $query_loans_insert = "INSERT INTO prestamos(id_prestamo, id_transaccion, id_libro) VALUES (NULL, $id_transaccion, $id_libro)";                
                $result_loans_insert = mysqli_query($conn, $query_loans_insert);   
            }
            
            // Verifica si las inserciones fueron exitosas
            if ($result_loans_insert) {
                echo "Préstamo registrado!";
            }

            // Confirmar transacción
            mysqli_commit($conn);
            
        } catch (Exception $e) {
            // Ocurrió un error, realizar rollback
            mysqli_rollback($conn);
            echo "Error: " . $e->getMessage();
        }
    } 

    if (isset($_POST['edit_id'])) {
        $id_transaccion = $_POST['edit_id'];
        $id_transaccion = $_POST['edit_id'];
        
        $query_transaction_data = "SELECT t.id_transaccion, a.nombre_alumno, u.nombre_usuario, t.fecha_prestamo, t.fecha_entrega, t.estado_prestamo FROM transaccion_prestamo AS t INNER JOIN prestamos AS p ON t.id_transaccion = p.id_transaccion INNER JOIN alumnos AS a ON t.id_alumno = a.id_alumno INNER JOIN usuarios AS u ON t.id_usuario = u.id_usuario WHERE t.id_transaccion = $id_transaccion";
        $transaction_data = mysqli_query($conn, $query_transaction_data);
        $row = mysqli_fetch_all($transaction_data, MYSQLI_ASSOC);

        $query_books_data = "SELECT l.titulo_libro FROM prestamos AS p INNER JOIN libros AS l ON p.id_libro = l.id_libro WHERE id_transaccion = $id_transaccion ORDER BY titulo_libro ASC";
        $books_data = mysqli_query($conn, $query_books_data);
        $row_books = mysqli_fetch_all($books_data, MYSQLI_ASSOC);
        
        // Combinar los resultados en un solo arreglo
        $resultado_combinado = array("transaccion_data" => $row, "libros_data" => $row_books);

        // Codificar como JSON
        echo json_encode($resultado_combinado, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {
        $id_transaccion = $_POST['id_transaccion'];
        $id_transaccion = $_POST['id_transaccion'];
        $estado_prestamo = htmlspecialchars(trim($_POST['estado_prestamo']), ENT_QUOTES, 'UTF-8');
        // $fecha_entrega = $_POST['fecha_entrega']; // Pendiente para editar la fecha de los préstamos
        // $fecha_entrega = $_POST['fecha_entrega']; // Pendiente para editar la fecha de los préstamos

        $query_transaction_update = "UPDATE transaccion_prestamo SET estado_prestamo = '$estado_prestamo' WHERE id_transaccion = $id_transaccion";                
        $result_transaction_update = mysqli_query($conn, $query_transaction_update);
        
        if ($result_transaction_update) {
            echo "Recepción exitosa!";
        $query_transaction_update = "UPDATE transaccion_prestamo SET estado_prestamo = '$estado_prestamo' WHERE id_transaccion = $id_transaccion";                
        $result_transaction_update = mysqli_query($conn, $query_transaction_update);
        
        if ($result_transaction_update) {
            echo "Recepción exitosa!";
        }
    }

    if (isset($_POST['delete_id'])) {
        $id_transaccion = $_POST['delete_id'];
        
        $query_transaction_delete = "DELETE FROM transaccion_prestamo WHERE id_transaccion = $id_transaccion";
        $result_transaction_delete = mysqli_query($conn, $query_transaction_delete);    
        
        if ($result_transaction_delete) {
            echo "Préstamo eliminado!";
            echo "Préstamo eliminado!";
        }
    }
}

mysqli_close($conn);
?>