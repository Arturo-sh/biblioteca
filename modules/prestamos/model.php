<?php
session_start();
require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
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
?>