<!-- Modal -->
<div class="modal fade" id="modalFormUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formUsuario" name="formUsuario">
              <input type="hidden" id="idUsuario" name="idUsuario" value="">
              <div class="form-group col-md-12">
                <label><span class="required2">Todos los campos con asterisco son obligatorios</span>:</label>
              </div>
              <div class="form-group col-md-6">
                <label for="txtNombre">Nombres <span class="required">*</span>:</label>
                <input class="form-control" id="txtNombre" name="txtNombre" type="text"
                  placeholder="Nombres del usuario" required="">
              </div>
              <div class="form-group col-md-6">
                <label for="txtApellido">Apellidos <span class="required">*</span>:</label>
                <input class="form-control" id="txtApellido" name="txtApellido" type="text"
                  placeholder="Apellidos del usuario" required="">
              </div>
              <div class="form-group col-md-6">
                <label for="txtCi">Cédula de identidad <span class="required">*</span>:</label>
                <input class="form-control" id="txtCi" name="txtCi" type="text" placeholder="Cédula del usuario"
                  required="">
              </div>
              <div class="form-group col-md-6">
                <label for="txtCelular">Celular <span class="required">*</span>:</label>
                <input class="form-control" id="txtCelular" name="txtCelular" type="tel"
                  placeholder="Celular del usuario" required="">
              </div>
              <div class="form-group col-md-6">
                <label for="txtEmail">Email <span class="required">*</span>:</label>
                <input class="form-control" id="txtEmail" name="txtEmail" type="email" placeholder="Email del usuario"
                  required="">
              </div>
              <div class="form-group col-md-6">
                <label for="txtPass">Contraseña <span class="required">*</span>:</label>
                <input class="form-control" id="txtPass" name="txtPass" type="password"
                  placeholder="Contraseña del usuario" required="">
              </div>
              <div class="form-group col-md-6">
                <label for="listRol">Tipo de usuario <span class="required">*</span>:</label>
                <select class="form-control" data-size="2" data-title="Selecciona una opción" id="listRol" name="listRol" required="">
                  <!-- opciones del select -->
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="listStatus">Estado <span class="required">*</span>:</label>
                <select class="form-control selectpicker" id="list" name="listStatus" required="">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
                <br><br><br><br>
              </div>

              <div class="tile-footer text-center">

                <button id="btnActionForm" onclick="registrarUsuario(event);" class="btn btn-primary" type="button"><i
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

<div class="modal fade" id="modalVerUsuario" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="titleModal">Datos del Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Nombres</h5>
                  <p class="card-text" id="verNombres" style="font-size: 19px;">Camila</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Apellidos</h5>
                  <p class="card-text" id="verApellidos" style="font-size: 19px;">Salinas</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">CI</h5>
                  <p class="card-text" id="verCI" style="font-size: 19px;">98745874</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Email</h5>
                  <p class="card-text" id="verEmail" style="font-size: 19px;">camila@gmail.com</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Teléfono</h5>
                  <p class="card-text" id="verTelefono" style="font-size: 19px;">68547844</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Tipo de Usuario</h5>
                  <p class="card-text" id="verTipoUsuario" style="font-size: 19px;">Administrador</p>
                </div>
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <div class="card text-center">
                <div class="card-body">
                  <h5 class="card-title">Estado</h5>
                  <p class="card-text" id="verEstado" style="font-size: 22px;">
                    <span class="badge badge-success">Activo</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-center">
        <button class="btn btn-primary" type="button" data-dismiss="modal" style="font-size: 26px;">Cerrar</button>
      </div>
    </div>
  </div>
</div>