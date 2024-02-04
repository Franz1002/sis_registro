<div class="modal fade" id="modalFormSalidas" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Registrar salida de documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tile">
                    <div class="tile-body">
                        <form id="formSalidas" name="formSalidas">
                            <input type="hidden" id="idSalidas" name="idSalidas" value="">

                            <div class="form-group">
                                <div class="form-group col-md-12">
                                    <label><span class="required2">Todos los campos con asterisco son
                                            obligatorios</span>:</label>
                                </div>

                                <label class="control-label">Entregado por <span class="required">*</span>:</label>
                                <input class="form-control" id="txtUsuario" name="txtUsuario" type="text" required=""
                                    value="<?= $_SESSION['userData']['nombres_usuario'] . ' ' . $_SESSION['userData']['apellidos_usuario']; ?>"
                                    readonly>
                                <!-- Campo oculto para almacenar el usuario_id -->
                                <input type="hidden" id="usuarioId" name="usuarioId"
                                    value="<?= $_SESSION['userData']['id_usuario']; ?>">
                            </div>

                            <div class="form-group">
                                <label for="listArchivo">Documento (Archivo) <span class="required">*</span>:</label>
                                <input type="text" name="listArchivo" id="listArchivo" class="form-control"
                                    data-id="id_doc" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <input type="text" name="tituloDoc" id="tituloDoc" class="form-control" disabled
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="form-group">
                                    <label>Hoja de ruta</label>
                                    <input type="text" name="hojaRuta" id="hojaRuta" class="form-control" disabled
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="form-group">
                                    <label>Recibido de</label>
                                    <input type="text" name="remitenteD" id="remitenteD" class="form-control" disabled
                                        required>
                                </div>
                            </div>
                            <div class="form-group col-sm-12">
                                <div class="form-group">
                                    <label>Archivo</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="archivoIcon"></span>
                                        </div>
                                        <input type="text" name="archivo" id="archivo" class="form-control" disabled
                                            required>
                                        <div class="input-group-append">
                                            <a href="" id="archivoLink" target="_blank" style="display: none;"
                                                class="btn btn-outline-secondary">
                                                <i class="fa fa-file"></i> Ver Archivo
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="txtDestinatario">Entregado a (Destinatario)<span
                                        class="required">*</span>:</label>
                                <input class="form-control" id="txtDestinatario" name="txtDestinatario"
                                    placeholder="Nombre y Apellido de la persona quien recibe el documento" required="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Fecha y hora de salida <span
                                        class="required">*</span>:</label>
                                <input class="form-control" id="txtFechaHoraS" name="txtFechaHoraS"
                                    value="<?php echo date('Y/m/d H:i:s'); ?>" readonly>
                            </div>
                            <div class="tile-footer text-center">

                                <button id="btnActionForm" onclick="registrarDocSalida(event);" class="btn btn-primary"
                                    type="button"><i class="fa fa-check-circle"></i><span
                                        id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;
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


<div class="modal fade" id="modalVerDocSalida" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header header-primary text-center">
                <h5 class="modal-title" id="titleModal">Detalles de la Salida del Documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Título del Documento:</h5>
                                    <p class="card-text" id="verTituloDocumento" style="font-size: 19px;">Prueba1</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Hoja de Ruta:</h5>
                                    <p class="card-text" id="verHojaDeRuta" style="font-size: 19px;">20230809-001</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Área:</h5>
                                    <p class="card-text" id="verArea" style="font-size: 19px;">Área 1</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Remitente:</h5>
                                    <p class="card-text" id="verRemitente" style="font-size: 19px;">Eva Vargas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Fecha y hora de Recepción:</h5>
                                    <p class="card-text" id="verFechaRecepcion" style="font-size: 19px;">2023-08-09
                                        19:57:24</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Usuario quien entregó el documento:</h5>
                                    <p class="card-text" id="verUsuario" style="font-size: 19px;">Eva Vargas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Destinatario:</h5>
                                    <p class="card-text" id="verDestinatario" style="font-size: 19px;">Eva Vargas</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title text-dark">Fecha y hora de salida:</h5>
                                    <p class="card-text" id="verFechaSalida" style="font-size: 19px;">2023-08-09
                                        19:57:24</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="card-title text-dark">Archivo Adjunto:</h3>
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
                <button class="btn btn-primary" type="button" data-dismiss="modal"
                    style="font-size: 26px;">Cerrar</button>
            </div>
        </div>
    </div>
</div>