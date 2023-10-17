<?php
require_once "../database.php";

$query_get_students = "SELECT * FROM alumnos";
$data_students = mysqli_query($conn, $query_get_students);

$data = mysqli_fetch_all($data_students, MYSQLI_ASSOC);

echo json_encode($data, JSON_UNESCAPED_UNICODE);
mysqli_close($conn);
?>