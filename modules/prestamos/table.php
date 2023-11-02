<?php
require_once "../database.php";

$query_get_loans = "SELECT t.id_transaccion, a.nombre_alumno, u.nombre_usuario, t.fecha_prestamo, t.fecha_entrega, t.estado_prestamo FROM transaccion_prestamo AS t INNER JOIN alumnos AS a ON t.id_alumno = a.id_alumno INNER JOIN usuarios AS u ON t.id_usuario = u.id_usuario  ORDER BY estado_prestamo ASC";
$data_loans = mysqli_query($conn, $query_get_loans);

$data = mysqli_fetch_all($data_loans, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
?>