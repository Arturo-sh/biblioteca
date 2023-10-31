<?php
// Obtenemos la sesión actual
session_start();

// Destruimos la sesión obtenida
session_destroy();

// Redireccionamiento al inicio de sesión
header("Location: iniciar_sesion");
?>