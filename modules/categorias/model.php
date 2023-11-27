<?php
session_start();
if (!isset($_SESSION['id_usuario'])) exit;

require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['categories_table'])) {
        $query_get_categories = "SELECT * FROM categorias";
        $categories_data = mysqli_query($conn, $query_get_categories);

        $data = mysqli_fetch_all($categories_data, MYSQLI_ASSOC);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "insert") {
        $nombre_categoria = htmlspecialchars(trim($_POST['nombre_categoria']), ENT_QUOTES, 'UTF-8');
        $descripcion_categoria = htmlspecialchars(trim($_POST['descripcion_categoria']), ENT_QUOTES, 'UTF-8');

        $query_category_insert = "INSERT INTO categorias(id_categoria, nombre_categoria, descripcion_categoria) VALUES(NULL, '$nombre_categoria', '$descripcion_categoria')";
        $result_category_insert = mysqli_query($conn, $query_category_insert);

        if ($result_category_insert) echo "Categoría registrada!";
    }

    if (isset($_POST['edit_id'])) {
        $id_categoria = $_POST['edit_id'];

        $query_category_data = "SELECT * FROM categorias WHERE id_categoria = $id_categoria";
        $category_data = mysqli_query($conn, $query_category_data);
        $row = mysqli_fetch_all($category_data, MYSQLI_ASSOC);

        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {
        $id_categoria = htmlspecialchars(trim($_POST['id_categoria']), ENT_QUOTES, 'UTF-8');
        $nombre_categoria = htmlspecialchars(trim($_POST['nombre_categoria']), ENT_QUOTES, 'UTF-8');
        $descripcion_categoria = htmlspecialchars(trim($_POST['descripcion_categoria']), ENT_QUOTES, 'UTF-8');

        $query_category_update = "UPDATE categorias SET nombre_categoria = '$nombre_categoria', descripcion_categoria = '$descripcion_categoria' WHERE id_categoria = $id_categoria";
        $result_category_update = mysqli_query($conn, $query_category_update);

        if ($result_category_update) echo "Datos de categoría actualizados!";
    }

    if (isset($_POST['delete_id'])) {
        $id_categoria = $_POST['delete_id'];

        $query_category_delete = "DELETE FROM categorias WHERE id_categoria = $id_categoria";
        $result_category_delete = mysqli_query($conn, $query_category_delete);

        if ($result_category_delete) echo "Categoría eliminada!";
    }
}

mysqli_close($conn);
