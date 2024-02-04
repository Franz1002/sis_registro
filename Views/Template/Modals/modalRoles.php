<!-- Modal -->
<div class="modal fade" id="modalFormRol" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formRol" name="formRol">
              <input type="hidden" id="idRol" name="idRol" value="">
              <div class="form-group col-md-12">
                <label><span class="required2">Todos los campos con asterisco son obligatorios</span>:</label>
              </div>
              <div class="form-group">
                <label class="control-label">Cargo <span class="required">*</span>:</label>
                <input class="form-control" id="txtNombre" name="txtNombre" type="text"
                  placeholder="Nombre del tipo de Usuario" required="">
              </div>
              <div class="form-group">
                <label class="control-label">Descripción <span class="required">*</span>:</label>
                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2"
                  placeholder="Descripción del tipo de Usuario" required=""></textarea>
              </div>
              <div class="form-group">
                <label for="exampleSelect1">Estado <span class="required">*</span>:</label>
                <select class="form-control selectpicker" id="listStatus" name="listStatus" required="">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
                <br><br> <br>
              </div>

              <div class="tile-footer text-center">

                <button id="btnActionForm" onclick="registrarTu(event);" class="btn btn-primary" type="button"><i
                    class="fa fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-secondary" type="reset"><i
                    class="fa fa-fw fa-lg fa-times-circle"></i>Resetear</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalVerTipo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Tipo de usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Tipo de usuario</h5>
            <p class="card-text" id="verTipo" style="font-size: 20px;" >Administrador</p>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Descripción</h5>
            <p class="card-text" id="verDescripcion" style="font-size: 20px;">Este tipo de usuario tiene acceso completo al sistema.</p>
          </div>
        </div>
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Estado</h5>
            <p class="card-text" id="verEstado" style="font-size: 18px;">
              <span class="badge badge-success" style="font-size: 24px;">Activo</span>
            </p>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button class="btn btn-primary" type="button" data-dismiss="modal" style="font-size: 24px;">Cerrar</button>
      </div>
    </div>
  </div>
</div>
