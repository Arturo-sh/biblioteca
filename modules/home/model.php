<?php
session_start();
require_once "../database.php";

if (isset($_POST['students'])){
    $html = '';

    $query = "SELECT id_alumno, matricula, nombre_alumno FROM alumnos";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id_alumno = $row['id_alumno'];              
            $matricula = $row['matricula'];              
            $nombre_alumno = $row['nombre_alumno'];

            $html .= "
            <option value='$id_alumno'>$matricula - $nombre_alumno</option>";
        }
    }

    echo $html;
}

if (isset($_POST['cards_info'])){
    $query_get_loans = "SELECT * FROM transaccion_prestamo";
    $result_get_loans = mysqli_query($conn, $query_get_loans);

    $query_get_books = "SELECT * FROM libros";
    $result_get_books = mysqli_query($conn, $query_get_books);

    $query_get_students = "SELECT * FROM alumnos";
    $result_get_students = mysqli_query($conn, $query_get_students);

    $query_get_admins = "SELECT * FROM usuarios";
    $result_get_admins = mysqli_query($conn, $query_get_admins);

    $arr = [
        "card_prestamos" => mysqli_num_rows($result_get_loans),
        "card_libros" => mysqli_num_rows($result_get_books),
        "card_alumnos" => mysqli_num_rows($result_get_students),
        "card_usuarios" => mysqli_num_rows($result_get_admins)
    ];
    
    echo json_encode($arr);
}

if (isset($_POST['prestamo'])) {
    $data = json_decode($_POST['prestamo'], true);

    // $id_alumno = htmlspecialchars(trim($_POST['id_alumno']), ENT_QUOTES, 'UTF-8');
    $id_alumno = $data[count($data) - 1]['id_alumno'];
    $id_usuario = $_SESSION['id_usuario'];
    $fecha_entrega = $data[count($data) - 2]['fecha_entrega'];
    $cantidad_libros_prestados = count($data) - 2;

    mysqli_begin_transaction($conn);

    try {
        // Se hace el insert en la tabla transaccion
        $query_transaction_insert = "INSERT INTO transaccion_prestamo(id_transaccion, id_alumno, id_usuario, fecha_entrega) VALUES (NULL, $id_alumno, $id_usuario, '$fecha_entrega')";                
        $result_transaction_insert = mysqli_query($conn, $query_transaction_insert);

        // Se obtiene el id de la ultima transaccion
        $id_transaccion = mysqli_insert_id($conn);

        for ($i = 0; $i < $cantidad_libros_prestados; $i++) {
            $id_libro = $data[$i]['id_libro'];
            $unidades_prestamo = $data[$i]['unidades_prestamo'];
            
            // Comienza el insert mediante un ciclo para insertar los libros prestados durante la transaccion
            $query_loans_insert = "INSERT INTO prestamos(id_prestamo, id_transaccion, id_libro, unidades_prestamo) VALUES (NULL, $id_transaccion, $id_libro, $unidades_prestamo)";                
            $result_loans_insert = mysqli_query($conn, $query_loans_insert);

            // Se actualiza la cantidad de stock de libros
            $query_stock_update = "UPDATE libros SET unidades_restantes = unidades_restantes - $unidades_prestamo WHERE id_libro = $id_libro";                
            $result_stock_update = mysqli_query($conn, $query_stock_update);
        }
        
        // Verifica si las inserciones fueron exitosas
        if (isset($result_loans_insert) && $result_loans_insert) echo "Préstamo registrado!";

        // Confirmar transacción
        mysqli_commit($conn);
        
    } catch (Exception $e) {
        // Ocurrió un error, realizar rollback
        mysqli_rollback($conn);
        echo "Error: " . $e->getMessage();
    }   
}

mysqli_close($conn);
?>