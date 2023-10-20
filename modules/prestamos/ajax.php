<?php
require_once "../database.php";

$html = '';
$key = $_POST['key'];

if ($key == "") {
    return $html = "";
}

$query_get_books = "SELECT id_libro, titulo_libro FROM libros WHERE titulo_libro LIKE  '%$key%'";
$result_get_books = mysqli_query($conn, $query_get_books);

if (mysqli_num_rows($result_get_books) > 0) {
    while ($row = mysqli_fetch_assoc($result_get_books)) {
        $id_libro = $row['id_libro'];              
        $titulo_libro = $row['titulo_libro'];

        $html .= "
        <div>
            <a class='suggest-element' id='$id_libro' titulo='$titulo_libro'>$titulo_libro</a>
        </div>";
    }
}

echo $html;
?>