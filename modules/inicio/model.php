<?php
session_start();
require_once "../database.php";

if (isset($_POST['students_select'])) {
    $html = "<option value='0' selected disabled>Selecciona un alumno</option>";

    $query = "SELECT id_alumno, matricula, nombre_alumno FROM alumnos WHERE estado_alumno = 'Activo'";
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

if (isset($_POST['cards_info'])) {
    $query_get_loans = "SELECT * FROM transaccion_prestamo WHERE estado_prestamo = 'Pendiente'";
    $result_get_loans = mysqli_query($conn, $query_get_loans);

    $query_get_books = "SELECT * FROM libros WHERE estado_libro = 'Activo'";
    $result_get_books = mysqli_query($conn, $query_get_books);

    $query_get_publishers = "SELECT * FROM editoriales";
    $result_get_publishers = mysqli_query($conn, $query_get_publishers);

    $query_get_categories = "SELECT * FROM categorias";
    $result_get_categories = mysqli_query($conn, $query_get_categories);

    $query_get_students = "SELECT * FROM alumnos WHERE estado_alumno = 'Activo'";
    $result_get_students = mysqli_query($conn, $query_get_students);

    $query_get_admins = "SELECT * FROM usuarios WHERE estado_usuario = 'Activo'";
    $result_get_admins = mysqli_query($conn, $query_get_admins);

    $arr = [
        "card_prestamos" => mysqli_num_rows($result_get_loans),
        "card_libros" => mysqli_num_rows($result_get_books),
        "card_editoriales" => mysqli_num_rows($result_get_publishers),
        "card_categorias" => mysqli_num_rows($result_get_categories),
        "card_alumnos" => mysqli_num_rows($result_get_students),
        "card_usuarios" => mysqli_num_rows($result_get_admins)
    ];

    echo json_encode($arr);
}

if (isset($_POST['autocomplete'])) {
    $html = '';
    $key = $_POST['key'];

    if ($key == "") return $html = "";

    $query_get_books = "SELECT id_libro, titulo_libro FROM libros WHERE titulo_libro LIKE  '%$key%' AND estado_libro = 'Activo'";
    $result_get_books = mysqli_query($conn, $query_get_books);

    if (mysqli_num_rows($result_get_books) > 0) {
        while ($row = mysqli_fetch_assoc($result_get_books)) {
            $id_libro = $row['id_libro'];
            $titulo_libro = $row['titulo_libro'];

            $html .= "
            <div>
                <a class='suggest-element' id='$id_libro' titulo='$titulo_libro'>$titulo_libro</a>
            </div>";
        }
    }

    echo $html;
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
