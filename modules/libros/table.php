<?php
require_once "../database.php";

$query_get_books = "SELECT l.id_libro, l.titulo_libro, e.nombre_editorial, c.nombre_categoria, l.unidades_totales, l.imagen_portada, l.descripcion, l.estado_libro FROM libros AS l INNER JOIN editoriales AS e ON l.id_editorial = e.id_editorial INNER JOIN categorias AS c ON l.id_categoria = c.id_categoria";
$data_books = mysqli_query($conn, $query_get_books);

$data = mysqli_fetch_all($data_books, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
?>