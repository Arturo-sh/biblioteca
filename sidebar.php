<?php

$prestamos_active = "";
$libros_active = "";
$alumnos_active = "";
$usuarios_active = "";

if (!empty($_GET)) {
    if ($_GET['module'] == "prestamos") {
        $prestamos_active = "active";
    }
    elseif ($_GET['module'] == "libros") {
        $libros_active = "active";
    }
    elseif ($_GET['module'] == "alumnos") {
        $alumnos_active = "active";
    }
    elseif ($_GET['module'] == "usuarios") {
        $usuarios_active = "active";
    }
}

echo "
<li class='nav-item'>
    <a href='?module=prestamos' class='nav-link text-left btn btn-outline-secondary $prestamos_active'>
      <i class='nav-icon fas fas fa-edit'></i>
      <p>
        Préstamos
      </p>
    </a>
</li>";

echo "
<li class='nav-item'>
  <a href='?module=libros' class='nav-link text-left btn btn-outline-secondary $libros_active'>
    <i class='nav-icon fas fas fa-book'></i>
    <p>
      Libros
    </p>
  </a>
</li>";

echo "
<li class='nav-item'>
  <a href='?module=alumnos' class='nav-link text-left btn btn-outline-secondary $alumnos_active'>
    <i class='nav-icon fas fas fa-users'></i>
    <p>
      Alumnos
    </p>
  </a>
</li>";

echo "
<li class='nav-item'>
  <a href='?module=usuarios' class='nav-link text-left btn btn-outline-secondary $usuarios_active'>
    <i class='nav-icon fas fas fa-user'></i>
    <p>
      Usuarios
    </p>
  </a>
</li>";

echo "
<li class='nav-item mt-3'>
  <a href='pages/#' class='nav-link bg-info'>
    <i class='nav-icon fas fas fa-edit'></i>
    <p>
      Configurar perfil
      <!-- <span class='right badge badge-danger'>New</span> -->
    </p>
  </a>
</li>";

echo "
<li class='nav-item mt-1'>
  <a href='logout.php' class='nav-link bg-danger'>
    <i class='nav-icon fas fa-power-off'></i>
    <p>
      Cerrar sesión
    </p>
  </a>
</li>";

?>