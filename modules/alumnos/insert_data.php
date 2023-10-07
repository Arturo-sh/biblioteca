
<?php
    session_start();

    require_once "../database.php";

    if (isset($_POST['btn_save'])) {

        $matricula = mysqli_real_escape_string($conn, trim($_POST['matricula']));
        $nombre = mysqli_real_escape_string($conn, trim($_POST['nombre']));
        $semestre = mysqli_real_escape_string($conn, trim($_POST['semestre']));
        $grupo = mysqli_real_escape_string($conn, trim($_POST['grupo']));

        $query_insert_alumno = "INSERT INTO alumnos(id_alumno, matricula, nombre_alumno, semestre, grupo_alumno) VALUES(NULL, $matricula, '$nombre', $semestre, '$grupo')";
        $sql_insert_alumno = mysqli_query($conn, $query_insert_alumno);

        if ($sql_insert_alumno) {
            $_SESSION['insert_alumno'] = true;
        } else {
            $_SESSION['insert_alumno'] = false;
        }

        mysqli_close($conn);
        header("Location: ../../?module=alumnos");
    }
?>