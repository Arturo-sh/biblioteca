<?php

// Obtenemos la sesión actual
session_start();

// Destruimos la sesión obtenida
session_destroy();

header("Location: login.php");

?>