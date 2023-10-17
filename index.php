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
<!-- Page specific script -->
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
<!-- Page specific script -->

<script>
  var table;
  
  $(document).ready(function () {
    table = $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "ordering": false, 
      pageLength: 5,
      buttons: [
        {
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
        }
      ],
      ajax: {
        url: "modules/usuarios/table.php",
        dataSrc: ""
      },
      columns: [
        { data: "id_usuario" },
        { data: "usuario" },
        { data: "nombre_usuario" },
        { data: "telefono_usuario" },
        { data: "correo_usuario" },
        { data: "creacion_cuenta" },
        { 
          data: "estado_usuario",
          render: function (data, type) {
            if (type === 'display') {
              let template = `
              <td class='text-center'>
                <span class='badge bg-danger'>${data}</span>
              </td>`;
 
              if (data == "Activo") {
                template = `
                <td class='text-center'>
                  <span class='badge bg-success'>${data}</span>
                </td>`;
              }

              return template;
            }
 
            return data;
          } 
        },
        {
          data: "usuario",
          render: function (data, type, row, meta) {
            if (type === 'display') {
              let template = `
              <button id='${row.id_usuario}' mod='usuarios' class='btn btn-sm btn-primary btn-edit' data-toggle='modal' data-target='#modal-default'>
                <i class='fas fa-pen'></i>
              </button>`;
 
              if (data != "Admin") {
                template = `
                <button id='${row.id_usuario}' mod='usuarios' class='btn btn-sm btn-primary btn-edit' data-toggle='modal' data-target='#modal-default'>
                  <i class='fas fa-pen'></i>
                </button>
                <button id='${row.id_usuario}' mod='usuarios' class='btn btn-sm btn-danger btn-delete'>
                  <i class='fas fa-trash'></i>
                </button>`;
              }

              return template;
            }

            return data;
          }
        }
      ],
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
    });
    // .buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

</script>

<!-- Extras datatables -->
<script src="dist/js/insert_update_register.js"></script>
<script src="dist/js/edit_register.js"></script>
<script src="dist/js/delete_register.js"></script>
<!-- <script src="dist/js/change_grade.js"></script> -->

<script>
  $("#form").submit(function(e){
    e.preventDefault();
  });
</script>

<!-- Mostrar las portadas en formulario -->
<script>
  $(document).on('click', '.btn-view', function() {
    var image_name = $(this).attr("image-name");
    $("#image-form").attr("src", "dist/portadas/" + image_name);
  });
</script>

</body>
</html>