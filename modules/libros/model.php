<?php
    session_start();
    require_once "../database.php";

    if (isset($_POST['btn_insert'])) {
        $titulo = htmlspecialchars(trim($_POST['titulo']), ENT_QUOTES, 'UTF-8');
        $editorial = htmlspecialchars(trim($_POST['editorial']), ENT_QUOTES, 'UTF-8');
        $categoria = htmlspecialchars(trim($_POST['categoria']), ENT_QUOTES, 'UTF-8');
        $unidades = htmlspecialchars(trim($_POST['unidades']), ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars(trim($_POST['descripcion']), ENT_QUOTES, 'UTF-8');

        $nombre_imagen = $_FILES['imagen']['name'];
        $tam_imagen = $_FILES['imagen']['size'];
		$tipo_imagen = $_FILES['imagen']['type'];
		$nombre_temp = $_FILES['imagen']['tmp_name'];
		
		$imagen = pathinfo($nombre_imagen, PATHINFO_FILENAME);
		$extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
        $imagen_unica = $imagen . "_" . uniqid() . "." . $extension;

        $extensiones_permitidas = array('jpg','jpeg','png');
		$ruta_destino = "../../dist/portadas/" . $imagen_unica;

        if ($descripcion == "") $descripcion = "Libro en buena condición";

        $query_insert_book = "INSERT INTO libros(id_libro, titulo_libro, id_editorial, id_categoria, unidades_totales, descripcion) VALUES (NULL, '$titulo', $editorial, $categoria, $unidades, '$descripcion')";        
        
        if (!empty($_FILES['imagen']['name'])) {	
            if (in_array($extension, $extensiones_permitidas)) {   
                if($tam_imagen <= 10000000) { 
                    if(move_uploaded_file($nombre_temp, $ruta_destino)) {
                        $query_insert_book = "INSERT INTO libros(id_libro, titulo_libro, id_editorial, id_categoria, unidades_totales, imagen_portada, descripcion) VALUES (NULL, '$titulo', $editorial, $categoria, $unidades, '$imagen_unica', '$descripcion')";
                    } 
                }
            }
        }

        $result_book_insert = mysqli_query($conn, $query_insert_book);

        $error_msg = "Ha ocurrido un error al insertar el registro, intentelo de nuevo!";
        $_SESSION['book_insert'] = ["icon" => "error", "title" => $error_msg];

        if ($result_book_insert) {
            $_SESSION['book_insert'] = ["icon" => "success", "title" => "Libro registrado!"];
        }
    } if (isset($_POST['btn_update'])) {
        $id_libro = htmlspecialchars(trim($_POST['id_libro']), ENT_QUOTES, 'UTF-8');
        $titulo = htmlspecialchars(trim($_POST['titulo']), ENT_QUOTES, 'UTF-8');
        $editorial = htmlspecialchars(trim($_POST['editorial']), ENT_QUOTES, 'UTF-8');
        $categoria = htmlspecialchars(trim($_POST['categoria']), ENT_QUOTES, 'UTF-8');
        $unidades = htmlspecialchars(trim($_POST['unidades']), ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars(trim($_POST['descripcion']), ENT_QUOTES, 'UTF-8');
        $estatus = htmlspecialchars(trim($_POST['estatus']), ENT_QUOTES, 'UTF-8');
        
        $nombre_imagen = $_FILES['imagen']['name'];
        $tam_imagen = $_FILES['imagen']['size'];
		$tipo_imagen = $_FILES['imagen']['type'];
		$nombre_temp = $_FILES['imagen']['tmp_name'];
		
		$imagen = pathinfo($nombre_imagen, PATHINFO_FILENAME);
		$extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
        $imagen_unica = $imagen . "_" . uniqid() . "." . $extension;
        
        $extensiones_permitidas = array('jpg','jpeg','png');
		$ruta_destino = "../../dist/portadas/" . $imagen_unica;

        if ($descripcion == "") $descripcion = "Libro en buena condición";

        $query_update_book = "UPDATE libros SET titulo_libro = '$titulo', id_editorial = $editorial, id_categoria = $categoria, unidades_totales = $unidades, descripcion = '$descripcion', estado_libro = '$estatus' WHERE id_libro = $id_libro";        
        
        if (!empty($_FILES['imagen']['name'])) {	
            if (in_array($extension, $extensiones_permitidas)) {   
                if($tam_imagen <= 10000000) { 
                    if(move_uploaded_file($nombre_temp, $ruta_destino)) {
                        $query_update_book = "UPDATE libros SET titulo_libro = '$titulo', id_editorial = $editorial, id_categoria = $categoria, unidades_totales = $unidades, imagen_portada = '$imagen_unica', descripcion = '$descripcion', estado_libro = '$estatus' WHERE id_libro = $id_libro";
                    } 
                }
            }
        }

        $result_book_update = mysqli_query($conn, $query_update_book);

        $error_msg = "Ha ocurrido un error al actualizar el registro, intentelo de nuevo!";
        $_SESSION['student_update'] = ["icon" => "error", "title" => $error_msg];

        if ($result_book_update) {
            $_SESSION['student_update'] = ["icon" => "success", "title" => "Datos del libro actualizados!"];
        }
    }
    
    mysqli_close($conn);
    header("Location: ../../?module=libros");
?>