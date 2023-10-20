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
        $id_prestamo = $_POST['edit_id'];
        
        $query_loan_data = "SELECT p.id_prestamo, a.id_alumno, a.nombre_alumno, l.id_libro, p.unidades_prestamo, p.fecha_entrega, p.estado_prestamo FROM prestamos AS p INNER JOIN alumnos AS a ON p.id_alumno = a.id_alumno INNER JOIN libros AS l ON p.id_libro = l.id_libro INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario WHERE id_prestamo = $id_prestamo";
        $loan_data = mysqli_query($conn, $query_loan_data);
        $row = mysqli_fetch_all($loan_data, MYSQLI_ASSOC);

        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {
        $id_prestamo = htmlspecialchars(trim($_POST['id_prestamo']), ENT_QUOTES, 'UTF-8');
        $id_alumno = htmlspecialchars(trim($_POST['id_alumno']), ENT_QUOTES, 'UTF-8');
        $id_libro = htmlspecialchars(trim($_POST['id_libro']), ENT_QUOTES, 'UTF-8');
        $unidades_prestamo = htmlspecialchars(trim($_POST['unidades_prestamo']), ENT_QUOTES, 'UTF-8');
        $estado_prestamo = htmlspecialchars(trim($_POST['estado_prestamo']), ENT_QUOTES, 'UTF-8');
        $fecha_entrega = $_POST['fecha_entrega'];

        $query_loan_update = "UPDATE prestamos SET id_alumno = $id_alumno, id_libro = $id_libro, unidades_prestamo = $unidades_prestamo, fecha_entrega = '$fecha_entrega', estado_prestamo = '$estado_prestamo' WHERE id_prestamo = $id_prestamo";                
        $result_loan_update = mysqli_query($conn, $query_loan_update);

        if ($result_loan_update) {
            echo "Préstamo actualizado!";
        }
    }

    if (isset($_POST['delete_id'])) {
        $id_transaccion = $_POST['delete_id'];
        
        $query_transaction_delete = "DELETE FROM transaccion_prestamo WHERE id_transaccion = $id_transaccion";
        $result_transaction_delete = mysqli_query($conn, $query_transaction_delete);    
        
        if ($result_transaction_delete) {
            echo "Devolución satisfactoria!";
        }
    }
}

mysqli_close($conn);
?>