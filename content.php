<?php

$modules = [
    "home" => "modules/home/view.php",
    "prestamos" => "modules/prestamos/view.php",
    "libros" => "modules/libros/view.php",
    "alumnos" => "modules/alumnos/view.php",
    "usuarios" => "modules/usuarios/view.php",
    "form_usuario" => "modules/usuarios/form.php",
    "form_alumno" => "modules/alumnos/form.php",
    "form_libro" => "modules/libros/form.php",
    "form_prestamo" => "modules/prestamos/form.php"
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