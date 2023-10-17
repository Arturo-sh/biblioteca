<?php
require_once "../database.php";

$query_get_loans = "SELECT p.id_prestamo, a.nombre_alumno, l.titulo_libro, p.unidades_prestamo, p.fecha_prestamo, p.fecha_entrega, u.nombre_usuario, p.estado_prestamo FROM prestamos AS p INNER JOIN alumnos AS a ON p.id_alumno = a.id_alumno INNER JOIN libros AS l ON p.id_libro = l.id_libro INNER JOIN usuarios AS u ON p.id_usuario = u.id_usuario";
$data_loans = mysqli_query($conn, $query_get_loans);

$data = mysqli_fetch_all($data_loans, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
?>