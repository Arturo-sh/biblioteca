<?php
session_start();
require_once "../database.php";

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

mysqli_close($conn);
