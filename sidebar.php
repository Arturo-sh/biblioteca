<?php

$home_active = "";
$loans_active = "";
$books_active = "";
$students_active = "";
$users_active = "";

if (!empty($_GET) && isset($_GET['module'])) {
    switch($_GET['module']){
      case 'home':
        $home_active = 'active'; break;
      case 'prestamos':
        $loans_active = 'active'; break;
      case 'libros':
        $books_active = 'active'; break;
      case 'alumnos':
        $students_active = 'active'; break;
      case 'usuarios':
        $users_active = 'active'; break;
    }
}

echo "
<li class='nav-item mb-3'>
    <a href='home' class='nav-link text-left btn btn-outline-secondary $home_active'>
      <i class='nav-icon fas fas fa-home'></i>
      <p>
        Inicio
      </p>
    </a>
</li>";

echo "
<li class='nav-item'>
    <a href='prestamos' class='nav-link text-left btn btn-outline-secondary $loans_active'>
      <i class='nav-icon fas fas fa-edit'></i>
      <p>
        Préstamos
      </p>
    </a>
</li>";

echo "
<li class='nav-item'>
  <a href='libros' class='nav-link text-left btn btn-outline-secondary $books_active'>
    <i class='nav-icon fas fas fa-book'></i>
    <p>
      Libros
    </p>
  </a>
</li>";

echo "
<li class='nav-item'>
  <a href='alumnos' class='nav-link text-left btn btn-outline-secondary $students_active'>
    <i class='nav-icon fas fas fa-users'></i>
    <p>
      Alumnos
    </p>
  </a>
</li>";

echo "
<li class='nav-item'>
  <a href='usuarios' class='nav-link text-left btn btn-outline-secondary $users_active'>
    <i class='nav-icon fas fas fa-user'></i>
    <p>
      Usuarios
    </p>
  </a>
</li>";

echo "
<li class='nav-item mt-3'>
  <a href='logout.php' class='nav-link bg-danger'>
    <i class='nav-icon fas fa-power-off'></i>
    <p>
      Cerrar sesión
    </p>
  </a>
</li>";
?>