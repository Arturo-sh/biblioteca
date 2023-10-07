<?php

include_once "modules/database.php";

$query_prestamos = "SELECT * FROM prestamos";
$sql_prestamos = mysqli_query($conn, $query_prestamos);

$query_libros = "SELECT * FROM libros";
$sql_libros = mysqli_query($conn, $query_libros);

$query_alumnos = "SELECT * FROM alumnos";
$sql_alumnos = mysqli_query($conn, $query_alumnos);

$query_administradores = "SELECT * FROM usuarios";
$sql_administradores = mysqli_query($conn, $query_administradores);

$_SESSION['cantidad_prestamos'] = mysqli_num_rows($sql_prestamos);
$_SESSION['cantidad_libros'] = mysqli_num_rows($sql_libros);
$_SESSION['cantidad_alumnos'] = mysqli_num_rows($sql_alumnos);
$_SESSION['cantidad_administradores'] = mysqli_num_rows($sql_administradores);

?>