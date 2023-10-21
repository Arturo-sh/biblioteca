<?php
session_start();
require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['action']) && $_POST['action'] == "insert") {
        $titulo_libro = htmlspecialchars(trim($_POST['titulo_libro']), ENT_QUOTES, 'UTF-8');
        $id_editorial = htmlspecialchars(trim($_POST['id_editorial']), ENT_QUOTES, 'UTF-8');
        $id_categoria = htmlspecialchars(trim($_POST['id_categoria']), ENT_QUOTES, 'UTF-8');
        $unidades_totales = htmlspecialchars(trim($_POST['unidades_totales']), ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars(trim($_POST['descripcion']), ENT_QUOTES, 'UTF-8');
        if ($descripcion == "") $descripcion = "Libro en buena condición";

        $query_insert_book = "INSERT INTO libros(id_libro, titulo_libro, id_editorial, id_categoria, unidades_totales, descripcion) VALUES (NULL, '$titulo_libro', $id_editorial, $id_categoria, $unidades_totales, '$descripcion')";        
        
        if (!empty($_FILES['imagen']['name'])) {
            $nombre_imagen = $_FILES['imagen']['name'];
            $tam_imagen = $_FILES['imagen']['size'];
            $nombre_temp = $_FILES['imagen']['tmp_name'];
            
            $imagen = pathinfo($nombre_imagen, PATHINFO_FILENAME);
            $extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
            $imagen_portada = $imagen . "_" . uniqid() . "." . $extension;

            $ruta_destino = "../../dist/portadas/" . $imagen_portada;

            if (in_array($extension, ['jpg','jpeg','png'])) {   
                if($tam_imagen <= 10000000) { 
                    if(move_uploaded_file($nombre_temp, $ruta_destino)) {
                        $query_insert_book = "INSERT INTO libros(id_libro, titulo_libro, id_editorial, id_categoria, unidades_totales, imagen_portada, descripcion) VALUES (NULL, '$titulo_libro', $id_editorial, $id_categoria, $unidades_totales, '$imagen_portada', '$descripcion')";
                    } 
                }
            }
        }

        $result_book_insert = mysqli_query($conn, $query_insert_book);

        if ($result_book_insert) echo "Libro registrado!";
    } 
        
    if (isset($_POST['edit_id'])) {
        $id_libro = $_POST['edit_id'];
        
        $query_book_data = "SELECT * FROM libros WHERE id_libro = $id_libro";
        $book_data = mysqli_query($conn, $query_book_data);
        $row = mysqli_fetch_all($book_data, MYSQLI_ASSOC);

        echo json_encode($row, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['action']) && $_POST['action'] == "update") {
        $id_libro = htmlspecialchars(trim($_POST['id_libro']), ENT_QUOTES, 'UTF-8');
        $titulo_libro = htmlspecialchars(trim($_POST['titulo_libro']), ENT_QUOTES, 'UTF-8');
        $id_editorial = htmlspecialchars(trim($_POST['id_editorial']), ENT_QUOTES, 'UTF-8');
        $id_categoria = htmlspecialchars(trim($_POST['id_categoria']), ENT_QUOTES, 'UTF-8');
        $unidades_totales = htmlspecialchars(trim($_POST['unidades_totales']), ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars(trim($_POST['descripcion']), ENT_QUOTES, 'UTF-8');
        $estado_libro = htmlspecialchars(trim($_POST['estado_libro']), ENT_QUOTES, 'UTF-8');
        if ($descripcion == "") $descripcion = "Libro en buena condición";

        $query_update_book = "UPDATE libros SET titulo_libro = '$titulo_libro', id_editorial = $id_editorial, id_categoria = $id_categoria, unidades_totales = $unidades_totales, descripcion = '$descripcion', estado_libro = '$estado_libro' WHERE id_libro = $id_libro";        
        
        if (!empty($_FILES['imagen']['name'])) {
            $nombre_imagen = $_FILES['imagen']['name'];
            $tam_imagen = $_FILES['imagen']['size'];
            $nombre_temp = $_FILES['imagen']['tmp_name'];
            
            $imagen = pathinfo($nombre_imagen, PATHINFO_FILENAME);
            $extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
            $imagen_portada = $imagen . "_" . uniqid() . "." . $extension;

            $ruta_destino = "../../dist/portadas/" . $imagen_portada;

            if (in_array($extension, ['jpg','jpeg','png'])) {   
                if($tam_imagen <= 10000000) { 
                    if(move_uploaded_file($nombre_temp, $ruta_destino)) {
                        $query_update_book = "UPDATE libros SET titulo_libro = '$titulo_libro', id_editorial = $id_editorial, id_categoria = $id_categoria, unidades_totales = $unidades_totales, imagen_portada = '$imagen_portada', descripcion = '$descripcion', estado_libro = '$estado_libro' WHERE id_libro = $id_libro";
                    } 
                }
            }
        }

        $result_book_update = mysqli_query($conn, $query_update_book);

        if ($result_book_update) echo "Libro actualizado!";
    }

    if (isset($_POST['delete_id'])) {
        $id_libro = $_POST['delete_id'];
        
        $query_book_delete = "DELETE FROM libros WHERE id_libro = $id_libro";
        $result_book_delete = mysqli_query($conn, $query_book_delete);    

        if ($result_book_delete) echo "Libro eliminado!";
    }
}

mysqli_close($conn);
?>