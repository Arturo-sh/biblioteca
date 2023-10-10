<?php
    session_start();
    require_once "../database.php";

    if (isset($_POST['btn_insert'])) {
        $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia = htmlspecialchars(trim($_POST['contrasenia']), ENT_QUOTES, 'UTF-8');
        $nombre_usuario = htmlspecialchars(trim($_POST['nombre_usuario']), ENT_QUOTES, 'UTF-8');
        $telefono_usuario = htmlspecialchars(trim($_POST['telefono_usuario']), ENT_QUOTES, 'UTF-8');
        $correo_usuario = htmlspecialchars(trim($_POST['correo_usuario']), ENT_QUOTES, 'UTF-8');
        
        $contrasenia_segura = sha1($contrasenia);

        $query_user_insert = "INSERT INTO usuarios(id_usuario, usuario, contrasenia, nombre_usuario, telefono_usuario, correo_usuario) VALUES(NULL, '$usuario', '$contrasenia_segura', '$nombre_usuario', '$telefono_usuario', '$correo_usuario')";
        $result_user_insert = mysqli_query($conn, $query_user_insert);

        $_SESSION['user_insert'] = ["icon" => "error", "action" => "insertar"];

        if ($result_user_insert) {
            $_SESSION['user_insert'] = ["icon" => "success", "title" => "Usuario registrado!"];
        }
    }

    if (isset($_POST['btn_update'])) {
        $id_usuario = htmlspecialchars(trim($_POST['id_usuario']), ENT_QUOTES, 'UTF-8');
        $usuario = htmlspecialchars(trim($_POST['usuario']), ENT_QUOTES, 'UTF-8');
        $contrasenia = htmlspecialchars(trim($_POST['contrasenia']), ENT_QUOTES, 'UTF-8');
        $nombre_usuario = htmlspecialchars(trim($_POST['nombre_usuario']), ENT_QUOTES, 'UTF-8');
        $telefono_usuario = htmlspecialchars(trim($_POST['telefono_usuario']), ENT_QUOTES, 'UTF-8');
        $correo_usuario = htmlspecialchars(trim($_POST['correo_usuario']), ENT_QUOTES, 'UTF-8');
        $estado_usuario = htmlspecialchars(trim($_POST['estado_usuario']), ENT_QUOTES, 'UTF-8');
        
        if ($contrasenia == "") {
            $query_user_update = "UPDATE usuarios SET usuario = '$usuario', nombre_usuario = '$nombre_usuario', telefono_usuario = '$telefono_usuario', correo_usuario = '$correo_usuario', estado_usuario = '$estado_usuario' WHERE id_usuario = $id_usuario";
        } else {
            $contrasenia_segura = sha1($contrasenia);
            $query_user_update = "UPDATE usuarios SET usuario = '$usuario', contrasenia = '$contrasenia_segura', nombre_usuario = '$nombre_usuario', telefono_usuario = '$telefono_usuario', correo_usuario = '$correo_usuario', estado_usuario = '$estado_usuario' WHERE id_usuario = $id_usuario";
        }

        $result_user_update = mysqli_query($conn, $query_user_update);

        $_SESSION['user_update'] = ["icon" => "error", "action" => "actualizar"];

        if ($result_user_update) {
            $_SESSION['user_update'] = ["icon" => "success", "title" => "Datos del usuario actualizados!"];
        }
    }

    mysqli_close($conn);
    header("Location: ../../?module=usuarios");
?>