<?php
session_start();
require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['action']) && $_POST['action'] == "insert") {
        $id_alumno = htmlspecialchars(trim($_POST['id_alumno']), ENT_QUOTES, 'UTF-8');
        $id_libro = htmlspecialchars(trim($_POST['id_libro']), ENT_QUOTES, 'UTF-8');
        $unidades_prestamo = htmlspecialchars(trim($_POST['unidades_prestamo']), ENT_QUOTES, 'UTF-8');
        $fecha_entrega = $_POST['fecha_entrega'];
        $id_usuario = $_SESSION['id_usuario'];

        $query_loan_insert = "INSERT INTO prestamos(id_prestamo, id_alumno, id_libro, unidades_prestamo, fecha_entrega, id_usuario) VALUES (NULL, $id_alumno, $id_libro, $unidades_prestamo, '$fecha_entrega', $id_usuario)";                
        $result_loan_insert = mysqli_query($conn, $query_loan_insert);

        if ($result_loan_insert) {
            echo "Préstamo registrado!";
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
        $id_prestamo = $_POST['delete_id'];
        
        $query_loan_delete = "DELETE FROM prestamos WHERE id_prestamo = $id_prestamo";
        $result_loan_delete = mysqli_query($conn, $query_loan_delete);    
        
        if ($result_loan_delete) {
            echo "Libro entregado!";
        }
    }
}

mysqli_close($conn);
?>