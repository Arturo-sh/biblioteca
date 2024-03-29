<?php
session_start();
if (!isset($_SESSION['id_usuario'])) exit;

require_once "../database.php";

if ($_SESSION['rol_usuario'] == "Admin") {
    if (isset($_POST['books_table'])) {
        $query_get_books = "SELECT l.id_libro, l.titulo_libro, l.autor, e.nombre_editorial, c.nombre_categoria, l.unidades_totales, l.imagen_portada, l.descripcion, l.estado_libro FROM libros AS l INNER JOIN editoriales AS e ON l.id_editorial = e.id_editorial INNER JOIN categorias AS c ON l.id_categoria = c.id_categoria";
        $books_data = mysqli_query($conn, $query_get_books);

        $data = mysqli_fetch_all($books_data, MYSQLI_ASSOC);

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    if (isset($_POST['load_selects'])) {
        $query_get_publishers = "SELECT id_editorial, nombre_editorial FROM editoriales ORDER BY nombre_editorial ASC";
        $result_get_publishers = mysqli_query($conn, $query_get_publishers);

        $query_get_categories = "SELECT id_categoria, nombre_categoria FROM categorias ORDER BY nombre_categoria ASC";
        $result_get_categories = mysqli_query($conn, $query_get_categories);

        $publisher_options = "";
        $category_options = "";

        while ($row = mysqli_fetch_array($result_get_publishers)) {
            $id_editorial = $row['id_editorial'];
            $nombre_editorial = $row['nombre_editorial'];

            $publisher_options .= "
          <option value='$id_editorial'>$nombre_editorial</option>";
        }

        while ($row = mysqli_fetch_array($result_get_categories)) {
            $id_categoria = $row['id_categoria'];
            $nombre_categoria = $row['nombre_categoria'];

            $category_options .= "
          <option value='$id_categoria'>$nombre_categoria</option>";
        }

        $arr = [
            "categorias" => $category_options,
            "editoriales" => $publisher_options
        ];

        echo json_encode($arr);
    }

    if (isset($_POST['action']) && $_POST['action'] == "insert") {
        $titulo_libro = htmlspecialchars(trim($_POST['titulo_libro']), ENT_QUOTES, 'UTF-8');
        $autor = htmlspecialchars(trim($_POST['autor']), ENT_QUOTES, 'UTF-8');

        // Si se reciben los datos almacenar en variables
        if (isset($_POST['id_editorial'])) $id_editorial = htmlspecialchars(trim($_POST['id_editorial']), ENT_QUOTES, 'UTF-8');
        if (isset($_POST['id_categoria'])) $id_categoria = htmlspecialchars(trim($_POST['id_categoria']), ENT_QUOTES, 'UTF-8');

        $unidades_totales = htmlspecialchars(trim($_POST['unidades_totales']), ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars(trim($_POST['descripcion']), ENT_QUOTES, 'UTF-8');

        $nueva_editorial = htmlspecialchars(trim($_POST['nueva_editorial']), ENT_QUOTES, 'UTF-8');
        $nueva_categoria = htmlspecialchars(trim($_POST['nueva_categoria']), ENT_QUOTES, 'UTF-8');

        if (!empty($nueva_editorial)) {
            // Comparar si la "nueva editorial" existe en la base de datos
            $query_check_publisher = "SELECT id_editorial FROM editoriales WHERE nombre_editorial = '$nueva_editorial'";
            $result_check_publisher = mysqli_query($conn, $query_check_publisher);
            $row = mysqli_fetch_array($result_check_publisher);

            if (mysqli_num_rows($result_check_publisher) == 0) {
                // Si no existe, insertarla
                $query_insert_publisher = "INSERT INTO editoriales(id_editorial, nombre_editorial) VALUES (NULL, '$nueva_editorial')";
                $result_insert_publisher = mysqli_query($conn, $query_insert_publisher);

                // Obtener el id de la editorial insertada
                $id_editorial = mysqli_insert_id($conn);
            } else {
                // Si existe, obtener su id
                $id_editorial = $row['id_editorial'];
            }
        }

        if (!empty($nueva_categoria)) {
            // Comparar si la "nueva categoria" existe en la base de datos
            $query_check_category = "SELECT id_categoria FROM categorias WHERE nombre_categoria = '$nueva_categoria'";
            $result_check_category = mysqli_query($conn, $query_check_category);
            $row = mysqli_fetch_array($result_check_category);

            if (mysqli_num_rows($result_check_category) == 0) {
                // Si no existe, insertarla
                $query_insert_category = "INSERT INTO categorias(id_categoria, nombre_categoria) VALUES (NULL, '$nueva_categoria')";
                $result_insert_category = mysqli_query($conn, $query_insert_category);

                // Obtener el id de la categoria insertada
                $id_categoria = mysqli_insert_id($conn);
            } else {
                // Si existe, obtener su id
                $id_categoria = $row['id_categoria'];
            }
        }

        $query_insert_book = "INSERT INTO libros(id_libro, titulo_libro, autor, id_editorial, id_categoria, unidades_totales, descripcion) VALUES (NULL, '$titulo_libro', '$autor', $id_editorial, $id_categoria, $unidades_totales, '$descripcion')";

        if (!empty($_FILES['imagen']['name'])) {
            $nombre_imagen = $_FILES['imagen']['name'];
            $tam_imagen = $_FILES['imagen']['size'];
            $nombre_temp = $_FILES['imagen']['tmp_name'];

            $imagen = pathinfo($nombre_imagen, PATHINFO_FILENAME);
            $extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
            $imagen_portada = $imagen . "_" . uniqid() . "." . $extension;

            $ruta_destino = "../../dist/portadas/" . $imagen_portada;

            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                if ($tam_imagen <= 10000000) {
                    if (move_uploaded_file($nombre_temp, $ruta_destino)) {
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
        $autor = htmlspecialchars(trim($_POST['autor']), ENT_QUOTES, 'UTF-8');

        // Si se reciben los datos almacenar en variables
        if (isset($_POST['id_editorial'])) $id_editorial = htmlspecialchars(trim($_POST['id_editorial']), ENT_QUOTES, 'UTF-8');
        if (isset($_POST['id_categoria'])) $id_categoria = htmlspecialchars(trim($_POST['id_categoria']), ENT_QUOTES, 'UTF-8');

        $unidades_totales = htmlspecialchars(trim($_POST['unidades_totales']), ENT_QUOTES, 'UTF-8');
        $descripcion = htmlspecialchars(trim($_POST['descripcion']), ENT_QUOTES, 'UTF-8');
        $estado_libro = htmlspecialchars(trim($_POST['estado_libro']), ENT_QUOTES, 'UTF-8');

        $nueva_editorial = htmlspecialchars(trim($_POST['nueva_editorial']), ENT_QUOTES, 'UTF-8');
        $nueva_categoria = htmlspecialchars(trim($_POST['nueva_categoria']), ENT_QUOTES, 'UTF-8');

        if (!empty($nueva_editorial)) {
            // Comparar si la "nueva editorial" existe en la base de datos
            $query_check_publisher = "SELECT id_editorial FROM editoriales WHERE nombre_editorial = '$nueva_editorial'";
            $result_check_publisher = mysqli_query($conn, $query_check_publisher);
            $row = mysqli_fetch_array($result_check_publisher);

            if (mysqli_num_rows($result_check_publisher) == 0) {
                // Si no existe, insertarla
                $query_insert_publisher = "INSERT INTO editoriales(id_editorial, nombre_editorial) VALUES (NULL, '$nueva_editorial')";
                $result_insert_publisher = mysqli_query($conn, $query_insert_publisher);

                // Obtener el id de la editorial insertada
                $id_editorial = mysqli_insert_id($conn);
            } else {
                // Si existe, obtener su id
                $id_editorial = $row['id_editorial'];
            }
        }

        if (!empty($nueva_categoria)) {
            // Comparar si la "nueva categoria" existe en la base de datos
            $query_check_category = "SELECT id_categoria FROM categorias WHERE nombre_categoria = '$nueva_categoria'";
            $result_check_category = mysqli_query($conn, $query_check_category);
            $row = mysqli_fetch_array($result_check_category);

            if (mysqli_num_rows($result_check_category) == 0) {
                // Si no existe, insertarla
                $query_insert_category = "INSERT INTO categorias(id_categoria, nombre_categoria) VALUES (NULL, '$nueva_categoria')";
                $result_insert_category = mysqli_query($conn, $query_insert_category);

                // Obtener el id de la categoria insertada
                $id_categoria = mysqli_insert_id($conn);
            } else {
                // Si existe, obtener su id
                $id_categoria = $row['id_categoria'];
            }
        }

        $query_update_book = "UPDATE libros SET titulo_libro = '$titulo_libro', autor = '$autor', id_editorial = $id_editorial, id_categoria = $id_categoria, unidades_totales = $unidades_totales, descripcion = '$descripcion', estado_libro = '$estado_libro' WHERE id_libro = $id_libro";

        if (!empty($_FILES['imagen']['name'])) {
            $nombre_imagen = $_FILES['imagen']['name'];
            $tam_imagen = $_FILES['imagen']['size'];
            $nombre_temp = $_FILES['imagen']['tmp_name'];

            $imagen = pathinfo($nombre_imagen, PATHINFO_FILENAME);
            $extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION);
            $imagen_portada = $imagen . "_" . uniqid() . "." . $extension;

            $ruta_destino = "../../dist/portadas/" . $imagen_portada;

            if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                if ($tam_imagen <= 10000000) {
                    if (move_uploaded_file($nombre_temp, $ruta_destino)) {
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
