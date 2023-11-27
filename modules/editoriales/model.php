<?php
session_start();
if (!isset($_SESSION['id_usuario'])) exit;

require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['publishers_table'])) {
        $query_get_publishers = "SELECT * FROM editoriales";
        $publishers_data = mysqli_query($conn, $query_get_publishers);

        $data = mysqli_fetch_all($publishers_data, MYSQLI_ASSOC);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "insert") {
        $nombre_editorial = htmlspecialchars(trim($_POST['nombre_editorial']), ENT_QUOTES, 'UTF-8');
        $pais_editorial = htmlspecialchars(trim($_POST['pais_editorial']), ENT_QUOTES, 'UTF-8');

        $query_publisher_insert = "INSERT INTO editoriales(id_editorial, nombre_editorial, pais_editorial) VALUES(NULL, '$nombre_editorial', '$pais_editorial')";
        $result_publisher_insert = mysqli_query($conn, $query_publisher_insert);

        if ($result_publisher_insert) echo "Editorial registrada!";
    }

    if (isset($_POST['edit_id'])) {
        $id_editorial = $_POST['edit_id'];

        $query_publisher_data = "SELECT * FROM editoriales WHERE id_editorial = $id_editorial";
        $publisher_data = mysqli_query($conn, $query_publisher_data);
        $row = mysqli_fetch_all($publisher_data, MYSQLI_ASSOC);

        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {
        $id_editorial = htmlspecialchars(trim($_POST['id_editorial']), ENT_QUOTES, 'UTF-8');
        $nombre_editorial = htmlspecialchars(trim($_POST['nombre_editorial']), ENT_QUOTES, 'UTF-8');
        $pais_editorial = htmlspecialchars(trim($_POST['pais_editorial']), ENT_QUOTES, 'UTF-8');

        $query_publisher_update = "UPDATE editoriales SET nombre_editorial = '$nombre_editorial', pais_editorial = '$pais_editorial' WHERE id_editorial = $id_editorial";
        $result_publisher_update = mysqli_query($conn, $query_publisher_update);

        if ($result_publisher_update) echo "Datos de la editorial actualizados!";
    }

    if (isset($_POST['delete_id'])) {
        $id_editorial = $_POST['delete_id'];

        $query_publisher_delete = "DELETE FROM editoriales WHERE id_editorial = $id_editorial";
        $result_publisher_delete = mysqli_query($conn, $query_publisher_delete);

        if ($result_publisher_delete) echo "Editorial eliminada!";
    }
}

mysqli_close($conn);
