  
<?php

if ($_SESSION['rol_usuario'] != "Admin") {
    echo "<script> window.location.href = 'index.php?module=usuarios'; </script>";
}

if ($_GET['action'] == "insert") {
    echo "
    <!-- Content Header (Page header) -->
    <div class='content-header'>
    <div class='container-fluid'>
        <div class='row'>
        <div class='col-sm-6'>
            <h1 class='m-0'>Nuevo usuario</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class='content'>
        <div class='container-fluid'>
            <form method='POST' action='modules/usuarios/model.php'>
                <div class='card-body row'>
                <div class='form-group col-md-6'>
                    <label for='usuario'>Nombre de usuario</label>
                    <input type='text' class='form-control' id='usuario' name='usuario'>
                </div>
                <div class='form-group col-md-6'>
                    <label for='contrasenia'>Contraseña</label>
                    <input type='password' class='form-control' id='contrasenia' name='contrasenia'>
                </div>
                <div class='form-group col-md-6'>
                    <label for='nombre'>Nombre completo</label>
                    <input type='text' class='form-control' id='nombre' name='nombre'>
                </div>
                <div class='form-group col-md-6'>
                    <label for='telefono'>Teléfono</label>
                    <input type='telephone' class='form-control' id='telefono' name='telefono'>
                </div>
                <div class='form-group col-md-6'>
                    <label for='correo'>Correo</label>
                    <input type='email' class='form-control' id='correo' name='correo'>
                </div>
                </div>
                <!-- /.card-body -->

                <div class='text-center'>
                <a href='?module=usuarios' class='btn btn-outline-danger'>Cancelar</a>
                <button type='submit' class='btn btn-outline-success' name='btn_insert'>Guardar</button>
                </div>
            </form>
        </div>
    </section>";
} elseif ($_GET['action'] == "edit") {
    $id = $_GET['id'];

    require_once "modules/database.php";

    $query_user_data = "SELECT * FROM usuarios WHERE id_usuario = $id";
    $user_data = mysqli_query($conn, $query_user_data);
    $row = mysqli_fetch_array($user_data);

    $id_usuario = $row['id_usuario'];
    $usuario = $row['usuario'];
    $nombre = $row['nombre_usuario'];
    $telefono = $row['telefono_usuario'];
    $correo = $row['correo_usuario'];
    $estatus = $row['estado_usuario'];

    $activo = ""; $suspendido = "";

    $activo = $estatus == "Activo" ? "selected" : "";
    $suspendido = $estatus == "Suspendido" ? "selected" : "";

    echo "
    <!-- Content Header (Page header) -->
    <div class='content-header'>
    <div class='container-fluid'>
        <div class='row'>
        <div class='col-sm-6'>
            <h1 class='m-0'>Editar usuario</h1>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class='content'>
        <div class='container-fluid'>
            <form method='POST' action='modules/usuarios/model.php'>
                <div class='card-body row'>
                <div class='form-group col-md-6'>
                    <label for='usuario'>Nombre de usuario</label>
                    <input type='hidden' class='form-control' id='id_usuario' name='id_usuario' value='$id_usuario'>
                    <input type='text' class='form-control' id='usuario' name='usuario' value='$usuario'>
                </div>
                <div class='form-group col-md-6'>
                    <label for='contrasenia'>Nueva contraseña</label>
                    <input type='password' class='form-control' id='contrasenia' name='contrasenia'>
                </div>
                <div class='form-group col-md-6'>
                    <label for='nombre'>Nombre completo</label>
                    <input type='text' class='form-control' id='nombre' name='nombre' value='$nombre'>
                </div>
                <div class='form-group col-md-6'>
                    <label for='telefono'>Teléfono</label>
                    <input type='telephone' class='form-control' id='telefono' name='telefono' value='$telefono'>
                </div>
                <div class='form-group col-md-6'>
                    <label for='correo'>Correo</label>
                    <input type='email' class='form-control' id='correo' name='correo' value='$correo'>
                </div>
                <div class='form-group col-md-6'>
                    <label for='estatus'>Estatus</label>
                    <select class='form-control' id='estatus' name='estatus'> 
                        <option value='Activo' $activo>Activo</option>
                        <option value='Suspendido' $suspendido>Suspendido</option>
                    </select>
                </div>
                </div>
                <!-- /.card-body -->

                <div class='text-center'>
                <a href='?module=usuarios' class='btn btn-outline-danger'>Regresar</a>
                <button type='submit' class='btn btn-outline-success' name='btn_update'>Actualizar</button>
                </div>
            </form>
        </div>
    </section>";

    mysqli_close($conn);
} else {
    echo "<script> window.location.href = 'index.php?module=usuarios'; </script>";
}
