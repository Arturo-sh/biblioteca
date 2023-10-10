<?php 
session_start(); 

if (!isset($_SESSION['id_usuario'])) {
  header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblioteca 24 de febrero</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
 
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
  <!-- Styles for DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
  
   <!-- Theme style -->
   <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center dark-mode">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?module=home" class="nav-link">Inicio</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">1</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">1 Notificación</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> Entrega de libro
            <span class="float-right text-muted text-sm">2 dias</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">Ver todas las notificaciones</a>
        </div>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">TEBAEV 24</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- Logo default -->
          <img src="dist/img/user-default.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <!-- Aqui va la inclusion del archivo php que trae el nombre de usuario -->
          <a href="#" class="d-block"><?php echo $_SESSION['nombre_usuario']; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php require_once "sidebar.php"; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php require_once "content.php"; ?>
  </div>
  <!-- /.content-wrapper -->
  
  <!-- Main-footer -->
  <footer class="main-footer text-center">
    <strong>Copyright &copy; <?php echo date('Y'); ?> - <a href="#">Telebachillerato 24 de febrero</a>.</strong>
    Todos los derechos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
  <!-- ./main-footer -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
</script>

<!-- InputMask -->
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>

<script>
  $('[data-mask]').inputmask()
</script>

<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      buttons: [{
        extend: 'collection',
        text: 'Exportar',
        buttons: [
          {
            extend: 'pdf',
            text: "Generar PDF",
            pageSize: 'LEGAL'
          },
          {
            extend: 'excel',
            text: 'Generar Excel'
          },
          {
            extend: 'print',
            text: "Imprimir"
          }
        ]
      },
      {
        extend: 'colvis',
        text: 'Visor de columnas',
      }],
      pageLength: 5,
      language: {
        "emptyTable": "No hay registros",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ resultados",
        "infoEmpty": "Mostrando 0 a 0 de 0 resultados",
        "infoFiltered": "(Filtrado de _MAX_ entradas totales)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ resultados",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
          "first": "Primero",
          "last": "Ultimo",
          "next": "Siguiente",
          "previous": "Anterior"
        }
      }
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>

<!-- Toast (SweetAlert2) -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>

<?php
  function show_action_alert($data) {
    $icon = $data['icon'];
    $title = $data['title'];

    if ($data['icon'] == "error") {
      $icon = "error";
      $action = $data['action'];
      $title = "Ha ocurrido un error al $action el registro, intentelo de nuevo!";
    }

    echo "
      <script>
        Swal.fire({
          icon: '$icon',
          title: '$title',
          showConfirmButton: false,
          timer: 2000
        });
      </script>";      
  }

  function show_delete_alert($data) {
    $id_registro = $data['id_registro'];
    $url_confirmed = $data['url_confirmed'];
  
    echo "
    <script>
    Swal.fire({
        title: 'Seguro de eliminar el registro $id_registro?',
        text: 'Esto no se puede revertir!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, continuar!',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '$url_confirmed';
        }
      })
    </script>";
  }

  // Alerta de confirmación de eliminación
  if (isset($_SESSION['confirm_delete'])) {
    show_delete_alert($_SESSION['confirm_delete']);
    unset($_SESSION['confirm_delete']);
  }

  // Alertas para la Inserción/Actualización/Eliminación de alumnos
  if (isset($_SESSION['student_insert'])) { 
    show_action_alert($_SESSION['student_insert']);
    unset($_SESSION['student_insert']);
  }

  if (isset($_SESSION['student_update'])) { 
    show_action_alert($_SESSION['student_update']);
    unset($_SESSION['student_update']);
  }

  if (isset($_SESSION['student_deleted'])) { 
    show_action_alert($_SESSION['student_deleted']);
    unset($_SESSION['student_deleted']);
  }

  // Alertas para la Inserción/Actualización/Eliminación de usuarios
  if (isset($_SESSION['user_insert'])) { 
    show_action_alert($_SESSION['user_insert']);
    unset($_SESSION['user_insert']);
  }

  if (isset($_SESSION['user_update'])) { 
    show_action_alert($_SESSION['user_update']);
    unset($_SESSION['user_update']);
  }

  if (isset($_SESSION['user_deleted'])) { 
    show_action_alert($_SESSION['user_deleted']);
    unset($_SESSION['user_deleted']);
  }

  // Alertas para la Inserción/Actualización/Eliminación de libros
  if (isset($_SESSION['book_insert'])) { 
    show_action_alert($_SESSION['book_insert']);
    unset($_SESSION['book_insert']);
  }

  if (isset($_SESSION['book_update'])) { 
    show_action_alert($_SESSION['book_update']);
    unset($_SESSION['book_update']);
  }

  if (isset($_SESSION['book_deleted'])) { 
    show_action_alert($_SESSION['book_deleted']);
    unset($_SESSION['book_deleted']);
  }

  // Alertas para la Inserción/Actualización/Eliminación de préstamos
  if (isset($_SESSION['loan_insert'])) { 
    show_action_alert($_SESSION['loan_insert']);
    unset($_SESSION['loan_insert']);
  }

  if (isset($_SESSION['loan_update'])) { 
    show_action_alert($_SESSION['loan_update']);
    unset($_SESSION['loan_update']);
  }

  if (isset($_SESSION['loan_deleted'])) { 
    show_action_alert($_SESSION['loan_deleted']);
    unset($_SESSION['loan_deleted']);
  }
?>

</body>
</html>