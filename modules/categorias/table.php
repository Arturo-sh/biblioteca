<?php
require_once "../database.php";

if (isset($_POST['categories_table'])) {
    $query_get_categories = "SELECT * FROM categorias";
    $categories_data = mysqli_query($conn, $query_get_categories);

    $data = mysqli_fetch_all($categories_data, MYSQLI_ASSOC);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

mysqli_close($conn);
?>