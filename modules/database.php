<?php

define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DBNAME", "biblioteca");

$conn = mysqli_connect(HOST, USER, PASS, DBNAME);

if (!$conn) {
    die('Error de conexion con la base de datos!');
}

?>