<?php
require_once "../database.php";

$query_get_loans = "SELECT t.id_transaccion, a.nombre_alumno, u.nombre_usuario, t.fecha_prestamo, t.fecha_entrega, t.estado_prestamo FROM transaccion_prestamo AS t INNER JOIN alumnos AS a ON t.id_alumno = a.id_alumno INNER JOIN usuarios AS u ON t.id_usuario = u.id_usuario  ORDER BY estado_prestamo ASC";
$data_loans = mysqli_query($conn, $query_get_loans);
$data = mysqli_fetch_all($data_loans, MYSQLI_ASSOC);

foreach($data as $key => $value) {
    $id_transaccion = $value['id_transaccion'];

    $query_books_data = "SELECT l.titulo_libro, p.unidades_prestamo FROM prestamos AS p INNER JOIN libros AS l ON p.id_libro = l.id_libro WHERE id_transaccion = $id_transaccion";
    $books_data = mysqli_query($conn, $query_books_data);
    $row_books = mysqli_fetch_all($books_data, MYSQLI_ASSOC);

    $data[$key]["libro_prestamo"] = $row_books;
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
?>