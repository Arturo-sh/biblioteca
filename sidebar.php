<?php
$home_active = '';
$loans_active = '';
$books_active = '';
$publishers_active = '';
$categories_active = '';
$students_active = '';
$users_active = '';
$menu_open = '';
$book_menu = '';

if (!empty($_GET) && isset($_GET['module'])) {
    switch($_GET['module']){
      case 'inicio':
        $home_active = 'active'; break;
      case 'prestamos':
        $loans_active = 'active'; break;
      case 'libros':
        $books_active = 'active'; 
        $book_menu = 'active';
        $menu_open = 'menu-open';
        break;
      case 'editoriales':
        $publishers_active = 'active';
        $book_menu = 'active';
        $menu_open = 'menu-open';
        break;
      case 'categorias':
        $categories_active = 'active';
        $book_menu = 'active';
        $menu_open = 'menu-open';
        break;
      case 'alumnos':
        $students_active = 'active'; break;
      case 'usuarios':
        $users_active = 'active'; break;
    }
}

echo "
<li class='nav-item mb-3'>
    <a href='inicio' class='nav-link text-left btn btn-outline-secondary $home_active'>
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
<li class='nav-item $menu_open'>
  <a href='#' class='nav-link $book_menu'>
    <i class='nav-icon fas fas fa-book'></i>
    <p>
      Libros
      <i class='fas fa-angle-left right'></i>
    </p>
  </a>
  <ul class='nav nav-treeview'>
    <li class='nav-item'>
      <a href='libros' class='nav-link $books_active'>
        <i class='far fa-circle nav-icon'></i>
        <p>Inventario</p>
      </a>
    </li>
    <li class='nav-item'>
      <a href='editoriales' class='nav-link $publishers_active'>
        <i class='far fa-circle nav-icon'></i>
        <p>Editoriales</p>
      </a>
    </li>
    <li class='nav-item'>
      <a href='categorias' class='nav-link $categories_active'>
        <i class='far fa-circle nav-icon'></i>
        <p>Categorías</p>
      </a>
    </li>
  </ul>
</li>";

echo "
<li class='nav-item'>
  <a href='alumnos' class='nav-link text-left btn btn-outline-secondary $students_active'>
    <i class='nav-icon fas fas fa-graduation-cap'></i>
    <p>
      Alumnos
    </p>
  </a>
</li>";

echo "
<li class='nav-item'>
  <a href='usuarios' class='nav-link text-left btn btn-outline-secondary $users_active'>
    <i class='nav-icon fas fas fa-users'></i>
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