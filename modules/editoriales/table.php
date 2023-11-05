<?php
require_once "../database.php";

if (isset($_POST['publishers_table'])) {
    $query_get_publishers = "SELECT * FROM editoriales";
    $publishers_data = mysqli_query($conn, $query_get_publishers);

    $data = mysqli_fetch_all($publishers_data, MYSQLI_ASSOC);

    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}

mysqli_close($conn);
?>