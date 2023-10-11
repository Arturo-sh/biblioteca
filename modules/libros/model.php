<?php
session_start();
require_once "../database.php";

if (isset($_POST['btn_insert'])) {
    $titulo_libro = htmlspecialchars(trim($_POST['titulo_libro']), ENT_QUOTES, 'UTF-8');
    $id_editorial = htmlspecialchars(trim($_POST['id_editorial']), ENT_QUOTES, 'UTF-8');
    $id_categoria = htmlspecialchars(trim($_POST['id_categoria']), ENT_QUOTES, 'UTF-8');
    $unidades_totales = htmlspecialchars(trim($_POST['unidades_totales']), ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars(trim($_POST['descripcion']), ENT_QUOTES, 'UTF-8');

    $nombre_imagen = $_FILES['imagen']['name'];
    $tam_imagen = $_FILES['imagen']['size'];
	$tipo_imagen = $_FILES['imagen']['type'];
	$nombre_temp = $_FILES['imagen']['tmp_name'];
	
	$imagen = pathinfo($nombre_imagen, PATHINFO_FILENAME);
	$extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
    $imagen_portada = $imagen . "_" . uniqid() . "." . $extension;

    $extensiones_permitidas = array('jpg','jpeg','png');
	$ruta_destino = "../../dist/portadas/" . $imagen_portada;

    if ($descripcion == "") $descripcion = "Libro en buena condición";

    $query_insert_book = "INSERT INTO libros(id_libro, titulo_libro, id_editorial, id_categoria, unidades_totales, descripcion) VALUES (NULL, '$titulo_libro', $id_editorial, $id_categoria, $unidades_totales, '$descripcion')";        
    
    if (!empty($_FILES['imagen']['name'])) {	
        if (in_array($extension, $extensiones_permitidas)) {   
            if($tam_imagen <= 10000000) { 
                if(move_uploaded_file($nombre_temp, $ruta_destino)) {
                    $query_insert_book = "INSERT INTO libros(id_libro, titulo_libro, id_editorial, id_categoria, unidades_totales, imagen_portada, descripcion) VALUES (NULL, '$titulo_libro', $id_editorial, $id_categoria, $unidades_totales, '$imagen_portada', '$descripcion')";
                } 
            }
        }
    }

    $result_book_insert = mysqli_query($conn, $query_insert_book);

    $_SESSION['book_insert'] = ["icon" => "error", "action" => "insertar"];

    if ($result_book_insert) {
        $_SESSION['book_insert'] = ["icon" => "success", "title" => "Libro registrado!"];
    }

    mysqli_close($conn);
    header("Location: ../../index.php?module=libros");
} 
    
if (isset($_POST['btn_update'])) {
    $id_libro = htmlspecialchars(trim($_POST['id_libro']), ENT_QUOTES, 'UTF-8');
    $titulo_libro = htmlspecialchars(trim($_POST['titulo_libro']), ENT_QUOTES, 'UTF-8');
    $id_editorial = htmlspecialchars(trim($_POST['id_editorial']), ENT_QUOTES, 'UTF-8');
    $id_categoria = htmlspecialchars(trim($_POST['id_categoria']), ENT_QUOTES, 'UTF-8');
    $unidades_totales = htmlspecialchars(trim($_POST['unidades_totales']), ENT_QUOTES, 'UTF-8');
    $descripcion = htmlspecialchars(trim($_POST['descripcion']), ENT_QUOTES, 'UTF-8');
    $estado_libro = htmlspecialchars(trim($_POST['estado_libro']), ENT_QUOTES, 'UTF-8');
    
    $nombre_imagen = $_FILES['imagen']['name'];
    $tam_imagen = $_FILES['imagen']['size'];
	$tipo_imagen = $_FILES['imagen']['type'];
	$nombre_temp = $_FILES['imagen']['tmp_name'];
		
	$imagen = pathinfo($nombre_imagen, PATHINFO_FILENAME);
	$extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
    $imagen_portada = $imagen . "_" . uniqid() . "." . $extension;
    
    $extensiones_permitidas = array('jpg','jpeg','png');
	$ruta_destino = "../../dist/portadas/" . $imagen_portada;

    if ($descripcion == "") $descripcion = "Libro en buena condición";

    $query_update_book = "UPDATE libros SET titulo_libro = '$titulo_libro', id_editorial = $id_editorial, id_categoria = $id_categoria, unidades_totales = $unidades_totales, descripcion = '$descripcion', estado_libro = '$estado_libro' WHERE id_libro = $id_libro";        
    
    if (!empty($_FILES['imagen']['name'])) {	
        if (in_array($extension, $extensiones_permitidas)) {   
            if($tam_imagen <= 10000000) { 
                if(move_uploaded_file($nombre_temp, $ruta_destino)) {
                    $query_update_book = "UPDATE libros SET titulo_libro = '$titulo_libro', id_editorial = $id_editorial, id_categoria = $id_categoria, unidades_totales = $unidades_totales, imagen_portada = '$imagen_portada', descripcion = '$descripcion', estado_libro = '$estado_libro' WHERE id_libro = $id_libro";
                } 
            }
        }
    }

    $result_book_update = mysqli_query($conn, $query_update_book);

    $_SESSION['book_update'] = ["icon" => "error", "action" => "actualizar"];

    if ($result_book_update) {
        $_SESSION['book_update'] = ["icon" => "success", "title" => "Datos del libro actualizados!"];
    }

    mysqli_close($conn);
    header("Location: ../../index.php?module=libros");
}

if ($_POST['delete_id'] && $_SESSION['rol_usuario'] == "Admin") {
    $id_libro = $_POST['delete_id'];
    
    $book_deleted = ["icon" => "error", "title" => "Ha ocurridó un error, inténtelo de nuevo!"];
    
    $query_book_delete = "DELETE FROM libros WHERE id_libro = $id_libro";
    $result_book_delete = mysqli_query($conn, $query_book_delete);    
    mysqli_close($conn);

    if ($result_book_delete) {
        $book_deleted = ["icon" => "success", "title" => "Libro eliminado!"];
        echo json_encode($book_deleted);
        return;
    }
}
?>