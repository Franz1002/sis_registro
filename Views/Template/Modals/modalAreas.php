<!-- Modal -->
<div class="modal fade" id="modalFormArea" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Cargo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formArea" name="formArea">
              <input type="hidden" id="idArea" name="idArea" value="">
              <div class="form-group">
              <div class="form-group col-md-12">
                <label><span class="required2">Todos los campos con asterisco son obligatorios</span>:</label>               
              </div>
                <label class="control-label" for="txtNombre">Nombre del Área <span class="required">*</span>:</label>
                <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del área"
                  required="">
              </div>
              <div class="form-group">
                <label class="control-label" for="txtResponsable">Responsable del Área <span class="required">*</span>:</label>
                <input class="form-control" id="txtResponsable" name="txtResponsable" type="text" placeholder="Nombre del(a) responsable "
                  required="">
              </div>
              <div class="form-group">
                <label class="control-label" for="txtDescripcion">Descripción del Área <span class="required">*</span>:</label>
                <textarea class="form-control" id="txtDescripcion" name="txtDescripcion" rows="2"
                  placeholder="Descripción del área" required=""></textarea>
              </div>
              <div class="form-group">
                <label for="exampleSelect1">Estado <span class="required">*</span>:</label>
                <select class="form-control" id="listStatus" name="listStatus" required="">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
                <br><br><br><br>
              </div>
              <div class="tile-footer text-center">

                <button id="btnActionForm" onclick="registrarArea(event);" class="btn btn-primary" type="button"><i
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
<div class="modal fade" id="modalVerArea" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Detalles del Área</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Nombre del Área</h5>
            <p class="card-text" id="verTipo" style="font-size: 20px;" >Rrhh</p>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Nombre del(a) responsable del Área</h5>
            <p class="card-text" id="verResponsable" style="font-size: 20px;" >Angel</p>
          </div>
        </div>
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Descripción</h5>
            <p class="card-text" id="verDescripcion" style="font-size: 20px;">Esta área</p>
          </div>
        </div>
        <div class="card">
          <div class="card-body text-center">
            <h5 class="card-title">Estado</h5>
            <p class="card-text" id="verEstado" style="font-size: 24px;">
            
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
