<?php
session_start();
if (!isset($_SESSION['id_usuario'])) header("Location: iniciar_sesion");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Biblioteca 24 de febrero</title>

  <!-- CSS files -->
  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
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
  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="dist/css/bootstrap.min.css">
  <!-- Suggestions search books -->
  <link rel="stylesheet" href="dist/css/suggestions.css">
  <!-- Responsive DataTables for mobile devices -->
  <link rel="stylesheet" href="dist/css/responsive_datatable.css">

  <!-- JS files -->
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- Select2 -->
  <script src="plugins/select2/js/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Toast (SweetAlert2) -->
  <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
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
  <!-- Service Worker -->
  <link rel="manifest" href="dist/js/manifest.json">
  <link rel="manifest" href="dist/js/index.js">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Wrapper -->
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
          <a href="inicio" class="nav-link">Inicio</a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
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
      <a href="#" class="brand-link" style="text-decoration: none;">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">TEBAEV 24</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <!-- <div class="image"> -->
          <!-- Logo default -->
          <!-- <img src="dist/img/user-default.png" class="img-circle elevation-2" alt="User Image"> -->
          <!-- </div> -->
          <div class="info">
            <!-- Aqui va la inclusion del archivo php que trae el nombre de usuario -->
            <a href="#" class="d-block" style="text-decoration: none;"><i class='fa fas fa-user mr-2'></i> <?php echo $_SESSION['nombre_usuario']; ?></a>
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
    <!-- /. main sidebar content-->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php require_once "content.php"; ?>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main-footer -->
    <footer class="main-footer text-center">
      <strong>Copyright &copy; <?php echo date('Y'); ?> - <a href="#" style="text-decoration: none;">Telebachillerato 24 de febrero</a>.</strong>
      Todos los derechos reservados.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>
    <!-- ./main-footer -->

  </div>
  <!-- ./wrapper -->

  <!-- Initialization elements -->
  <script>
    //Initialize Jquery UI
    $.widget.bridge('uibutton', $.ui.button);

    //Initialize inputMask Elements
    $('[data-mask]').inputmask();

    // Función limpiar para el formulario de usuarios.
    function resetForm() {
      $("#form")[0].reset();
      $(".estatus").attr("disabled", true);
      $(".image-field").attr("hidden", true);
      $(".btn-next").attr("action", "insert");
      $(".btn-next").attr("disabled", true);
      $(".btn-next").text("Guardar");
    }

    //Initialize Select2 Elements
    // $('.select2').select2();

    //Initialize bsCustomFileInput Elements
    // bsCustomFileInput.init();
  </script>

</body>

</html>