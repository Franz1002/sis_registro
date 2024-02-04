<div class="modal fade" id="modalFormDocumento" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="tile">
          <div class="tile-body">
            <form id="formDocumento" name="formDocumento">
              <input type="hidden" id="idDocumento" name="idDocumento" value="">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12 text-center">
                    <label class="required2">Todos los campos con asterisco son obligatorios</label>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtTitulo">Título del documento <span class="required">*</span></label>
                  <input class="form-control" id="txtTitulo" name="txtTitulo" type="text" required=""
                    placeholder="Título del documento">
                </div>
                <div class="form-group col-md-6">
                  <label for="codigoHojaRuta">Hoja de ruta <span class="required">*</span></label>
                  <!-- Campo oculto para almacenar el código generado -->
                  <input class="form-control" type="text" id="codigoHojaRuta" name="codigoHojaRuta" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="listArea">Área <span class="required">*</span></label>
                  <select class="form-control" data-title="Selecciona una opción" id="listArea" name="listArea"
                    required=""></select>
                </div>
                <div class="form-group col-md-6">
                  <label for="txtRemitente">Remitente <span class="required">*</span></label>
                  <input class="form-control" id="txtRemitente" name="txtRemitente" rows="2" required=""
                    placeholder="Nombre y Apellido del(a) Remitente">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="txtUsuario">Recibido por <span class="required">*</span></label>
                  <input class="form-control" id="txtUsuario" name="txtUsuario" type="text" required=""
                    value="<?= $_SESSION['userData']['nombres_usuario'] . ' ' . $_SESSION['userData']['apellidos_usuario']; ?>"
                    readonly>
                  <!-- Campo oculto para almacenar el usuario_id -->
                  <input type="hidden" id="usuarioId" name="usuarioId"
                    value="<?= $_SESSION['userData']['id_usuario']; ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="txtFechaHoraR">Fecha y hora de recepción <span class="required">*</span></label>
                  <input class="form-control" id="txtFechaHoraR" name="txtFechaHoraR"
                    value="<?php echo date('Y/m/d H:i:s'); ?>" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="archivoDocumento">Subir Documento <span class="required">*</span></label>
                  <input type="file" class="form-control" id="archivoDocumento" name="archivoDocumento"
                    accept=".pdf,.doc,.docx,.xls,.xlsx" required="">
                  <div class="mt-3 text-center">
                    <span id="nombreArchivoActual" style="font-size:24px;"></span>
                  </div>
                </div>
              </div><br><br>
              <div class="form-row mt-4">
                <div class="tile-footer col-md-12 text-center">
                  <button id="btnActionForm" onclick="registrarDoc(event);" class="btn btn-primary" type="button">
                    <i class="fa fa-check-circle"></i>
                    <span id="btnText">Guardar</span>
                  </button>
                  <button class="btn btn-secondary ml-2" type="reset">
                    <i class="fa fa-fw fa-lg fa-times-circle"></i>
                    Resetear
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<div class="modal fade" id="modalVerDocumento" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header header-primary text-center">
        <h5 class="modal-title" id="titleModal">Detalles del Documento</h5>
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
                  <h5 class="card-title">Título del Documento</h5>
                  <p class="card-text" id="verTituloDocumento" style="font-size: 19px;">Prueba1</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Hoja de Ruta</h5>
                  <p class="card-text" id="verHojaDeRuta" style="font-size: 19px;">20230809-001</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Usuario quien recibio el documento</h5>
                  <p class="card-text" id="verUsuario" style="font-size: 19px;">Eva Vargas</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Área</h5>
                  <p class="card-text" id="verArea" style="font-size: 19px;">Área 1</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Remitente</h5>
                  <p class="card-text" id="verRemitente" style="font-size: 19px;">Eva Vargas</p>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Fecha y hora de Recepción</h5>
                  <p class="card-text" id="verFechaRecepcion" style="font-size: 19px;">2023-08-09 19:57:24</p>
                </div>
              </div>
            </div>

            <div class="col-md-12 mb-3">
              <div class="card text-center">
                <div class="card-body">
                  <h3 class="card-title">Archivo Adjunto</h3>
                  <p class="card-text">
                    <a href="#" id="verArchivo" style="font-size: 24px;"></a>
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