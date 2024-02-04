<?php headerAdmin($data);
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">


    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <div class="row">
              <div class="col-md-12 text-center">
                <h4>
                  <?= $data['page_tag']; ?>
                </h4>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <div class="row">
              <div class="col-md-12">
                <div class="tile">
                  <div class="tile-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered" id="tableDocumentosRural">
                        <thead>
                          <tr>
                            <th>Hoja de ruta</th>
                            <th>Título</th>
                            <th>Recibido por</th>
                            <th>Área</th>
                            <th>Remitente</th>
                            <th>Fecha y hora recibido</th>
                            <th>Archivo</th>
                            <th>Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>7</td>
                            <td>8</td>

                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>



          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- /page content -->

<!-- footer content -->
<footer>
  <div class="pull-right">
    <a> ITSA - Proyecto de grado by <a href="https://colorlib.com">Camila Salinas Yarhui</a>
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>


<div class="modal fade" id="modalVerDocumentoRural" tabindex="-1" role="dialog" aria-hidden="true">
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
                  <h5 class="card-title">Fecha de Recepción</h5>
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
<?php footerAdmin($data); ?>