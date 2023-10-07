<?php

$modules = [
    "home" => "modules/home/view.php",
    "prestamos" => "modules/prestamos/view.php",
    "libros" => "modules/libros/view.php",
    "alumnos" => "modules/alumnos/view.php",
    "usuarios" => "modules/usuarios/view.php"
];

if (empty($_GET) || !isset($_GET['module'])) {
    $module = "home";
} else { 
    $module = $_GET['module'];
}

if (array_key_exists($module, $modules)) {
    $load_module = $modules[$module];
    include_once "$load_module";
} else {
    include_once "error404.php";
}

?>