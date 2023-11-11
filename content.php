<?php
$modules = [
    "inicio" => "modules/inicio/view.php",
    "prestamos" => "modules/prestamos/view.php",
    "libros" => "modules/libros/view.php",
    "editoriales" => "modules/editoriales/view.php",
    "categorias" => "modules/categorias/view.php",
    "alumnos" => "modules/alumnos/view.php",
    "usuarios" => "modules/usuarios/view.php"
];

if (empty($_GET) || !isset($_GET['module'])) {
    $module = "inicio";
} else { 
    $module = $_GET['module'];
}

$_SESSION['module_redirect'] = $module;

if (array_key_exists($module, $modules)) {
    $load_module = $modules[$module];
    include_once "$load_module";
} else {
    include_once "error404.php";
}
?>