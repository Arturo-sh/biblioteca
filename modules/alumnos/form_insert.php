<form method="POST" action="modules/alumnos/insert_data.php">
    <div class="card-body row">
      <div class="form-group col-md-6">
        <label for="matricula">Matrícula</label>
        <input type="text" class="form-control" id="matricula" name="matricula">
      </div>
      <div class="form-group col-md-6">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
      </div>
      <div class="form-group col-md-6">
        <label for="semestre">Semestre</label>
        <select class="form-control" id="semestre" name="semestre">
            <option value="1">1er semestre</option>
            <option value="2">2do semestre</option>
            <option value="3">3er semestre</option>
            <option value="4">4to semestre</option>
            <option value="5">5to semestre</option>
            <option value="6">6to semestre</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label for="grupo">Grupo</label>
        <select class="form-control" id="grupo" name="grupo">
            <option value="A">A</option>
            <option value="B">B</option>
        </select>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer text-center">
      <button type="reset" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
      <button type="submit" class="btn btn-outline-success" name="btn_save">Guardar</button>
    </div>
</form>
