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
                        <input type='text' class='form-control' id='usuario' name='usuario' pattern='^([\w]){6,}$' title='Ingrese nombre de usuario mayor a 5 carácteres y sin espacios' placeholder='Nombre corto (sin espacios)' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='contrasenia'>Contraseña</label>
                        <input type='password' class='form-control' id='contrasenia' name='contrasenia' pattern='^([\w]){6,}$' title='Ingrese una contraseña mayor a 5 carácteres' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='nombre_usuario'>Nombre completo</label>
                        <input type='text' class='form-control' id='nombre_usuario' name='nombre_usuario' pattern='^[^\d]+$' title='Ingrese un nombre válido' placeholder='Ejemplo: Pedro...' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='telefono_usuario'>Teléfono</label>
                        <input type='text' class='form-control' id='telefono_usuario' name='telefono_usuario' data-inputmask='\"mask\": \"(999) 999-9999\"' data-mask placeholder='(999) 999-9999'>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='correo_usuario'>Correo</label>
                        <input type='email' class='form-control' id='correo_usuario' name='correo_usuario' placeholder='usuario@gmail.com'>
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
} 

elseif ($_GET['action'] == "edit") {
    $id_usuario = $_GET['id'];

    require_once "modules/database.php";

    $query_user_data = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";
    $user_data = mysqli_query($conn, $query_user_data);
    $row = mysqli_fetch_array($user_data);

    $usuario = $row['usuario'];
    $nombre_usuario = $row['nombre_usuario'];
    $telefono_usuario = $row['telefono_usuario'];
    $correo_usuario = $row['correo_usuario'];
    $estado_usuario = $row['estado_usuario'];

    $activo = ""; $suspendido = "";

    $activo = $estado_usuario == "Activo" ? "selected" : "";
    $suspendido = $estado_usuario == "Suspendido" ? "selected" : "";

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
                        <input type='text' class='form-control' id='usuario' name='usuario' value='$usuario'  pattern='^([\w]){6,}$' title='Ingrese nombre de usuario mayor a 5 carácteres y sin espacios' placeholder='Nombre corto (sin espacios)' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='contrasenia'>Nueva contraseña</label>
                        <input type='password' class='form-control' id='contrasenia' name='contrasenia' pattern='^([\w]){6,}$' title='Ingrese una contraseña mayor a 5 carácteres'>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='nombre_usuario'>Nombre completo</label>
                        <input type='text' class='form-control' id='nombre_usuario' name='nombre_usuario' value='$nombre_usuario' name='nombre' pattern='^[^\d]+$' title='Ingrese un nombre válido' placeholder='Ejemplo: Pedro...' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='telefono_usuario'>Teléfono</label>
                        <input type='telephone' class='form-control' id='telefono_usuario' name='telefono_usuario' value='$telefono_usuario' data-inputmask='\"mask\": \"(999) 999-9999\"' data-mask placeholder='(999) 999-9999'>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='correo_usuario'>Correo</label>
                        <input type='email' class='form-control' id='correo_usuario' name='correo_usuario' value='$correo_usuario' placeholder='usuario@gmail.com'>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='estado_usuario'>Estatus</label>
                        <select class='form-control' id='estado_usuario' name='estado_usuario'> 
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
} 

elseif ($_GET['action'] == "delete") {
    echo "Formulario para eliminar registro";
} 

else {
    echo "<script> window.location.href = 'index.php?module=usuarios'; </script>";
}
