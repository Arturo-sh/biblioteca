<?php

if ($_SESSION['rol_usuario'] != "Admin") {
    echo "<script> window.location.href = 'index.php?module=alumnos'; </script>";
}

if ($_GET['action'] == "insert") {
    echo "
    <!-- Content Header (Page header) -->
    <div class='content-header'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-sm-6'>
                    <h1 class='m-0'>Nuevo alumno</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class='content'>
        <div class='container-fluid'>
            <form method='POST' action='modules/alumnos/model.php'>
                <div class='card-body row'>
                    <div class='form-group col-md-6'>
                        <label for='matricula'>Matrícula</label>
                        <input type='text' class='form-control' id='matricula' name='matricula' pattern='[0-9]{8}' title='Ingrese una mátricula válida' placeholder='Ejemplo: 12435678' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='nombre_alumno'>Nombre</label>
                        <input type='text' class='form-control' id='nombre_alumno' name='nombre_alumno' pattern='^[^\d]+$' title='Ingrese un nombre válido' placeholder='Ejemplo: Jorge...' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='semestre'>Semestre</label>
                        <select class='form-control' id='semestre' name='semestre'>
                            <option value='1'>1er semestre</option>
                            <option value='2'>2do semestre</option>
                            <option value='3'>3er semestre</option>
                            <option value='4'>4to semestre</option>
                            <option value='5'>5to semestre</option>
                            <option value='6'>6to semestre</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class='text-center'>
                    <a href='?module=alumnos' class='btn btn-outline-danger'>Cancelar</a>
                    <button type='submit' class='btn btn-outline-success' name='btn_insert'>Guardar</button>
                </div>
            </form>
        </div>
    </section>";
} 

elseif ($_GET['action'] == "edit") {
    $id_alumno = $_GET['id'];

    require_once "modules/database.php";

    $query_student_data = "SELECT * FROM alumnos WHERE id_alumno = $id_alumno";
    $student_data = mysqli_query($conn, $query_student_data);
    $row = mysqli_fetch_array($student_data);

    $matricula = $row['matricula'];
    $nombre_alumno = $row['nombre_alumno'];
    $semestre = $row['semestre'];
    $estado_alumno = $row['estado_alumno'];

    $activo = ""; 
    $baja = "";

    $semestre_1 = "";
    $semestre_2 = "";
    $semestre_3 = "";
    $semestre_4 = "";
    $semestre_5 = "";
    $semestre_6 = "";

    $activo = $estado_alumno == "Activo" ? "selected" : "";
    $baja = $estado_alumno == "Baja" ? "selected" : "";

    switch ($semestre) {
        case '1':
            $semestre_1 = "selected";
            break;
        case '2':
            $semestre_2 = "selected";
            break;
        case '3':
            $semestre_3 = "selected";
            break;
        case '4':
            $semestre_4 = "selected";
            break;
        case '5':
            $semestre_5 = "selected";
            break;
        case '6':
            $semestre_6 = "selected";
            break;
    }

    echo "
    <!-- Content Header (Page header) -->
    <div class='content-header'>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-sm-6'>
                    <h1 class='m-0'>Editar alumno</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class='content'>
        <div class='container-fluid'>
            <form method='POST' action='modules/alumnos/model.php'>
                <div class='card-body row'>
                    <div class='form-group col-md-6'>
                        <label for='matricula'>Matrícula</label>
                        <input type='hidden' class='form-control' id='id_alumno' name='id_alumno' value='$id_alumno'>
                        <input type='text' class='form-control' id='matricula' name='matricula' value='$matricula' pattern='[0-9]{8}' title='Ingrese una mátricula válida' placeholder='Ejemplo: 12435678' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='nombre_alumno'>Nombre</label>
                        <input type='text' class='form-control' id='nombre_alumno' name='nombre_alumno' value='$nombre_alumno' pattern='^[^\d]+$' title='Ingrese un nombre válido' placeholder='Ejemplo: Jorge...' required>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='semestre'>Semestre</label>
                        <select class='form-control' id='semestre' name='semestre'>
                            <option value='1' $semestre_1>1er semestre</option>
                            <option value='2' $semestre_2>2do semestre</option>
                            <option value='3' $semestre_3>3er semestre</option>
                            <option value='4' $semestre_4>4to semestre</option>
                            <option value='5' $semestre_5>5to semestre</option>
                            <option value='6' $semestre_6>6to semestre</option>
                        </select>
                    </div>
                    <div class='form-group col-md-6'>
                        <label for='estado_alumno'>Estatus</label>
                        <select class='form-control' id='estado_alumno' name='estado_alumno'> 
                            <option value='Activo' $activo>Activo</option>
                            <option value='Baja' $baja>Baja</option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->
    
                <div class='text-center'>
                    <a href='?module=alumnos' class='btn btn-outline-danger'>Regresar</a>
                    <button type='submit' class='btn btn-outline-success' name='btn_update'>Actualizar</button>
                </div>
            </form>
        </div>
    </section>";
    
    mysqli_close($conn);
}

else {
    echo "<script> window.location.href = 'index.php?module=alumnos'; </script>";
}
